
<?php include("../template/navegacion.php"); ?>
        <div class="row d-flex mt-5">
                        <!--FORMULARIO-->
                    <div class="col-xl-5 col-md-5 col-sm-12 add-project" >
                                <form class="formulario-project" id="form-addProject" method="POST" enctype="multipart/form-data">
                                        <legend><h3>Administrar proyectos</h3></legend>
                                        <input type="hidden" readonly name="codigoProyecto" id="codigoProyecto" placeholder="Codigo Proyecto">
                                        <input type="text" readonly name="codigoPersona"id="codigoPersona" value="<?php echo $codigoPersonaLogin ?>">
                                        <input type="hidden" readonly name="fecha_inicio">
                                        <input type="text" id="nombreProyecto" name="nombreProyecto" required placeholder="Nombre de proyecto..." >
                                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion...">
                                        <select name="codigoGrupo" id="miSelectGrupo">
                                            <option selected="true" disabled="disabled">seleccione un grupo</option>
                                            <?php foreach ($listaCodigoGrupo as $grupos) {?>
                                                <option value="<?php echo $grupos['codigo']; ?>"> <?php echo $grupos['codigo']; ?> </option>
                                            <?php } ?>
                                        </select>
                                        <div class="p-0">
                                            <p class="mb-0 p-0" id="nombreArchivo"> </p></br>
                                            <input class="mt-0 p-0" type="file" value="<?php echo $archivo ?>" name="archivo">
                                        </div>
                                        <div class="form-btn d-flex flex-column">
                                            <input type="submit" name="accion" class="btn btn-danger" value="Registrar">
                                            <input type="submit" name="accion" class="btn btn-success" value="Modificar">
                                        </div>
                                </form>
                    </div>
                    <div class="col-xl-7 col-md-7 col-sm-12 vh-100 overflow-auto" id="">             
                        <div class="row" id="my-projects" style=" height:100%;">
        
                        </div>
                    </div>
        </div>    
<?php include("../template/footer.php"); ?>
