<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../resources/PHPMailer/PHPMailer.php';
require_once '../resources/PHPMailer/SMTP.php';
require_once '../resources/PHPMailer/Exception.php';

if (isset($_SESSION['name']) && isset($_SESSION['phone']) && isset($_SESSION['email']) && isset($_SESSION['event']) && isset($_SESSION['tickets'])) {
    
    // CREAR PDF
    if (ob_get_contents()) ob_end_clean();
    require_once '../resources/fpdf/fpdf.php';
    
    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 20);
            $this->Cell(0, 20, 'TICKETS', 0, 1,'C');
            $this->Ln(5);
        }
    
    }
    
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(0, 15, '    Nombre: ' . iconv('utf-8', 'ISO-8859-2', $_SESSION['name']) , 0, 1);
    $pdf->Cell(0, 15, '    Telefono: ' . $_SESSION['phone'] , 0, 1);
    $pdf->Cell(0, 15, '    Email: ' . $_SESSION['email'] , 0, 1);
    $pdf->Cell(0, 15, '    Evento: ' . iconv('utf-8', 'ISO-8859-2', $_SESSION['event']) . '    Tickets: ' . $_SESSION['tickets'] , 0, 1);

    if (!file_exists('../resources/tickets/' . $_SESSION['event'] . '/')) {
        mkdir('../resources/tickets/' . $_SESSION['event'] . '/', 0777, true);
    }

    $pdf->Output('F','../resources/tickets/' . $_SESSION['event'] . '/Entrada' . $_SESSION['phone'] . '.pdf');
    $pdf->Output();
    
     // ENVIAR CORREO ELECTRÓNICO
    $mail = new PHPMailer(true);

    try {
        // CONFIGURACIÓN SEVIDOR
        $mail->SMTPDebug  = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'maricarmen61299@gmail.com';
        $mail->Password   = 'knrkqqwbsefmascf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465; // (587 unencrypted o 465 SSL)

        // CORREO
        $mail->setFrom('maricarmen61299@gmail.com', 'MC');
        $mail->addAddress($_SESSION['email']);
        $mail->addAttachment('../resources/tickets/' . $_SESSION['event'] . '/Entrada' . $_SESSION['phone'] . '.pdf');
        $mail->isHTML(true);
        $mail->Subject = 'Entrada';
        $mail->Body    = 'Gracias por su compra.';
        
        $mail->send();

    } catch (Exception $e) {}

} else {
    header("Location: index.php");
    exit();
}

session_unset();
session_destroy();

?>