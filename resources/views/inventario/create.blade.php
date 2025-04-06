<x-guest-layout>

    <form action="{{ route('inventario.store') }}" method="POST" class="container mt-4" id="inventarioForm" novalidate>
        <!-- EL ATRIBUTO "novalidate" ES PARA DESACTIVAR LA VALIDACION NATIVA DEL NAVEGADOR. -->
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tipo_equipo" class="form-label">Tipo de equipo:</label>
                <select id="tipo_equipo" name="tipo_equipo" class="form-select" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="Escritorio" {{ old('tipo_equipo') == 'Escritorio' ? 'selected' : '' }}>Escritorio</option>
                    <option value="Laptop" {{ old('tipo_equipo') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="pertenece" class="form-label">Pertenece a:</label>
                <select id="pertenece" name="pertenece" class="form-select" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Propio" {{ old('pertenece') == 'Propio' ? 'selected' : '' }}>Propio</option>
                    <option value="Milenio" {{ old('pertenece') == 'Milenio' ? 'selected' : '' }}>De Milenio</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="serial_cpu" class="form-label">Serial CPU:</label>
                <input type="text" id="serial_cpu" name="serial_cpu" class="form-control" value="{{ old('serial_cpu') }}" required>
            </div>
            <div class="col-md-6">
                <label for="serial_monitor" class="form-label">Serial Monitor:</label>
                <input type="text" id="serial_monitor" name="serial_monitor" class="form-control" value="{{ old('serial_monitor') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="serial_mac" class="form-label">Serial MAC:</label>
                <input type="text" id="serial_mac" name="serial_mac" class="form-control" value="{{ old('serial_mac') }}" required>
            </div>
            <div class="col-md-6">
                <label for="serial_fisico_monitor" class="form-label">Serial Físico del Monitor:</label>
                <input type="text" id="serial_fisico_monitor" name="serial_fisico_monitor" class="form-control" value="{{ old('serial_fisico_monitor') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="capacidad_disco" class="form-label">Capacidad del Disco:</label>
                <input type="text" id="capacidad_disco" name="capacidad_disco" class="form-control" value="{{ old('capacidad_disco') }}" required>
            </div>
            <div class="col-md-6">
                <label for="tipo_disco" class="form-label">Tipo de Disco:</label>
                <select id="tipo_disco" name="tipo_disco" class="form-control" required>
                    <option value="">Seleccione un tipo de disco</option>
                    <option value="HDD" {{ old('tipo_disco') == 'HDD' ? 'selected' : '' }}>HDD (Disco Duro)</option>
                    <option value="SSD" {{ old('tipo_disco') == 'SSD' ? 'selected' : '' }}>SSD (Unidad de Estado Sólido)</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="capacidad_ram" class="form-label">Capacidad de la RAM:</label>
                <input type="text" id="capacidad_ram" name="capacidad_ram" class="form-control" value="{{ old('capacidad_ram') }}" required>
            </div>
            <div class="col-md-6">
                <label for="tipo_procesador" class="form-label">Tipo de Procesador:</label>
                <input type="text" id="tipo_procesador" name="tipo_procesador" class="form-control" value="{{ old('tipo_procesador') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="marca_monitor" class="form-label">Marca del Monitor:</label>
                <input type="text" id="marca_monitor" name="marca_monitor" class="form-control" value="{{ old('marca_monitor') }}" required>
            </div>
            <div class="col-md-6">
                <label for="area" class="form-label">Área:</label>
                <input type="text" id="area" name="area" class="form-control" value="{{ old('area') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="jefe_area" class="form-label">Jefe de Área:</label>
                <input type="text" id="jefe_area" name="jefe_area" class="form-control" value="{{ old('jefe_area') }}" required>
            </div>
            <div class="col-md-6">
                <label for="torre" class="form-label">Torre:</label>
                <select id="torre" name="torre" class="form-select" required>
                    <option value="">Seleccione una torre</option>
                    <option value="Torre 1" {{ old('torre') == 'Torre 1' ? 'selected' : '' }}   >Torre 1</option>
                    <option value="Torre 2" {{ old('torre') == 'Torre 2' ? 'selected' : '' }}>Torre 2</option>
                    <option value="Torre 3" {{ old('torre') == 'Torre 3' ? 'selected' : '' }}>Torre 3</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="ip_equipo" class="form-label">IP del Equipo:</label>
                <input type="text" id="ip_equipo" name="ip_equipo" class="form-control" value="{{ old('ip_equipo') }}" required>
            </div>
            <div class="col-md-6">
                <label for="sistema_operativo" class="form-label">Tipo de Sistema Operativo:</label>
                <select id="sistema_operativo" name="sistema_operativo" class="form-select" required>
                    <option value="">Seleccione un sistema operativo</option>
                    <option value="Windows 10" {{ old('sistema_operativo') == 'Windows 10' ? 'selected' : '' }} >Windows 10</option>
                    <option value="Windows 11" {{ old('sistema_operativo') == 'Windows 11' ? 'selected' : '' }}>Windows 11</option>
                    <option value="Windows 8" {{ old('sistema_operativo') == 'Windows 8' ? 'selected' : '' }}>Windows 8</option>
                    <option value="Windows 7" {{ old('sistema_operativo') == 'Windows 7' ? 'selected' : '' }}>Windows 7</option>
                    <option value="Windows Vista" {{ old('sistema_operativo') == 'Windows Vista' ? 'selected' : '' }}>Windows Vista</option>
                    <option value="Windows XP" {{ old('sistema_operativo') == 'Windows XP' ? 'selected' : '' }}>Windows XP</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="version_office" class="form-label">Versión del Office:</label>
                <select id="version_office" name="version_office" class="form-select" required>
                    <option value="">Seleccione una versión</option>
                    <option value="Office 2000" {{ old('version_office') == 'Office 2000' ? 'selected' : '' }}>Office 2000</option>
                    <option value="Office XP" {{ old('version_office') == 'Office XP' ? 'selected' : '' }}>Office XP</option>
                    <option value="Office 2003" {{ old('version_office') == 'Office 2003' ? 'selected' : '' }}>Office 2003</option>
                    <option value="Office 2007" {{ old('version_office') == 'Office 2007' ? 'selected' : '' }}>Office 2007</option>
                    <option value="Office 2010" {{ old('version_office') == 'Office 2010' ? 'selected' : '' }}>Office 2010</option>
                    <option value="Office 2013" {{ old('version_office') == 'Office 2013' ? 'selected' : '' }}>Office 2013</option>
                    <option value="Office 2016" {{ old('version_office') == 'Office 2016' ? 'selected' : '' }}>Office 2016</option>
                    <option value="Office 2019" {{ old('version_office') == 'Office 2019' ? 'selected' : '' }}>Office 2019</option>
                    <option value="Office 2021" {{ old('version_office') == 'Office 2021' ? 'selected' : '' }}>Office 2021</option>
                    <option value="Microsoft 365" {{ old('version_office') == 'Microsoft 365' ? 'selected' : '' }}>Microsoft 365</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tipo_antivirus" class="form-label">Tipo de Antivirus:</label>
                <select id="tipo_antivirus" name="tipo_antivirus" class="form-select" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="ninguno" {{ old('tipo_antivirus') == 'ninguno' ? 'selected' : '' }}>Ninguno</option>
                    <option value="Eset Nod32" {{ old('tipo_antivirus') == 'Eset Nod32' ? 'selected' : '' }}>Eset Nod32</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="perifericos" class="form-label">¿Tiene Periféricos?</label>
            <select id="perifericos" name="perifericos" class="form-select" required>
                <option value="0" {{ old('perifericos') == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('perifericos') == '1' ? 'selected' : '' }}>Sí</option>
            </select>
        </div>

        <div id="perifericos_info" style="display: none;">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="marca_teclado" class="form-label">Marca del Teclado:</label>
                    <input type="text" id="marca_teclado" name="marca_teclado" class="form-control" value="{{ old('marca_teclado') }}">
                </div>
                <div class="col-md-6">
                    <label for="marca_mouse" class="form-label">Marca del Mouse:</label>
                    <input type="text" id="marca_mouse" name="marca_mouse" class="form-control" value="{{ old('marca_mouse') }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Inventario</button>
    </form>

    <script>
        document.getElementById('perifericos').addEventListener('change', function() {
            var perifericosInfo = document.getElementById('perifericos_info');
            if (this.value === '1') {
                perifericosInfo.style.display = 'block';
            } else {
                perifericosInfo.style.display = 'none';
            }
        });

        // Mostrar alertas de SweetAlert2 en caso de errores
        @if($errors -> any())
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '¡Error!',
            html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        });
        @endif

        // Validación del formulario antes de enviarlo
        document.getElementById('inventarioForm').addEventListener('submit', function(event) {
            let errors = [];
            const requiredFields = [
                'tipo_equipo', 'pertenece', 'serial_cpu', 'serial_monitor', 'serial_mac',
                'serial_fisico_monitor', 'capacidad_disco', 'tipo_disco', 'capacidad_ram',
                'tipo_procesador', 'marca_monitor', 'area', 'jefe_area', 'torre',
                'ip_equipo', 'sistema_operativo', 'version_office', 'tipo_antivirus', 'perifericos'
            ];

            requiredFields.forEach(function(field) {
                const input = document.getElementById(field);
                if (!input.value) {
                    errors.push(`El campo ${input.previousElementSibling.innerText} es obligatorio.`);
                }
            });

            if (errors.length > 0) {
                event.preventDefault(); // Evitar el envío del formulario
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '¡Error!',
                    html: '<ul>' + errors.map(error => `<li>${error}</li>`).join('') + '</ul>',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                });
            }
        });
    </script>
</x-guest-layout>