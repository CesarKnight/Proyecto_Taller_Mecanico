<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rol::all();
        return view('dashboard.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|unique:roles',
            'descripcion' => 'required|string|min:2|max:100',
        ]);

        // Crear un nuevo puesto relacionado con el usuario
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();

        alert()->success('¡Guardado!','El rol ha sido guardado exitosamente.');
        return redirect()->route('roles.index');
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
        $rol = Rol::find($id);
        return view('dashboard.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rol = Rol::find($request->id);

        // Validación de datos
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('roles', 'nombre')->ignore($rol->id),
            ],
            'descripcion' => 'required|string|min:2|max:100',
        ]);

        if (!$rol) {
            // Si no se encuentra el puesto, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('roles.edit', $request->id);
        }

        // Actualiza los datos del puesto con los valores del formulario
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();

        alert()->success('¡Actualizado!','El rol ha sido actualizado exitosamente.');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el empleado por su CI
        $rol = Rol::find($id);

        if (!$rol) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('roles.index');
        }

        // Elimina el empleado
        $rol->delete();

        alert()->success('¡Eliminado!','El rol ha sido eliminado exitosamente.');
        return redirect()->route('roles.index');
    }
}
