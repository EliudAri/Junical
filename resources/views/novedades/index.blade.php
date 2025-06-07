<x-guest-layout>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre de la Novedad</th>
                    <th>Torre</th>
                    <th>Piso</th>
                    <th>Descripción</th>
                    <th>Reportado por</th>
                    <th>Fecha y Hora de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($novedades as $novedad)
                    <tr>
                        <td>{{ $novedad->area }}</td>
                        <td>{{ $novedad->torre }}</td>
                        <td>{{ $novedad->piso }}</td>
                        <td>{{ $novedad->descripcion }}</td>
                        <td>{{ $novedad->usuario_reportador }}</td>
                        <td>{{ $novedad->fecha_hora_creacion }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('novedades.edit', $novedad->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#showNovedadModal{{ $novedad->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modales para cada novedad -->
    @foreach ($novedades as $novedad)
        <div class="modal fade" id="showNovedadModal{{ $novedad->id }}" tabindex="-1"
            aria-labelledby="showNovedadModalLabel{{ $novedad->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="showNovedadModalLabel{{ $novedad->id }}">
                            <i class="fas fa-clinic-medical me-2"></i>
                            Novedad: {{ $novedad->area }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-4"><i class="fas fa-info-circle me-2"></i>Información General</h6>
                                        <div class="mb-3 p-2 bg-white rounded">
                                            <strong class="text-primary">Nombre de la Novedad:</strong> 
                                            <span class="ms-2">{{ $novedad->area }}</span>
                                        </div>
                                        <div class="mb-3 p-2 bg-white rounded">
                                            <strong class="text-primary">Ubicación:</strong>
                                            <span class="ms-2">Torre {{ $novedad->torre }}, Piso {{ $novedad->piso }}</span>
                                        </div>
                                        <div class="mb-3 p-2 bg-white rounded">
                                            <strong class="text-primary">Descripción:</strong>
                                            <p class="mb-0 ms-2">{{ $novedad->descripcion }}</p>
                                        </div>
                                        <div class="mb-3 p-2 bg-white rounded">
                                            <strong class="text-primary">Responsable del Reporte:</strong>
                                            <span class="ms-2">{{ $novedad->usuario_reportador }}</span>
                                        </div>
                                        <div class="mb-3 p-2 bg-white rounded">
                                            <strong class="text-primary">Fecha de Registro:</strong>
                                            <span class="ms-2">{{ $novedad->fecha_hora_creacion }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="text-primary mb-4"><i class="fas fa-camera me-2"></i>Registro Fotográfico</h6>
                                        @if ($novedad->imagenes && count($novedad->imagenes) > 0)
                                            <div id="carouselNovedad{{ $novedad->id }}" class="carousel slide rounded overflow-hidden shadow-sm" 
                                                data-bs-ride="carousel" 
                                                data-bs-interval="10000">
                                                <div class="carousel-inner">
                                                    @foreach ($novedad->imagenes as $key => $imagen)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/' . $imagen) }}"
                                                                class="d-block w-100" alt="Imagen de la novedad">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if (count($novedad->imagenes) > 1)
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#carouselNovedad{{ $novedad->id }}"
                                                        data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Anterior</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#carouselNovedad{{ $novedad->id }}"
                                                        data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Siguiente</span>
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <div class="text-center p-4 bg-white rounded">
                                                <i class="fas fa-image text-muted fa-3x mb-3"></i>
                                                <p class="text-muted mb-0">No hay imágenes disponibles</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-guest-layout>
