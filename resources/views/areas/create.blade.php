<x-guest-layout>
    <div class="container">

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
            <!-- Solo incluimos la librería html5-qrcode -->
            <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
        </head>
        <form method="POST" action="{{ route('areas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="area">Nombre del Área</label>
                <input type="text" class="form-control" id="area" name="area" required>
            </div>

            <div class="form-group">
                <label for="torre">Torre</label>
                <select class="form-control" id="torre" name="torre" required>
                    <option value="">Seleccione una Torre</option>
                    <option value="1">Torre 1</option>
                    <option value="2">Torre 2</option>
                    <option value="3">Torre 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="piso">Piso</label>
                <select class="form-control" id="piso" name="piso" required>
                    <option value="">Seleccione un Piso</option>
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
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>

            <div class="form-group">
                <label for="codigo_barras">Código de Barras</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" required>
                    <button type="button" class="btn btn-primary" id="iniciar-scanner">Escanear</button>
                </div>
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

            <!-- Contenedor para el scanner -->
            <div id="reader"></div>

            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </form>
    </div>

    <script>
        let html5QrcodeScanner = null;

        document.getElementById('iniciar-scanner').addEventListener('click', function() {
            if (html5QrcodeScanner === null) {
                html5QrcodeScanner = new Html5Qrcode("reader");
                
                const config = {
                    fps: 10,
                    qrbox: 250,
                    aspectRatio: 1.0,
                    formatsToSupport: [ 
                        Html5QrcodeSupportedFormats.EAN_13,
                        Html5QrcodeSupportedFormats.EAN_8,
                        Html5QrcodeSupportedFormats.CODE_128,
                        Html5QrcodeSupportedFormats.CODE_39,
                        Html5QrcodeSupportedFormats.UPC_A,
                    ]
                };

                html5QrcodeScanner.start(
                    { facingMode: "environment" }, 
                    config,
                    (decodedText) => {
                        // Éxito
                        document.getElementById('codigo_barras').value = decodedText;
                        html5QrcodeScanner.stop();
                        html5QrcodeScanner = null;
                        alert('Código detectado: ' + decodedText);
                    },
                    (errorMessage) => {
                        // Error - lo ignoramos
                    }
                ).catch((err) => {
                    alert('Error al iniciar el scanner: ' + err);
                });
            } else {
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner = null;
                });
            }
        });
    </script>

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
</x-guest-layout>
