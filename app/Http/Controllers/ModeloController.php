<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ModeloController extends Controller
{
    public function index()
    {
        $data = Modelo::all();
        return view('dashboard.modelos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('dashboard.modelos.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|unique:modelos',
            'marca_id' => 'required',
        ]);

        // Crear un nuevo puesto relacionado con el usuario
        $modelo = new Modelo();
        $modelo->nombre = $request->nombre;
        $modelo->marca_id = $request->marca_id;
        $modelo->save();

        alert()->success('¡Guardado!','El modelo ha sido guardado exitosamente.');
        return redirect()->route('modelos.index');
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
        $modelo = Modelo::find($id);
        $marcas = Marca::all();
        return view('dashboard.modelos.edit', compact('modelo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $modelo = Modelo::find($request->id);

        if (!$modelo) {
            // Si no se encuentra el modelo, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('modelos.edit', $request->id);
        }

        // Validación de datos
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('modelos', 'nombre')->ignore($modelo->id),
            ],
            'marca_id' => 'required',
        ]);

        // Actualiza los datos del marca con los valores del formulario
        $modelo->nombre = $request->nombre;
        $modelo->marca_id = $request->marca_id;
        $modelo->save();

        alert()->success('¡Actualizado!','El modelo ha sido actualizado exitosamente.');
        return redirect()->route('modelos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        // Encuentra el modelo por su ID
        $modelo = Modelo::find($id);

        if (!$modelo) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('modelos.index');
        }

        // Elimina el empleado
        $modelo->delete();

        alert()->success('¡Eliminado!','El modelo ha sido eliminado exitosamente.');
        return redirect()->route('modelos.index');
    }
}
