<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Ficha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('fichas.update', $ficha->ficha_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre Ficha -->
                            <div>
                                <label for="nombre_ficha" class="block text-sm font-medium text-gray-700">Nombre de la Ficha</label>
                                <input type="text" name="nombre_ficha" id="nombre_ficha" value="{{ old('nombre_ficha', $ficha->nombre_ficha) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $ficha->descripcion) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Sede -->
                            <div>
                                <label for="sede_id" class="block text-sm font-medium text-gray-700">Sede</label>
                                <select name="sede_id" id="sede_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->sede_id }}" {{ $sede->sede_id == old('sede_id', $ficha->sede_id) ? 'selected' : '' }}>
                                            {{ $sede->nombre_sede }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jornada -->
                            <div>
                                <label for="jornada_id" class="block text-sm font-medium text-gray-700">Jornada</label>
                                <select name="jornada_id" id="jornada_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    @foreach ($jornadas as $jornada)
                                        <option value="{{ $jornada->jornada_id }}" {{ $jornada->jornada_id == old('jornada_id', $ficha->jornada_id) ? 'selected' : '' }}>
                                            {{ $jornada->nombre_jornada }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('fichas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                Actualizar Ficha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
