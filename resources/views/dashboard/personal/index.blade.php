<x-layouts.app>

    <x-layouts.content title="Personal" subtitle="" name="Personal">

        <div class="row">
            <div class="col-12">

                <div class="mb-2 d-flex justify-content-between">

                    <div class="form-group">
                        <a href="{{ route('personal.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            Nuevo Empleado
                        </a>
                    </div>

                </div>

                <div class="card-box">

                    <div class="table-responsive">
                        <table id="table-personal" class="table table-hover mb-0 dts">
                            <thead class="bg-dark text-center text-white text-nowrap">
                                <tr style="cursor: pointer">
                                    <th scope="col">CI</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">Puesto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $empleado)
                                <tr class="text-nowrap text-center">
                                    <th scope="row" class="align-middle">{{ $empleado->ci }}</th>
                                    <td class="align-middle">{{ $empleado->nombre }}</td>
                                    <td class="align-middle">{{ $empleado->apellido }}</td>
                                    <td class="align-middle">{{ $empleado->direccion }}</td>
                                    <td class="align-middle">{{ $empleado->telefono }}</td>
                                    <td class="align-middle">{{ $empleado->genero }}</td>
                                    <td class="align-middle">{{ $empleado->puesto->nombre }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" title="Ver" class="btn btn-sm btn-warning"><i
                                                class="fas fa-eye"></i></button>
                                        <a href="{{ route('personal.edit', $empleado->id) }}" title="Editar" class="btn btn-sm btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('personal.delete', $empleado->id) }}" title="Eliminar" class="btn btn-sm btn-danger" data-confirm-delete="true"><i
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
