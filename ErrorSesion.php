<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="multimedia/img-login.jpg" />
    <title> Error </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="css/Styles.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="sass/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
<body class="h-100">
    <div class="container-fluid p-0">
        <section class="container-error d-flex flex-column align-items-center">
            <div class="mt-5 mb-5 mensaje-e text-center">
                <h1>UPPS!</h1>
                <h2>No tienes permiso</h2>
            </div>
            <div class="mt-5">
                <button type="button" class="p-2 btn btn-outline-primary">
                    <a class="text-decoration-none" href="index.php">Inicia sesion</a>
                </button>
            </div>
        </section>
<?php  include("template/footer.php"); ?>