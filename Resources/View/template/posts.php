  <!-- Plantilla de post oculta -->
  <div id="templates" style="display: none;">
          <div id="post-template">
                  <div class="col-sm-12 col-md-6">
                          <div post-id="{{id}}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
                                  <div class="card-header d-flex justify-content-between">
                                          <div>
                                                  <h4 class="card-title">{{title}}</h4>
                                                  <h6 class="card-subtitle text-muted">{{created_at}}</h6>
                                          </div>
                                          <div>
                                                  <ul class="nav nav-pills">
                                                          <li class="nav-item dropdown">
                                                                  <a class="nav-link dropdown-toggle show" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"></a>
                                                                  <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 42px);">
                                                                          <a class="dropdown-item select-post desaparece" id="select-post">Editar</a>
                                                                          <a class="dropdown-item delete-post desaparece" id="delete-post">Eliminar</a>
                                                                          <div class="dropdown-divider"></div>
                                                                          <a class="dropdown-item" href="#">Reportar</a>
                                                                  </div>
                                                          </li>
                                                  </ul>
                                          </div>
                                  </div>
                                  <img src="{{cover_image_path}}" alt="" />
                                  <div class="card-body">
                                          <p class="card-text">{{description}}</p>
                                          <a href="{{pdf_path}}" style="width: 40px" target="blank" class="card-link"><i class="fa-regular fa-folder-open"></i></a>
                                  </div>
                                  <div class="card-footer text-muted d-flex">
                                          <div user-id="{{user_id}}" class="col-7">
                                                  <p>{{author}}</p>
                                                  <p>Semestre {{semester_student}}</p>
                                                  <p>{{career_student}}</p>
                                          </div>
                                          <div class="col-5 p-0 ms-auto d-flex align-items-start justify-content-end">
                                                  <button type="button" class="like btn {{class}}">
                                                          <i class="like {{like_state}} fa-sharp fa-regular fa-heart me-2"></i>{{num_likes}} Likes
                                                  </button>
                                          </div>
                                  </div>
                          </div>
                  </div>
          </div>
  </div>