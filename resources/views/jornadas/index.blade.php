<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Gestión de Jornadas
                            </h2>
                            <p class="text-gray-600 mt-1">Administra las jornadas académicas del sistema</p>
                        </div>
                        <button 
                            onclick="abrirModalCrear()"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-4">
                            Nueva Jornada
                        </button>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table id="jornadasTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre Jornada</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fichas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuarios</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Creado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalJornada" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 id="tituloModal" class="text-lg font-semibold text-gray-900">Nueva Jornada</h3>
                <button onclick="cerrarModal()" class="text-gray-500 hover:text-gray-700 text-2xl">×</button>
            </div>
            
            <form id="formJornada" onsubmit="guardarJornada(event)">
                <input type="hidden" id="jornadaId">
                <input type="hidden" id="metodo" value="POST">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Jornada *
                    </label>
                    <input 
                        type="text" 
                        id="nombreJornada" 
                        name="nombre_jornada" 
                        required 
                        maxlength="50"
                        placeholder="Ej: Mañana, Tarde, Nocturna"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="errorNombre" class="text-red-500 text-sm mt-1" style="display: none;"></div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="cerrarModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        let tabla;
        let editando = false;

        // Configurar token CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            console.log('Iniciando aplicación Jornadas...');
            
            // Inicializar DataTable
            tabla = $('#jornadasTable').DataTable({
                "ajax": {
                    "url": "{{ url('/jornadas/data') }}",
                    "type": "GET",
                    "dataSrc": "data",
                    "error": function(xhr, error, thrown) {
                        console.error('Error AJAX:', xhr.responseText);
                        Swal.fire('Error', 'No se pudieron cargar los datos: ' + xhr.status, 'error');
                    }
                },
                "columns": [
                    { "data": "jornada_id" },
                    { "data": "nombre_jornada" },
                    { "data": "fichas_count" },
                    { "data": "usuarios_count" },
                    { "data": "created_at" },
                    { "data": "acciones", "orderable": false, "searchable": false }
                ],
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "emptyTable": "No hay datos disponibles"
                },
                "pageLength": 10,
                "order": [[1, "asc"]]
            });
            
            console.log('DataTable inicializado correctamente');
        });

        function abrirModalCrear() {
            console.log('Abriendo modal para crear...');
            editando = false;
            document.getElementById('tituloModal').textContent = 'Nueva Jornada';
            document.getElementById('formJornada').reset();
            document.getElementById('jornadaId').value = '';
            document.getElementById('metodo').value = 'POST';
            limpiarErrores();
            document.getElementById('modalJornada').style.display = 'flex';
        }

        function editarJornada(id) {
            console.log('Editando jornada ID:', id);
            editando = true;
            
            fetch(`{{ url('/jornadas') }}/${id}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Datos recibidos:', data);
                if (data.success) {
                    document.getElementById('tituloModal').textContent = 'Editar Jornada';
                    document.getElementById('jornadaId').value = data.data.jornada_id;
                    document.getElementById('nombreJornada').value = data.data.nombre_jornada;
                    document.getElementById('metodo').value = 'PUT';
                    limpiarErrores();
                    document.getElementById('modalJornada').style.display = 'flex';
                } else {
                    Swal.fire('Error', data.message || 'Error al cargar datos', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Error al obtener los datos', 'error');
            });
        }

        function eliminarJornada(id) {
            console.log('Eliminando jornada ID:', id);
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('/jornadas') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Eliminado!', data.message, 'success');
                            tabla.ajax.reload();
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Error al eliminar', 'error');
                    });
                }
            });
        }

        function guardarJornada(event) {
            event.preventDefault();
            console.log('Guardando jornada...');
            
            const formData = new FormData();
            formData.append('nombre_jornada', document.getElementById('nombreJornada').value);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            
            let url = '{{ url("/jornadas") }}';
            let method = 'POST';
            
            if (editando) {
                url = `{{ url('/jornadas') }}/${document.getElementById('jornadaId').value}`;
                formData.append('_method', 'PUT');
            }
            
            limpiarErrores();
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta:', data);
                if (data.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    cerrarModal();
                    tabla.ajax.reload();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Error al procesar la solicitud', 'error');
            });
        }

        function cerrarModal() {
            document.getElementById('modalJornada').style.display = 'none';
            limpiarErrores();
        }

        function limpiarErrores() {
            document.getElementById('errorNombre').style.display = 'none';
        }

        // Funciones globales para botones
        window.editarJornada = editarJornada;
        window.eliminarJornada = eliminarJornada;
    </script>
</x-app-layout>
