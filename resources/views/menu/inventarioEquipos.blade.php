<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <!-- AQUI SOLO VA EL NOMBRE DE LA SECCION EN LA QUE SE ESTÁ     -->
        {{ __('Inventario de Equipos') }} 
        </h2>
    </x-slot>

   
    <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- campo de búsqueda -->
                <div class="mb-4 mt-4">
                    <div class="flex items-center">
                        <input type="text" 
                               id="searchInputInventario" 
                                class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mx-4"
                               placeholder="Buscar en el inventario de equipos..."
                               onkeyup="searchInventarioTable()">
                    </div>
                </div>
                @include('inventario.inventarioEquipos')
            </div>
        </div>
    </div>

    <!--script de búsqueda para inventario -->
    <script>
        function searchInventarioTable() {
            const input = document.getElementById('searchInputInventario');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const text = cell.textContent || cell.innerText;
                        if (text.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }
    </script>
</x-app-layout>
