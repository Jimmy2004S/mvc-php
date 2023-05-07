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
        <main class="main row d-flex justify-content-center ">
            <form class="form w-50 mt-5" action="Datos/persona/agregarPersona.php" method="POST'">
                <h2>Register</h2>
                <p>Crea una <span>cuenta</span> para acceder a las funciones de la aplicación</p>
                <input type="text" name="nombre" id="" placeholder="Nombre..." required>
                <input type="text" name="apellido" id="" placeholder="Apellido..." required>
                <input type="text" name="identificacion" id="" placeholder="identificacion..." required>
                <input type="email" name="email" id="" placeholder="Correo..." required>
                <input type="text" name="telefono" id="" placeholder="Telefono..." required>
                <select name="tipoUsuario" id="tipous" onchange="inforTipoPersona();">
                    <option selected="true" disabled="disabled">seleccione tipo de usuario</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Estudiante">Estudiante</option>
                </select>
                    <div id="estudiante" class="desaparece">
                        <input type="text" placeholder="Carrera..." name="carrera" required>
                            <select name="semestre"">
                                <option selected="true" disabled="disabled">Semestre</option>
                                <?php for ($i=0; $i < 11; $i++) { ?>
                                <option value=" <?php echo $i ?> "> <?php echo $i ?> </option>
                                <?php } ?>
                            </select>
                    </div>
                    <div id="profesor" class="desaparece">
                        <input type="text" name="departamento" placeholder="Departamento...">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Registrarse">
                <p>¿Ya tienes una cuenta? <a href="index.php">Iniciar sesion</a></p>
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