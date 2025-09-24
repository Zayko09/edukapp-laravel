@extends('layouts.app')

@section('title', 'Gestión de Jornadas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Gestión de Jornadas
                        </h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jornadaModal" onclick="openCreateModal()">
                            <i class="fas fa-plus me-2"></i>
                            Nueva Jornada
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jornadasTable" class="table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre de Jornada</th>
                                    <th>Fichas</th>
                                    <th>Usuarios</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="jornadaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Nueva Jornada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="jornadaForm">
                <div class="modal-body">
                    <input type="hidden" id="jornadaId" name="jornada_id">
                    <div class="mb-3">
                        <label for="nombreJornada" class="form-label">Nombre de la Jornada *</label>
                        <input type="text" class="form-control" id="nombreJornada" name="nombre_jornada" required maxlength="50">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let table;
let isEditing = false;

$(document).ready(function() {
    // Inicializar DataTable
    table = $('#jornadasTable').DataTable({
        ajax: {
            url: '{{ route("jornadas.data") }}',
            dataSrc: 'data'
        },
        columns: [
            { data: 'jornada_id' },
            { data: 'nombre_jornada' },
            { data: 'fichas_count' },
            { data: 'usuarios_count' },
            { data: 'created_at' },
            { data: 'acciones', orderable: false, searchable: false }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']]
    });
    
    $('#jornadaForm').on('submit', function(e) {
        e.preventDefault();
        saveJornada();
    });
});

function openCreateModal() {
    isEditing = false;
    $('#modalTitle').text('Nueva Jornada');
    $('#jornadaForm')[0].reset();
    $('#jornadaId').val('');
    clearValidation();
}

function editJornada(id) {
    isEditing = true;
    $('#modalTitle').text('Editar Jornada');
    clearValidation();
    
    $.get('/jornadas/' + id)
        .done(function(response) {
            if(response.success) {
                $('#jornadaId').val(response.data.jornada_id);
                $('#nombreJornada').val(response.data.nombre_jornada);
                $('#jornadaModal').modal('show');
            }
        });
}

function deleteJornada(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/jornadas/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire('¡Eliminado!', response.message, 'success');
                        table.ajax.reload();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }
            });
        }
    });
}

function saveJornada() {
    const formData = new FormData($('#jornadaForm')[0]);
    const url = isEditing ? '/jornadas/' + $('#jornadaId').val() : '/jornadas';
    const method = isEditing ? 'PUT' : 'POST';
    
    if (isEditing) {
        formData.append('_method', 'PUT');
    }
    
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.success) {
                Swal.fire('¡Éxito!', response.message, 'success');
                $('#jornadaModal').modal('hide');
                table.ajax.reload();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors && errors.nombre_jornada) {
                showFieldError('nombreJornada', errors.nombre_jornada[0]);
            }
        }
    });
}

function showFieldError(fieldId, message) {
    $('#' + fieldId).addClass('is-invalid').next('.invalid-feedback').text(message);
}

function clearValidation() {
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').text('');
}
</script>
@endpush
