<?php
require_once "app/modelos/Entrenamiento.php";
require_once "app/modelos/EntrenamientosDAO.php";

class ControladorEntrenamientos
{
    public function inicio()
    {
        require 'app/vistas/inicio.php';
    }

    public function crear()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recogida de datos del formulario
            $id_usuario = Sesion::getUsuario()->getId();
            $dia = htmlentities($_POST['dia']);
            $rutina = htmlentities($_POST['rutina']);
            $grupo_muscular = htmlentities($_POST['grupo_muscular']);

            // Validaciones
            if (empty($rutina) || empty($grupo_muscular)) {
                $error = "Todos los campos son obligatorios";
            } elseif (strlen($rutina) > 1500) {
                $error = "La rutina no puede tener más de 1500 caracteres";
            } elseif (strlen($grupo_muscular) > 100) {
                $error = "El grupo muscular no puede tener más de 100 caracteres";
            } else {
                // Conexion a la BD
                $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
                $conn = $conexionDB->getConnexion();

                // Instancia del DAO de entrenamientos
                $entrenamientosDAO = new EntrenamientosDAO($conn);
                $entrenamiento = new Entrenamiento();

                // Asigno los datos al entrenamiento
                $entrenamiento->setIdUsuario($id_usuario);
                $entrenamiento->setDia($dia);
                $entrenamiento->setRutina($rutina);
                $entrenamiento->setGrupoMuscular($grupo_muscular);

                // Condición para que si se inserta correctamente un entrenamiento, vuelva a redirigir a la vista correspondiente 
                if ($entrenamientosDAO->insert($entrenamiento)) {
                    $rolUsuario = Sesion::getUsuario()->getRol();
                    if ($rolUsuario == "Normal" || $rolUsuario == "Profesional") {
                        header("location: index.php?accion=listarEntrenamientos");
                        die();
                    }
                } else {
                        $error = "No se ha podido insertar el entrenamiento";
                        header("location: index.php?accion=crearEntrenamiento");
                        die();
                }
            }
        }
        // Vista con metodo GET
        require 'app/vistas/crearEntrenamiento.php';
    }

    public function editarEntrenamiento()
{
    // Verificar que se recibe un ID
    if (!isset($_GET['id'])) {
        echo "Error: No se ha proporcionado un ID";
        return;
    }

    $id = $_GET['id'];
    $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
    $conn = $conexionDB->getConnexion();
    $entrenamientosDAO = new EntrenamientosDAO($conn);
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_usuario = Sesion::getUsuario()->getId();
        $dia = htmlentities($_POST['dia']);
        $rutina = htmlentities($_POST['rutina']);
        $grupo_muscular = htmlentities($_POST['grupo_muscular']);

        // Validaciones
        if (empty($dia) || empty($rutina) || empty($grupo_muscular)) {
            $error = "Todos los campos son obligatorios.";
        } elseif (strlen($rutina) > 1500) {
            $error = "La rutina no puede tener más de 1500 caracteres.";
        } elseif (strlen($grupo_muscular) > 100) {
            $error = "El grupo muscular no puede tener más de 100 caracteres.";
        } else {
            // Si las validaciones pasan, se procede con la actualización del entrenamiento
            $entrenamiento = new Entrenamiento();
            $entrenamiento->setId($id);
            $entrenamiento->setIdUsuario($id_usuario);
            $entrenamiento->setDia($dia);
            $entrenamiento->setRutina($rutina);
            $entrenamiento->setGrupoMuscular($grupo_muscular);

            if ($entrenamientosDAO->update($entrenamiento)) {
                header("location: index.php?accion=listarEntrenamientos");
                die();
            } else {
                $error = "No se ha podido actualizar el entrenamiento.";
            }
        }
    } else {
        $entrenamiento = $entrenamientosDAO->getById($id);
        if (!$entrenamiento) {
            echo "Entrenamiento no encontrado";
            return;
        }
    }

    require 'app/vistas/vistaEditarEntrenamiento.php';
}

    public function borrar()
    {
        $mensaje="";
        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];

        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Instancia del DAO de entrenamientos
        $entrenamientosDAO = new EntrenamientosDAO($conn);
        var_dump("1");

        // Condición para borrar un entrenamiento y redirigir
        if ($entrenamientosDAO->delete($id)) {
            $rolUsuario = Sesion::getUsuario()->getRol();
            if ($rolUsuario == "Normal" || $rolUsuario == "Profesional") {
                header("location: index.php?accion=listarEntrenamientos");
                die();
            }else if(Sesion::getUsuario()->getRol() == "Administrador"){
                $mensaje="Se ha borrado el entrenamiento";
                header("location: index.php?accion=vistaAdmin");
                die();
            }
        } else {
            echo "No se ha podido borrar el entrenamiento";
        }
    }
    public function listarEntrenamientos()
    {
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $entrenamientosDAO = new EntrenamientosDAO($conn);
        $entrenamientos = $entrenamientosDAO->getAllByIdUsuario($id_usuario);

        // Obtener la cantidad de entrenamientos en el array
        $cantidadEntrenamientos = count($entrenamientos);
        require 'app/vistas/listarEntrenamientos.php';
    }
    public function mostrarEntrenamiento()
    {
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];

        $entrenamientosDAO = new EntrenamientosDAO($conn);
        $entrenamiento = $entrenamientosDAO->getById($id);

        require 'app/vistas/mostrarEntrenamiento.php';
    }
    public function contarEntrenamientos()
    {
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $entrenamientosDAO = new EntrenamientosDAO($conn);
        $entrenamientos = $entrenamientosDAO->getAllByIdUsuario($id_usuario);

        $cantidadEntrenamientos = count($entrenamientos);

        // Devolver el número de entrenamientos como JSON
        echo json_encode(['cantidad' => $cantidadEntrenamientos]);
    }
}
