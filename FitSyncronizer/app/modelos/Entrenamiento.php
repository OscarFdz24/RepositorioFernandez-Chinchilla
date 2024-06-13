<?php 
class Entrenamiento {
    private $id;
    private $id_usuario;
    private $dia;
    private $rutina;
    private $grupo_muscular;
    private $fecha;

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getDia() {
        return $this->dia;
    }

    public function getRutina() {
        return $this->rutina;
    }

    public function getGrupoMuscular() {
        return $this->grupo_muscular;
    }

    public function getFecha() {
        return $this->fecha;
    }

    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }

    public function setRutina($rutina) {
        $this->rutina = $rutina;
    }

    public function setGrupoMuscular($grupo_muscular) {
        $this->grupo_muscular = $grupo_muscular;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}