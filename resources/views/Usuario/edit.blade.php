<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('Usuario.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('nombre', $usuario->nombre) }}" required>
                        </div>

                        <!-- Apellido -->
                        <div>
                            <label for="apellido" class="block font-medium text-sm text-gray-700">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('apellido', $usuario->apellido) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('email', $usuario->email) }}" required>
                        </div>

                        <!-- Numero Documento -->
                        <div>
                            <label for="numero_documento" class="block font-medium text-sm text-gray-700">Número de Documento</label>
                            <input type="text" name="numero_documento" id="numero_documento" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('numero_documento', $usuario->numero_documento) }}" required>
                        </div>

                        <!-- Activo -->
                        <div>
                            <label for="activo" class="block font-medium text-sm text-gray-700">Estado</label>
                            <select name="activo" id="activo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" {{ $usuario->activo == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $usuario->activo == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('Usuario.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
