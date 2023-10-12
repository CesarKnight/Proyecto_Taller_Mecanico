<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'genero',
        'telefono',
        'direccion',
        'usuario_id',
        'puesto_id',
    ];

    public function usuario(): BelongsTo {
        return $this->BelongsTo(Usuario::class, 'usuario_id');
    }

    public function puesto(): BelongsTo {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

}
