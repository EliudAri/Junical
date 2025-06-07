<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Rol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Rol</label>
                            <input type="text" name="name" id="name" value="{{ $role->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Permisos</label>
                            <div class="mb-2">
                                <label class="flex items-center">
                                    <input type="checkbox" id="select-all-permissions" class="form-checkbox h-5 w-5 text-blue-600">
                                    <span class="ml-2 text-gray-700 font-bold">Seleccionar todos</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($groupedPermissions as $category => $permissions)
                                    <div class="mb-4">
                                        <h4 class="font-semibold text-indigo-700 mb-2 text-base uppercase">{{ $category }}</h4>
                                        @foreach($permissions as $permission)
                                            <label class="flex items-center">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-checkbox h-5 w-5 text-blue-600 permiso-checkbox" {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const selectAll = document.getElementById('select-all-permissions');
                                const checkboxes = document.querySelectorAll('.permiso-checkbox');
                                selectAll.addEventListener('change', function() {
                                    checkboxes.forEach(cb => cb.checked = selectAll.checked);
                                });
                                // Si todos los permisos están seleccionados al cargar, marcar el checkbox principal
                                let allChecked = Array.from(checkboxes).every(cb => cb.checked);
                                selectAll.checked = allChecked;
                            });
                        </script>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Actualizar Rol
                            </button>
                            <a href="{{ route('roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 