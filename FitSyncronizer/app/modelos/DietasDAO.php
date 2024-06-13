<?php
require_once 'Dieta.php';

class DietasDAO
{
    private mysqli $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getById($id): Dieta|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM dietas WHERE id = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $dieta = $result->fetch_object(Dieta::class);
            return $dieta;
        } else {
            return null;
        }
    }
    public function getAllByIdUsuario($idUsuario): array|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM dietas WHERE id_usuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $array_dietas = array();

        while ($dieta = $result->fetch_object(Dieta::class)) {
            $array_dietas[] = $dieta;
        }
        return $array_dietas;
    }
    public function getAllOrder(): array|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM dietas ORDER BY id_usuario ASC")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $array_dietas = array();

        while ($dieta = $result->fetch_object(Dieta::class)) {
            $array_dietas[] = $dieta;
        }
        return $array_dietas;
    }
    public function getByIdUsuario($idUsuario): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM dietas WHERE id_usuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return [];
        }

        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $array_dietas = array();

        while ($dieta = $result->fetch_object(Dieta::class)) {
            $array_dietas[] = $dieta;
        }
        return $array_dietas;
    }

    public function getAll(): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM dietas")) {
            echo "Error en la SQL: " . $this->conn->error;
            return [];
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $array_dietas = array();

        while ($dieta = $result->fetch_object(Dieta::class)) {
            $array_dietas[] = $dieta;
        }
        return $array_dietas;
    }

    public function insert(Dieta $dieta): int|bool
    {
        if (!$stmt = $this->conn->prepare("INSERT INTO dietas (id_usuario, nombre_dieta, descripcion, en_proceso) VALUES (?, ?, ?, ?)")) {
            echo "Error al preparar la consulta insert: " . $this->conn->error;
            return false;
        }
        $id_usuario = $dieta->getIdUsuario();
        $nombre_dieta = $dieta->getNombreDieta();
        $descripcion = $dieta->getDescripcion();
        $en_proceso = $dieta->getEnProceso();

        $stmt->bind_param('issi', $id_usuario, $nombre_dieta, $descripcion, $en_proceso);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            return false;
        }
    }

    public function delete($id): bool
    {
        if (!$stmt = $this->conn->prepare("DELETE FROM dietas WHERE id = ?")) {
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

    public function update(Dieta $dieta): bool
    {
        if (!$stmt = $this->conn->prepare("UPDATE dietas SET id_usuario=?, nombre_dieta=?, descripcion=?, en_proceso=? WHERE id=?")) {
            echo "Error al preparar la consulta update: " . $this->conn->error;
            return false;
        }

        $id = $dieta->getId();
        $id_usuario = $dieta->getIdUsuario();
        $nombre_dieta = $dieta->getNombreDieta();
        $descripcion = $dieta->getDescripcion();
        $en_proceso = $dieta->getEnProceso();
        var_dump("5S");
        $stmt->bind_param('issii', $id_usuario, $nombre_dieta, $descripcion, $en_proceso, $id);

        return $stmt->execute();
    }
}
?>