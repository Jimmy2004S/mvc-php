<?php

$subject = $_POST['subject'];
$message = $_POST['messagge'];

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) { echo "$level: $str\n"; };

    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Servidor SMTP
    $mail->Port = 587; // Puerto SMTP
    $mail->SMTPAuth = true; // Activar autenticación SMTP
    $mail->Username = 'jimmisiitho450@gmail.com'; // Tu dirección de correo electrónico
    $mail->Password = 'sglxqvpgqcvjedjj'; // Tu contraseña de correo electrónico
    $mail->SMTPSecure = 'tls'; // Tipo de conexión segura (tls o ssl)

    // Detalles del mensaje
    $mail->setFrom('jimmisiitho450@gmail.com', 'Jimmy Jimenez'); // Remitente
    $mail->addAddress('jimmy.jimenez@unicolombo.edu.co', 'JIMMY ISAAC JIMENEZ BRAVO'); // Destinatario
    $mail->Subject = $subject; // Asunto
    $mail->Body = $message; // Cuerpo del correo en formato HTML
    $mail->AltBody = ''; // Cuerpo del correo en texto plano (opcional)

    // Adjuntar archivos (opcional)
    //$mail->addAttachment(''); // Adjuntar archivo

    // Enviar el correo
    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}


