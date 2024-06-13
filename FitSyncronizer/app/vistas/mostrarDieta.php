<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel="stylesheet" href="web/css/vistaNormal.css">
    <link rel="stylesheet" href="web/css/estilosComun.css">
    <link rel="stylesheet" href="web/css/mostrarStyles.css">
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
                            <a class="nav-link" href="index.php?accion=vistaNormal"><i class="fa-solid fa-house"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=listarEntrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=listarDietas"><i class="fa-solid fa-bowl-rice"></i>Dietas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=listarPerfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
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
                            <a class="nav-link" href="#">Contacto</a>
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
            <a class="sidebar__brand" href="">
                <img src="web/imagenes/FitSync2.png" width="100px" height="auto" alt="logo de FitSyncronizer">
                <span>FitSyncronizer</span>
            </a>
            <hr class="sidebar__separator">
            <div class="sidebar__userData">
                <p><?= Sesion::getUsuario()->getNombreUsuario() ?></p>
                <p><?= Sesion::getUsuario()->getNombre() ?></p>
                <p><?= Sesion::getUsuario()->getCorreo() ?></p>
                <p><?= Sesion::getUsuario()->getTelefono() ?></p>
            </div>
            <hr class="sidebar__separator">
            <div class="sidebar__PrimaryMenu">
                <a href="index.php?accion=vistaNormal" class="sidebar__PrimaryMenu__item"><i class="fa-solid fa-house "></i> Inicio</a>
                <a href="index.php?accion=listarEntrenamientos" class="sidebar__PrimaryMenu__item"><i class="fa-solid fa-dumbbell "></i> Entrenamientos</a>
                <a href="index.php?accion=listarDietas" class="sidebar__PrimaryMenu__item"><i class="fa-solid fa-bowl-rice "></i> Dietas</a>
                <a href="index.php?accion=listarPerfiles" class="sidebar__PrimaryMenu__item"><i class="fa-solid fa-globe "></i> Perfiles</a>
                <?php if (Sesion::getUsuario()->getRol() == "Profesional") : ?>
                    <a href="index.php?accion=miPerfil"><i class="fa-solid fa-globe"></i> Mi perfil</a>
                <?php endif; ?>
            </div>
            <hr>
            <div class="sidebar__SecondaryMenu">
                <a href="index.php?accion=ajustes" class="sidebar__SecondaryMenu__item">Ajustes</a>
                <a href="" class="sidebar__SecondaryMenu__item">Ayuda</a>
                <a href="index.php?accion=cerrarSesion" class="sidebar__SecondaryMenu__item">Cerrar Sesión</a>
            </div>
        </div>
        <section class="full-view-content">
            <!-- Contenedor para el cotenido principal de la página -->
            <div id="content-container">
                <div class="row">
                    <h2 class="data-entrenamiento__title">- Propietario: <?= Sesion::getUsuario()->getNombreUsuario() ?></h2>
                    <h2 class="data-entrenamiento__date">- Creada el: <?php echo htmlspecialchars($dieta->getFecha()) ?></h2>
                    <h2 class="data-dieta__name">- Nombre: <?php echo htmlspecialchars($dieta->getNombreDieta()) ?></h2>
                    <hr class="separator">
                    <div class="card data-entrenamiento__card">
                        <div class="card__body">
                        <pre><?= htmlspecialchars_decode($dieta->getDescripcion()) ?></pre>
                        </div>
                    </div>
                    <div class="data-entrenamiento__buttons">
                        <div class="buttons buttons--delete">
                            <a class="deleteLink" href="index.php?accion=eliminarDieta&id=<?php echo $dieta->getId() ?>"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
                        </div>
                        <div class="buttons buttons--modifier"> <a href="index.php?accion=editarDieta&id=<?php echo $dieta->getId() ?>"><i class="fa-solid fa-pen-to-square"></i> Modificar</a></div>
                    </div>
                </div>
            </div>
            <footer>
                <div id="politicasFooter">
                    <h5 class="policies__tittle">Política de Privacidad:</h5>
                    <hr>
                    <p class="policies__body">
                        En FitSyncronizer, valoramos y respetamos tu privacidad. <br><br> Puedes
                        encontrar más detalles en nuestra página de Política de Privacidad.
                    </p>
                    <hr>
                    <p class="policies__body">
                        <i class="fa-regular fa-copyright"></i> [2024] [FitSyncronizer]. Todos los derechos reservados.
                        El contenido de este sitio web, incluyendo
                        texto, imágenes, gráficos y otros materiales, está protegido por las leyes de derechos de autor
                        y otras leyes
                        de propiedad intelectual.
                    </p>
                </div>
                <div id="logo__Footer">
                    <img src="web/imagenes/FitSync2.png" width="200px" height="auto" alt="logo de FitSyncronizer">
                </div>
                <div class="medias__Footer">
                    <h5 class="medias__Footer__tittle">Redes sociales</h5>
                    <a href=""><i class="fa-brands fa-x-twitter medias__Footer__item"></i> Twitter</a><br>
                    <a href=""><i class="fa-brands fa-youtube medias__Footer__item"></i> Youtube</a><br>
                    <a href=""><i class="fa-brands fa-instagram medias__Footer__item"></i></i> Instagram</a><br>
                    <a href=""><i class="fa-brands fa-tiktok medias__Footer__item"></i> TikTok</a><br>
                    <a href=""><i class="fa-brands fa-twitch medias__Footer__item"></i> Twitch</a><br>
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
                        <a href=""><i class="fa-solid fa-gear"></i></a>
                        <a href=""><i class="fa-regular fa-circle-user"></i></a>
                        <a href=""><i class="fa-solid fa-right-from-bracket"></i></a>
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
                                    <a class="nav-link" href="index.php?accion=vistaNormal"><i class="fa-solid fa-house"></i> Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=listarEntrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=listarDietas"><i class="fa-solid fa-bowl-rice"></i>Dietas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?accion=listarPerfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
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
                                    <a class="nav-link" href="#">Contacto</a>
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
                <div class="row row-small">
                <h2 class="data-entrenamiento__title">- Propietario: <?= Sesion::getUsuario()->getNombreUsuario() ?></h2>
                    <h2 class="data-entrenamiento__date">- Creada el: <?php echo htmlspecialchars($dieta->getFecha()) ?></h2>
                    <h2 class="data-dieta__name">- Creada el: <?php echo htmlspecialchars($dieta->getNombreDieta()) ?></h2>
                    <hr class="separator">
                    <div class="card data-entrenamiento__card">
                        <div class="card__body">
                            <p><?php echo htmlspecialchars($dieta->getDescripcion()) ?></p>
                        </div>
                    </div>
                    <div class="data-entrenamiento__buttons">
                        <div class="buttons buttons--delete">
                            <a class="deleteLink" href="index.php?accion=eliminarDieta&id=<?php echo $dieta->getId() ?>"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
                        </div>
                        <div class="buttons buttons--modifier"> <a href="#"><i class="fa-solid fa-pen-to-square"></i> Modificar</a></div>
                    </div>
                </div>
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

        </main>

    </div>
    <!-- JavaScript de Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
    <script src="web/archivosJS/date.js"></script>
</body>

</html>