<div class="sidenav-overlay"></div><!--Overlay-->
<!-- Barra de navegacion lateral-->
<nav id="side-nav" class="d-flex sidebar sidebar-sticky">
    <div id="nav-container" class="position-sticky pt-3">
        <ul class="list-unstyled ps-0 mb-auto">
            <li class="mb-1 px-2">
                <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                <i class="fa-solid fa-desktop"></i>Inventario
                </button>
                <div class="collapse show" id="home-collapse" style="">
                    <ul id="sbar-op" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="sub-nav-link"><a type="button" onclick="cargarContenido('wrapper','vistas/modulos/equipos.php');" class="link-dark rounded sbr-links">Equipos</a></li>
                        <li class="sub-nav-link"><a type="button" onclick="cargarContenido('wrapper','vistas/modulos/areas.php');" class="link-dark rounded sbr-links">Areas</a></li>
                        <!--  -->
                    </ul>
                </div>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dwnUsuario" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="vistas/assets/dist/img/usericon.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $_SESSION["nombre"];?></strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dwnUsuario">
                <li><button id="btnCerrarSesion" class="dropdown-item">Cerrar Sesión</button></li>
            </ul>
        </div>
    </div>
</nav>

