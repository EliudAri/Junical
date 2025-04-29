<div class="max-w-7xl mx-auto p-6">
    <div class="flex gap-4">
        <!-- Calendario -->
        <div class="w-full">
            <div id='calendar' class="bg-white rounded-lg shadow"></div>
        </div>
    </div>
</div>

<!-- Modal para nuevo evento -->
<div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg w-[500px] mx-auto mt-20 p-6">
        <h3 class="text-lg font-semibold mb-4">Agregar Nuevo Evento</h3>
        <form id="newEventForm" class="space-y-4">
            <!-- Título -->
            <div>
                <label class="block text-sm font-medium mb-1">Título del Evento</label>
                <input type="text" id="eventTitle" class="w-full border rounded p-2">
            </div>

            <!-- Fecha y Hora -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Fecha Inicio</label>
                    <input type="date" id="eventStartDate" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Hora Inicio</label>
                    <input type="time" id="eventStartTime" class="w-full border rounded p-2">
                </div>
            </div>

            <!-- Fecha y Hora -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Fecha Final</label>
                    <input type="date" id="eventEndDate" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Hora Final</label>
                    <input type="time" id="eventEndTime" class="w-full border rounded p-2">
                </div>
            </div>

            <!-- Color -->
            <div>
                <label class="block text-sm font-medium mb-1">Color del Evento</label>
                <select id="eventColor" class="w-full border rounded p-2">
                    <option value="#3788d8">Azul</option>
                    <option value="#2ecc71">Verde</option>
                    <option value="#e74c3c">Rojo</option>
                    <option value="#f1c40f">Amarillo</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" id="cancelBtn" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts necesarios -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales/es.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para mostrar notificaciones Toast
    function showToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: icon,
            title: title
        });
    }

    // Inicializar el calendario
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        selectable: true,
        displayEventTime: true,
        displayEventEnd: true,
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short',
            hour12: true
        },
        slotEventOverlap: false,
        eventOrder: function(a, b) {
            const startTimeA = a.start_time ? a.start_time.split(' ')[0].split(':') : ['00', '00'];
            const startTimeB = b.start_time ? b.start_time.split(' ')[0].split(':') : ['00', '00'];
            const hourA = parseInt(startTimeA[0]);
            const hourB = parseInt(startTimeB[0]);
            
            if (hourA === hourB) {
                return parseInt(startTimeA[1]) - parseInt(startTimeB[1]);
            }
            return hourA - hourB;
        },
        eventOverlap: true,
        eventOrderStrict: true,
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch('/api/events')
                .then(response => response.json())
                .then(data => {
                    const events = data.map(event => {
                        console.log('Procesando evento:', event);
                        try {
                            if (!event.start || !event.end) {
                                console.error('Evento sin fecha de inicio o fin:', event);
                                return null;
                            }

                            const start_time = event.start_time || '12:00 AM';
                            const end_time = event.end_time || '12:00 AM';

                            // Separar la hora y el meridiano (AM/PM)
                            const startTimeParts = start_time.split(' ');
                            const endTimeParts = end_time.split(' ');
                            const startHourMin = startTimeParts[0].split(':');
                            const endHourMin = endTimeParts[0].split(':');

                            // Convertir a 24 horas para el objeto Date
                            let startHour = parseInt(startHourMin[0]);
                            let endHour = parseInt(endHourMin[0]);
                            
                            // Ajustar las horas si es PM
                            if (startTimeParts[1] === 'PM' && startHour !== 12) startHour += 12;
                            if (endTimeParts[1] === 'PM' && endHour !== 12) endHour += 12;
                            // Ajustar para medianoche
                            if (startTimeParts[1] === 'AM' && startHour === 12) startHour = 0;
                            if (endTimeParts[1] === 'AM' && endHour === 12) endHour = 0;

                            const startParts = event.start.split('-');
                            const endParts = event.end.split('-');

                            const startDate = new Date(
                                parseInt(startParts[0]),
                                parseInt(startParts[1]) - 1,
                                parseInt(startParts[2]),
                                startHour,
                                parseInt(startHourMin[1])
                            );

                            const endDate = new Date(
                                parseInt(endParts[0]),
                                parseInt(endParts[1]) - 1,
                                parseInt(endParts[2]),
                                endHour,
                                parseInt(endHourMin[1])
                            );

                            return {
                                id: event.id,
                                title: event.title,
                                start: startDate,
                                end: endDate,
                                color: event.color,
                                allDay: false
                            };
                        } catch (error) {
                            console.error('Error procesando evento:', event, error);
                            return null;
                        }
                    }).filter(event => event !== null);

                    console.log('Eventos procesados:', events);
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error al cargar eventos:', error);
                    failureCallback(error);
                });
        },
        select: function(info) {
            const endDate = new Date(info.end);
            endDate.setDate(endDate.getDate() - 1);
            document.getElementById('eventStartDate').value = info.startStr;
            document.getElementById('eventEndDate').value = endDate.toISOString().split('T')[0];
            openModal(null, true);
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        eventClick: function(info) {
            showEventDetails(info.event);
        },
        dateClick: function(info) {
            openModal(info.dateStr, true);
        },
        eventDrop: function(info) {
            updateEventInDatabase(info.event);
        }
    });
    calendar.render();

    // Manejar el modal
    const modal = document.getElementById('eventModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const newEventForm = document.getElementById('newEventForm');
    let addToCalendar = false;

    // Cerrar modal
    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Manejar el formulario
    newEventForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('eventTitle').value.trim();
        const start = document.getElementById('eventStartDate').value;
        const startTime = document.getElementById('eventStartTime').value;
        const end = document.getElementById('eventEndDate').value;
        const endTime = document.getElementById('eventEndTime').value;
        const color = document.getElementById('eventColor').value;

        if (!title || !start || !end || !color) {
            showToast('error', 'Por favor, completa todos los campos requeridos.');
            return;
        }

        const eventData = {
            title: title,
            start: start,
            start_time: startTime,
            end: end,
            end_time: endTime,
            color: color
        };

        saveEventToDatabase(eventData);
        modal.classList.add('hidden');
        newEventForm.reset();
    });

    function openModal(dateStr, toCalendar) {
        if (dateStr) {
            document.getElementById('eventStartDate').value = dateStr;
        }
        addToCalendar = toCalendar;
        modal.classList.remove('hidden');
    }

    function calculateEndTime(date, time, durationMinutes) {
        const datetime = new Date(`${date}T${time}`);
        datetime.setMinutes(datetime.getMinutes() + durationMinutes);
        return datetime.toISOString();
    }

    function createRecurringEvents(baseEvent, weekDays) {
        weekDays.forEach(day => {
            const eventCopy = { ...baseEvent };
            const start = new Date(baseEvent.start);
            start.setDate(start.getDate() + ((day - start.getDay() + 7) % 7));
            eventCopy.start = start.toISOString();
            
            const end = new Date(baseEvent.end);
            end.setDate(end.getDate() + ((day - end.getDay() + 7) % 7));
            eventCopy.end = end.toISOString();

            calendar.addEvent(eventCopy);
        });
    }

    function saveEventToDatabase(eventData) {
        fetch('/api/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(eventData)
        })
        .then(response => response.json())
        .then(data => {
            calendar.refetchEvents();
            showToast('success', 'Evento guardado correctamente');
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Error al guardar el evento');
        });
    }

    function updateEventInDatabase(event) {
        const startTime = event.start.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: false });
        const endTime = event.end ? event.end.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', hour12: false }) : startTime;

        const updatedData = {
            start: event.start.toISOString().split('T')[0],
            end: event.end ? event.end.toISOString().split('T')[0] : event.start.toISOString().split('T')[0],
            title: event.title,
            color: event.backgroundColor,
            start_time: startTime,
            end_time: endTime
        };

        fetch(`/api/events/${event.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(updatedData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || 'Error del servidor');
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Evento actualizado:', data);
            showToast('success', 'Evento actualizado correctamente');
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Error al actualizar el evento: ' + error.message);
        });
    }

    // Nueva función para mostrar detalles del evento
    function showEventDetails(event) {
        const formatDateTime = (date) => {
            if (!date) return 'No especificada';
            return date.toLocaleString('es-ES', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        };

        Swal.fire({
            title: event.title,
            html: `
                <p><strong>Fecha y Hora de Inicio:</strong> ${formatDateTime(event.start)}</p>
                <p><strong>Fecha y Hora de Fin:</strong> ${formatDateTime(event.end)}</p>
                <p><strong>Color:</strong> <span style="display:inline-block; width: 20px; height: 20px; background-color: ${event.backgroundColor};"></span></p>
            `,
            showCloseButton: true,
            showConfirmButton: false
        });
    }
});
</script>

<!-- Estilos necesarios -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />