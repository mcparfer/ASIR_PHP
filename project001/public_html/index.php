<?php
require_once '../src/db_conn.php';

$sql = "SELECT * FROM EVENTOS";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Compra de entradas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // CASCADE SELECT HTML
        $(document).ready(function() {
            $("#event").change(function() {
                $('#tickets').find('option').remove();

                <?php
                $eventos = [];
                foreach ($result as $evento) {
                    array_push($eventos, json_encode($evento));
                }
                $eventos = implode('</3', $eventos);
                echo "var eventos_list = '$eventos'.split('</3');";
                ?>

                var evento = {}
                var check_id = this.value

                $.each(eventos_list, function(index, val) {
                    var each_evento = JSON.parse(val)
                    if (each_evento.id == check_id) {
                        evento = each_evento
                    }
                });

                var max = evento.max
                var remaining = evento.remaining

                if (remaining == 0) {
                    $('#tickets').append('<option selected disabled value=""> --Sin entradas disponibles--</option>');
                } else {
                    for (var i = 1; i <= max && remaining > 0; i++) {
                        $('#tickets').append('<option value=' + i + '>' + i + '</option>');
                        remaining--;
                    }
                }
            });
        });
    </script>

</head>

<body>

    <div class="w-100 text-end">
        <a href="admin.php"><button type="button" class="btn btn-dark mx-4 mt-4">Administrador</button></a>
    </div>
    <main class="container mb-5 col-md-6">
        <div class="w-100 my-3 text-center">
            <h3 class="m-0 p-2">VENTA DE ENTRADAS</h3>
            <b>Introduzca sus datos personales.</b>
        </div>
        <div class="text-center">
            <?php if (isset($_GET['error'])) {
                echo '<p class="badge rounded-pill bg-danger">' . $_GET['error'] . '</p>';
            } ?>
        </div>
        <form method="POST" action="controllers/users/ticketController.php">
            <div class="form-group mb-3">
                <label for="name" class="mb-2">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Introduzca su nombre" required oninvalid="this.setCustomValidity('Introduzca su nombre')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="mb-2">Teléfono:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="999-999-999" required oninvalid="this.setCustomValidity('Introduzca su teléfono')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group mb-3">
                <label for="email" class="mb-2">Correo electrónico:</label>
                <input type="email" class="form-control mb-1" id="email" name="email" placeholder="example@example.com" required oninvalid="this.setCustomValidity('Introduzca su correo')" oninput="this.setCustomValidity('')">
                <small id="email" class="form-text text-muted">(*) Acepta recibir ofertas periódicas de nuestros servicios.</small>
            </div>
            <div class="row">
                <div class="mb-4 col-md-6">
                    <label for="event" class="mb-2">Evento:</label><br>
                    <select class="form-select" id="event" name="event" required oninvalid="this.setCustomValidity('Seleccione un evento')" oninput="this.setCustomValidity('')">
                        <option value="" selected disabled>Elija el evento...</option>
                        <?php
                        foreach ($result as $evento) {
                            echo "<option value=" . $evento['id'] . ">" . $evento['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4 col-md-6">
                    <label for="tickets" class="mb-2">Tickets:</label><br>
                    <select class="form-select" id="tickets" name="tickets" required oninvalid="this.setCustomValidity('Entradas no disponibles')" oninput="this.setCustomValidity('')"></select>
                </div>
            </div>
            <button type="submit" class="btn btn-dark w-100" style="bottom: 0px">Descarga PDF</button>
        </form>
        <main>

</body>

</html>