<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function cliente(): HasOne {
        return $this->HasOne(Cliente::class, 'usuario_id');
    }

    public function empleado(): HasOne {
        return $this->HasOne(Empleado::class, 'usuario_id');
    }

    // public function roles() {
    //     return $this->belongsToMany(Rol::class, 'rol_usuario', 'usuario_id', 'rol_id');
    // }

    public function rol(): BelongsTo {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

}
