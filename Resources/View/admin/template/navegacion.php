<body class="no-padding">
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="nav-user">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user" style="color: #ffffff;"></i> </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Manage</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="api/logout">Cerrar Session</a>
                        </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"> Create AD
                            <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown  administrador">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="admin/users">Users</a>
                            <a class="dropdown-item" href="#">Projects</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">About</a>
                            </div>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="search" placeholder="Search" oninput="buscarTabla()" id="buscar">
                    </form>
                </div>
            </div>
        </nav>