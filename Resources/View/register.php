<?php include '../resources/view/template/head.php'; ?>
<body>
    <div>
        <main class="main row d-flex justify-content-center ">
            <form class="form w-50 mt-5" action="Datos/persona/agregarPersona.php" method="POST">
                <h2>Register</h2>
                <p>Crea una <span>cuenta</span> para acceder a las funciones de la aplicación</p>
                <input type="text" name="nombre" id="nombre" placeholder="Name..." required>
                <input type="text" name="apellido" id="apellido" placeholder="Last name..." required>
                <input type="email" name="email" id="email" placeholder="Email..." required>
                <input type="password" name="password" placeholder="passsword">
                <select name="role" id="role" onchange="inforTipoPersona();">
                    <option selected="true" disabled="disabled">seleccione tipo de usuario</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Estudiante">Studiante</option>
                </select>
                    <div id="estudiante" class="desaparece">
                        <input type="text" id="carrera" placeholder="Carrera..." name="carrera">
                            <select name="semestre">
                                <option selected="true" disabled="disabled">Semestre</option>
                                <?php for ($i=0; $i < 11; $i++) { ?>
                                <option value=" <?php echo $i ?> "> <?php echo $i ?> </option>
                                <?php } ?>
                            </select>
                    </div>
                    <div id="profesor" class="desaparece">
                        <input type="text" id="departamento" name="departamento" placeholder="Departamento...">
                    </div>
                    <button type="submit">registrar</button>
                    <p>¿Ya tienes una cuenta? <a href="/">Log in</a></p>
            </form>
        </main> 
<?php include '../resources/view/template/footer.php'; ?>