<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="padding:16px">
                    <p>
                        <a href="{{ route('employee.create') }}">Nuevo</a>
                    </p>

                    @if (session('ok'))
                        <p style="color:green">{{ session('ok') }}</p>
                    @endif

                    <table id="employees" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>						
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Salario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employees as $e)
                                <tr>
                                    <td>{{ $e->employee_id }}</td>
                                    <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                                    <td>{{ $e->email }}</td>
                                    <td>{{ $e->hr_job->job_title ?? '-' }}</td>
                                    <td>{{ number_format($e->salary, 2) }}</td>
                                    <td>
                                        <a href="{{ route('employee.edit', $e) }}">Editar</a>
                                        <form action="{{ route('employee.destroy', $e) }}" method="POST"
                                            style="display:inline" onsubmit="return confirm('¿Eliminar?')">
                                            @csrf @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery + DataTables (CDN) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(function() {
            $('#employees').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
</x-app-layout>