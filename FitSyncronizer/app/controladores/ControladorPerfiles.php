<?php
require_once "app/utils/funciones.php";

class ControladorPerfiles
{
    // Método para crear un nuevo perfil profesional
    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recogida de datos del formulario
            $id_usuario = Sesion::getUsuario()->getId();
            $foto = $_FILES['foto']['name'];
            $nombre_personal = htmlentities($_POST['nombre_personal']);
            $nombre_usuario_profesional = htmlentities($_POST['nombre_usuario_profesional']);
            $descripcion_personal = htmlentities($_POST['descripcion_personal']);
            $edad = htmlentities($_POST['edad']);
            $anos_experiencia = htmlentities($_POST['anos_experiencia']);
            $datos_contacto = htmlentities($_POST['datos_contacto']);
            $trabajos_anteriores = htmlentities($_POST['trabajos_anteriores']);
            $extension = pathinfo($foto, PATHINFO_EXTENSION);

            // Conexión a la BD
            $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
            $conn = $conexionDB->getConnexion();

            // Instancia del DAO de perfiles
            $perfilesDAO = new PerfilesProfesionalesDAO($conn);
            $perfil = new PerfilProfesional();

            // Validar y Copiar la foto al disco
            if ($_FILES['foto']['type'] != 'image/jpeg' && $_FILES['foto']['type'] != 'image/webp' && $_FILES['foto']['type'] != 'image/png') {
                $error = 'La foto no tiene el formato adecuado';
            } else {
                // Generar nombre único para la foto
                $foto = generarNombreArchivo($foto);

                // Asegurar que el nombre del archivo sea único
                while (file_exists("web/fotosPerfiles/$foto")) {
                    $foto = generarNombreArchivo($foto);
                }

                if (!move_uploaded_file($_FILES['foto']['tmp_name'], "web/fotosPerfiles/$foto")) {
                    die("Error al subir el archivo");
                }

                // Asignar los datos al perfil
                $perfil->setIdUsuario($id_usuario);
                $perfil->setImagen($foto);
                $perfil->setNombrePersonal($nombre_personal);
                $perfil->setNombreUsuarioProfesional($nombre_usuario_profesional);
                $perfil->setDescripcionPersonal($descripcion_personal);
                $perfil->setEdad($edad);
                $perfil->setAnosExperiencia($anos_experiencia);
                $perfil->setDatosContacto($datos_contacto);
                $perfil->setTrabajosAnteriores($trabajos_anteriores);

                // Insertar perfil en la BD
                if ($perfilesDAO->insert($perfil)) {
                    header("location: index.php?accion=vistaNormal");
                    die();
                } else {
                    header("location: index.php?accion=crearPerfil");
                    $error = "No se ha podido insertar el perfil profesional";
                    die();
                }
            }
        }
        // Vista con método GET
        require 'app/vistas/crearPerfil.php';
    }

    // Método para editar un perfil profesional existente
    public function editarPerfil()
    {
        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];

        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Instancia del DAO de perfiles
        $perfilesDAO = new PerfilesProfesionalesDAO($conn);

        // Obtener el perfil actual
        $perfil = $perfilesDAO->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger datos del formulario
            $nombrePersonal = htmlspecialchars($_POST['nombre_personal']);
            $nombreUsuarioProfesional = htmlspecialchars($_POST['nombre_usuario_profesional']);
            $descripcionPersonal = htmlspecialchars($_POST['descripcion_personal']);
            $edad = htmlspecialchars($_POST['edad']);
            $anosExperiencia = htmlspecialchars($_POST['anos_experiencia']);
            $datosContacto = htmlspecialchars($_POST['datos_contacto']);
            $trabajosAnteriores = htmlspecialchars($_POST['trabajos_anteriores']);

            // Manejo de la subida de imagen
            $imagen = $perfil->getImagen();
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $imagenPath = 'web/fotosPerfiles/' . basename($_FILES['imagen']['name']);
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
                    // Eliminar la imagen antigua
                    if (file_exists('web/fotosPerfiles/' . $perfil->getImagen())) {
                        unlink('web/fotosPerfiles/' . $perfil->getImagen());
                    }
                    $imagen = basename($_FILES['imagen']['name']);
                } else {
                    echo "Error al subir la imagen";
                    return;
                }
            }

            // Actualizar el perfil
            $perfil->setNombrePersonal($nombrePersonal);
            $perfil->setNombreUsuarioProfesional($nombreUsuarioProfesional);
            $perfil->setDescripcionPersonal($descripcionPersonal);
            $perfil->setEdad($edad);
            $perfil->setAnosExperiencia($anosExperiencia);
            $perfil->setDatosContacto($datosContacto);
            $perfil->setTrabajosAnteriores($trabajosAnteriores);
            $perfil->setImagen($imagen);

            if ($perfilesDAO->update($perfil)) {
                header("location: index.php?accion=miPerfil");
                die();
            } else {
                echo "Error al actualizar el perfil";
            }
        }

        require 'app/vistas/vistaEditarPerfil.php';
    }

    // Método para borrar un perfil profesional existente
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

        $perfilesDAO = new PerfilesProfesionalesDAO($conn);

        // Obtener el perfil para obtener el nombre de la imagen
        $perfil = $perfilesDAO->getById($id);
        if ($perfil) {
            // Obtener la ruta de la imagen
            $imagenPath = 'web/fotosPerfiles/' . $perfil->getImagen();

            // Condición para borrar el perfil y la imagen
            if ($perfilesDAO->delete($id)) {
                // Eliminar la imagen del sistema de archivos
                if (file_exists($imagenPath)) {
                    unlink($imagenPath);
                }
                if (Sesion::getUsuario()->getRol() == "Administrador") {
                    $mensaje="Se ha borrado el perfil";
                    header("location: index.php?accion=vistaAdmin");
                    die();
                } else {
                    header("location: index.php?accion=miPerfil");
                    die();
                }
            } else {
                echo "No se ha podido borrar el perfil";
            }
        } else {
            echo "Perfil no encontrado";
        }
    }

    // Método para listar todos los perfiles profesionales
    public function listarPerfiles()
    {
        $id_usuario = Sesion::getUsuario()->getId();

        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        $perfilesDAO = new PerfilesProfesionalesDAO($conn);
        $perfiles = $perfilesDAO->getAll();
        $likeDAO = new LikesDAO($conn);

        // Obtener la cantidad de perfiles en el array
        $cantidadPerfiles = count($perfiles);

        require 'app/vistas/listarPerfiles.php';
    }

    // Método para mostrar el perfil del usuario actual
    public function miPerfil()
    {
        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Instancia del DAO de perfiles
        $perfilesDAO = new PerfilesProfesionalesDAO($conn);

        $id_usuario = Sesion::getUsuario()->getId();

        // Obtener el perfil del usuario actual
        $perfil = $perfilesDAO->getByIdUsuario($id_usuario);

        require 'app/vistas/miPerfil.php';
    }

    // Método para mostrar un perfil profesional específico
    public function mostrarPerfil()
    {
        // Verificar que se recibe un ID
        if (!isset($_GET['id'])) {
            echo "Error: No se ha proporcionado un ID";
            return;
        }

        $id = $_GET['id'];

        // Conexión a la BD
        $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $conexionDB->getConnexion();

        // Instancia del DAO de perfiles
        $perfilesDAO = new PerfilesProfesionalesDAO($conn);

        // Obtener el perfil específico
        $perfil = $perfilesDAO->getById($id);

        require 'app/vistas/mostrarPerfil.php';
    }
}
