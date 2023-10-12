<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PuestoController extends Controller
{
    public function index()
    {
        $data = Puesto::all();
        return view('dashboard.cargos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cargos.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $puesto = Puesto::find($id);
        return view('dashboard.cargos.edit', compact('puesto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|unique:',
            'descripcion' => 'required|string|min:2|max:100',
        ]);

        // Crear un nuevo puesto relacionado con el usuario
        $puesto = new Puesto();
        $puesto->nombre = $request->nombre;
        $puesto->descripcion = $request->descripcion;
        $puesto->save();

        alert()->success('¡Guardado!','El cargo ha sido guardado exitosamente.');
        return redirect()->route('cargo.index');

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
        $puesto = Puesto::find($request->id);
        
        // Validación de datos
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('puestos', 'nombre')->ignore($puesto->id),
            ],
            'descripcion' => 'required|string|min:2|max:100',
        ]);

        // Encuentra el puesto por su ID
        $puesto = Puesto::find($request->id);

        if (!$puesto) {
            // Si no se encuentra el puesto, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('cargo.edit', $request->id);
        }

        // Actualiza los datos del puesto con los valores del formulario
        $puesto->nombre = $request->nombre;
        $puesto->descripcion = $request->descripcion;
        $puesto->save();

        alert()->success('¡Actualizado!','El cargo ha sido actualizado exitosamente.');
        return redirect()->route('cargo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el empleado por su CI
        $puesto = Puesto::find($id);

        if (!$puesto) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('cargo.index');
        }

        // Elimina el empleado
        $puesto->delete();

        alert()->success('¡Eliminado!','El cargo ha sido eliminado exitosamente.');
        return redirect()->route('cargo.index');
    }
}
