<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'genero',
        'telefono',
        'direccion',
        'usuario_id'
    ];

    public function usuario(): BelongsTo {
        return $this->BelongsTo(Usuario::class, 'usuario_id');
    }

    public function vehiculos(): HasMany {
        return $this->hasMany(Vehiculo::class, 'cliente_id');
    }

}
