<?php include("../Datos/proyectos/listar.php"); ?>
<?php include("../template/navegacion.php"); ?>

    <div class="container mt-3">
            <div class="row">
                <div class="col-12 mb-3 d-flex">
                    <div class="add-project p-2 w-100">
                        <a href="addProject.php"> <i class="fa-solid fa-square-plus"></i> New proyect </a>
                    </div>
                    <div class="p-2 flex-shrink-1">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                            <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Mi informacion </a>
                                    <a class="dropdown-item" href="#">Denunciar</a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Cerrar sesion</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row vh-100">
            <div class="col-12">
                <div class="container-fluid mt-2">
                    <div class="row">
                        <?php foreach ($lista as $proyectos) { ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title"><?php echo $proyectos['nombre'] . '  | ' .  $proyectos['codigo']  ?></h5>
                                    <p class="text-danger"><?php echo $proyectos['fecha_inicio'] ?></p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $proyectos['descripcion'] ?></p>
                                    <a href="#" class="btn btn-primary">Ver detalles</a>
                                    <input type="hidden" name="id" value="<?php echo $proyectos['codigo']; ?>" >
                                    <input type="submit" class="btn btn-danger" name="accion" value="Eliminar">
                                    <input type="submit" class="btn btn-primary" name="accion" value="Modificar">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>

            </div>
            </div>
    </div>

<?php include("../template/footer.php"); ?>   