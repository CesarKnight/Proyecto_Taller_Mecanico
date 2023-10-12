<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empleado::create([
            'ci' => '223344',
            'nombre' => 'Benjamin',
            'apellido' => 'Condori Vasquez',
            'genero' => 'M',
            'telefono' => '66774412',
            'direccion' => 'Calle 1',
            'usuario_id' => '1',
            'puesto_id' => '1',
        ]);

        Empleado::create([
            'ci' => '447788',
            'nombre' => 'Cesar Alejandro',
            'apellido' => 'Caballero Caballero',
            'genero' => 'M',
            'telefono' => '67845422',
            'direccion' => 'Calle 2',
            'usuario_id' => '2',
            'puesto_id' => '3',
        ]);
    }
}
