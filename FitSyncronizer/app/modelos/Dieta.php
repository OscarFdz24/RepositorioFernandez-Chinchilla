<?php 
class Dieta {
    private $id;
    private $id_usuario;
    private $nombre_dieta;
    private $descripcion;
    private $en_proceso;
    private $fecha;

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombreDieta() {
        return $this->nombre_dieta;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEnProceso() {
        return $this->en_proceso;
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

    public function setNombreDieta($nombre_dieta) {
        $this->nombre_dieta = $nombre_dieta;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEnProceso($en_proceso) {
        $this->en_proceso = $en_proceso;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}