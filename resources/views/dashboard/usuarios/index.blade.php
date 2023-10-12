<x-layouts.app>

    <x-layouts.content title="Usuarios" subtitle="" name="Usuarios">

        <div class="row">
            <div class="col-12">

                {{-- <div class="mb-2 d-flex justify-content-between">

                    <div class="form-group">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            Nuevo Cliente
                        </a>
                    </div>

                </div> --}}

                <div class="card-box">

                    <div class="table-responsive">
                        <table id="table-usuarios" class="table table-hover mb-0 dts">
                            <thead class="bg-dark text-center text-white text-nowrap">
                                <tr style="cursor: pointer">
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre del usuario</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $usuario)
                                <tr class="text-nowrap text-center">
                                    <th scope="row" class="align-middle">{{ $usuario->id }}</th>
                                    <td class="align-middle">{{ $usuario->empleado->nombre}} {{ $usuario->empleado->apellido }}</td>
                                    <td class="align-middle">{{ $usuario->email }}</td>
                                    <td class="align-middle">{{ $usuario->rol->nombre }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" title="Ver" class="btn btn-sm btn-warning"><i
                                                class="fas fa-eye"></i></button>
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar" class="btn btn-sm btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('usuarios.delete', $usuario->id) }}" title="Eliminar" class="btn btn-sm btn-danger" data-confirm-delete="true"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </x-layouts.content>

</x-layouts.app>
