<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control Estudiantil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Tu código original para el grid de usuarios va aquí --}}
                <style>
                    /* Estilos mínimos para mantener la apariencia del grid. Lo ideal sería mover esto a un archivo CSS. */
                    .user-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                        gap: 20px;
                        padding: 20px;
                    }
                    .user-card {
                        background-color: #fff;
                        border-radius: 8px;
                        padding: 20px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                        text-align: center;
                    }
                    .user-card h3 {
                        margin-top: 0;
                        font-size: 1.2em;
                    }
                    .user-card p {
                        font-size: 0.9em;
                        color: #666;
                        margin: 5px 0;
                    }
                    .user-card .action-button {
                        display: inline-block;
                        margin-top: 15px;
                        background-color: #5cb85c;
                        color: white;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 8px;
                        font-size: 0.9em;
                        cursor: pointer;
                        text-decoration: none;
                        transition: background-color 0.3s ease;
                    }
                    .user-card .action-button:hover {
                        background-color: #4cae4c;
                    }
                </style>
                <div class="user-grid">
                    @forelse ($usuarios as $usuario)
                        <div class="user-card">
                            <h3>{{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
                            <p>{{ $usuario->email }}</p>
                            <p>Doc: {{ $usuario->numero_documento }}</p>
                            <a href="{{ route('dashboard.carnet', $usuario) }}" class="action-button">Generar Carnet</a>
                        </div>
                    @empty
                        <p>No hay usuarios registrados para mostrar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>