<x-guest-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table table-striped text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tipo de Equipo</th>
                            <th>Pertenece</th>
                            <th>Serial CPU</th>
                            <th>Serial Monitor</th>
                            <th>Serial MAC</th>
                            <th>Serial Físico Monitor</th>
                            <th>Área</th>
                            <th>Jefe Área</th>
                            <th>Torre</th>
                            <th>IP Equipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventarios as $inventario)
                        <tr>
                            <td>{{ $inventario->tipo_equipo }}</td>
                            <td>{{ $inventario->pertenece }}</td>
                            <td>{{ $inventario->serial_cpu }}</td>
                            <td>{{ $inventario->serial_monitor }}</td>
                            <td>{{ $inventario->serial_mac }}</td>
                            <td>{{ $inventario->serial_fisico_monitor }}</td>
                            <td>{{ $inventario->area }}</td>
                            <td>{{ $inventario->jefe_area }}</td>
                            <td>{{ $inventario->torre }}</td>
                            <td>{{ $inventario->ip_equipo }}</td>
                            <td class="text-center">
                                <!-- Aquí puedes agregar iconos para editar, eliminar y visualizar -->
                                <button class="btn btn-link p-0" data-toggle="modal" data-target="#modalEquipo{{ $inventario->id }}">
                                    <i class="fas fa-eye fa-sm"></i>
                                </button>
                                <button class="btn btn-link p-0">
                                    <i class="fas fa-edit fa-sm"></i>
                                </button>
                                <button class="btn btn-link p-0">
                                    <i class="fas fa-trash fa-sm"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalEquipo{{ $inventario->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $inventario->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="modalLabel{{ $inventario->id }}">Detalles del Equipo</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Tipo de Equipo:</strong> {{ $inventario->tipo_equipo }}</li>
                                                    <li class="list-group-item"><strong>Pertenece:</strong> {{ $inventario->pertenece }}</li>
                                                    <li class="list-group-item"><strong>Serial CPU:</strong> {{ $inventario->serial_cpu }}</li>
                                                    <li class="list-group-item"><strong>Serial Monitor:</strong> {{ $inventario->serial_monitor }}</li>
                                                    <li class="list-group-item"><strong>Serial MAC:</strong> {{ $inventario->serial_mac }}</li>
                                                    <li class="list-group-item"><strong>Capacidad Disco:</strong> {{ $inventario->capacidad_disco }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Capacidad RAM:</strong> {{ $inventario->capacidad_ram }}</li>
                                                    <li class="list-group-item"><strong>Tipo Procesador:</strong> {{ $inventario->tipo_procesador }}</li>
                                                    <li class="list-group-item"><strong>Marca Monitor:</strong> {{ $inventario->marca_monitor }}</li>
                                                    <li class="list-group-item"><strong>Área:</strong> {{ $inventario->area }}</li>
                                                    <li class="list-group-item"><strong>Jefe Área:</strong> {{ $inventario->jefe_area }}</li>
                                                    <li class="list-group-item"><strong>IP Equipo:</strong> {{ $inventario->ip_equipo }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>Información Adicional</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Sistema Operativo:</strong> {{ $inventario->sistema_operativo }}</li>
                                            <li class="list-group-item"><strong>Versión Office:</strong> {{ $inventario->version_office }}</li>
                                            <li class="list-group-item"><strong>Tipo Antivirus:</strong> {{ $inventario->tipo_antivirus }}</li>
                                            <li class="list-group-item"><strong>Periféricos:</strong> {{ $inventario->perifericos ? 'Sí' : 'No' }}</li>
                                            <li class="list-group-item"><strong>Marca Teclado:</strong> {{ $inventario->marca_teclado }}</li>
                                            <li class="list-group-item"><strong>Marca Mouse:</strong> {{ $inventario->marca_mouse }}</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-guest-layout>