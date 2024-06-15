<?php
require_once "app/modelos/Dieta.php";
require_once "app/modelos/DietasDAO.php";
class ControladorDietas
{
        public function crearDieta()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recogida de datos del formulario
            $id_usuario = Sesion::getUsuario()->getId();
            $nombre_dieta = htmlentities($_POST['nombre_dieta']);
            $descripcion = htmlentities($_POST['descripcion']);
            $en_proceso = isset($_POST['en_proceso']) ? 1 : 0;

            // Validaciones
            if (empty($nombre_dieta) || empty($descripcion)) {
                $error = "Todos los campos son obligatorios.";
            } elseif (strlen($nombre_dieta) > 100) {
                $error = "El nombre de la dieta no puede tener más de 100 caracteres.";
            } elseif (strlen($descripcion) > 1500) {
                $error = "La descripción no puede tener más de 1500 caracteres.";
            } else {
                // Si las validaciones pasan, se procede con la creación de la dieta
                $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
                $conn = $conexionDB->getConnexion();
                $dietasDAO = new DietasDAO($conn);
                $dieta = new Dieta();
                $dieta->setIdUsuario($id_usuario);
                $dieta->setNombreDieta($nombre_dieta);
                $dieta->setDescripcion($descripcion);
                $dieta->setEnProceso($en_proceso);

                if ($dietasDAO->insert($dieta)) {
                    $rolUsuario = Sesion::getUsuario()->getRol();
                    if ($rolUsuario == "Normal") {
                        header("location: index.php?accion=listarDietas");
                        die();
                    } else if ($rolUsuario == "Profesional") {
                        header("location: index.php?accion=listarDietas");
                        die();
                    }
                } else {
                    $error = "No se ha podido insertar la dieta.";
                        header("location: index.php?accion=crearDieta");
                        die();
                }
            }
        }
        require 'app/vistas/crearDieta.php';
    }
    public function editarDieta()
    {
        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $dietasDAO = new DietasDAO($conn);
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = Sesion::getUsuario()->getId();
            $nombre_dieta = htmlentities($_POST['nombre_dieta']);
            $descripcion = htmlentities($_POST['descripcion']);
            $en_proceso = isset($_POST['en_proceso']) ? 1 : 0;

            // Validaciones
            if (empty($nombre_dieta) || empty($descripcion)) {
                $error = "Todos los campos son obligatorios.";
            } elseif (strlen($nombre_dieta) > 100) {
                $error = "El nombre de la dieta no puede tener más de 100 caracteres.";
            } elseif (strlen($descripcion) > 1500) {
                $error = "La descripción no puede tener más de 1500 caracteres.";
            } else {
                // Si las validaciones pasan, se procede con la actualización de la dieta
                $dieta = new Dieta();
                $dieta->setId($id);
                $dieta->setIdUsuario($id_usuario);
                $dieta->setNombreDieta($nombre_dieta);
                $dieta->setDescripcion($descripcion);
                $dieta->setEnProceso($en_proceso);

                if ($dietasDAO->update($dieta)) {
                    header("location: index.php?accion=listarDietas");
                    die();
                } else {
                    $error = "No se ha podido actualizar la dieta.";
                }
            }
            // Si hay un error, se carga la vista de edición con el mensaje de error y los datos actuales
            $dieta = new Dieta();
            $dieta->setId($id);
            $dieta->setNombreDieta($nombre_dieta);
            $dieta->setDescripcion($descripcion);
            $dieta->setEnProceso($en_proceso);
        } else {
            $dieta = $dietasDAO->getById($id);
            if (!$dieta) {
                echo "Dieta no encontrada";
                return;
            }
        }
        require 'app/vistas/vistaEditarDieta.php';
    }
    public function borrar()
    {
        $mensaje=null;
        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];

        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Instancia del DAO de dietas
        $dietasDAO = new DietasDAO($conn);

        // Condición para borrar una dieta y redirigir
        if ($dietasDAO->delete($id)) {
            $rolUsuario = Sesion::getUsuario()->getRol();
            if ($rolUsuario == "Normal" || $rolUsuario == "Profesional") {
                header("location: index.php?accion=listarDietas");
                die();
            }else if(Sesion::getUsuario()->getRol() == "Administrador"){
                $mensaje="Se ha borrado la dieta";
                header("location: index.php?accion=vistaAdmin");
                die();
            }
        } else {
            echo "No se ha podido borrar el entrenamiento";
        }
    }
    public function listarDietas()
    {
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $dietasDAO = new DietasDAO($conn);
        $dietas = $dietasDAO->getAllByIdUsuario($id_usuario);
        // Obtén la cantidad de entrenamientos en el array
        $cantidadDietas = count($dietas);
        require 'app/vistas/listarDietas.php';
    }
    public function mostrarDieta()
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

        $dietasDAO = new DietasDAO($conn);
        $dieta = $dietasDAO->getById($id);

        require 'app/vistas/mostrarDieta.php';
    }
    public function contarDietas()
    {
        $id_usuario = Sesion::getUsuario()->getId();
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();
        $dietasDAO = new DietasDAO($conn);
        $dietas = $dietasDAO->getAllByIdUsuario($id_usuario);

        $cantidadDietas = count($dietas);

        // Devolver el número de entrenamientos como JSON
        echo json_encode(['cantidad' => $cantidadDietas]);
    }
}
