<?php
try {
    // Establecer conexión a la base de datos
    include("../conexion.php");
    // Iniciar transacción
    $conexion->beginTransaction();
  
    // Primera consulta SQL
    $sql1 = "INSERT INTO `persona`(`nombre`, `apellido`, `identificacion`, `tipo_persona`, `email`, `clave`, `telefono`) VALUES (:nombre,:apellido,:identificacion,:tipo_persona,:email, :clave , :telefono)";
    $stmt1 = $conexion->prepare($sql1);
  
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $identificacion = $_POST['identificacion'];
    $tipo_persona = $_POST['tipoUsuario'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $clave = $_POST['contrasenia']; // Clave por defecto es la identificación
  
    $stmt1->bindParam(':nombre', $nombre);
    $stmt1->bindParam(':apellido', $apellido);
    $stmt1->bindParam(':identificacion', $identificacion);
    $stmt1->bindParam(':tipo_persona', $tipo_persona);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':clave', $clave);
    $stmt1->bindParam(':telefono', $telefono);
    $stmt1->execute();
  
    // Obtener el ID insertado en la primera tabla
    $codigoPersona = $conexion->lastInsertId();
  
    // Segunda consulta SQL
    if($tipo_persona == 'Estudiante'){
        $sql2 = "INSERT INTO `estudiante`(`codigo`, `carrera`, `semestre`) VALUES (:codigoPersona, :carrera , :semestre)";
        $stmt = $conexion->prepare($sql2);
      
        $carrera = $_POST['carrera'];
        $semestre = $_POST['semestre']; 
      
        $stmt->bindParam(':codigoPersona', $codigoPersona);
        $stmt->bindParam(':carrera', $carrera);
        $stmt->bindParam(':semestre', $semestre);

        $stmt->execute();
    }else if($tipo_persona == 'Profesor'){
        $sql3 = "INSERT INTO `profesor`(`codigo`, `departamento`) VALUES (:codigoPersona,:departamento)";
        $stmt = $conexion->prepare($sql3);
      
        $departamento = $_POST['departamento'];
      
        $stmt->bindParam(':codigoPersona', $codigoPersona);
        $stmt->bindParam(':departamento', $departamento);

        $stmt->execute();
    }
  
    // Confirmar transacción
    $conexion->commit();
    echo '<script>window.alert("Tu registro se validara, se paciente por favor..."); window.location.href = "../../vistas/misProject.php";</script>';

} catch (PDOException $e) {
    // Cancelar transacción en caso de error
    $conexion->rollback();
    echo "Error en la transacción: " . $e->getMessage();
}finally{
    $stmt = null;
    $stmt1 = null;
    $conexion = null;
}
?>
  

<?php
//Enviar correo para que validen tu registro
$subject = 'Nuevo usuario registrado';
$message = '
<html>
<head>
<title>Información del registro</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
</head>
<body>
<h2>Información de variables</h2>
<table>
    <tr>
        <th>Codigo</th>
        <th>Nombres</th>
        <th> identificacion </th>
    </tr>
    <tr>
        <td>' . $codigoPersona  .'</td>
        <td>'.$nombre . " " . $apellido .'</td>
        <td> ' . $identificacion . ' </td>
    </tr>
';


require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

$mail->isHTML(true); // Establecer el formato del correo como HTML
$mail->CharSet = 'UTF-8'; // Establecer el juego de caracteres

// Configurar las cabeceras del correo para el formato HTML
$mail->Encoding = 'base64';
$mail->ContentType = 'text/html; charset=utf-8';

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

?>