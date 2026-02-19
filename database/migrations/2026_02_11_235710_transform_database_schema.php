<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Users: Add role
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'dj', 'client'])->default('client')->after('email');
            }
        });

        // 2. Equipos: Add tipo, estado; Remove categoria_id
        Schema::table('equipos', function (Blueprint $table) {
            if (!Schema::hasColumn('equipos', 'tipo')) {
                $table->string('tipo')->after('nombre'); // cabina, consola, luces, humo, microfono, accesorios
            }
            if (!Schema::hasColumn('equipos', 'estado')) {
                $table->string('estado')->default('disponible')->after('cantidad_disponible');
            }
            if (Schema::hasColumn('equipos', 'categoria_id')) {
                // Drop foreign key first. Standard name format: table_column_foreign
                $table->dropForeign(['categoria_id']); 
                $table->dropColumn('categoria_id');
            }
        });

        // 3. Reservas: Fix dj_id to reference users
        Schema::table('reservas', function (Blueprint $table) {
             if (Schema::hasColumn('reservas', 'dj_id')) {
                 $table->dropForeign(['dj_id']);
                 $table->dropColumn('dj_id');
             }
        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->unsignedBigInteger('dj_id')->nullable()->after('plan_id');
            $table->foreign('dj_id')->references('id')->on('users');
        });

        // 4. Drop obsolete tables
        Schema::dropIfExists('djs');
        Schema::dropIfExists('categorias_equipos');
    }

    public function down(): void
    {
        // Simplified down
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
