<?php
// Requiere los archivos necesarios para los modelos, controladores, configuración y utilidades.
require_once "app/modelos/Usuario.php";
require_once "app/modelos/UsuariosDAO.php";
require_once "app/modelos/Entrenamiento.php";
require_once "app/modelos/EntrenamientosDAO.php";
require_once "app/modelos/Dieta.php";
require_once "app/modelos/DietasDAO.php";
require_once "app/modelos/PerfilProfesional.php";
require_once "app/modelos/PerfilesProfesionalesDAO.php";
require_once "app/modelos/Like.php";
require_once "app/modelos/LikesDAO.php";
require_once "app/config/config.php";
require_once "app/modelos/ConexionBD.php";
require_once "app/controladores/ControladorUsuarios.php";
require_once "app/controladores/ControladorPerfiles.php";
require_once "app/controladores/ControladorEntrenamientos.php";
require_once "app/controladores/ControladorDietas.php";
require_once "app/controladores/ControladorLikes.php";
require_once 'app/modelos/Sesion.php';
require_once "app/utils/funciones.php";

// Inicia la sesión PHP
session_start();

// Mapa de rutas que define las acciones permitidas y sus respectivos controladores, métodos y si requieren sesión iniciada
$mapa = array(
    'inicio' => array(
        "controlador" => 'ControladorUsuarios',
        'metodo' => 'inicio',
        'privada' => false
    ),
    'registrar' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'registrar',
        'privada' => false
    ),
    'login' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'login',
        'privada' => false
    ),
    'vistaNormal' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'vistaNormal',
        'privada' => true
    ),
    'vistaAdmin' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'vistaAdmin',
        'privada' => true
    ),
    'vistaProfesional' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'vistaProfesional',
        'privada' => true
    ),
    'ajustes' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'verAjustes',
        'privada' => true
    ),
    'modificarDatosUsuario' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'modificarDatosUsuario',
        'privada' => true
    ),
    'modificarUsuarioAdmin' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'modificarUsuarioAdmin',
        'privada' => true
    ),
    'eliminarUsuario' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'eliminarUsuario',
        'privada' => true
    ),
    'sobreMi' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'sobreMi',
        'privada' => true
    ),
    'cerrarSesion' => array(
        'controlador' => 'ControladorUsuarios',
        'metodo' => 'cerrarSesion',
        'privada' => false
    ),
    // Nuevas acciones para Entrenamientos
    'crearEntrenamiento' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'crear',
        'privada' => true
    ),
    'eliminarEntrenamiento' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'borrar',
        'privada' => true
    ),
    'editarEntrenamiento' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'editarEntrenamiento',
        'privada' => true
    ),
    'mostrarEntrenamiento' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'mostrarEntrenamiento',
        'privada' => true
    ),
    'listarEntrenamientos' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'listarEntrenamientos',
        'privada' => true
    ),
    'contarEntrenamientos' => array(
        'controlador' => 'ControladorEntrenamientos',
        'metodo' => 'contarEntrenamientos',
        'privada' => true 
    ),
    'listarDietas' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'listarDietas',
        'privada' => true
    ),
    'crearDieta' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'crearDieta',
        'privada' => true
    ),
    'editarDieta' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'editarDieta',
        'privada' => true
    ),
    'eliminarDieta' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'borrar',
        'privada' => true
    ),
    'mostrarDieta' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'mostrarDieta',
        'privada' => true
    ),
    'contarDietas' => array(
        'controlador' => 'ControladorDietas',
        'metodo' => 'contarDietas',
        'privada' => true 
    ),
    'miPerfil' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'miPerfil',
        'privada' => true
    ),
    'crearPerfil' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'crear',
        'privada' => true
    ),
    'eliminarPerfil' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'borrar',
        'privada' => true
    ),
    'mostrarPerfil' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'mostrarPerfil',
        'privada' => true
    ),
    'editarPerfil' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'editarPerfil',
        'privada' => true
    ),
    'listarPerfiles' => array(
        'controlador' => 'ControladorPerfiles',
        'metodo' => 'listarPerfiles',
        'privada' => true
    ),
    // Nuevas acciones para Likes
    'insertar_like' => array(
        'controlador' => 'ControladorLikes',
        'metodo' => 'insertar',
        'privada' => true
    ),
    'borrar_like' => array(
        'controlador' => 'ControladorLikes',
        'metodo' => 'borrar',
        'privada' => true
    ),
    'existe_like' => array(
        'controlador' => 'ControladorLikes',
        'metodo' => 'existeLike',
        'privada' => true
    ),

);

// Parseo de la ruta y selección de acción
if (isset($_GET['accion'])) {
    // Comprueba si se ha pasado una acción concreta, sino usa la acción por defecto 'inicio'
    if (isset($mapa[$_GET['accion']])) {
        // Comprueba si la acción existe en el mapa, sino muestra error 404
        $accion = $_GET['accion'];
    } else {
        // La acción no existe
        header('Status: 404 Not found');
        echo 'Página no encontrada';
        die();
    }
} else {
    // Acción por defecto
    $accion = 'inicio';
}

// Verificación de la cookie y inicio de sesión automático
if (!Sesion::existeSesion() && isset($_COOKIE['usuario'])) {
    // Conectamos con la BD
    $conexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
    $conn = $conexionDB->getConnexion();

    // Nos conectamos para obtener el id 
    $usuariosDAO = new UsuariosDAO($conn);
    if ($usuario = $usuariosDAO->getByNombreUsuario($_COOKIE['usuario'])) {
        // Inicia sesión automáticamente
        Sesion::iniciarSesion($usuario);
        // Redirigir a la página principal después de iniciar sesión automáticamente
        header('location: index.php?accion=vistaNormal');
        die();
    }
}

// Si la acción es privada, comprueba que el usuario ha iniciado sesión, sino redirige a index
if (!Sesion::existeSesion() && $mapa[$accion]['privada']) {
    header('location: index.php');
    guardarMensaje("Debes iniciar sesión para acceder a $accion");
    die();
}

// Obtiene el controlador y método a ejecutar del mapa
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

// Ejecuta el método del controlador
$objeto = new $controlador();
$objeto->$metodo();
