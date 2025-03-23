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

// SCRIPT DE ESCANEAR CODIGOS DE BARRAS PARA LOS EQUIPOS 

let html5QrcodeScanner = null;

document.getElementById('iniciar-scanner').addEventListener('click', function () {
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
// FIN FUNCION CODIGO DE BARRAS 