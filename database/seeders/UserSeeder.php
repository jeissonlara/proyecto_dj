<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Prevent dupes if migrating fresh
        // User::truncate(); // be careful

        if(!User::where('email', 'admin@admin.com')->exists()){
            User::create([
                'name' => 'Jose David Garcia',
                'email' => 'josegarcia2304@admin.com',
                'password' => 'password',
                'role' => User::ROLE_ADMIN,
            ]);
        }

        if(!User::where('email', 'djfernandomix@dj.com')->exists()){
            User::create([
                'name' => 'DJ Fernando Mix',
                'email' => 'djfernandomix@dj.com',
                'password' => 'password',
                'role' => User::ROLE_DJ,
            ]);
        }

        if(!User::where('email', 'djcarlosmedina@dj.com')->exists()){
            User::create([
                'name' => 'DJ Carlos Medina',
                'email' => 'djcarlosmedina@dj.com',
                'password' => 'password',
                'role' => User::ROLE_DJ,
            ]);
        } 

        if(!User::where('email', 'djdavidmusic45@dj.com')->exists()){
            User::create([
                'name' => 'DJ David Music',
                'email' => 'djdavidmusic45@dj.com',
                'password' => 'password',
                'role' => User::ROLE_DJ,
            ]);
        }

        if(!User::where('email', 'djpeñacolombia@dj.com')->exists()){
            User::create([
                'name' => 'DJ Peña Colombia',
                'email' => 'djpeñacolombia@dj.com',
                'password' => 'password',
                'role' => User::ROLE_DJ,
            ]);
        }

        if(!User::where('email', 'cliente@cliente.com')->exists()){
            User::create([
                'name' => 'Cliente Ejemplo',
                'email' => 'cliente@cliente.com',
                'password' => 'password',
                'role' => User::ROLE_CLIENT,
            ]);
        }
    }
}
