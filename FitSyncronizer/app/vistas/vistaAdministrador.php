<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitSyncronizer | Panel Administración</title>
    <link rel="icon" href="web/imagenes/FitSync2.png" type="image/x-icon">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel="stylesheet" href="web/css/vistaNormal.css">
    <link rel="stylesheet" href="web/css/estilosComun.css">
    <style>
    .small-table {
        width: 50%; 
        margin: auto; 
    }
    .big-table{
        width: 60%; 
        margin: auto; 
    }
    .small-table th, .small-table td .big-table th, .big-table td {
        padding: 5px; /* Reduce el padding */
        font-size: 14px; /* Ajusta el tamaño de la fuente */
    }
</style>
</head>

<body>
    <header id="header-big">
        <div id="header-bg__container">
            <div id="fecha" class="fecha"></div>
            <button class="navbar-toggler navbar-buttonB" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="brandOffcanvas" href="">
                        <img src="web/imagenes/FitSync2.png" width="80px" height="auto" alt="logo de FitSyncronizer">
                        <span>FitSyncronizer</span>
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="color:white!important"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="offcanvas-body" style="text-align: center;">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#entrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#dietas"><i class="fa-solid fa-bowl-rice"></i>Dietas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#perfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#usuarios"><i class="fa-solid fa-globe"></i> Usuarios</a>
                        </li>
                        <?php if (Sesion::getUsuario()->getRol() == "Profesional") : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?accion=miPerfil"><i class="fa-solid fa-globe"></i> Mi perfil</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <hr style="color: black; border: 2px solid rgb(255, 255, 255);">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= Sesion::getUsuario()->getNombreUsuario() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= Sesion::getUsuario()->getNombre() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= Sesion::getUsuario()->getCorreo() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= Sesion::getUsuario()->getTelefono() ?></a>
                        </li>

                    </ul>
                    <hr style="color: black; border: 2px solid rgb(255, 255, 255);">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=ajustes">Ajustes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=sobreMi">Sobre Mi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=cerrarSesion">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    <main>
        <div class="sidebar">
            <a class="brand" href="">
                <img src="web/imagenes/FitSync2.png" width="100px" height="auto" alt="logo de FitSyncronizer">
                <span>FitSyncronizer</span>
            </a>
            <hr class="separador">
            <p><?= Sesion::getUsuario()->getNombreUsuario() ?></p>
            <p><?= Sesion::getUsuario()->getNombre() ?></p>
            <p><?= Sesion::getUsuario()->getCorreo() ?></p>
            <p><?= Sesion::getUsuario()->getTelefono() ?></p>
            <hr class="separador">
            <div class="PrimaryMenu">
                <a href="#"><i class="fa-solid fa-house"></i> Inicio</a>
                <a href="#entrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                <a href="#dietas"><i class="fa-solid fa-bowl-rice"></i> Dietas</a>
                <a href="#perfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
                <a href="#usuarios"><i class="fa-solid fa-globe"></i> Usuarios</a>
                <?php if (Sesion::getUsuario()->getRol() == "Profesional") : ?>
                    <a href="index.php?accion=miPerfil"><i class="fa-solid fa-globe"></i> Mi perfil</a>
                <?php endif; ?>
            </div>
            <hr>
            <div class="SecondaryMenu">
                <a href="index.php?accion=ajustes">Ajustes</a>
                <a href="index.php?accion=sobreMi">Sobre Mi</a>
                <a href="index.php?accion=cerrarSesion">Cerrar Sesión</a>
            </div>
        </div>
        <section class="full-view-content">
            <div id="content-container">
                <h1>Panel de Administración</h1>

                <!-- Tabla de Entrenamientos -->
                <h2 id="entrenamientos">Entrenamientos</h2>
                <table class="table table-striped big-table">
                    <thead>
                        <tr>
                            <th>Id Usuario</th>
                            <th>ID</th>
                            <th>Grupo Muscular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entrenamientos as $entrenamiento) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entrenamiento->getIdUsuario()); ?></td>
                                <td><?php echo htmlspecialchars($entrenamiento->getId()); ?></td>
                                <td><?php echo htmlspecialchars($entrenamiento->getGrupoMuscular()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarEntrenamiento&id=<?php echo htmlspecialchars($entrenamiento->getId()); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($entrenamiento->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tabla de Dietas -->
                <h2 id="dietas">Dietas</h2>
                <table class="table table-striped big-table">
                    <thead>
                        <tr>
                            <th>Id Usuario</th>
                            <th>ID</th>
                            <th>Nombre Dieta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dietas as $dieta) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dieta->getIdUsuario()); ?></td>
                                <td><?php echo htmlspecialchars($dieta->getId()); ?></td>
                                <td><?php echo htmlspecialchars($dieta->getNombreDieta()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarDieta&id=<?php echo htmlspecialchars($dieta->getId()); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($dieta->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tabla de Usuarios -->
                <h2 id="usuarios">Usuarios</h2>
                <table class="table table-striped big-tablee">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Nombre de Usuario</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario->getId()); ?></td>
                                <td><?php echo htmlspecialchars($usuario->getRol()); ?></td>
                                <td><?php echo htmlspecialchars($usuario->getNombre()); ?></td>
                                <td><?php echo htmlspecialchars($usuario->getNombreUsuario()); ?></td>
                                <td><?php echo htmlspecialchars($usuario->getCorreo()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarUsuario&id=<?php echo htmlspecialchars($usuario->getId()) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm mb-2">Eliminar</button>
                                    </form>
                                    <form action="index.php?accion=modificarUsuarioAdmin&id=<?php echo htmlspecialchars($usuario->getId()) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario->getId()); ?>">
                                        <button type="submit" class="btn btn-primary btn-sm mb-2">Modificar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tabla de Perfiles -->
                <h2 id="perfiles">Perfiles Profesionales</h2>
                <table class="table table-striped big-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Real</th>
                            <th>Nombre Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perfiles as $perfil) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($perfil->getId()); ?></td>
                                <td><?php echo htmlspecialchars($perfil->getNombrePersonal()); ?></td>
                                <td><?php echo htmlspecialchars($perfil->getNombreUsuarioProfesional()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarPerfil&id=<?php echo $perfil->getId() ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($perfil->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
            <footer>
                <div id="politicasFooter">
                    <h5>Política de Privacidad:</h5>
                    <hr>
                    <p>
                        En FitSyncronizer, valoramos y respetamos tu privacidad. <br><br> Puedes
                        encontrar más detalles en nuestra página de Política de Privacidad.
                    </p>
                    <hr>
                    <p>
                        <i class="fa-regular fa-copyright"></i> [2024] [FitSyncronizer]. Todos los derechos reservados.
                        El contenido de este sitio web, incluyendo
                        texto, imágenes, gráficos y otros materiales, está protegido por las leyes de derechos de autor
                        y otras leyes
                        de propiedad intelectual.
                    </p>
                </div>
                <div id="logoFooter">
                    <img src="web/imagenes/FitSync2.png" alt="imagen del logo de FytSyncronizer" width="250px">
                </div>
                <div id="redesFooter">
                    <h5>Redes sociales</h5>
                    <a href=""><i class="fa-brands fa-x-twitter"></i> Twitter</a><br>
                    <a href=""><i class="fa-brands fa-youtube"></i> Youtube</a><br>
                    <a href=""><i class="fa-brands fa-instagram"></i></i> Instagram</a><br>
                    <a href=""><i class="fa-brands fa-tiktok"></i> TikTok</a><br>
                    <a href=""><i class="fa-brands fa-twitch"></i> Twitch</a><br>
                </div>
            </footer>
        </section>
    </main>
    <div class="content-small">
        <header class="header__small">
            <div class="container">
                <div class="d-flex align-items-center">
                    <a class="header__small__brand me-auto" href="">
                        <img src="web/imagenes/FitSync2.png" width="80px" height="auto" alt="logo de FitSyncronizer">
                        <span>FitSyncronizer</span>
                    </a>
                    <div class="crm-menu-header">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="index.php?accion=ajustes"><i class="fa-regular fa-circle-user"></i></a>
                        <a href="index.php?accion=cerrarSesion"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <a class="brandOffcanvas" href="">
                                <img src="web/imagenes/FitSync2.png" width="80px" height="auto" alt="logo de FitSyncronizer">
                                <span>FitSyncronizer</span>
                            </a>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="color:white!important"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <div class="offcanvas-body" style="text-align: center;">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#entrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#dietas"><i class="fa-solid fa-bowl-rice"></i>Dietas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#perfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#usuarios"><i class="fa-solid fa-globe"></i> Usuarios</a>
                                </li>
                                <?php if (Sesion::getUsuario()->getRol() == "Profesional") : ?>
                                    <li class="nav-item">
                                        <a href="index.php?accion=miPerfil"><i class="fa-solid fa-globe"></i> Mi perfil</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <hr style="color: black; border: 2px solid rgb(255, 255, 255);">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?= Sesion::getUsuario()->getNombreUsuario() ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?= Sesion::getUsuario()->getNombre() ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?= Sesion::getUsuario()->getCorreo() ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?= Sesion::getUsuario()->getTelefono() ?></a>
                                </li>
                            </ul>
                            <hr style="color: black; border: 2px solid rgb(255, 255, 255);">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=ajustes">Ajustes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=sobreMi">Sobre Mi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=cerrarSesion">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="main_small">
            <div id="content-container">
                <h1>Panel de Administración</h1>
                <!-- Tabla de Entrenamientos -->
                <h2 id="entrenamientos">Entrenamientos</h2>
                <table class="table table-striped small-table">
                    <thead>
                        <tr>
                            <th>Id Usuario</th>
                            <th>ID</th>
                            <th>Grupo Muscular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entrenamientos as $entrenamiento) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entrenamiento->getIdUsuario()); ?></td>
                                <td><?php echo htmlspecialchars($entrenamiento->getId()); ?></td>
                                <td><?php echo htmlspecialchars($entrenamiento->getGrupoMuscular()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarEntrenamiento&id=<?php echo htmlspecialchars($entrenamiento->getId()); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($entrenamiento->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Tabla de Dietas -->
                <h2 id="dietas">Dietas</h2>
                <table class="table table-striped small-table">
                    <thead>
                        <tr>
                            <th>Id Usuario</th>
                            <th>ID</th>
                            <th>Nombre Dieta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dietas as $dieta) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dieta->getIdUsuario()); ?></td>
                                <td><?php echo htmlspecialchars($dieta->getId()); ?></td>
                                <td><?php echo htmlspecialchars($dieta->getNombreDieta()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarDieta&id=<?php echo htmlspecialchars($dieta->getId()); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($dieta->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Tabla de Usuarios -->
                <h2 id="usuarios">Usuarios</h2>
                <table class="table table-striped small-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario->getId()); ?></td>
                                <td><?php echo htmlspecialchars($usuario->getNombreUsuario()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarUsuario&id=<?php echo htmlspecialchars($usuario->getId()) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Tabla de Perfiles -->
                <h2 id="perfiles">Perfiles Profesionales</h2>
                <table class="table table-striped small-table mb-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Real</th>
                            <th>Nombre Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perfiles as $perfil) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($perfil->getId()); ?></td>
                                <td><?php echo htmlspecialchars($perfil->getNombrePersonal()); ?></td>
                                <td><?php echo htmlspecialchars($perfil->getNombreUsuarioProfesional()); ?></td>
                                <td>
                                    <form action="index.php?accion=eliminarPerfil&id=<?php echo $perfil->getId() ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($perfil->getId()); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <footer class="crm_footer">
                    <p>
                        <i class="fa-regular fa-copyright"></i> [2024] [FitSyncronizer]. Todos los derechos reservados.
                        El contenido de este sitio web, incluyendo
                        texto, imágenes, gráficos y otros materiales, está protegido por las leyes de derechos de autor
                        y otras leyes
                        de propiedad intelectual.
                    </p>
                    <img src="web/imagenes/FitSync2.png" alt="foto del logo" width="200px">
                    <div id="crm_footer-redes">
                        <h5>Redes sociales</h5>
                        <a href=""><i class="fa-brands fa-x-twitter"></i> Twitter</a><br>
                        <a href=""><i class="fa-brands fa-youtube"></i> Youtube</a><br>
                        <a href=""><i class="fa-brands fa-instagram"></i></i> Instagram</a><br>
                        <a href=""><i class="fa-brands fa-tiktok"></i> TikTok</a><br>
                        <a href=""><i class="fa-brands fa-twitch"></i> Twitch</a><br>
                    </div>
                </footer>
            </div>
    </div>

    </main>

    </div>
    <!-- JavaScript de Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
    <script src="web/archivosJS/date.js"></script>
</body>

</html>