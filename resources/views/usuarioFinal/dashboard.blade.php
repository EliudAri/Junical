<x-guest-layout>
    <div class="container-fluid py-4 px-3 px-md-4">
        <!-- Acciones Pendientes -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-warning text-white py-3">
                <h5 class="mb-0 fs-5">Mis Acciones Pendientes</h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <p class="mb-0">No hay acciones pendientes</p>
            </div>
        </div>

        <!-- Grid de Servicios -->
        <div class="row g-3 g-md-4">
            <!-- Problemas de Infraestructura -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-wrench fa-2x text-primary me-3"></i>
                            <h5 class="card-title mb-0 fs-5">Mantenimiento de Instalaciones</h5>
                        </div>
                        <p class="card-text">Reporte problemas de infraestructura como: aire acondicionado, iluminación, mobiliario, baños, electricidad o cualquier desperfecto en las instalaciones.</p>
                        <a href="#" class="btn btn-primary w-100 w-md-auto">Reportar Desperfecto</a>
                    </div>
                </div>
            </div>

            <!-- Solicitar Equipo -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-laptop fa-2x text-success me-3"></i>
                            <h5 class="card-title mb-0 fs-5">Solicitar Equipo</h5>
                        </div>
                        <p class="card-text">Solicite hardware de computadora, periféricos u otro equipo de oficina</p>
                        <a href="#" class="btn btn-success w-100 w-md-auto">Solicitar</a>
                    </div>
                </div>
            </div>

            <!-- Soporte Técnico -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-headset fa-2x text-info me-3"></i>
                            <h5 class="card-title mb-0 fs-5">Soporte Técnico</h5>
                        </div>
                        <p class="card-text">Solicite ayuda con TI u otros problemas relacionados con la tecnología</p>
                        <a href="#" class="btn btn-info text-white w-100 w-md-auto">Solicitar Ayuda</a>
                    </div>
                </div>
            </div>

            <!-- Formación y Educación -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-graduation-cap fa-2x text-warning me-3"></i>
                            <h5 class="card-title mb-0 fs-5">Formación y Educación</h5>
                        </div>
                        <p class="card-text">Solicitar acceso a programas o sesiones de capacitación</p>
                        <a href="#" class="btn btn-warning w-100 w-md-auto">Ver Programas</a>
                    </div>
                </div>
            </div>

            <!-- Reubicación de Oficina -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-building fa-2x text-secondary me-3"></i>
                            <h5 class="card-title mb-0 fs-5">Reubicación de Oficina</h5>
                        </div>
                        <p class="card-text">Pídale al equipo de instalaciones que lo ayude a mover oficinas</p>
                        <a href="#" class="btn btn-secondary w-100 w-md-auto">Solicitar Reubicación</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .card-title {
                font-size: 1.1rem !important;
            }
            .card-text {
                font-size: 0.9rem;
            }
            .btn {
                margin-top: 1rem;
                padding: 0.5rem;
            }
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .btn {
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Mejoras de accesibilidad */
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        /* Asegurar contraste adecuado */
        .card-header {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        /* Mejoras de espaciado para dispositivos móviles */
        @media (max-width: 576px) {
            .container-fluid {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1rem;
            }

            .d-flex.align-items-center {
                flex-direction: column;
                text-align: center;
            }

            .d-flex.align-items-center i {
                margin-bottom: 0.5rem;
                margin-right: 0 !important;
            }

            .card-title {
                text-align: center;
            }
        }
    </style>
</x-guest-layout>