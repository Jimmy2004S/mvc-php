
<?php include("../template/navegacion.php"); ?>
        <div class="container d-flex flex-column mt-5">
            <!--Dialog-->  
            <button id="add-project" type="button" class="btn btn-primary mb-3">Agregar proyecto</button>
                            <div class="modal" id="miModal">
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
                                                        <input type="hidden" readonly name="codigoProyecto" id="codigoProyecto" placeholder="Codigo Proyecto">
                                                        <input type="hidden" readonly name="codigoPersona"id="codigoPersona" value="<?php echo $codigoPersonaLogin ?>">
                                                        <input type="hidden" readonly name="fecha_inicio">
                                                        <input type="text" id="nombreProyecto" name="nombreProyecto" required placeholder="Nombre de proyecto..." >
                                                        <input type="text" name="descripcion" id="descripcion" required placeholder="Descripcion...">
                                                        <select name="codigoGrupo" id="miSelectGrupo" required>
                                                            <option selected="true" disabled="disabled">seleccione un grupo</option>
                                                            <?php foreach ($listaCodigoGrupo as $grupos) {?>
                                                                <option value="<?php echo $grupos['codigo_grupo']; ?>"> <?php echo $grupos['codigo_grupo']; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="p-0 ms-5 mt-3 ">
                                                            <p class="mb-0 p-0" id="nombreArchivo"> </p></br>
                                                            <input class="mt-0 p-0" type="file" required value="<?php echo $archivo ?>" name="archivo">
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                                                    <input type="submit" name="accion"  class="btn btn-primary custom-btn" id="btn-registrar"  value="Registrar">
                                                    <input type="submit" name="accion"  class="btn btn-primary custom-btn" id="btn-modificar" value="Modificar">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
            <div class="row" id="my-projects">
            </div>
        </div>    
<?php include("../template/footer.php"); ?>
