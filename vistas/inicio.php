<?php include("../template/navegacion.php"); ?>

        <div class="col-12 mt-5">
                    <div class="container mt-2">
                        <div class="row">
                            <?php foreach ($lista as $proyectos) { ?>
                            <div class="col-sm-12 col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header d-flex">
                                        <div class="p-2 w-80">
                                            <h5 class="card-title"><?php echo $proyectos['nombre']?></h5>
                                            <p class="text-secondary"><?php echo $proyectos['fecha_inicio'] ?></p>
                                        </div>     
                                    </div>
                                    <div class="card-body" id="proyecto_<?php echo $proyectos['codigo']; ?>">
                                        <p class="card-text"><?php echo $proyectos['descripcion'] ?></p>
                                        <div class="d-flex">
                                            <form action="" method="post">
                                                <input type="hidden" name="codigo" value="<?php echo $proyectos['codigo']; ?>" >
                                                    <input class="btn btn-primary" type="submit" name="accion" value="Like">
                                                </form>
                                        </div>
                                        <div class="likes-container">
                                            <span class=""> <?php echo $proyectos['likes']; ?> </span> personas les gusta este proyecto.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
        </div>
<?php include("../template/footer.php") ?>