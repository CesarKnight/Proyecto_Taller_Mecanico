<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'El administrador es el encargado de supervisar todas las operaciones y la gestión general del taller.',
        ]);

        Rol::create([
            'nombre' => 'Recepcionista',
            'descripcion' => 'El recepcionista es el primer punto de contacto para los clientes que ingresan al taller.',
        ]);

        Rol::create([
            'nombre' => 'Mecánico',
            'descripcion' => 'El mecánico es el profesional especializado en la reparación y el mantenimiento de vehículos.',
        ]);

        Rol::create([
            'nombre' => 'Cliente',
            'descripcion' => 'Los clientes son propietarios de vehículos que buscan servicios de reparación, mantenimiento o inspección en el taller automotriz.',
        ]);
    }
}
