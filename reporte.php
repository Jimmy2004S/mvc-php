<?php
session_start();
$email = $_SESSION['email'];
$codigo = $_GET['codigo']; // Obtener el código del proyecto del parámetro de la URL
include("Datos/conexion.php");
try{    
    $stmt = $conexion -> prepare("SELECT  CONCAT(p.nombre, ' ', p.apellido) AS nombres , p.identificacion , p.tipo_persona ,  pr.fecha_inicio , pr.nombre AS nombre_proyecto , pr.descripcion , pr.archivo
    FROM proyectos pr
    JOIN persona p ON pr.codigo_lider_proyecto = p.codigo_persona
    WHERE pr.codigo = :codigo;");
    $stmt -> bindParam(":codigo" , $codigo);
    $stmt -> execute();
    $lista = $stmt -> fetch(PDO::FETCH_LAZY); 

}catch(Exception $e){
    echo $e -> getMessagge();
}
?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="multimedia/img-login.jpg" />
<!--BOOTSTRAP-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title> <?php echo $lista['archivo'] ?> </title>
</head>
<body>
    <div>
        <div style="text-align: center; margin-top:150px;">
            <h1 style="color: blue; text-transform: uppercase;">Felicitaciones</h1>
            <br>
            <p style="display: flex; flex-wrap: wrap; font-size:20px;">Este certificado valida la autoria a <span style="font-weight: bold;"> <?php echo $lista['nombres'] ?> </span> con identificacion <?php echo $lista['identificacion'] . ' ' . $lista['tipo_persona'] ?> de la comunidad <span style="font-weight: bold;"> UNICOLOMBO </span> en el desarrollo del siguiente proyecto </p>
            <br>
            <h2><?php echo $lista['nombre_proyecto'] ?></h2>
            <p style="display: flex; flex-wrap: wrap; font-size:20px;"><?php echo $lista['descripcion'] .' '?> <span class="color: gray;"> ( <?php echo $lista['fecha_inicio'] ?> )</span> </p>
            <br>
        </div>
    </div>
    
    
</body>
</html>

<?php
$html = ob_get_clean();

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

//$dompdf->setPaper("letter");
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment" => false));

?>



