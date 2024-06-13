<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | FitSyncronizer</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel="stylesheet" href="web/css/login.css">
</head>

<body>
    <header>
        <nav class="nav">
            <a id="enlace-logo" href="#">
                <img id="logo" src="web/imagenes/FitSync2.png" alt="icono" width="100px" height="auto">
                FitSyncronizer
            </a>
            <div class="nav-links">
                <a class="nav-link active" aria-current="page" href="index.php?accion=inicio">Iniciar Sesión</a> <span class="separador">|</span>
                <a class="nav-link" href="index.php?accion=registrar">Registrarse</a><span class="separador">|</span>
                <a class="nav-link" href="#">Sobre mí</a>
            </div>
        </nav>
    </header>
    <main>
        <section id="principal">
        <section id="introduccion">
            <h1>¿Que es FitSyncronizer?</h1>
            <p>FitSyncronizer es una aplicación web destinada a aquellos usuarios del mundo fitness y la salud, los cuales buscan un lugar de administración y gestión de sus propias rutinas y dietas de forma online, rápida y sencilla.</p>
            <p>En FS podrás gestionar todos tus entrenamientos y comidas con la interfaz de la aplicación en cero coma.</p>
            <p>A su vez, también podrás encontrar perfiles públicos profesionales destinados a darse a conocer con el objetivo de proporcionar información y ayuda a aquellos que busquen algun entrenador o algun dietista.</p>
        </section>
        <section id="formulario-login">
            <h2>Iniciar sesión</h2>
            <img id="logo-login" src="web/imagenes/FitSync2.png" width="100px" alt="logo FitSyncronizer">
            <form action="index.php?accion=login" method="post">
                <label for="nombreUsuario">Nombre de usuario</label><br>
                <input type="text" id="nombreUsuario" name="nombreUsuario" required><br>
                <label for="email">Correo electrónico</label><br>
                <input type="text" id="email" name="email" required><br>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" id="contrasena" name="contrasena" required><br><br>
                <input class="boton" type="submit" value="Acceder">
            </form>
            <h3>¿Todavia no tienes cuenta?</h3>
            <p>Pincha <a href="index.php?accion=registrar">aquí</a> para ir a la pagina de registro</p>
        </section>
        </section>
    </main>
    <footer>
    </footer>
    <!-- JavaScript de Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
</body>

</html>