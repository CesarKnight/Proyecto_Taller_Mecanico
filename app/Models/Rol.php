<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; 

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // public function usuarios() {
    //     return $this->belongsToMany(Usuario::class, 'rol_usuario', 'rol_id', 'usuario_id');
    // }

    public function usuarios(): HasMany {
        return $this->hasMany(Usuario::class, 'rol_id');
    }

    public function permisos() {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'rol_id', 'permiso_id');
    }

}
