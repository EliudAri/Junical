<x-guest-layout>
    <div class="container">

        <head>
            <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
</x-guest-layout>
