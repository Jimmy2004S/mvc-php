<?php include '../resources/view/template/navegacion.php'; ?>
        <div class="container d-flex flex-column mt-5">
            <!--Dialog-->  
            <button id="add-project" type="button" class="btn btn-primary mb-3">Add project</button>
                            <div class="modal" id="miModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Manage project</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <form class="post-form" id="post-form" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                    <div class="input-form">
                                                        <input type="hidden" readonly name="post_id" id="post_id">
                                                        <input type="hidden" readonly name="user_id"id="user_id" value="{{id_persona}}">
                                                        <input type="hidden" readonly name="created_at">
                                                        <input type="text" id="post_title" name="title" required placeholder="Titulo del proyecto..." >
                                                        <textarea class="form-control" id="post_description" name="description" required placeholder="Descripción..." rows="3" spellcheck="false"></textarea>
                                                        <div>
                                                            <p id="file_name"></p>
                                                            <input type="file" required value="{{nombre_archivo}}" name="file">
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-btn d-flex flex-column" id="form-project-action">
                                                    <input type="submit" name="action"  class="btn btn-primary custom-btn" id="btn-create-post"  value="publicar">
                                                    <input type="submit" name="action"  class="btn btn-primary custom-btn" id="btn-update-post" value="actualizar">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
            <div class="row" id="my-posts">
                 <!-- Aquí se llenará dinámicamente la lista de posts -->
            </div>
        </div>
<?php include '../resources/view/template/posts.php'; ?>
<?php include '../resources/view/template/footer.php'; ?>
