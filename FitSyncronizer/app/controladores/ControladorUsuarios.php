<?php
require_once "app/modelos/Usuario.php";
require_once "app/modelos/UsuariosDAO.php";
class ControladorUsuarios
{
    public function inicio()
    {
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Si existe la cookie y no ha iniciado sesión, le iniciamos sesión de forma automática
        if (Sesion::getUsuario() && isset($_COOKIE['usuario'])) {
            $usuariosDAO = new UsuariosDAO($conn);
            $usuario = $usuariosDAO->getByNombreUsuario($_COOKIE['usuario']);

            if ($usuario) {
                Sesion::iniciarSesion($usuario);
                setcookie('usuario', $usuario->getNombreUsuario(), time() + 7 * 24 * 60 * 60, '/');
                header('location: index.php?accion=vistaNormal');
                die();
            }
        }

        require 'app/vistas/inicio.php';
    }

    public function registrar()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Para ver que formulario se rellena tenemos esta condición
            if ($_POST['tipo'] == 'normal') {

                //Recogida de datos
                $nombre = htmlentities($_POST['nombre']);
                $nombreU = htmlentities($_POST['nombreUsuario']);
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);
                $password2 = htmlentities($_POST['password2']);
                $telefono = null;
                $perfilPublico = false;
                $rol = "Normal";
            } elseif ($_POST['tipo'] == 'profesional') {
                $nombre = htmlentities($_POST['nombre2']);
                $nombreU = htmlentities($_POST['nombreUsuario2']);
                $email = htmlentities($_POST['email2']);
                $password = htmlentities($_POST['passwordP']);
                $password2 = htmlentities($_POST['password2P']);
                $telefono = htmlentities($_POST['telefono']);
                $perfilPublico = true;
                $rol = "Profesional";
            }
            //Condiciones para que se rellenes todos los campos correctamente
            if (empty($email) || empty($password) || empty($password2)) {
                $error = "Todos los campos son obligatorios";
            } elseif ($password != $password2) {
                $error = "Las contraseñas no coinciden";
            } else {
                //Conexion a la BD
                $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
                $conn = $conexionDB->getConnexion();

                //Instancia del DAO de usuarios
                $usuariosDAO = new UsuariosDAO($conn);

                //Compruebo que no exista un usuario con este email
                if ($usuariosDAO->getByEmail($email) != null) {
                    $error = "Ya hay un usuario con ese email";
                } else {
                    //SI no existe, creo uno nuevo
                    $usuario = new Usuario();
                    $usuario->setCorreo($email);
                    $usuario->setRol($rol);
                    $usuario->setNombre($nombre);
                    $usuario->setNombreUsuario($nombreU);
                    $usuario->setTelefono($telefono);
                    $usuario->setPerfilPublico($perfilPublico);
                    $passwordCifrado = password_hash($password, PASSWORD_DEFAULT);
                    $usuario->setContrasena($passwordCifrado);

                    //Condicion para registrar el nuevo usuario y volver a la página de login
                    if ($usuariosDAO->insert($usuario)) {
                        header("location: index.php");
                        die();
                    } else {
                        $error = "No se ha podido insertar el usuario";
                    }
                }
            }
        }
        require 'app/vistas/registro.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Conexion a la BD
            $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
            $conn = $conexionDB->getConnexion();

            //Instancia del DAO de usuarios
            $usuariosDAO = new UsuariosDAO($conn);

            //Recogemos los datos
            $nombreUsuario = htmlspecialchars($_POST['nombreUsuario']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['contrasena']);

            //Condicion para probar que existe un usuario con los parametros proporcionados
            if ($usuario = $usuariosDAO->getByEmail($email)) {
                //Compruebo la contraseña y el nombre de usuarios ya que es Unico
                if (password_verify($password, $usuario->getContrasena()) && $nombreUsuario == $usuario->getNombreUsuario()) {
                    //Inicio sesion
                    session_start();
                    Sesion::iniciarSesion($usuario);

                    // Creamos la cookie para que nos recuerde por 1 semana
                    setcookie('usuario', $nombreUsuario, time() + 7 * 24 * 60 * 60, '/');

                    //Dependiendo el rol lo redirige a una vista normal o profesional
                    if ($usuario->getRol() == "Normal") {
                        header('location: index.php?accion=vistaNormal');
                    } elseif ($usuario->getRol() == "Profesional") {
                        header('location: index.php?accion=vistaNormal');
                    } elseif ($usuario->getRol() == "Administrador") {
                        header('location: index.php?accion=vistaAdmin');
                    }
                    die();
                } else {
                    $error = "Error con las credenciales";
                }
            } else {
                $error = "Email o password incorrectos";
            }
            guardarMensaje($error);
            header('location: index.php');
        }
    }
    public function cerrarSesion()
    {
        // Iniciar la sesión
        session_start();

        // Cerrar la sesión
        Sesion::cerrarSesion();

        // Eliminar la cookie
        if (isset($_COOKIE['usuario'])) {
            setcookie('usuario', '', time() - 3600, '/'); // Expira la cookie
        }

        // Redirigir a la página de inicio
        header('Location: index.php');
        die();
    }
    //Funcion para mostrar la vista normal
    public function vistaNormal()
    {
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $entrenamientosDAO = new EntrenamientosDAO($conn);
        $entrenamientos = $entrenamientosDAO->getAllByIdUsuario($id_usuario);
        $dietasDAO = new DietasDAO($conn);
        $dietas = $dietasDAO->getAllByIdUsuario($id_usuario);
        // Obtén la cantidad de entrenamientos en el array
        $cantidadDietas = count($dietas);
        // Obtén la cantidad de entrenamientos en el array
        $cantidadEntrenamientos = count($entrenamientos);
        require 'app/vistas/vistaUsuarioNormal.php';
    }
    //Funcion para mostrar la vista de administrador
    public function vistaAdmin()
    {
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        $entrenamientosDAO = new EntrenamientosDAO($conn);
        $entrenamientos = $entrenamientosDAO->getAllOrder();
        $dietasDAO = new DietasDAO($conn);
        $dietas = $dietasDAO->getAllOrder();
        $usuariosDAO = new UsuariosDAO($conn);
        $usuarios = $usuariosDAO->getAllOrder();
        $perfilesDAO = new PerfilesProfesionalesDAO($conn);
        $perfiles = $perfilesDAO->getAllOrder();

        // Obtén la cantidad de entrenamientos en el array
        $cantidadDietas = count($dietas);
        // Obtén la cantidad de entrenamientos en el array
        $cantidadEntrenamientos = count($entrenamientos);
        require 'app/vistas/vistaAdministrador.php';
    }
    //Funcion para mostrar la vista de ajustes
    public function verAjustes()
    {
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $usuariosDAO = new UsuariosDAO($conn);
        $usuario = $usuariosDAO->getById($id_usuario);

        // Configurar el locale a español
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'spanish');
        $timestamp = strtotime($usuario->getFecha());

        // Usar strftime para formatear la fecha en español
        $fechaFormateada = strftime("%d de %B de %Y, %I:%M %p", $timestamp);

        require 'app/vistas/vistaAjustes.php';
    }
    //Funcion para mostrar la vista de modificar ajustes
    public function modificarDatosUsuario()
    {
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $usuariosDAO = new UsuariosDAO($conn);
        $usuario = $usuariosDAO->getById($id_usuario);

        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger los datos del formulario
            $nombre = $_POST['nombre'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $correo = $_POST['correo'];
            $contrasena_nueva = $_POST['contrasena'];

            // Validar que los campos no estén vacíos
            if (empty($nombre) || empty($nombre_usuario) || empty($correo) || empty($contrasena_nueva)) {
                $error = "Todos los campos son obligatorios.";
            } else {
                // Validar longitud de los campos
                if (strlen($nombre) > 200 || strlen($nombre_usuario) > 200 || strlen($correo) > 200 || strlen($contrasena_nueva) > 200) {
                    $error = "Los campos nombre, nombre de usuario, correo y contraseña no pueden tener más de 200 caracteres.";
                } else {

                    if (strlen($contrasena_nueva) < 6) {
                        $error = "La nueva contraseña debe tener al menos 6 caracteres.";
                    } elseif ($usuariosDAO->getByEmail($correo) != null && $correo != $usuario->getCorreo()) {
                        $error = "El nuevo correo ya está asociado a una cuenta existente";
                    } elseif ($usuariosDAO->getByNombreUsuario($nombre_usuario) != null && $nombre_usuario != $usuario->getNombreUsuario()) {
                        $error = "El nombre de usuario ya esta en uso";
                    } else {
                        $usuario->setCorreo($correo);
                        $usuario->setNombre($nombre);
                        $usuario->setNombreUsuario($nombre_usuario);
                        $passwordCifrado = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
                        $usuario->setContrasena($passwordCifrado);

                        // Actualizar el usuario en la base de datos
                        if ($usuariosDAO->update($usuario)) {
                            header("location: index.php?accion=vistaNormal");
                            die();
                        } else {
                            $error = "No se ha podido actualizar el usuario";
                        }
                    }
                }
            }
        }

        require 'app/vistas/vistaEditarUsuario.php';
    }

    //Funcion para eliminar la cuenta del usuario
    public function eliminarUsuario()
    {
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $usuariosDAO = new UsuariosDAO($conn);
        // Obtener el ID del usuario que ha iniciado sesión
        $id_usuario_sesion = Sesion::getUsuario()->getId();

        // Obtener el ID del usuario que se intenta eliminar desde la URL
        // Por ejemplo, si la URL es eliminar_usuario.php?id=1, puedes obtener el ID así:
        $id_usuario_eliminar = $_GET['id'];

        // Verificar si el usuario tiene permisos para eliminar la cuenta
        if ($id_usuario_sesion == $id_usuario_eliminar || Sesion::getUsuario()->getRol() == "Administrador") {
            // Actualizar el usuario en la base de datos
            if ($usuariosDAO->delete($id_usuario_eliminar)) {
                // Eliminar la cookie
                if (isset($_COOKIE['usuario'])) {
                    setcookie('usuario', '', time() - 3600, '/'); // Expira la cookie
                }
                if (Sesion::getUsuario()->getRol() == "Administrador") {
                    header('location: index.php?accion=vistaAdmin');
                    die();
                } else {
                    Sesion::cerrarSesion();
                    header("location: index.php");
                    die();
                }
            } else {
                $error = "No se ha podido actualizar el usuario";
            }
        } else {
            // Si el usuario no tiene permisos, redireccionarlo a alguna página de error o mostrar un mensaje de error
            header('Location: error.php');
            die();
        }
    }
    public function modificarUsuarioAdmin()
    {
        // Verificar si existe la sesión
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }

        // Verificar si el usuario tiene rol de administrador
        if (Sesion::getUsuario()->getRol() != 'Administrador') {
            header('Location: index.php');
            die();
        }

        $id_usuario = $_GET['id'];
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $usuariosDAO = new UsuariosDAO($conn);
        $usuario = $usuariosDAO->getById($id_usuario);

        $usuario->setRol("Administrador");
        // Actualizar el usuario en la base de datos
        if ($usuariosDAO->update($usuario)) {
            header("location: index.php?accion=vistaAdmin");
            die();
        } else {
            $error = "No se ha podido actualizar el usuario";
        }
        require 'app/vistas/vistaModificarUsuario.php';
    }

    public function sobreMi(){
        // Verificar si existe la sesión
        if (!Sesion::existeSesion()) {
            header('Location: index.php');
            die();
        }
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        require 'app/vistas/sobreMi.php';
    }
}
