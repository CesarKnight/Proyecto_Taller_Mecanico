<x-layouts.app>

    <x-layouts.content title="Permisos" subtitle="" name="Permisos">

        <div class="row">
            <div class="col-12">

                <div class="mb-2 d-flex justify-content-between">

                    <div class="form-group">
                        <select class="form-control mr-1" >
                            <option value="">Seleccionar Rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-check-circle"></i>&nbsp;
                                Sincronizar todos
                        </a>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-times-circle"></i>&nbsp;
                                Revocar todos
                        </a>
                    </div>

                </div>

                <div class="card-box">

                    <div class="table-responsive">
                        <table id="table-rol" class="table table-hover mb-0 dts">
                            <thead class="bg-dark text-center text-white text-nowrap">
                                <tr style="cursor: pointer">
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $permiso)
                                <tr class="text-nowrap text-center">
                                    <th scope="row" class="align-middle">{{ $permiso -> id }}</th>
                                    <td class="align-middle">{{ $permiso-->nombre }}</td>
                                    <td class="align-middle text-wrap">{{ $rol->id }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" title="Ver" class="btn btn-sm btn-warning"><i
                                                class="fas fa-eye"></i></button>
                                        <a href="{{ route('roles.edit', $rol->id) }}" title="Editar" class="btn btn-sm btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('roles.delete', $rol->id) }}" title="Eliminar" class="btn btn-sm btn-danger" data-confirm-delete="true"><i
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
