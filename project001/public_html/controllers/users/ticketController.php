<?php

session_start();

require_once '../../../src/db_conn.php';

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['event']) && isset($_POST['tickets'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $event = $_POST['event'];
    $tickets = $_POST['tickets'];

    // INSERTAR VENTA EN TABLA VENTAS
    $sql = "INSERT INTO VENTAS (name, email, phone, event, tickets) VALUES ('$name', '$email', '$phone', '$event', '$tickets')";

    if ($conn->query($sql) === FALSE) {
    header("Location: ../../index.php?error=Este usuario ya ha sido registrado.");
    exit();
    }

    // ACTUALIZAR TABLA EVENTOS.
    $sql = "SELECT name, taken FROM EVENTOS WHERE id = '$event'";

    $row = $conn->query($sql); 
    $row_fetched = mysqli_fetch_row($row);

    $name_event = $row_fetched[0];
    $total_taken= (int) $row_fetched[1] + (int) $tickets;

    $sql = "UPDATE EVENTOS SET taken = '$total_taken' WHERE id = '$event'";
    $remaining = $conn->query($sql);   

    $conn->close();

    // DATOS PARA ENVIAR AL PDF.
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['event'] = $name_event;
    $_SESSION['tickets'] = $tickets;
    header("Location: ../../ticket.php");

} else {
    
    header('Location: ../../index.php');
    exit();
    
}

?>