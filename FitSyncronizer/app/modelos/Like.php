<?php 
class Like {
    private $id;
    private $id_perfil;
    private $id_usuario;

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdPerfil() {
        return $this->id_perfil;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdPerfil($id_perfil) {
        $this->id_perfil = $id_perfil;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
}