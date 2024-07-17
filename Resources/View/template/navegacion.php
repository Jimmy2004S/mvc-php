<body class="no-padding container-fluid m-0 p-0">
    <div class="container-fluid px-0">
        <div class="modal" id="miModalC">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar Correo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <form class="formulario-project" id="form-report" method="POST">
                        <div class="modal-body">
                            <div class="input-form">
                                <input type="hidden" id="my-email" value="<?php echo $email ?>">
                                <input type="hidden" id="to" value="<?php echo $to ?>">
                                <input type="text" id="subject" placeholder="Subject...">
                                <textarea name="texto" id="messagge" rows="5" cols="40" placeholder="Describe el problema"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                                <input type="submit" name="accion" class="btn btn-primary" id="enviar-correo" value="Enviar correo">
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="navbar w-100 container-fluid navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="nav-user">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
                    <div class="dropdown-menu">
                        <p class="px-3 bg-color-success color-white"> <?php echo $nombres ?> </p>
                        <a class="dropdown-item" id="report" href="#">Reportar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="api/logout">Cerrar sesion</a>
                    </div>
                </div>
                <a class="navbar-brand active" id="home-link">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" id="tendencias-link">Tendencias
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="my-perfil-link">My perfil</a>
                        </li>
                    </ul>
                    <!-- Campo de busqueda -->
                    <form class="d-flex">
                        <input class="form-control me-sm-2" id="search" type="search" placeholder="Search">
                    </form>
                </div>
            </div>
        </nav>