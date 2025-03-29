<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <!-- AQUI SOLO VA EL NOMBRE DE LA SECCION EN LA QUE SE ESTÁ     -->
        {{ __('Usuarios') }} 
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @include('usuarios.index', ['usuarios' => $usuarios])
            </div>
        </div>
    </div>
</x-app-layout>
