<!DOCTYPE html>
<html>
    
    <head>
        <title>Compra de entradas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body>
        
        <div class="w-100 text-end">
            <a href="index.php"><button type="button" class="btn btn-dark mx-4 mt-4">Página principal</button></a>
        </div>
        
        <main class="container mb-5 col-md-5">

            <div class="w-100 my-3 text-center">
                <h3 class="m-0 p-2">LOGIN</h3>
                <b>Introduzca sus credenciales.</b>
            </div>

            <div class="text-center">
                <?php if (isset($_GET['error'])) {
                    echo '<p class="badge rounded-pill bg-danger">' . $_GET['error'] . '</p>';
                } ?>
            </div>

            <form method="POST" action="controllers/admins/login.php">
                <div class="form-group mb-3">
                    <label for="user" class="mb-2">Usuario:</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Introduzca su usuario" required oninvalid="this.setCustomValidity('Introduzca su usuario')" oninput="this.setCustomValidity('')">
                </div>

                <div class="form-group mb-3">
                    <label for="pass" class="mb-2">Contraseña:</label>
                    <input type="text" class="form-control" id="pass" name="pass" placeholder="Introduzca su clave" required oninvalid="this.setCustomValidity('Introduzca su contraseña')" oninput="this.setCustomValidity('')">
                </div>

                <button type="submit" class="btn btn-dark w-100" style="bottom: 0px">Acceder</button>
            </form>
        <main>
            
    </body>
</html>