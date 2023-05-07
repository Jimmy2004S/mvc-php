
<?php include("../template/navegacion.php"); ?>
        <div class="row d-flex mt-5">
                        <!--FORMULARIO-->
                    <div class="col-xl-5 col-md-5 col-sm-12 add-project" >
                                <form class="formulario-project" method="POST" enctype="multipart/form-data">
                                        <legend><h3>Administrar proyectos</h3></legend>
                                        <input type="hidden" readonly name="codigoProyecto" value="<?php echo $codigoProyecto; ?>" placeholder="Codigo Proyecto">
                                        <input type="hidden" readonly name="codigoPersona" value=" <?php echo $codigoPersonaLogin; ?> ">
                                        <input type="text" readonly name="fecha" value="<?php echo $fecha ?>">
                                        <input type="text" value="<?php echo $nombre; ?>" name="nombre" required placeholder="Nombre de proyecto..." >
                                        <input type="text" value="<?php echo $descripcion; ?>" name="descripcion" placeholder="Descripcion">
                                        <select name="codigoGrupo" id="">
                                            <option selected="true" disabled="disabled">seleccione un grupo</option>
                                            <?php foreach ($listaCodigoGrupo as $grupos) {?>
                                                <option value="<?php echo $grupos['codigo'] ?>">  <?php echo $grupos['codigo'] ?> </option>
                                            <?php } ?>
                                        </select>
                                        <div>
                                            <label for=""> <?php echo $archivo; ?></label></br>
                                            <input type="file" value="<?php echo $archivo ?>" name="archivo">
                                        </div>
                                        <div class="form-btn d-flex flex-column">
                                            <input type="submit" <?php echo($accion=="Seleccionar")? "disabled": ""; ?> class="btn btn-danger" name="accion" value="Registrar">
                                            <input type="submit" <?php echo($accion!= "Seleccionar")? "disabled": ""; ?> class="btn btn-success" name="accion" value="Modificar">
                                        </div>
                                </form>
                    </div>
                    <div class="col-xl-7 col-md-7 col-sm-12 vh-100 overflow-auto" id="">             
                        <div class="row" id="my-projects" style=" height:100%;">
        
                        </div>
                    </div>
        </div>    
<?php include("../template/footer.php"); ?>
