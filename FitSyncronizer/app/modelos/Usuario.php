<?php 
class Usuario {
    private $id;
    private $rol;
    private $nombre;
    private $nombre_usuario;
    private $correo;
    private $contrasena;
    private $telefono;
    private $perfil_publico;
    private $fecha;

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPerfilPublico() {
        return $this->perfil_publico;
    }

    public function getFecha() {
        return $this->fecha;
    }

    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setNombreUsuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setPerfilPublico($perfil_publico) {
        $this->perfil_publico = $perfil_publico;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}