<?php
include("../conexion.php");

//sentencia preparada
$stmt = mysqli_prepare($conexion, "INSERT INTO `proyectos`(`nombre`, `descripcion`,`codigo_grupo`, `codigo_lider_proyecto`) VALUES (?,?,?,?)");

//asociar valores a los parámetros de la sentencia preparada
mysqli_stmt_bind_param($stmt, "ssii", $valor1, $valor2);


//ejecutar la sentencia preparada
mysqli_stmt_execute($stmt);

//cerrar la sentencia preparada
mysqli_stmt_close($stmt);

//cerrar la conexión
mysqli_close($conex);
