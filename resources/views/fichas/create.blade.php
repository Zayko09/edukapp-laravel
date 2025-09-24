<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Ficha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('fichas.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="nombre">Nombre de la ficha:</label>
                            <input type="text" name="nombre" id="nombre" required>
                        </div>
                        <div>
                            <label for="sede_id">ID de la Sede:</label>
                            <input type="number" name="sede_id" id="sede_id" required>
                        </div>
                        <button type="submit">Guardar Ficha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
