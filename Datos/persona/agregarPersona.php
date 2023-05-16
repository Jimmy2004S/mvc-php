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
    echo '<script>window.alert("Registrado..."); window.location.href = "../../vistas/misProject.php";</script>';

} catch (PDOException $e) {
    // Cancelar transacción en caso de error
    $conexion->rollback();
    echo "Error en la transacción: " . $e->getMessage();
}
$stmt = null;
$stmt1 = null;
$conexion = null;
  

