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
    <style>
        #curriculum-container {
            background-color: white;
            color: black;
            border-radius: 10px;
        }

        .row {
            text-align: start;
        }

        #cv__imagen {
            margin: 10px !important;
            padding: 0 !important;
            width: 25%;
            display: inline-block;
        }

        .cv__titles {
            color: white;
            background-color: black;
            display: inline-block;
            text-align: center;
            padding: 7px;
        }

        .cv__separator {
            margin: 1rem;
            width: 97%;
            border: none;
            border-top: 2px dotted #000;
            /* Cambia el color y el grosor según tus necesidades */

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
                <a href=""><i class="fa-solid fa-house"></i> Inicio</a>
                <a href="index.php?accion=listarEntrenamientos"><i class="fa-solid fa-dumbbell"></i> Entrenamientos</a>
                <a href="index.php?accion=listarDietas"><i class="fa-solid fa-bowl-rice"></i> Dietas</a>
                <a href="index.php?accion=listarPerfiles"><i class="fa-solid fa-globe"></i> Perfiles</a>
                <?php if (Sesion::getUsuario()->getRol() == "Profesional") : ?>
                    <a href="index.php?accion=miPerfil"><i class="fa-solid fa-globe"></i> Mi perfil</a>
                <?php endif; ?>
            </div>
            <hr>
            <div class="SecondaryMenu">
                <a href="index.php?accion=ajustes">Ajustes</a>
                <a href="">Ayuda</a>
                <a href="index.php?accion=cerrarSesion">Cerrar Sesión</a>
            </div>
        </div>
        <section class="full-view-content">
            <div id="content-container">
                <div id="curriculum-container" class="container-fluid">
                    <div class="row p-2">
                        <div class="col-6" style="text-align: center;">
                            <img id="cv__imagen" src="web/imagenes/FitSync2.png" alt="texto">
                            <div class="nombre">
                                <h3>Óscar Fernández-Chinchilla López</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-4">
                                <p><strong>Email:</strong> chinchillalopezfernandez@gmail.com</p>
                                <p><strong>Dirección:</strong> C/Ramón y Cajal Baja Nº18, Mota del Cuervo, Cuenca, España</p>
                                <p><strong>Teléfono:</strong> +34 610416855</p>
                                <p><strong>Fecha de nacimiento:</strong> 24/12/2004</p>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Sobre mi</h2>
                            <p>Joven apasionado por el mundo de la informática y comunicaciones, con ganas de desarrollar un extenso futuro laboral en la industria
                                tecnológica y aportar innovaciones al sector.
                            </p>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Experiencia profesional</h2>
                            <div class="row">
                                <div class="col-4">
                                    <h4><strong>Camarero</strong></h4>
                                    <h5>Cafereteria - La Caramela</h5>
                                    <h5>Mota del Cuervo</h5>
                                    <h5>Junio 2023 / Septiembre 2023</h5>
                                </div>
                                <div class="col-8 p-3">
                                    <p style="padding-left: 1rem;">Como camarero he ofrecido servicio a diversos tipos de clientes, tomando pedidos
                                        alimenticios, asegurando la satisfacción del cliente y ofreciéndole una experiencia
                                        positiva. A su vez he obtenido experiencia en un entorno de trabajo con ritmo alto y
                                        rápido.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Formación académica</h2>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mt-2 mb-5">
                                        <h4><strong>Educación Secundaria Obligatoria
                                                (ESO)</strong></h4>
                                        <h5>IES Julián Zarco</h5>
                                        <h5>Mota del Cuervo, Cuenca
                                            2020</h5>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h4><strong>Bachillerato de Ciencias</strong></h4>
                                        <h5>IES Julián Zarco</h5>
                                        <h5>Mota del Cuervo, Cuenca
                                            2020</h5>
                                    </div>
                                    <div class="col-8">
                                        <p style="padding-left: 1rem;">Especializado en materias como TIC (tecnologia de la información y telecomunicación)</p>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-4">
                                        <h4><strong>Grado Superior de Desarrollo de
                                                Aplicaciones WEB</strong></h4>
                                        <h5>IES Juan Bosco</h5>
                                        <h5>Alcázar de San Juan -
                                            En progreso
                                        </h5>
                                    </div>
                                    <div class="col-8">
                                        <p style="padding-left: 1rem;">Se desarrollan aplicaciones web en diversos lenguajes de Back-End como Java y PHP, a
                                            su vez que también se desarrolla Front-End con HTML,CSS, JavaScript y diversos
                                            frameworks como Bootstrap o Tailwind.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Habilidades</h2>
                            <div class="row">
                                <div class="col-4">
                                    <h4><strong>Trato con el cliente</strong></h4>
                                    <p>Intermedio</p>
                                </div>
                                <div class="col-4">
                                    <h4><strong>Resolución de
                                    desafios</strong></h4>
                                    <p>Avanzado</p>
                                </div>
                                <div class="col-4">
                                    <h4><strong>Adaptabilidad</strong></h4>
                                    <p>Avanzado</p>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Idiomas</h2>
                            <div class="row">
                                <h4><strong>Español</strong></h4>
                                <p>Lengua materna</p>
                                <h4><strong>Inglés</strong></h4>
                                <p>Conversacional</p>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Intereses adicionales</h2>
                            <div class="row">
                                <p><strong>Obtener experiencia en el sector de la informática y la tecnología, desarrollar conocimientos de IA y Big Data, aprender
                                diversas lenguas, viajar y aumentar las habilidades sociales para el manejo de diferentes situaciones en el futuro.</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
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
            <div id="curriculum-container" class="container-fluid">
                    <div class="row p-2">
                        <div class="col-12" style="text-align: center;">
                            <img id="cv__imagen" src="web/imagenes/FitSync2.png" alt="texto">
                            <div class="nombre">
                                <h3>Óscar Fernández-Chinchilla López</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mt-4">
                                <p><strong>Email:</strong> chinchillalopezfernandez@gmail.com</p>
                                <p><strong>Dirección:</strong> C/Ramón y Cajal Baja Nº18, Mota del Cuervo, Cuenca, España</p>
                                <p><strong>Teléfono:</strong> +34 610416855</p>
                                <p><strong>Fecha de nacimiento:</strong> 24/12/2004</p>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Sobre mi</h2>
                            <p>Joven apasionado por el mundo de la informática y comunicaciones, con ganas de desarrollar un extenso futuro laboral en la industria
                                tecnológica y aportar innovaciones al sector.
                            </p>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Experiencia profesional</h2>
                            <div class="row">
                                <div class="col-4">
                                    <h4><strong>Camarero</strong></h4>
                                    <h5>Cafereteria - La Caramela</h5>
                                    <h5>Mota del Cuervo</h5>
                                    <h5>Junio 2023 / Septiembre 2023</h5>
                                </div>
                                <div class="col-8 p-3">
                                    <p style="padding-left: 1rem;">Como camarero he ofrecido servicio a diversos tipos de clientes, tomando pedidos
                                        alimenticios, asegurando la satisfacción del cliente y ofreciéndole una experiencia
                                        positiva. A su vez he obtenido experiencia en un entorno de trabajo con ritmo alto y
                                        rápido.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Formación académica</h2>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mt-2 mb-5">
                                        <h4><strong>Educación Secundaria Obligatoria
                                                (ESO)</strong></h4>
                                        <h5>IES Julián Zarco</h5>
                                        <h5>Mota del Cuervo, Cuenca
                                            2020</h5>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h4><strong>Bachillerato de Ciencias</strong></h4>
                                        <h5>IES Julián Zarco</h5>
                                        <h5>Mota del Cuervo, Cuenca
                                            2020</h5>
                                    </div>
                                    <div class="col-8">
                                        <p style="padding-left: 1rem;">Especializado en materias como TIC (tecnologia de la información y telecomunicación)</p>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-4">
                                        <h4><strong>Grado Superior de Desarrollo de
                                                Aplicaciones WEB</strong></h4>
                                        <h5>IES Juan Bosco</h5>
                                        <h5>Alcázar de San Juan -
                                            En progreso
                                        </h5>
                                    </div>
                                    <div class="col-8">
                                        <p style="padding-left: 1rem;">Se desarrollan aplicaciones web en diversos lenguajes de Back-End como Java y PHP, a
                                            su vez que también se desarrolla Front-End con HTML,CSS, JavaScript y diversos
                                            frameworks como Bootstrap o Tailwind.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Habilidades</h2>
                            <div class="row">
                                <div class="col-4">
                                    <h4><strong>Trato con el cliente</strong></h4>
                                    <p>Intermedio</p>
                                </div>
                                <div class="col-4">
                                    <h4><strong>Resolución de
                                    desafios</strong></h4>
                                    <p>Avanzado</p>
                                </div>
                                <div class="col-4">
                                    <h4><strong>Adaptabilidad</strong></h4>
                                    <p>Avanzado</p>
                                </div>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Idiomas</h2>
                            <div class="row">
                                <h4><strong>Español</strong></h4>
                                <p>Lengua materna</p>
                                <h4><strong>Inglés</strong></h4>
                                <p>Conversacional</p>
                            </div>
                        </div>
                        <hr class="cv__separator">
                        <div class="col-12">
                            <h2 class="cv__titles">Intereses adicionales</h2>
                            <div class="row">
                                <p><strong>Obtener experiencia en el sector de la informática y la tecnología, desarrollar conocimientos de IA y Big Data, aprender
                                diversas lenguas, viajar y aumentar las habilidades sociales para el manejo de diferentes situaciones en el futuro.</strong></p>
                            </div>
                        </div>
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
    </div>

    </main>

    </div>
    <!-- JavaScript de Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
    <script src="web/archivosJS/date.js"></script>
</body>

</html>