<?php
//error_reporting(0);
//   $identificacion = $_SESSION['identificacion'];
//   $codigoPersonaLogin = $_SESSION['codigo'];
//   $tipo_persona = $_SESSION['tipo_persona'];
// $nombres = $_SESSION['nombre'] . $_SESSION['apellido'];
// $to = 'jimmisiitho450@gmail.com';
// $email =   $_SESSION['email'];
// //     // if($identificacion == null || $identificacion == ""){
// //     //     header("location: ../ErrorSesion.php");
// //     //     die();
// //     // }
?>

<?php
// include("../Datos/grupos/listar.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://proaula.test/"> <!--Definir url las rutas relativas -->
    <link rel="icon" type="image/x-icon" href="iconon-1.webp" />
    <title>Proyectos Investigacion</title>
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="css/styles.css" />
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body class="no-padding container-fluid m-0 p-0">
    <div class="container-fluid px-0">
        <div class="modal" id="miModalC">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar Correo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <form class="formulario-project" id="form-report" method="POST">
                        <div class="modal-body">
                            <div class="input-form">
                                <input type="hidden" id="my-email" value="<?php echo $email ?>">
                                <input type="hidden" id="to" value="<?php echo $to ?>">
                                <input type="text" id="subject" placeholder="Subject...">
                                <textarea name="texto" id="messagge" rows="5" cols="40" placeholder="Describe el problema"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                                <input type="submit" name="accion" class="btn btn-primary" id="enviar-correo" value="Enviar correo">
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="navbar w-100 container-fluid navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="nav-user">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
                    <div class="dropdown-menu">
                        <p class="px-3 bg-color-success color-white"> <?php echo $nombres ?> </p>
                        <a class="dropdown-item" href="#">Mi informacion </a>
                        <a class="dropdown-item" id="report" href="#">Denunciar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="api/logout">Cerrar sesion</a>
                    </div>
                </div>
                <a class="navbar-brand" id="home-link">Homepage</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" id="tendencias-link">Trends
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="portfolio-link" href="../vistas/misProject.php">My portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="groups-link" href="../vistas/misGrupos.php">My groups</a>
                        </li>
                    </ul>
                    <!-- Campo de busqueda -->
                    <form class="d-flex">
                        <input class="form-control me-sm-2" id="search" type="search" placeholder="Search">
                    </form>
                </div>
            </div>
        </nav>