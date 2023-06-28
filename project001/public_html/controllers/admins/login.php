<?php

session_start();

require_once '../../../src/db_conn.php';

// DATOS DEL FORMULARIO
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    
        $sql = "SELECT * FROM ADMINS WHERE username='$user'";
        $result = $conn->query($sql);

        if (mysqli_num_rows($result) === 1 ) {

            $encryt = explode("$", crypt($pass, '$2a$07$iamsherlocked09sherlock$'));
            $passwd = $encryt[3];

            $row = mysqli_fetch_assoc($result);
            
            if ($row['username'] === $user && $row['passwd'] === $passwd) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../../home.php");
            } else {
                header("Location: ../../admin.php?error=Usuario o contraseña incorrecta.");
                exit();
            }
        } else {
            header("Location: ../../admin.php?error=Usuario o contraseña incorrecta.");
            exit();
        }
        
} else {
    header('Location: ../../admin.php');
    exit();
}

$conn->close();

?>