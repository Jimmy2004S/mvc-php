<?php
session_start();
error_reporting(0);
$identificacion = $_SESSION['identificacion'];
$codigoPersonaLogin = $_SESSION['codigo'];
$tipo_persona = $_SESSION['tipo_persona'];
  if($identificacion == null || $identificacion == ""){
      echo 'Error sesion';
      die();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos Investigacion</title>
<!--Font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--CSS-->
<link rel="stylesheet" href="../css/Styles.css"/>
<!--BOOTSTRAP-->
<link rel="stylesheet" href="../sass/custom.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body class="no-padding">
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="nav-user">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user"></i> </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Administrar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../cerrarSesion.php">Cerrar sesion</a>
                        </div>
                </div>
               
                <a class="navbar-brand" href="../vistas/inicio.php">Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"> Crear anuncio
                            <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown  administrador">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="usuarios.php">Usuarios</a>
                            <a class="dropdown-item" href="#">Proyectos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Acerca de</a>
                            </div>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="search" placeholder="Search" oninput="buscarTabla()" id="buscar">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>