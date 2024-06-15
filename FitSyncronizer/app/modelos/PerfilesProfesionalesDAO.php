<?php
require_once "PerfilProfesional.php";
class PerfilesProfesionalesDAO
{
    private mysqli $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    //Función para obtener un perfil por su id
    public function getById($id): PerfilProfesional|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM perfil_profesional WHERE id = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $perfil = $result->fetch_object(PerfilProfesional::class);
            return $perfil;
        } else {
            return null;
        }
    }
    //Función para obtener un perfil por su id de usuario
    public function getByIdUsuario($id_usuario): PerfilProfesional|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM perfil_profesional WHERE id_usuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $perfil = $result->fetch_object(PerfilProfesional::class);
            return $perfil;
        } else {
            return null;
        }
    }
    //Función para obtener todos los perfiles
    public function getAll(): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM perfil_profesional")) {
            echo "Error en la SQL: " . $this->conn->error;
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $array_perfiles = array();

        while ($perfil = $result->fetch_object(PerfilProfesional::class)) {
            $array_perfiles[] = $perfil;
        }
        return $array_perfiles;
    }
    // Función para obtener todos los perfiles ordenados por nombreUsuario de la A a la Z
    public function getAllOrder(): array
    {
        // Preparar la consulta SQL con la cláusula ORDER BY nombreUsuario ASC
        if (!$stmt = $this->conn->prepare("SELECT * FROM perfil_profesional ORDER BY nombre_usuario_profesional DESC")) {
            echo "Error en la SQL: " . $this->conn->error;
            return [];
        }

        // Ejecutar la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Crear el array para almacenar los perfiles
        $array_perfiles = array();

        // Obtener los resultados y almacenarlos en el array
        while ($perfil = $result->fetch_object(PerfilProfesional::class)) {
            $array_perfiles[] = $perfil;
        }

        // Devolver el array de perfiles
        return $array_perfiles;
    }
    //Función para insertar un perfil
    public function insert(PerfilProfesional $perfil): int|bool
    {
        $sql = "INSERT INTO perfil_profesional (id_usuario, imagen, nombre_personal, nombre_usuario_profesional, descripcion_personal, edad, anos_experiencia, datos_contacto, trabajos_anteriores) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if (!$stmt = $this->conn->prepare($sql)) {
            echo "Error al preparar la consulta insert: " . $this->conn->error;
            return false;
        }

        $id_usuario = $perfil->getIdUsuario();
        $imagen = $perfil->getImagen();
        $nombre_personal = $perfil->getNombrePersonal();
        $nombre_usuario_profesional = $perfil->getNombreUsuarioProfesional();
        $descripcion_personal = $perfil->getDescripcionPersonal();
        $edad = $perfil->getEdad();
        $anos_experiencia = $perfil->getAnosExperiencia();
        $datos_contacto = $perfil->getDatosContacto();
        $trabajos_anteriores = $perfil->getTrabajosAnteriores();

        $stmt->bind_param('issssiiss', $id_usuario, $imagen, $nombre_personal, $nombre_usuario_profesional, $descripcion_personal, $edad, $anos_experiencia, $datos_contacto, $trabajos_anteriores);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            return false;
        }
    }
    //Función para borrar un perfil
    public function delete($id): bool
    {
        if (!$stmt = $this->conn->prepare("DELETE FROM perfil_profesional WHERE id = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return false;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    //Función para modificar un perfil
    public function update(PerfilProfesional $perfil): bool
    {
        if (!$stmt = $this->conn->prepare(
            "UPDATE perfil_profesional SET id_usuario=?, imagen=?, nombre_personal=?, nombre_usuario_profesional=?, descripcion_personal=?, edad=?, anos_experiencia=?, datos_contacto=?, trabajos_anteriores=? WHERE id=?"
        )) {
            echo "Error al preparar la consulta update: " . $this->conn->error;
            return false;
        }

        $id = $perfil->getId();
        $id_usuario = $perfil->getIdUsuario();
        $imagen = $perfil->getImagen();
        $nombre_personal = $perfil->getNombrePersonal();
        $nombre_usuario_profesional = $perfil->getNombreUsuarioProfesional();
        $descripcion_personal = $perfil->getDescripcionPersonal();
        $edad = $perfil->getEdad();
        $anos_experiencia = $perfil->getAnosExperiencia();
        $datos_contacto = $perfil->getDatosContacto();
        var_dump("DAO");
        var_dump($datos_contacto);
        $trabajos_anteriores = $perfil->getTrabajosAnteriores();

        $stmt->bind_param(
            'issssisssi',
            $id_usuario,
            $imagen,
            $nombre_personal,
            $nombre_usuario_profesional,
            $descripcion_personal,
            $edad,
            $anos_experiencia,
            $datos_contacto,
            $trabajos_anteriores,
            $id
        );

        return $stmt->execute();
    }
}
