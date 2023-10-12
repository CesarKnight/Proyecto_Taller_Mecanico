<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Puesto::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Administra todo el taller',
        ]);

        Puesto::create([
            'nombre' => 'Secreataria',
            'descripcion' => 'Se encarga de la recepción en el taller',
        ]);

        Puesto::create([
            'nombre' => 'Mecanico',
            'descripcion' => 'Se encarga de realizar las reparaciones de vehiculos en el taller',
        ]);
    }
}
