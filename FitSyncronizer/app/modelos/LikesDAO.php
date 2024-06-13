<?php 
class LikesDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($like){
        if($this->existByIdUsuarioIdPerfil($like->getIdUsuario(), $like->getIdPerfil())){
            return false;
        }
        if(!$stmt = $this->conn->prepare("INSERT INTO `like` (id_perfil, id_usuario) VALUES (?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $idPerfil = $like->getIdPerfil();
        $idUsuario = $like->getIdUsuario();
        $stmt->bind_param('ii', $idPerfil, $idUsuario);
        if($stmt->execute()){
            $like->setId($stmt->insert_id);
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }

    public function delete($like){
        if(!$stmt = $this->conn->prepare("DELETE FROM `like` WHERE id = ?")){
            die("Error al preparar la consulta delete: " . $this->conn->error );
        }
        $id = $like->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if($stmt->affected_rows >= 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function countByIdPerfil($idPerfil){
        if(!$stmt = $this->conn->prepare("SELECT count(*) as NumLikes FROM `like` WHERE id_perfil = ?")){
            die("Error al preparar la consulta select count: " . $this->conn->error );
        }
        $stmt->bind_param('i', $idPerfil);
        $stmt->execute();
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();
        return $fila['NumLikes'];
    }

    /**
     * Función que comprueba si existe un like con idUsuario y idPerfil
     * Devuelve true si existe y false si no existe
     */
    public function existByIdUsuarioIdPerfil($idUsuario, $idPerfil){
        if(!$stmt = $this->conn->prepare("SELECT * FROM `like` WHERE id_perfil = ? and id_usuario = ?")){
            die("Error al preparar la consulta select count: " . $this->conn->error );
        }
        $stmt->bind_param('ii', $idPerfil, $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >= 1){
            return true;
        } else {
            return false;
        }
    }

    public function getByIdUsuarioIdPerfil($idUsuario, $idPerfil){
        if(!$stmt = $this->conn->prepare("SELECT * FROM `like` WHERE id_perfil = ? and id_usuario = ?")){
            die("Error al preparar la consulta select count: " . $this->conn->error );
        }
        echo("p1");
        $stmt->bind_param('ii', $idPerfil, $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($like = $result->fetch_object(Like::class)){
            return $like;
        }
        else{
            return false;
        }
    }
}?>