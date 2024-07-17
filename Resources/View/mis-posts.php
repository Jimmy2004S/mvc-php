<?php include '../resources/view/template/head.php'; ?>
<?php include '../resources/view/template/navegacion.php'; ?>
<div class="container d-flex flex-column mt-5">
    <!--Dialog-->
    <button id="add-post" type="button" class="btn btn-primary mb-3">Add project</button>
    <div class="modal" id="miModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form class="post-form" id="post-form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-form">
                            <div class="image-upload">
                                <label for="cover_image_input">
                                    <img id="cover_image_preview" src="img/no-photo.jpg" alt="Seleccionar imagen de portada" />
                                </label>
                                <input id="cover_image_input" type="file" name="cover_image" accept="image/*" required>
                                <p id="cover_image_name"></p>
                            </div>
                            <input type="hidden" readonly name="post_id" id="post_id">
                            <input type="hidden" readonly name="user_id" id="user_id" value="{{id_persona}}">
                            <input type="hidden" readonly name="created_at">
                            <input type="text" id="post_title" name="title" required placeholder="Titulo del proyecto...">
                            <textarea class="form-control" id="post_description" name="description" required placeholder="Descripción..." rows="3" spellcheck="false"></textarea>
                            <div>
                                <p id="pdf_name"></p>
                                <input type="file" required value="{{nombre_archivo}}" name="pdf" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-btn d-flex flex-column" id="form-project-action">
                            <input type="submit" name="action" class="btn btn-primary custom-btn" id="btn-create-post" value="publicar">
                            <input type="submit" name="action" class="btn btn-primary custom-btn" id="btn-update-post" value="actualizar">
                        </div>
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