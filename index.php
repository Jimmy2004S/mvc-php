<?php
session_start();
if(isset($_SESSION['error_login']) && $_SESSION['error_login']) {
    echo '<script>alert("Datos de inicio de sesión incorrectos")</script>';
    unset($_SESSION['error_login']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="css/Styles.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="sass/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
<body class="h-100">
    <div class="">
        <main class="main d-flex justify-content-center row">
            <form class="form w-50 mt-5" action="login.php" method="post">
                <h2 id="login">Login</h2>
                <input type="text" name="identificacion" class="form-control" id="floatingInput" placeholder="Identificacion">
                <input type="password" name="contrasenia" class="form-control" id="floatingPassword" placeholder="Password">
                <button>Login</button>
                <hr>
                <p>¿No tienes una cuenta?<a href="register.php">Register</a></p>
            </form>
        </main>
        <footer class="footer container-fluid m-0 row">
                    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                        <div class="h-100">
                            <p>Lorem ipsum dolor sit.</p>
                            <p>Derechos reservados</p>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                        <div class="h-100">
                            <p>Lorem ipsum dolor sit.</p>
                            <p>Lorem ipsum dolor sit.</p>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                        <div class="h-100">
                            <p>Lorem ipsum dolor sit.</p>
                            <p>Derechos reservados</p>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                    </div>       
        </footer>
        <!--SCRIPTS-->
        <script src="script/script.js"></script>  
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</body>
</html>