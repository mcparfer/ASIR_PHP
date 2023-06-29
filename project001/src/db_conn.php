<?php

// CONSTANTES DB
define('DB_SERVER', 'localhost');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');

// CONEXION DB
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// ERRORES CONEXION DB
if ($conn->connect_error) {
    header("Location: index.php?error=Lo sentimos. La base de datos no se encuentra disponible.");
    exit();
}


?>