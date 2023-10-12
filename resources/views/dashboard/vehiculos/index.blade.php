<x-layouts.app>

    <x-layouts.content title="Listado de vehiculos" subtitle="" name="Listado de vehiculos">

        <div class="row">
            <div class="col-12">

                <div class="mb-2 d-flex justify-content-between">

                    <div class="form-group">
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            Nuevo Vehiculo
                        </a>
                    </div>

                </div>

                <div class="card-box">

                    <div class="table-responsive">
                        <table id="table-vehiculos" class="table table-hover mb-0 dts">
                            <thead class="bg-dark text-center text-white text-nowrap">
                                <tr style="cursor: pointer">
                                    <th scope="col">Placa</th>
                                    <th scope="col">Nro Chasis</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Cliente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $vehiculo)
                                <tr class="text-nowrap text-center">
                                    <th scope="row" class="align-middle">{{ $vehiculo->placa }}</th>
                                    <td class="align-middle">{{ $vehiculo->nro_chasis }}</td>
                                    <td class="align-middle">{{ $vehiculo->año }}</td>
                                    <td class="align-middle">{{ $vehiculo->color }}</td>
                                    <td class="align-middle">{{ $vehiculo->marca->nombre }}</td>
                                    <td class="align-middle">{{ $vehiculo->modelo->nombre }}</td>
                                    <td class="align-middle">{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellido }}</</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" title="Ver" class="btn btn-sm btn-warning"><i
                                                class="fas fa-eye"></i></button>
                                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" title="Editar" class="btn btn-sm btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('vehiculos.delete', $vehiculo->id) }}" title="Eliminar" class="btn btn-sm btn-danger" data-confirm-delete="true"><i
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
