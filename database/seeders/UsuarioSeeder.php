<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        Usuario::create([
            'email' => 'cesar@gmail.com',
            'password' => Hash::make('abc123'),
        ]);

        Usuario::create([
            'email' => 'pablo@gmail.com',
            'password' => Hash::make('54321'),
        ]);

        Usuario::create([
            'email' => 'eben@gmail.com',
            'password' => Hash::make('123abc'),
        ]);

        Usuario::create([
            'email' => 'diego@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Usuario::create([
            'email' => 'mauricio@gmail.com',
            'password' => Hash::make('xyz123'),
        ]);
    }
}
