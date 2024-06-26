<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitSyncronizer | Registro Usuario</title>
    <link rel="icon" href="web/imagenes/FitSync2.png" type="image/x-icon">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel="stylesheet" href="web/css/registro.css">
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
                <a class="nav-link" href="index.php?accion=registrar">Registrarse</a>
            </div>
        </nav>
    </header>
    <main>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <section id="formulario-normal">
            <h3>Plan para usuarios básicos</h3>
            <hr>
            <form action="index.php?accion=registrar" method="post">
                <input type="hidden" name="tipo" value="normal">
                <label for="nombre">Nombre personal</label><br>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br>
                <label for="nombreUsuario">Nombre de usuario</label><br>
                <input type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre de usuario" required><br>
                <label for="email">Correo electrónico</label><br>
                <input type="text" id="email" name="email" required placeholder="Correo electrónico"><br>
                <label for="contrasena">Contraseña</label><br>
                <input type="password" id="contrasena" name="password" placeholder="Ingrese su contraseña" required><br>
                <label for="contrasena2">Confirmar contraseña</label><br>
                <input type="password" id="contrasena2" name="password2" placeholder="Confirme su contraseña" required><br><br>
                <input class="boton" type="submit" value="Acceder">
            </form>
        </section>
        <section id="formulario-profesional">
            <h3>Plan para usuarios profesionales</h3>
            <hr>
            <form action="index.php?accion=registrar" method="post">
                <input type="hidden" name="tipo" value="profesional">
                <label for="nombre2">Nombre personal</label><br>
                <input type="text" id="nombre2" name="nombre2" placeholder="Nombre" required><br>
                <label for="nombreUsuario2">Nombre de usuario</label><br>
                <input type="text" id="nombreUsuario2" name="nombreUsuario2" placeholder="Correo electrónico" required><br>
                <label for="email2">Correo electrónico</label><br>
                <input type="text" id="email2" name="email2" placeholder="Correo electrónico" required><br>
                <label for="telefono">Teléfono</label><br>
                <input type="number" id="telefono" name="telefono" placeholder="Nº Telefono" required><br>
                <label for="contrasenaP">Contraseña</label><br>
                <input type="password" id="contrasenaP" name="passwordP" placeholder="Ingrese su contraseña" required><br>
                <label for="contrasena2P">Confirmar contraseña</label><br>
                <input type="password" id="contrasena2P" name="password2P" placeholder="Confirme su contraseña" required><br><br>
                <input class="boton" type="submit" value="Acceder">
            </form>
        </section>
    </main>
    <footer>

    </footer>
    <!-- JavaScript de Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
</body>

</html>