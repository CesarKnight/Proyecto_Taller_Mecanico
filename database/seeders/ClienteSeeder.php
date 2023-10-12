<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'ci' => '112233',
            'nombre' => 'Pablo ALexis',
            'apellido' => 'Lijeron Añez',
            'genero' => 'M',
            'telefono' => '77115546',
            'direccion' => 'Direccion 1',
            'usuario_id' => '3',
        ]);

        Cliente::create([
            'ci' => '445577',
            'nombre' => 'Eben Ezer',
            'apellido' => 'Cayo Terrazas',
            'genero' => 'M',
            'telefono' => '66774412',
            'direccion' => 'Direccion 2',
            'usuario_id' => '4',
        ]);

        Cliente::create([
            'ci' => '774422',
            'nombre' => 'Diego',
            'apellido' => 'Iglesias Godoy',
            'genero' => 'M',
            'telefono' => '74851595',
            'direccion' => 'Direccion 3',
            'usuario_id' => '5',
        ]);

        Cliente::create([
            'ci' => '667744',
            'nombre' => 'Mauricio',
            'apellido' => 'Banegas Lopez',
            'genero' => 'M',
            'telefono' => '76547144',
            'direccion' => 'Direccion 4',
            'usuario_id' => '6',
        ]);
    }
}
