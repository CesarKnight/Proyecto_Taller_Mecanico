<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    public function index()
    {
        $data = Marca::all();
        return view('dashboard.marcas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.marcas.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marca = Marca::find($id);
        return view('dashboard.marcas.edit', compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|unique:marcas',
        ]);

        // Crear un nuevo puesto relacionado con el usuario
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->save();

        alert()->success('¡Guardado!','La marca ha sido guardado exitosamente.');
        return redirect()->route('marcas.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $marca = Marca::find($request->id);
        
        // Validación de datos
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('marcas', 'nombre')->ignore($marca->id),
            ],
        ]);

        if (!$marca) {
            // Si no se encuentra el marca, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('marcas.edit', $request->id);
        }

        // Actualiza los datos del marca con los valores del formulario
        $marca->nombre = $request->nombre;
        $marca->save();

        alert()->success('¡Actualizado!','El cargo ha sido actualizado exitosamente.');
        return redirect()->route('marcas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el marca por su ID
        $marca = Marca::find($id);

        if (!$marca) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('marcas.index');
        }

        // Elimina el empleado
        $marca->delete();

        alert()->success('¡Eliminado!','La marca ha sido eliminado exitosamente.');
        return redirect()->route('marcas.index');
    }
}
