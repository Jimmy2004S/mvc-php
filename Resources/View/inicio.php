<?php include '../resources/view/template/navegacion.php'; ?>
<div class="col-12 container-inicio">
</div>
<div class="col-12 mt-5">
        <div class="container mt-2">
                <div class="row w-80" id="all-posts">
                        <!-- Aquí se llenará dinámicamente la lista de posts -->
                </div>
        </div>

        <!-- Plantilla de post oculta -->
        <div id="templates" style="display: none;">
                <div id="post-template">
                        <div class="col-sm-12 col-md-6">
                                <div post-id="{{id}}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
                                        <div class="card-header">
                                                <h4 class="card-title">{{title}}</h4>
                                                <h6 class="card-subtitle text-muted">{{created_at}}</h6>
                                        </div>
                                        <img src="https://picsum.photos/400/200" alt="" />
                                        <div class="card-body">
                                                <p class="card-text">{{description}}</p>
                                                <a href="#" target="blank" class="card-link">Link 1</a>
                                                <a href="#" class="card-link">Link 2</a>
                                        </div>
                                        <div class="card-footer text-muted d-flex">
                                                <div user-id="{{user_id}}" class="col-9">
                                                        <p>{{author}}</p>
                                                        <p>Semestre {{semester_student}}</p>
                                                        <p>{{career_student}}</p>
                                                </div>
                                                <div class="col-3 p-0 ms-auto">
                                                        <button type="button" class="btn {{class}}">
                                                                <i class="{{like_state}} fa-sharp fa-regular fa-heart me-2"></i>{{num_likes}} Likes
                                                        </button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<?php include '../resources/view/template/footer.php'; ?>