<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Usuario::whereHas('rol', function ($query) {
            $query->where('nombre', '!=', 'Cliente');
        })->get();
        return view('dashboard.usuarios.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $usuario = Usuario::find($id);
        $roles = Rol::where('nombre', '!=', 'Cliente')->get();
        return view('dashboard.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $usuario = Usuario::find($request->id);

        // Validación de datos
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('usuarios', 'email')->ignore($usuario->id),
            ],
            'nombre' => 'required|string|min:2|max:100',
        ]);

        if (!$usuario) {
            // Si no se encuentra el cliente, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('usuarios.edit', $request->id);
        }

        // Actualiza los datos del usuario con los valores del formulario
        $usuario->email = $request->email;
        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        alert()->success('Actualizado!','El usuario ha sido actualizado exitosamente.');
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encuentra el usuario por su CI
        $usuario = Usuario::find($id);

        if (!$usuario) {
            // Si no se encuentra el usuario, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('clientes.index');
        }

        // Encuentra el empleado asociado al usuario
        $empleado = $usuario->empleado;

        if ($empleado) {
            // Elimina el empleado
            $empleado->delete();

            // Elimina el usuario
            $usuario->delete();
        }

        alert()->success('¡Eliminado!','El usuario ha sido eliminado exitosamente.');
        return redirect()->route('usuarios.index');
    }
}
