
<div class="container">
    <div class="row">
        @foreach ($areas as $area)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-container">
                        @if ($area->imagenes && count($area->imagenes) > 0)
                            <div id="carousel-{{ $area->id }}" class="carousel slide">
                                <div class="carousel-indicators">
                                    @foreach ($area->imagenes as $index => $imagen)
                                        <button type="button" data-bs-target="#carousel-{{ $area->id }}"
                                            data-bs-slide-to="{{ $index }}"
                                            class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-label="Slide {{ $index + 1 }}">
                                        </button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($area->imagenes as $index => $imagen)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $imagen) }}" class="d-block w-100"
                                                alt="{{ $area->area }}">
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($area->imagenes) > 1)
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carousel-{{ $area->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Anterior</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carousel-{{ $area->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Siguiente</span>
                                    </button>
                                @endif
                            </div>
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="Sin imagen">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $area->area }}</h5>
                        <p class="card-text">
                            <strong>Torre:</strong> {{ $area->torre }}<br>
                            <strong>Piso:</strong> {{ $area->piso }}<br>
                            <strong>Descripción:</strong> {{ $area->descripcion }}
                        </p>
                    </div>
                    <div class="card-footer bg-light border-top-0 text-center">
                        <a href="{{ route('areas.edit', $area) }}" class="btn btn-outline-primary">Editar</a>
                        <form action="{{ route('areas.destroy', $area) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .card-img-container {
        height: 200px;
        overflow: hidden;
        border-radius: 0.5rem;
    }

    .carousel,
    .carousel-inner,
    .carousel-item {
        height: 100%;
    }

    .carousel-item img {
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .carousel-indicators {
        margin-bottom: 0;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
    }
</style>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousels = document.querySelectorAll('.carousel');
            carousels.forEach(carouselElement => {
                const carousel = new bootstrap.Carousel(carouselElement, {
                    interval: 3000,
                    wrap: true,
                    touch: true
                });
            });
        });
    </script>
@endsection
