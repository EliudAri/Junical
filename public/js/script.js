// FUNCION PARA PREVISUALIZAR LAS IMAGENES Y ORGANIZARLAS CUANDO SE AGREGUEN A LA CREACION DE NOVEDADES
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('imagenes').addEventListener('change', function (event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-image');
                img.onclick = function () {
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

    modalElement.addEventListener('hidden.bs.modal', function () {
        modalElement.remove();
    });
}