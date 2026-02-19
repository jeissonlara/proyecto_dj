<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Reserva;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role Constants
    const ROLE_ADMIN = 'admin';
    const ROLE_DJ = 'dj';
    const ROLE_CLIENT = 'client';

    // Accessors / Helpers
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDj(): bool
    {
        return $this->role === self::ROLE_DJ;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Events assigned to DJ
    public function events()
    {
        return $this->hasMany(Reserva::class, 'dj_id');
    }
}
