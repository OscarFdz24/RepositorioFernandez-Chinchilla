<?php 
class PerfilProfesional {
    private $id;
    private $id_usuario;
    private $imagen;
    private $nombre_personal;
    private $nombre_usuario_profesional;
    private $descripcion_personal;
    private $edad;
    private $anos_experiencia;
    private $datos_contacto;
    private $trabajos_anteriores;

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getNombrePersonal() {
        return $this->nombre_personal;
    }

    public function getNombreUsuarioProfesional() {
        return $this->nombre_usuario_profesional;
    }

    public function getDescripcionPersonal() {
        return $this->descripcion_personal;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getAnosExperiencia() {
        return $this->anos_experiencia;
    }

    public function getDatosContacto() {
        return $this->datos_contacto;
    }

    public function getTrabajosAnteriores() {
        return $this->trabajos_anteriores;
    }

    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function setNombrePersonal($nombre_personal) {
        $this->nombre_personal = $nombre_personal;
    }

    public function setNombreUsuarioProfesional($nombre_usuario_profesional) {
        $this->nombre_usuario_profesional = $nombre_usuario_profesional;
    }

    public function setDescripcionPersonal($descripcion_personal) {
        $this->descripcion_personal = $descripcion_personal;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setAnosExperiencia($anos_experiencia) {
        $this->anos_experiencia = $anos_experiencia;
    }

    public function setDatosContacto($datos_contacto) {
        $this->datos_contacto = $datos_contacto;
    }

    public function setTrabajosAnteriores($trabajos_anteriores) {
        $this->trabajos_anteriores = $trabajos_anteriores;
    }
}