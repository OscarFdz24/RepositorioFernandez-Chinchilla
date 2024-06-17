<?php
require_once "app/utils/funciones.php";

class ControladorLikes
{
    function insertar()
    {
        header('Content-Type: application/json');
        ob_start(); // Inicia la captura de salida
        $connexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $idPerfil = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $likeDAO = new LikesDAO($conn);
        $like = new Like();
        $like->setIdPerfil($idPerfil);
        $like->setIdUsuario(Sesion::getUsuario()->getId());
        if ($likeDAO->insert($like)) {
            $numLikes = $likeDAO->countByIdPerfil($idPerfil);
            $response = ['respuesta' => 'ok', 'numLikes' => $numLikes];
        } else {
            $response = ['respuesta' => 'error'];
        }
        ob_end_clean(); // Limpia el buffer de salida para asegurarse de que no haya ningún otro contenido, es nesario para que funcione el script con AJAX
        echo json_encode($response);
    }

    function borrar()
    {
        header('Content-Type: application/json');
        ob_start(); // Inicia la captura de salida
        $connexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $connexionDB->getConnexion();
        $idPerfil = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $likeDAO = new LikesDAO($conn);
        $like = new Like();
        $like = $likeDAO->getByIdUsuarioIdPerfil(Sesion::getUsuario()->getId(), $idPerfil);
        if ($likeDAO->delete($like)) {
            $numLikes = $likeDAO->countByIdPerfil($idPerfil);
            $response = ['respuesta' => 'ok', 'numLikes' => $numLikes];
        } else {
            $response = ['respuesta' => 'error'];
        }
        ob_end_clean(); // Limpia el buffer de salida para asegurarse de que no haya ningún otro contenido
        echo json_encode($response);
    }

    function existeLike()
    {
        header('Content-Type: application/json');
        ob_start(); // Inicia la captura de salida
        $connexionDB = new ConexionBD(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $idPerfil = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $likeDAO = new LikesDAO($conn);
        $existe = $likeDAO->existByIdUsuarioIdPerfil(Sesion::getUsuario()->getId(), $idPerfil);

        $response = ['existe' => $existe];
        ob_end_clean(); // Limpia el buffer de salida para asegurarse de que no haya ningún otro contenido
        echo json_encode($response);
    }
}
