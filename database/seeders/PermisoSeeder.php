<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permiso::create([
            'nombre' => 'Agregar_cliente',
        ]);
        Permiso::create([
            'nombre' => 'Modificar_cliente',
        ]);
        Permiso::create([
            'nombre' => 'Eliminar_cliente',
        ]);
        Permiso::create([
            'nombre' => 'Agregar_empleado',
        ]);
        Permiso::create([
            'nombre' => 'Modificar_empleado',
        ]);
        Permiso::create([
            'nombre' => 'Eliminar_empleado',
        ]);
    }
}
