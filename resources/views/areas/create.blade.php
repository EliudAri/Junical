<x-guest-layout>
    <div class="container">

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
            <!-- Solo incluimos la librería html5-qrcode -->
            <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        </head>
        <form method="POST" action="{{ route('areas.store') }}" enctype="multipart/form-data" id="yourFormId">
            @csrf
            <div class="form-group">
                <label for="area">Nombre del Área</label>
                <input type="text" class="form-control" id="area" name="area">
            </div>

            <div class="form-group">
                <label for="torre">Torre</label>
                <select class="form-control" id="torre" name="torre">
                    <option value="">Seleccione una Torre</option>
                    <option value="1">Torre 1</option>
                    <option value="2">Torre 2</option>
                    <option value="3">Torre 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="piso">Piso</label>
                <select class="form-control" id="piso" name="piso">
                    <option value="">Seleccione un Piso</option>
                    <option value="s2">Sótano 2</option>
                    <option value="s1">Sótano 1</option>
                    <option value="ss">Subsótano</option>
                    <option value="1">Piso 1</option>
                    <option value="2">Piso 2</option>
                    <option value="3">Piso 3</option>
                    <option value="4">Piso 4</option>
                    <option value="5">Piso 5</option>
                    <option value="6">Piso 6</option>
                    <option value="7">Piso 7</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>

            <div class="form-group">
                <label for="imagenes">Imágenes</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple accept="image/*">
                <small class="form-text text-muted">Puede seleccionar múltiples imágenes. Formatos permitidos: JPG, PNG,
                    GIF, etc.</small>
            </div>

            <div class="form-group mt-3">
                <div class="image-preview" id="imagePreview">
                    <!-- Las imágenes previsualizadas se mostrarán aquí -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </form>
    </div>
<script src="{{ asset('js/script.js') }}"></script>
    

    <style>
        #reader {
            width: 100%;
            max-width: 640px;
            margin: 20px auto;
        }
        #reader video {
            width: 100%;
            max-width: 640px;
        }
    </style>

    <!-- Agregar meta tags para mejorar la experiencia móvil -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <script>
        // Mostrar alertas de SweetAlert2 en caso de errores
        @if($errors->any())
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
        document.getElementById('yourFormId').addEventListener('submit', function(event) {
            let errors = [];
            const requiredFields = [
                'area', 'torre', 'piso', 'descripcion', 'imagenes'
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
