<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PermisoController;
use Illuminate\Support\Facades\Route;

/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/', [AuthController::class, 'authenticate'])->name('auth.login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'auth.admin'])->group(function() {
Route::get('/dashboard', [DefaultController::class, 'index'])->name('dashboard');

Route::get('/dashboard/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/dashboard/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::get('/dashboard/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::post('/dashboard/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/dashboard/clientes/delete/{id}', [ClienteController::class, 'destroy'])->name('clientes.delete');
Route::post('/dashboard/clientes/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');

Route::get('/dashboard/personal', [EmpleadoController::class, 'index'])->name('personal.index');
Route::get('/dashboard/personal/create', [EmpleadoController::class, 'create'])->name('personal.create');
Route::get('/dashboard/personal/edit/{id}', [EmpleadoController::class, 'edit'])->name('personal.edit');
Route::post('/dashboard/personal', [EmpleadoController::class, 'store'])->name('personal.store');
Route::get('/dashboard/personal/delete/{id}', [EmpleadoController::class, 'destroy'])->name('personal.delete');
Route::post('/dashboard/personal/update/{id}', [EmpleadoController::class, 'update'])->name('personal.update');

Route::get('/dashboard/cargo', [PuestoController::class, 'index'])->name('cargo.index');
Route::get('/dashboard/cargo/create', [PuestoController::class, 'create'])->name('cargo.create');
Route::get('/dashboard/cargo/edit/{id}', [PuestoController::class, 'edit'])->name('cargo.edit');
Route::post('/dashboard/cargo', [PuestoController::class, 'store'])->name('cargo.store');
Route::get('/dashboard/cargo/delete/{id}', [PuestoController::class, 'destroy'])->name('cargo.delete');
Route::post('/dashboard/cargo/update/{id}', [PuestoController::class, 'update'])->name('cargo.update');

Route::get('/dashboard/marcas', [MarcaController::class, 'index'])->name('marcas.index');
Route::get('/dashboard/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
Route::get('/dashboard/marcas/edit/{id}', [MarcaController::class, 'edit'])->name('marcas.edit');
Route::post('/dashboard/marcas', [MarcaController::class, 'store'])->name('marcas.store');
Route::get('/dashboard/marcas/delete/{id}', [MarcaController::class, 'destroy'])->name('marcas.delete');
Route::post('/dashboard/marcas/update/{id}', [MarcaController::class, 'update'])->name('marcas.update');

Route::get('/dashboard/modelos', [ModeloController::class, 'index'])->name('modelos.index');
Route::get('/dashboard/modelos/create', [ModeloController::class, 'create'])->name('modelos.create');
Route::get('/dashboard/modelos/edit/{id}', [ModeloController::class, 'edit'])->name('modelos.edit');
Route::post('/dashboard/modelos', [ModeloController::class, 'store'])->name('modelos.store');
Route::get('/dashboard/modelos/delete/{id}', [ModeloController::class, 'destroy'])->name('modelos.delete');
Route::post('/dashboard/modelos/update/{id}', [ModeloController::class, 'update'])->name('modelos.update');

Route::get('/dashboard/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
Route::get('/dashboard/vehiculos/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
Route::get('/dashboard/vehiculos/edit/{id}', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
Route::post('/dashboard/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
Route::get('/dashboard/vehiculos/delete/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.delete');
Route::post('/dashboard/vehiculos/update/{id}', [VehiculoController::class, 'update'])->name('vehiculos.update');

Route::get('/dashboard/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/dashboard/roles', [RolController::class, 'index'])->name('roles.index');
Route::get('/dashboard/permisos', [PermisoController::class, 'index'])->name('permisos.index');

});
