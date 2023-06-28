<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>HOME</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body>
        
        <div class="w-100 text-end">
            <a href="controllers/admins/logout.php"><button type="button" class="btn btn-dark mx-4 mt-4">Cerrar sesión</button></a>
        </div>
        
        <main class="container mb-5">
            <h2>¡Hola, <?php echo $_SESSION['name']; ?>!</h2>
            <h4>Aquí tienes información de los eventos actuales...</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Entradas totales</th>
                        <th>Reservadas</th>
                        <th>Restantes</th>
                        <th>Máxima venta por compra</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once '../src/db_conn.php';

                    $sql = "SELECT * FROM EVENTOS";
                    $result = $conn->query($sql);

                    while($row =mysqli_fetch_array($result)) {
                        echo 
                        "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['total'] . "</td>
                            <td>" . $row['taken'] . "</td>
                            <td>" . $row['remaining'] . "</td>
                            <td>" . $row['max'] . "</td>
                            <td> 
                            <a href=\"edit.php?id= ". $row['id'] . "\">Editar</a>
                        </tr>";
                    }

                    ?>
                    <tr></tr>
                </tbody>
            </table>
        <main>
            
    </body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}

?>