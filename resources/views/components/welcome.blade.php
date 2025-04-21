<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Dashboard de TI</h1>
        <p class="text-gray-600 mt-2">Resumen de actividades y métricas del departamento</p>
    </div>
    
    <!-- Resumen General - Fila Superior -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Casos Totales</p>
                    <p class="text-2xl font-bold">100</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-ticket-alt text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-green-600">
                    <i class="fas fa-arrow-up"></i> 12% vs mes anterior
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Casos Pendientes</p>
                    <p class="text-2xl font-bold">15</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-red-600">
                    <i class="fas fa-arrow-up"></i> 3% vs mes anterior
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Tiempo Promedio</p>
                    <p class="text-2xl font-bold">35 min</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-stopwatch text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-green-600">
                    <i class="fas fa-arrow-down"></i> 5% vs mes anterior
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Satisfacción</p>
                    <p class="text-2xl font-bold">92%</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-smile text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-green-600">
                    <i class="fas fa-arrow-up"></i> 2% vs mes anterior
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Gráfica de Tiempo Promedio de Atención -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Tiempo Promedio de Atención</h2>
                <select class="form-select text-sm" id="tiempoAtencionPeriodo">
                    <option value="semana">Esta Semana</option>
                    <option value="mes">Este Mes</option>
                </select>
            </div>
            <div class="h-80">
            <canvas id="tiempoAtencionChart"></canvas>
            </div>
        </div>

        <!-- Gráfica de Casos por Auxiliar -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Casos por Auxiliar</h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-full" onclick="filtrarCasos('todos')">Todos</button>
                    <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-full" onclick="filtrarCasos('pendientes')">Pendientes</button>
                </div>
            </div>
            <div class="h-80">
            <canvas id="casosAuxiliarChart"></canvas>
            </div>
        </div>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Gráfica de Demoras -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Demoras en Atención</h2>
                <div class="text-sm text-gray-500">
                    Tiempo promedio: 12 min
                </div>
            </div>
            <div class="h-64">
            <canvas id="demorasChart"></canvas>
            </div>
        </div>

        <!-- Gráfica de Casos Repetitivos -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Distribución de Casos</h2>
                <i class="fas fa-info-circle text-gray-400" title="Distribución de casos por categoría"></i>
            </div>
            <div class="h-64">
            <canvas id="casosRepetitivosChart"></canvas>
        </div>
        </div>

        <!-- Gráfica de Reportes Diarios -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Reportes Diarios</h2>
                <div class="text-sm text-gray-500">
                    Total semanal: 30
                </div>
                </div>
            <div class="h-64">
                <canvas id="reportesDiariosChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Chart.register(ChartDataLabels);
        
        // Configuración común para todos los gráficos
        Chart.defaults.font.family = 'Inter var, sans-serif';
        Chart.defaults.font.size = 12;
        Chart.defaults.plugins.legend.position = 'bottom';
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        Chart.defaults.plugins.tooltip.titleFont.size = 14;
        Chart.defaults.plugins.tooltip.titleFont.weight = 'bold';

    // Gráfica de Tiempo de Atención
        new Chart(document.getElementById('tiempoAtencionChart'), {
        type: 'line',
        data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
            datasets: [{
                    label: 'Tiempo Real',
                data: [30, 45, 25, 40, 35],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgb(59, 130, 246)'
                }, {
                    label: 'Objetivo',
                    data: [30, 30, 30, 30, 30],
                    borderColor: 'rgba(220, 220, 220, 0.5)',
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' min';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' min';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
        }
    });

    // Gráfica de Casos por Auxiliar
        new Chart(document.getElementById('casosAuxiliarChart'), {
        type: 'bar',
        data: {
                labels: ['Camilo', 'Felipe', 'Jaime'],
            datasets: [{
                    label: 'Casos Resueltos',
                    data: [12, 17, 10],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 6
                }, {
                    label: 'Casos Pendientes',
                    data: [3, 3, 2],
                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        }
                    }
                }
        }
    });

    // Gráfica de Demoras
        new Chart(document.getElementById('demorasChart'), {
        type: 'line',
        data: {
            labels: ['9:00', '10:00', '11:00', '12:00', '13:00'],
            datasets: [{
                label: 'Demoras (minutos)',
                data: [10, 15, 5, 20, 10],
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgb(239, 68, 68)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Demora: ' + context.parsed.y + ' minutos';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' min';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
        }
    });

    // Gráfica de Casos Repetitivos
        new Chart(document.getElementById('casosRepetitivosChart'), {
            type: 'doughnut',
        data: {
            labels: ['Hardware', 'Software', 'Red', 'Otros'],
            datasets: [{
                data: [25, 30, 20, 15],
                backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: function(value, context) {
                            return Math.round((value / context.dataset.data.reduce((a, b) => a + b)) * 100) + '%';
                        },
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    }
                },
                cutout: '60%'
        }
    });

    // Gráfica de Reportes Diarios
        new Chart(document.getElementById('reportesDiariosChart'), {
        type: 'bar',
        data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
            datasets: [{
                label: 'Reportes Generados',
                data: [5, 8, 6, 7, 4],
                    backgroundColor: 'rgba(139, 92, 246, 0.7)',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value) {
                            return value;
                        },
                        color: '#666',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });

    // Función para filtrar casos (simulada)
    function filtrarCasos(tipo) {
        // Aquí irá la lógica de filtrado cuando se implemente la funcionalidad completa
        const botones = document.querySelectorAll('[onclick^="filtrarCasos"]');
        botones.forEach(btn => btn.classList.replace('bg-blue-100', 'bg-gray-100'));
        botones.forEach(btn => btn.classList.replace('text-blue-600', 'text-gray-600'));
        event.target.classList.replace('bg-gray-100', 'bg-blue-100');
        event.target.classList.replace('text-gray-600', 'text-blue-600');
    }
</script>
@endpush
