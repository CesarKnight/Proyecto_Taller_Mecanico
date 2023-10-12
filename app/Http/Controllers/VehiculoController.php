<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Vehiculo::all();
        return view('dashboard.vehiculos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $clientes = Cliente::all();
        return view('dashboard.vehiculos.create', compact('marcas', 'modelos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'placa' => 'required|unique:vehiculos',
            'nro_chasis' => 'required|unique:vehiculos',
            'año' => 'required',
            'color' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'cliente_id' => 'required',
        ]);

        // Crear un nuevo puesto relacionado con el usuario
        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->nro_chasis = $request->nro_chasis;
        $vehiculo->año = $request->año;
        $vehiculo->color = $request->color;
        $vehiculo->marca_id = $request->marca_id;
        $vehiculo->modelo_id = $request->modelo_id;
        $vehiculo->cliente_id = $request->cliente_id;
        $vehiculo->save();

        alert()->success('¡Guardado!','El vehiculo ha sido guardado exitosamente.');
        return redirect()->route('vehiculos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $clientes = Cliente::all();
        return view('dashboard.vehiculos.edit', compact('vehiculo', 'marcas', 'modelos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehiculo = Vehiculo::find($request->id);

        if (!$vehiculo) {
            // Si no se encuentra el modelo, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('vehiculos.edit', $request->id);
        }

        // Validación de datos
        $request->validate([
            'placa' => [
                'required',
                Rule::unique('vehiculos', 'placa')->ignore($vehiculo->id),
            ],
            'nro_chasis' => [
                'required',
                Rule::unique('vehiculos', 'nro_chasis')->ignore($vehiculo->id),
            ],
            'año' => 'required',
            'color' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'cliente_id' => 'required',
        ]);

        // Actualiza los datos del marca con los valores del formulario
        $vehiculo->placa = $request->placa;
        $vehiculo->nro_chasis = $request->nro_chasis;
        $vehiculo->año = $request->año;
        $vehiculo->color = $request->color;
        $vehiculo->marca_id = $request->marca_id;
        $vehiculo->modelo_id = $request->modelo_id;
        $vehiculo->cliente_id = $request->cliente_id;
        $vehiculo->save();

        alert()->success('¡Actualizado!','El vehiculo ha sido actualizado exitosamente.');
        return redirect()->route('vehiculos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encuentra el modelo por su ID
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('vehiculos.index');
        }

        // Elimina el empleado
        $vehiculo->delete();

        alert()->success('¡Eliminado!','El vehiculo ha sido eliminado exitosamente.');
        return redirect()->route('vehiculos.index');
    }
}
