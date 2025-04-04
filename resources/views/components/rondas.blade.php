<div class="max-w-7xl mx-auto p-6">
    <div class="flex gap-4">
        <!-- Panel lateral de eventos -->
        <div class="w-64 bg-gray-800 rounded-lg p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-white font-semibold">Eventos Disponibles</h2>
                <button id="newEventBtn" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">
                    + Nuevo
                </button>
            </div>
            <div id="external-events">
                <p class="text-gray-400 text-sm italic mb-2">Arrastra estos eventos al calendario</p>
                <!-- Los eventos se agregarán aquí dinámicamente -->
            </div>
        </div>

        <!-- Calendario -->
        <div class="flex-1">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        droppable: true,
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        // DATOS QUE SE MUESTRAN EN LA VISTA DEL CALENDARIO
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch('/api/events')
                .then(response => response.json())
                .then(data => {
                    const formattedEvents = data.map(event => ({
                        id: event.id,
                        title: event.title,
                        start: event.start,
                        end: event.end,
                        color: event.color
                    }));
                    successCallback(formattedEvents);
                })
                .catch(error => {
                    console.error('Error al cargar eventos:', error);
                    failureCallback(error);
                });
        },
        eventClick: function(info) {
            // Mostrar información del evento en un modal
            showEventDetails(info.event);
        },
        dateClick: function(info) {
            openModal(info.dateStr, true);
        },
        // Manejar el evento de mover
        eventDrop: function(info) {
            updateEventInDatabase(info.event);
        }
    });
    calendar.render();

    // Manejar el modal
    const modal = document.getElementById('eventModal');
    const newEventBtn = document.getElementById('newEventBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const newEventForm = document.getElementById('newEventForm');
    const externalEvents = document.getElementById('external-events');
    let addToCalendar = false;

    // Abrir modal
    newEventBtn.addEventListener('click', () => {
        openModal(null, false);
    });

    // Cerrar modal
    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Manejar el formulario
    newEventForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('eventTitle').value.trim();
        const start = document.getElementById('eventStartDate').value;
        const startTime = document.getElementById('eventStartTime').value || '00:00';
        const end = document.getElementById('eventEndDate').value;
        const endTime = document.getElementById('eventEndTime').value || '00:00';
        const color = document.getElementById('eventColor').value;

        if (!title || !start || !end || !color) {
            alert('Por favor, completa todos los campos requeridos.');
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

        if (addToCalendar) {
            calendar.addEvent(eventData);
            saveEventToDatabase(eventData);
        } else {
            addEventToExternalList(eventData);
        }

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

    function addEventToExternalList(eventData) {
        const eventDiv = document.createElement('div');
        eventDiv.className = 'fc-event p-2 mb-2 rounded cursor-pointer text-white';
        eventDiv.style.backgroundColor = eventData.backgroundColor;
        eventDiv.innerHTML = eventData.title;

        new FullCalendar.Draggable(eventDiv, {
            eventData: {
                title: eventData.title,
                backgroundColor: eventData.backgroundColor,
                borderColor: eventData.borderColor
            }
        });

        externalEvents.appendChild(eventDiv);
    }

    function calculateEndTime(date, time, durationMinutes) {
        const datetime = new Date(`${date}T${time}`);
        datetime.setMinutes(datetime.getMinutes() + durationMinutes);
        return datetime.toISOString();
    }

    function createRecurringEvents(baseEvent, weekDays) {
     
        // for (let i = 0; i < 4; i++) {
            weekDays.forEach(day => {
                const eventCopy = { ...baseEvent };
                // Ajustar fecha según el día de la semana
                const start = new Date(baseEvent.start);
                start.setDate(start.getDate() + ((day - start.getDay() + 7) % 7));
                eventCopy.start = start.toISOString();
                
                const end = new Date(baseEvent.end);
                end.setDate(end.getDate() + ((day - end.getDay() + 7) % 7));
                eventCopy.end = end.toISOString();

                calendar.addEvent(eventCopy);
            });
        // }
    }

    function saveEventToDatabase(eventData) {
        fetch('/api/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(eventData)
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
            console.log('Evento guardado:', data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar el evento: ' + error.message);
        });
    }

    function updateEventInDatabase(event) {
        const updatedData = {
            start: event.start.toISOString(),
            end: event.end ? event.end.toISOString() : null,
            title: event.title,
            color: event.backgroundColor,
            start_time: event.start_time || '00:00',
            end_time: event.end_time || '00:00'
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
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el evento: ' + error.message);
        });
    }

    // Nueva función para mostrar detalles del evento
    function showEventDetails(event) {
        const modalContent = `
            <h3 class="text-lg font-semibold mb-4">${event.title}</h3>
            <p><strong>Fecha de Inicio:</strong> ${new Date(event.start).toLocaleString()}</p>
            <p><strong>Fecha de Fin:</strong> ${event.end ? new Date(event.end).toLocaleString() : 'No especificada'}</p>
            <p><strong>Color:</strong> <span style="display:inline-block; width: 20px; height: 20px; background-color: ${event.backgroundColor};"></span></p>
        `;
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="bg-white rounded-lg w-[400px] p-6">
                ${modalContent}
                <div class="flex justify-end mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded" onclick="this.parentElement.parentElement.parentElement.remove();">Cerrar</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }
});
</script>

<!-- Estilos necesarios -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />