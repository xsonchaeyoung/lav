<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h3 class="mb-4">Contactos registrados</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contacts as $c)
                <tr>
                    <td>{{ $c->nombre }}</td>
                    <td>{{ $c->telefono }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->mensaje }}</td>

                    <td>
                        <button class="btn btn-primary btn-edit"
                            data-id="{{ $c->id }}"
                            data-nombre="{{ $c->nombre }}"
                            data-telefono="{{ $c->telefono }}"
                            data-email="{{ $c->email }}"
                            data-mensaje="{{ $c->mensaje }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal">
                            Actualizar
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-delete"
                            data-id="{{ $c->id }}"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            Eliminar
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        Registrar contacto
    </a>

    <!-- MODAL UPDATE -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('contacts.update') }}"> <!-- NUEVO: usar route Laravel -->
                    @csrf

                    <input type="hidden" name="id" id="edit_id"> <!-- NUEVO: input oculto para enviar id -->

                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Contacto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Telefono</label>
                            <input type="text" name="telefono" id="edit_telefono" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Mensaje</label>
                            <textarea name="mensaje" id="edit_mensaje" class="form-control" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Guardar cambios
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

        <!-- MODAL DELETE -->
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                    
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar Contacto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">
                                Eliminar
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('.btn-edit').click(function () {
            $('#edit_id').val($(this).data('id')); // NUEVO: llena el hidden id
            $('#edit_nombre').val($(this).data('nombre'));
            $('#edit_telefono').val($(this).data('telefono'));
            $('#edit_email').val($(this).data('email'));
            $('#edit_mensaje').val($(this).data('mensaje'));
        });
        $('.btn-delete').click(function () {

let id = $(this).data('id');

// Cambia dinámicamente el action del form
$('#deleteForm').attr('action', '/contacts/' + id);

});

    </script>

</body>

</html>
