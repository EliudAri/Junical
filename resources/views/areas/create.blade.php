<div class="container">
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


@section('styles')
    <style>
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 4px;
            transition: transform 0.2s;
        }

        .preview-image:hover {
            transform: scale(1.05);
        }

        /* Estilos para el modal */
        .modal-image {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('imagenes').addEventListener('change', function(event) {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = '';

                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        img.onclick = function() {
                            showImageModal(e.target.result);
                        };
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(file);
                });
            });
        });

        function showImageModal(src) {
            const modal = `
        <div class="modal fade" id="imageModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-0">
                        <img src="${src}" class="modal-image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;

            document.body.insertAdjacentHTML('beforeend', modal);
            const modalElement = document.getElementById('imageModal');
            const bootstrapModal = new bootstrap.Modal(modalElement);
            bootstrapModal.show();

            modalElement.addEventListener('hidden.bs.modal', function() {
                modalElement.remove();
            });
        }
    </script>
@endsection
