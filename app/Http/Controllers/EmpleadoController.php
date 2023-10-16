<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function index()
    {
        // $data = Empleado::all();
        $data = Empleado::with('puesto')->get();
        return view('dashboard.personal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $puestos = Puesto::all();
        return view('dashboard.personal.create', compact('puestos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $usuario = $empleado->usuario;
        $puestos = Puesto::all();
        return view('dashboard.personal.edit', compact('empleado', 'usuario', 'puestos'));
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
            'puesto_id' => 'required',
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
            'rol_id' => 1
        ]);

        // Verificar que el usuario se haya creado correctamente
        if (!$user) {
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('personal.edit', $request->id);
        }

        // Crear un nuevo empleado relacionado con el usuario
        $empleado = new Empleado([
            'ci' => $request->ci,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'genero' => $request->genero,
            'puesto_id' => $request->puesto_id,
        ]);

        // Asociar el cliente con el usuario
        $user->cliente()->save($empleado);
        alert()->success('Guardado!','El empleado ha sido guardado exitosamente.');
        return redirect()->route('personal.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Encuentra el empleado por su ID con su usuario asociado
        $empleado = Empleado::with('user')->find($id);

        if (!$empleado) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Devuelve el cliente en formato JSON
        return response()->json($empleado);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $empleado = Empleado::find($request->id);

        // Validación de datos
        $request->validate([
            'ci' => [
                'required',
                Rule::unique('empleados', 'ci')->ignore($empleado->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('usuarios', 'email')->ignore($empleado->usuario->id),
            ],
            'nombre' => 'required|string|min:2|max:100',
            'apellido' => 'required|string|min:2|max:100',
            'telefono' => 'required',
            'direccion' => 'required',
            'genero' => 'required|max:1',
            'puesto_id' => 'required',
        ]);

        // Encuentra el empleado por su CI
        $empleado = Empleado::find($request->id);

        if (!$empleado) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('personal.edit', $request->id);
        }

        // Actualiza los datos del empleado con los valores del formulario
        $empleado->ci = $request->ci;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->genero = $request->genero;
        $empleado->telefono = $request->telefono;
        $empleado->direccion = $request->direccion;
        $empleado->puesto_id = $request->puesto_id;
        $empleado->save();

        // Actualiza el correo electrónico del usuario asociado (si ha cambiado)
        if ($empleado->usuario->email !== $request->email) {
            $empleado->usuario->email = $request->email;
            $empleado->usuario->save();
        }

        alert()->success('Actualizado!','El empleado ha sido actualizado exitosamente.');
        return redirect()->route('personal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el empleado por su CI
        $empleado = Empleado::find($id);

        if (!$empleado) {
            // Si no se encuentra el empleado, devuelve una respuesta de error
            alert()->error('Oops...','Ha ocurrido un error. Por favor, intenta nuevamente.');
            return redirect()->route('personal.index');
        }

        // Elimina el empleado
        $empleado->delete();

        // Encuentra el usuario asociado al empleado
        $usuario = $empleado->usuario;

        if ($usuario) {
            // Elimina el usuario
            $usuario->delete();
        }

        alert()->success('Eliminado!','El empleado ha sido eliminado exitosamente.');
        return redirect()->route('personal.index');
    }
}
