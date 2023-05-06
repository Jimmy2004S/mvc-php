
<?php  include("../Datos/proyectos/listar.php") ?>
<?php  include("../Datos/grupos/listar.php") ?>
<?php include("../template/navegacion.php"); ?>
        <div class="row d-flex mt-5">
                        <!--FORMULARIO-->
                    <div class="col-xl-5 col-md-5 col-sm-12" id="form-add-project" >
                                <form method="POST" enctype="multipart/form-data">
                                        <legend><h3>Administrar proyectos</h3></legend>
                                        <input type="hidden" name="codigoProyecto" value="<?php echo $codigoProyecto; ?>" placeholder="Codigo Proyecto">
                                        <input type="hidden" name="codigoPersona" value=" <?php echo $codigoPersonaLogin; ?> ">
                                        <input type="hidden" name="fecha" value=" <?php echo date("d-m-Y") ?>">
                                        <input type="text" value="<?php echo $nombre; ?>" name="nombre" required placeholder="Nombre de proyecto..." ><br> <br>
                                        <input type="text" value="<?php echo $descripcion; ?>" name="descripcion" placeholder="Descripcion"><br> <br>
                                        <select name="codigoGrupo" id="">
                                            <option selected="true" disabled="disabled">seleccione un grupo</option>
                                            <?php foreach ($listaCodigoGrupo as $grupos) {?>
                                                <option value="<?php echo $grupos['codigo'] ?>">  <?php echo $grupos['codigo'] ?> </option>
                                            <?php } ?>
                                        </select>
                                        </br>
                                        <input type="file" value="" name="archivo"><br> <br>
                                        <input type="submit" <?php echo($accion=="Seleccionar")? "disabled": ""; ?> class="btn btn-danger" name="accion" value="Registrar">
                                        <input type="submit" <?php echo($accion!= "Seleccionar")? "disabled": ""; ?> class="btn btn-success" name="accion" value="Modificar">
                                </form>
                    </div>
                    <div class="col-xl-7 col-md-7 col-sm-12 vh-100 overflow-auto" id="">             
                        <div class="row" style=" height:100%;">
                            <?php foreach ($lista as $proyectos) { ?>
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="card mb-3">
                                        <div class="card-header d-flex">
                                            <div class="p-2 w-50%">
                                                <h5 class="card-title"><?php echo $proyectos['nombre']?></h5>
                                                <p class="text-secondary"><?php echo $proyectos['fecha_inicio'] ?></p>
                                            </div>     
                                        </div>
                                        <div class="card-body" id="proyecto_<?php echo $proyectos['codigo']; ?>">
                                            <p class="card-text"><?php echo $proyectos['descripcion'] ?></p>
                                            <div class="d-flex">
                                                <form method="POST">
                                                    <input type="hidden" name="codigo" value="<?php echo $proyectos['codigo']; ?>" >
                                                    <input type="submit" class="btn btn-secondary" name="accion" value="Eliminar">
                                                    <input type="submit" class="btn btn-danger" name="accion" value="Selecionar">
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
<?php include("../template/footer.php"); ?>
