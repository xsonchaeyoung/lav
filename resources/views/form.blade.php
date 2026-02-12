<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="xd" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulario</title>
</head>

<body class="container mt-5">

    <h3 class="mb-4">Formulario de Registro</h3>

    <form id="formulario">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mensaje</label>
            <textarea id="mensaje" name="mensaje" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ route('contacts') }}" class="btn btn-outline-secondary"> Contactos registrados </a>

    </form>

    <div id="respuesta" class="mt-4"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $('#formulario').submit(function (e) {
            e.preventDefault();

            let nombre = $('#nombre').val();
            let email = $('#email').val();
            let telefono = $('#telefono').val();
            let mensaje = $('#mensaje').val();

            let regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;
            let regexTelefono = /^[0-9]+$/;
            let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nombre === '' || email === '' || telefono === '' || mensaje === '') {
                $('#respuesta').html('<div class="alert alert-danger">Verificar que todos los campos estén completos</div>');
                return;
            }

            if (!regex.test(nombre)) {
                $('#respuesta').html('<div class="alert alert-danger">El nombre solo puede contener letras</div>');
                $('#nombre').focus();
                return;
            }

            if (!regexTelefono.test(telefono)) {
                $('#respuesta').html('<div class="alert alert-danger">El teléfono solo puede contener números</div>');
                $('#telefono').focus();
                return;
            }

            if (!regexEmail.test(email)) {
                $('#respuesta').html('<div class="alert alert-danger">Email inválido</div>');
                return;
            }

            $.ajax({
                url: '/saveData',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nombre,
                    email,
                    telefono,
                    mensaje
                },
                success: function (response) {
                    $('#respuesta').html(`<div class="alert alert-success">${response.message}</div>`);
                    $('#formulario')[0].reset();
                },
                error: function () {
                    $('#respuesta').html('<div class="alert alert-danger">Error al enviar los datos</div>');
                }
            });
        });
    </script>
</body>

</html>