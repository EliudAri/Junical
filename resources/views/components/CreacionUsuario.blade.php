<div class="container py-4">
    <div class="row justify-content-center g-4">
        <div class="col-lg-12 col-md-12 col-ms-12 col-xs-12">
            <div class="form-container">
                <form id="registroForm" class="needs-validation" novalidate method="POST" action="{{ route('creacionusuarios.store') }}">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-12 col-md-3 img-logo text-center text-md-start">
                            <x-imagen class="block h-9 w-auto" />
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="alert alert-primary mt-3 mb-3 custom-alertm-title" role="alert">
                                <h3 class="text-center">CREACIÓN USUARIOS NUEVOS APLICATIVO HOSVITAL</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-lg-3 col-md-3 col-ms-3 col-xs-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="text" class="form-control custom-alert" id="fecha" name="fecha" required value="{{ date('Y-m-d') }}" style="border: none; background: none; padding: 0; width: auto; font-size: 1.2rem; display: inline; margin-left: 10px;" readonly>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="alert alert-primary mt-3 mb-3 custom-alertm-title" role="alert" style="background-color: #A4C8E1; border: none; border-radius: 5px;">
                                <h3 class="text-center" style="font-weight: bold; margin: 0;">DATOS DE INGRESO</h3>
                                <h4 class="text-start" style="font-weight: normal; margin: 0;">INFORMACIÓN PERSONAL</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-lg-4">
                            <label for="primerApellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerApellido" name="primerApellido" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="segundoApellido" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="nombres" class="form-label">Nombres:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-lg-4">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <div>
                                <input type="radio" id="masculino" name="sexo" value="masculino" required>
                                <label for="masculino">Masculino</label>
                                <input type="radio" id="femenino" name="sexo" value="femenino" required>
                                <label for="femenino">Femenino</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="tipoDocumento" class="form-label">Tipo de Documento:</label>
                            <input type="text" class="form-control" id="tipoDocumento" name="tipoDocumento" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="numeroDocumento" class="form-label">Número de Documento:</label>
                            <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="origen" class="form-label">De dónde es:</label>
                            <input type="text" class="form-control" id="origen" name="origen" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="regMedico" class="form-label">No. REG. MÉDICO:</label>
                            <input type="text" class="form-control" id="regMedico" name="regMedico" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="direccionDomicilio" class="form-label">Dirección Domicilio:</label>
                            <input type="text" class="form-control" id="direccionDomicilio" name="direccionDomicilio" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="ciudad" class="form-label">Ciudad:</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="barrio" class="form-label">Barrio:</label>
                            <input type="text" class="form-control" id="barrio" name="barrio" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="email" class="form-label">E-MAIL:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="celular" class="form-label">No. CELULAR:</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="alert alert-primary mt-3 mb-3 custom-alertm-title" role="alert" style="background-color: #A4C8E1; border: none; border-radius: 5px;">
                                <h5 class="text-start" style="font-weight: normal; margin: 0;">INFORMACIÓN LABORAL</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <label for="tipoProfesion" class="form-label">TIPO PROFESIÓN:</label>
                            <select class="form-control" id="tipoProfesion" name="tipoProfesion" required>
                                <option value="medico_general">MED. GENERAL</option>
                                <option value="enfermero_jefe">ENFERMERO JEFE</option>
                                <option value="aux_enfermeria">AUX. ENFERMERIA</option>
                                <option value="bacteriologo">BACTERIOLOGO</option>
                                <option value="odontologo">ODONTOLOGO</option>
                                <option value="tecnico_radiologia">TÉCNICO RADIOLOGÍA</option>
                                <option value="aux_laboratorio">AUX. LABORATORIO</option>
                                <option value="medico_especialista">MED. ESPECIALISTA</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="especialidad" class="form-label">ESPECIALIDAD:</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <label for="tipoVinculacion" class="form-label">TIPO VINCULACIÓN:</label>
                            <select class="form-control" id="tipoVinculacion" name="tipoVinculacion" required>
                                <option value="prestacion_servicios">PRESTACION DE SERVICIOS</option>
                                <option value="evento">EVENTO</option>
                                <option value="paquete">PAQUETE</option>
                                <option value="hora">HORA</option>
                                <option value="directos">DIRECTOS</option>
                                <option value="cooperativa">COOPERATIVA</option>
                                <option value="sociedad">SOCIEDAD</option>
                                <option value="otro">OTRO</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="cooperativa" class="form-label">COOPERATIVA:</label>
                            <input type="text" class="form-control" id="cooperativa" name="cooperativa">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <label for="sociedad" class="form-label">SOCIEDAD:</label>
                            <input type="text" class="form-control" id="sociedad" name="sociedad">
                        </div>
                        <div class="col-lg-6">
                            <label for="otroVinculacion" class="form-label">OTRO:</label>
                            <input type="text" class="form-control" id="otroVinculacion" name="otroVinculacion">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <label for="atencionGrupal" class="form-label">ATENCIÓN GRUPAL DE PACIENTES:</label>
                            <div>
                                <input type="radio" id="atencionSi" name="atencionGrupal" value="si" required>
                                <label for="atencionSi">Sí</label>
                                <input type="radio" id="atencionNo" name="atencionGrupal" value="no" required>
                                <label for="atencionNo">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <label for="serviciosOfrecidos" class="form-label">SERVICIOS QUE OFRECE (Nombre consulta – exámenes que realiza):</label>
                            <textarea class="form-control" id="serviciosOfrecidos" name="serviciosOfrecidos" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3 g-2">
                        <div class="col-12 col-md-6">
                            <h4 class="text-center">Nombres y apellidos</h4>
                            <canvas id="firmaCanvas1" width="550" height="200" class="border mb-3"></canvas>
                            <button type="button" class="btn btn-secondary" id="limpiarModal1">Limpiar Firma</button>
                        </div>

                        <div class="col-12 col-md-6">
                            <h4 class="text-center">Firma</h4>
                            <canvas id="firmaCanvas2" width="550" height="200" class="border mb-3"></canvas>
                            <button type="button" class="btn btn-secondary" id="limpiarModal2">Limpiar Firma</button>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <p>&copy; <span id="year"></span>SP-GESH-FO-01 / VERSIÓN 02 / 22-03-2022</p>
                    </div>
                    <!-- Contenedor de botones -->
                    <div class="row g-2 mt-2">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-danger" id="guardarInformacion">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function autoExpand(field) {
        field.style.height = 'auto'; // Resetea la altura
        field.style.height = (field.scrollHeight) + 'px'; // Ajusta la altura al contenido
    }

    let isDrawing1 = false;
    let isDrawing2 = false;
    const canvas1 = document.getElementById('firmaCanvas1');
    const ctx1 = canvas1.getContext('2d');
    const canvas2 = document.getElementById('firmaCanvas2');
    const ctx2 = canvas2.getContext('2d');

    function startDrawing(event, canvas, ctx) {
        isDrawing1 = true; // Cambia a true si es el primer canvas
        isDrawing2 = true; // Cambia a true si es el segundo canvas
        ctx.beginPath();
        ctx.moveTo(event.offsetX, event.offsetY);
    }

    function draw(event, ctx) {
        if (!isDrawing1 && !isDrawing2) return;
        ctx.lineTo(event.offsetX, event.offsetY);
        ctx.stroke();
    }

    function stopDrawing() {
        isDrawing1 = false; // Cambia a false si es el primer canvas
        isDrawing2 = false; // Cambia a false si es el segundo canvas
        ctx1.closePath();
        ctx2.closePath();
    }

    function clearCanvas(canvas, ctx) {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpia el canvas
    }

    canvas1.addEventListener('mousedown', (event) => startDrawing(event, canvas1, ctx1));
    canvas1.addEventListener('mousemove', (event) => draw(event, ctx1));
    canvas1.addEventListener('mouseup', stopDrawing);
    canvas1.addEventListener('mouseout', stopDrawing);

    canvas2.addEventListener('mousedown', (event) => startDrawing(event, canvas2, ctx2));
    canvas2.addEventListener('mousemove', (event) => draw(event, ctx2));
    canvas2.addEventListener('mouseup', stopDrawing);
    canvas2.addEventListener('mouseout', stopDrawing);

    // Agregar eventos a los botones de limpiar
    document.getElementById('limpiarModal1').addEventListener('click', () => clearCanvas(canvas1, ctx1));
    document.getElementById('limpiarModal2').addEventListener('click', () => clearCanvas(canvas2, ctx2));
</script>


<script>
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
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            let errors = [];
            const requiredFields = [
                'primerApellido', 'segundoApellido', 'nombres', 'sexo', 'fechaNacimiento',
            'tipoDocumento', 'numeroDocumento', 'origen', 'regMedico', 'direccionDomicilio',
            'departamento', 'ciudad', 'barrio', 'email', 'celular', 'tipoProfesion',
            'tipoVinculacion', 'atencionGrupal', 'serviciosOfrecidos'
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