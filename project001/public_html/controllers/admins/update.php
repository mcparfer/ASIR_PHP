<?php

require_once '../../../src/db_conn.php';

if (isset($_POST['name']) && isset($_POST['total']) && isset($_POST['max'])) {

    $id=$_GET['id'];
    
    $name = $_POST['name'];
    $total = $_POST['total'];
    $max = $_POST['max'];


    $sql = "SELECT taken FROM EVENTOS WHERE name = '$name'";

    $row = $conn->query($sql); 
    $row_fetched = mysqli_fetch_row($row);

    $taken = $row_fetched[0];

    if ($taken > $total) {
        header("Location: ../../edit.php?id=$id&error=El número de entradas totales no puede ser menor a las entradas reservadas.");
        exit();
    }

    // ACTUALIZAR TABLA EVENTOS.
    $sql = "UPDATE EVENTOS SET name = '$name', total = '$total', max = '$max' WHERE id = $id";

    if ($conn->query($sql) === FALSE) {
        header("Location: ../../edit.php?id=$id&error=Ha ocurrido un error.");
        exit();
    }
    
    $conn->close();
    
    header('Location: ../../home.php');

} else {
    
    header('Location: ../../home.php');
    exit();
    
}

?>