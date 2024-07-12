  <!-- Plantilla de post oculta -->
  <div id="templates" style="display: none;">
          <div id="post-template">
                  <div class="col-sm-12 col-md-6">
                          <div post-id="{{id}}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
                                  <div class="card-header">
                                          <h4 class="card-title">{{title}}</h4>
                                          <h6 class="card-subtitle text-muted">{{created_at}}</h6>
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
                                                  <button type="button" class="select ms-3 btn btn-outline-dark desaparece" id="seleccionar-button">
                                                          <i class="select fa-solid fa-hand-pointer"></i>
                                                  </button>
                                          </div>
                                  </div>
                          </div>
                  </div>
          </div>
  </div>