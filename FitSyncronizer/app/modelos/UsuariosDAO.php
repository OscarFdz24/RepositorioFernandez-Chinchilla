<?php
require_once 'Usuario.php';
class UsuariosDAO
{
    private mysqli $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * Obtiene un usuario de la BD en función del email
     * @return Usuario Devuelve un Objeto de la clase Usuario o null si no existe
     */
    public function getByEmail($email): Usuario|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM usuario WHERE correo = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_object(Usuario::class);
            return $usuario;
        } else {
            return null;
        }
    }

    public function getById($id): Usuario|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM usuario WHERE id = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_object(Usuario::class);
            return $usuario;
        } else {
            return null;
        }
    }

    public function getByNombreUsuario($nombreUsuario): Usuario|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('s', $nombreUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_object(Usuario::class);
            return $usuario;
        } else {
            return null;
        }
    }
    /**
     * Obtiene todos los usuarios de la tabla mensajes
     */
    public function getAll(): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM usuario")) {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_mensajes = array();

        while ($usuario = $result->fetch_object(Usuario::class)) {
            $array_usuarios[] = $usuario;
        }
        return $array_usuarios;
    }

    public function getAllOrder(): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM usuario ORDER BY id")) {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Ejecutamos la SQL
        $stmt->execute();
        //Obtener el objeto mysql_result
        $result = $stmt->get_result();

        $array_mensajes = array();

        while ($usuario = $result->fetch_object(Usuario::class)) {
            $array_usuarios[] = $usuario;
        }
        return $array_usuarios;
    }


    /**
     * Inserta en la base de datos el usuario que recibe como parámetro
     * @return idUsuario Devuelve el id autonumérico que se le ha asignado al usuario o false en caso de error
     */
    function insert(Usuario $usuario): int|bool
    {
        if (!$stmt = $this->conn->prepare("INSERT INTO usuario (rol, nombre, nombre_usuario, correo, contrasena, telefono, perfil_publico) VALUES (?,?,?,?,?,?,?)")) {
            echo "Error al preparar la consulta insert: " . $this->conn->error;
            return false;
        }
        $rol = $usuario->getRol();
        $nombre = $usuario->getNombre();
        $nombre_usuario = $usuario->getNombreUsuario();
        $correo = $usuario->getCorreo();
        $contrasena = $usuario->getContrasena();
        $telefono = $usuario->getTelefono();
        $perfil_publico = $usuario->getPerfilPublico();
        if($perfil_publico == false) {
            $perfil_publico = 0;
        } else {
            $perfil_publico = 1;
        }
        $stmt->bind_param('ssssssi', $rol, $nombre, $nombre_usuario, $correo, $contrasena, $telefono, $perfil_publico);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            return false;
        }
    }
    /**
     * Borra el usuario de la tabla usuario del id pasado por parámetro
     * @return bool True si ha borrado el usuario y false si no lo ha borrado (por que no existía)
     */
    function delete($id): bool
    {
        if (!$stmt = $this->conn->prepare("DELETE FROM usuario WHERE id = ?")) {
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
    /**
     * Actualiza los datos del usuario en la base de datos
     * @return bool True si se realizó la actualización correctamente, false en caso contrario
     */
    function update(Usuario $usuario): bool
    {
        if (!$stmt = $this->conn->prepare("UPDATE usuario SET rol=?, nombre=?, nombre_usuario=?, correo=?, contrasena=?, telefono=?, perfil_publico=? WHERE id=?")) {
            echo "Error al preparar la consulta update: " . $this->conn->error;
            return false;
        }

        $id = $usuario->getId();
        $rol = $usuario->getRol();
        $nombre = $usuario->getNombre();
        $nombre_usuario = $usuario->getNombreUsuario();
        $correo = $usuario->getCorreo();
        $contrasena = $usuario->getContrasena();
        $telefono = $usuario->getTelefono();
        $perfil_publico = $usuario->getPerfilPublico();

        $stmt->bind_param('ssssssii', $rol, $nombre, $nombre_usuario, $correo, $contrasena, $telefono, $perfil_publico, $id);

        return $stmt->execute();
    }
}
