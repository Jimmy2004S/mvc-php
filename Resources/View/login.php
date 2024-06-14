<?php
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
    <link rel="icon" type="image/x-icon" href="iconon-1.webp" />
    <title> Login </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="css/styles.css">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
<body>
    <div>
        <main class="main d-flex justify-content-center row">
            <form class="form w-50 mt-5" action="index.php?url=SessionController/login" method="post">
                <h2 id="login">Login</h2>
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email...">
                <input type="password" name="clave" class="form-control" id="floatingPassword" placeholder="Clave...">
                <button>Login</button>
                <hr>
                <p>You are not registered?<a href="register.php">Register</a></p>
            </form>
        </main>
        <footer class="footer">
            <div class="d-flex justify-content-center align-items-center flex-column ">
                <h3> Copyright © 2023 All rights reserved</h1> 
                <img style="width: 20%;" src="multimedia/logo-unicolombo.png" alt="">
            </div>
        </footer>
    </div>
    <!--SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>  
    <script src="js/scriptadmin.js"></script>  
</body>
</html>