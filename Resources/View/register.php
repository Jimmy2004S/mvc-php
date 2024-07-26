<?php include '../resources/view/template/head.php'; ?>

<body>
    <div>
        <main class="main row d-flex justify-content-center ">
            <form id="form-user-register" class="form w-50 mt-5 p-4" method="POST">
                <h2 class="text-center mb-4">Register</h2>
                <p class="text-center mb-4">Crea una <span>cuenta</span> para acceder a las funciones de la aplicación</p>
                <div class="w-100 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group w-100 mb-3">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Name..." required>
                    </div>
                    <div class="form-group w-100 mb-3">
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Last name..." required>
                    </div>
                    <div class="form-group w-100 mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email..." required>
                    </div>
                    <div class="form-group w-100 mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group w-100 mb-3">
                        <select name="role" id="role" class="form-control" onchange="inforRoleUser();" required>
                            <option selected="true" disabled="disabled">Seleccione tipo de usuario</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                    </div>
                    <div id="register-student-infor" class="w-100 form-group desaparece">
                        <div class="form-group w-100 mb-3">
                            <select name="career" class="form-control">
                                <option selected="true" disabled="disabled">-- Carrera --</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="Ingenieria de Sistemas">Ingeniería de Sistemas</option>
                                <option value="Ingenieria Industrial">Ingeniería Industrial</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Turismo">Turismo</option>
                            </select>
                        </div>
                        <div class="form-group w-100 mb-3">
                            <select name="semestre" class="form-control">
                                <option selected="true" disabled="disabled">Semestre</option>
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="register-teacher-infor" class="w-100 form-group desaparece">
                        <div class="form-group w-100 mb-3">
                            <select name="department" class="form-control">
                                <option selected="true" disabled="disabled">-- Departamento --</option>
                                <option value="Informatica">Informática</option>
                                <option value="Idiomas">Idiomas</option>
                                <option value="Ciencias">Ciencias</option>
                                <option value="Artes">Artes</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </div>
                <p class="text-center mt-4">¿Ya tienes una cuenta? <a href="/">Log in</a></p>
            </form>
        </main>
        <?php include '../resources/view/template/footer.php'; ?>
    </div>
</body>
</html>
