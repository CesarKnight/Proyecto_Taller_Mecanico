<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cliente::all();
        return view('dashboard.clientes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clientes.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $usuario = $cliente->usuario;
        return view('dashboard.clientes.edit', compact('cliente', 'usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'ci' => 'required|unique:clientes',
            'nombre' => 'required|string|min:2|max:100',
            'apellido' => 'required|string|min:2|max:100',
            'telefono' => 'required',
            'direccion' => 'required',
            'genero' => 'required|max:1',
            'email' => 'required|string|email|max:100|unique:usuarios',
        ]);

        // Comprueba si se proporciona un campo 'password' en la solicitud
        if ($request->has('password')) {
            $password = Hash::make($request->password);
        } else {
            // Si no se proporciona un campo 'password', usa el campo 'ci' como contraseña
            $password = Hash::make($request->ci);
        }

        // Crea el usuario con la contraseña determinada
        $user = Usuario::create([
            'email' => $request->email,
            'password' => $password,
            'rol_id' => 4
        ]);

        // Verificar que el usuario se haya creado correctamente
        if (!$user) {
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('clientes.edit', $request->id);
        }

        // Crear un nuevo cliente relacionado con el usuario
        $cliente = new Cliente([
            'ci' => $request->ci,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'genero' => $request->genero,
        ]);

        // Asociar el cliente con el usuario
        $user->cliente()->save($cliente);
        alert()->success('Guardado!','El cliente ha sido guardado exitosamente.');
        return redirect()->route('clientes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Encuentra el cliente por su ID con su usuario asociado
        $cliente = Cliente::with('user')->find($id);

        if (!$cliente) {
            // Si no se encuentra el cliente, devuelve una respuesta de error
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Devuelve el cliente en formato JSON
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $cliente = Cliente::find($request->id);

        // Validación de datos
        $request->validate([
            'ci' => [
                'required',
                Rule::unique('clientes', 'ci')->ignore($cliente->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('usuarios', 'email')->ignore($cliente->usuario->id),
            ],
            'nombre' => 'required|string|min:2|max:100',
            'apellido' => 'required|string|min:2|max:100',
            'telefono' => 'required',
            'direccion' => 'required',
            'genero' => 'required|max:1',
        ]);

        // Encuentra el cliente por su CI
        $cliente = Cliente::find($request->id);

        if (!$cliente) {
            // Si no se encuentra el cliente, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('clientes.edit', $request->id);
        }

        // Actualiza los datos del cliente con los valores del formulario
        $cliente->ci = $request->ci;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->genero = $request->genero;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        // Actualiza el correo electrónico del usuario asociado (si ha cambiado)
        if ($cliente->usuario->email !== $request->email) {
            $cliente->usuario->email = $request->email;
            $cliente->usuario->save();
        }

        alert()->success('Actualizado!','El cliente ha sido actualizado exitosamente.');
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el cliente por su CI
        $cliente = Cliente::find($id);

        if (!$cliente) {
            // Si no se encuentra el cliente, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('clientes.index');
        }

        // Elimina el cliente
        $cliente->delete();

        // Encuentra el usuario asociado al cliente
        $usuario = $cliente->usuario;

        if ($usuario) {
            // Elimina el usuario
            $usuario->delete();
        }

        alert()->success('Eliminado!','El cliente ha sido eliminado exitosamente.');
        return redirect()->route('clientes.index');
    }
}
