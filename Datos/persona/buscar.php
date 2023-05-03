<?php
include("../conexion.php");

$identificacion = $_POST['']

//sentencia preparada
$stmt = mysqli_prepare($conexion, "SELECT * FROM persona WHERE identificacion=");

//asociar valores a los parámetros de la sentencia preparada
mysqli_stmt_bind_param($stmt, "ss", $valor1, $valor2);

//asignar valores a las variables de los parámetros
$valor1 = "valor1";
$valor2 = "valor2";

//ejecutar la sentencia preparada
mysqli_stmt_execute($stmt);

//cerrar la sentencia preparada
mysqli_stmt_close($stmt);

//cerrar la conexión
mysqli_close($conex);
