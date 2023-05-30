<?php include("../template/navegacion.php") ?>
        <div class="container d-flex flex-column mt-5">
            <!--Dialog-->  
                            <button id="add-project" type="button" class="btn btn-primary mb-5">Agregar grupo</button>
                            <div class="modal" id="miModalG">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Administrar grupos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <form class="formulario-grupo" id="form-grupo" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                    <div class="input-form">
                                                        <input type="text" readonly name="codigoGrupo" id="codigoGrupoG" placeholder="Codigo grupo">
                                                        <input type="hidden" readonly name="codigoPersona"id="codigoPersona" value="<?php echo $codigoPersonaLogin ?>">
                                                        <input type="text" id="nombreGrupoG" name="nombre-grupo" required placeholder="Nombre de grupo...">  
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                                                    <input type="submit" name="accion"  class="btn btn-primary custom-btn" id="btn-registrar-G"  value="Registrar">
                                                    <input type="submit" name="accion"  class="btn btn-primary custom-btn" id="btn-modificar-G" value="Modificar">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
            <div class="row" id="my-grupos">
            </div>
        </div>    
<?php include("../template/footer.php") ?>