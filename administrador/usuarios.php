
<?php 
    $accion = (isset($_POST["accion"]))? $_POST["accion"]: "";
    $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";

    switch($accion){
        case "Registrar":
            include("insertar.php");
            break;
        case "Eliminar":
            include("eliminar.php");
            break;
    }  
?>

<?php include("templateAdmin/navegacion.php"); ?>
                            <div class="modal" id="miModalA">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Administrar proyectos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <form class="formulario-project" id="form-addProject" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                    <div class="input-form">
                                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." required>
                                                        <input type="text" name="apellido" id="apellido" placeholder="Apellido..." required>
                                                        <input type="text" name="identificacion" id="identificacion" placeholder="identificacion..." required>
                                                        <input type="email" name="email" id="emailPersona" placeholder="Correo..." required>
                                                        <input type="text" name="telefono" id="telefono" placeholder="Telefono..." required>
                                                        <select name="tipoUsuario" id="tipous" onchange="inforTipoPersona();">
                                                            <option selected="true" disabled="disabled">seleccione tipo de usuario</option>
                                                            <option value="Profesor">Profesor</option>
                                                            <option value="Estudiante">Estudiante</option>
                                                        </select>
                                                            <div id="estudiante" class="desaparece">
                                                                <input type="text" id="carrera" placeholder="Carrera..." name="carrera">
                                                                    <select name="semestre"">
                                                                        <option selected="true" disabled="disabled">Semestre</option>
                                                                        <?php for ($i=0; $i < 11; $i++) { ?>
                                                                        <option value=" <?php echo $i ?> "> <?php echo $i ?> </option>
                                                                        <?php } ?>
                                                                    </select>
                                                            </div>
                                                            <div id="profesor" class="desaparece">
                                                                <input type="text" id="departamento" name="departamento" placeholder="Departamento...">
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                                                    <input type="submit" name="accion"  class="btn btn-primary" id="btn-modificar" value="Modificar">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
    <section class="container mt-5 mb-5">
        <div class="table-responsive">
            <table class="table" id="tabla">
                <thead class="table-dark">
                    <tr>
                        <th> Codigo</th>
                        <th> Nombres </th>
                        <th> Tipo persona </th>
                        <th> Correo electronico </th>
                        <th> Telefono </th>
                        <th> Estado </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="personasINadmin">
                </tbody>
                </table>
        </div> 
    </section>
  
        <footer class="footer container-fluid m-0 row">
                    <div class="d-flex justify-content-center align-items-center flex-column ">
                        <h3> Copyright © 2023 All rights reserved</h1> 
                        <img style="width: 20%;" src="../multimedia/logo-unicolombo.png" alt="">
                    </div>
        </footer>
    </div>
    <!--SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="scriptadmin.js"></script>  
</body>
</html>