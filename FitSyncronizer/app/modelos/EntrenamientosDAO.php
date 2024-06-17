<?php
require_once 'Entrenamiento.php';

class EntrenamientosDAO
{
    private mysqli $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getById($id): Entrenamiento|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM entrenamiento WHERE id = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $entrenamiento = $result->fetch_object(Entrenamiento::class);
            return $entrenamiento;
        } else {
            return null;
        }
    }
    public function getAllByIdUsuario($idUsuario): array|null
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM entrenamiento WHERE id_usuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $array_entrenamientos = array();

        while ($entrenamiento = $result->fetch_object(Entrenamiento::class)) {
            $array_entrenamientos[] = $entrenamiento;
        }
        return $array_entrenamientos;
    }
    public function getAllOrder(): array|null
    {

        if (!$stmt = $this->conn->prepare("SELECT * FROM entrenamiento ORDER BY id_usuario ASC")) {
            echo "Error en la SQL: " . $this->conn->error;
            return null;
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $array_entrenamientos = array();

        while ($entrenamiento = $result->fetch_object(Entrenamiento::class)) {
            $array_entrenamientos[] = $entrenamiento;
        }
        return $array_entrenamientos;
    }
    public function getAll(): array
    {
        if (!$stmt = $this->conn->prepare("SELECT * FROM entrenamiento")) {
            echo "Error en la SQL: " . $this->conn->error;
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $array_entrenamientos = array();

        while ($entrenamiento = $result->fetch_object(Entrenamiento::class)) {
            $array_entrenamientos[] = $entrenamiento;
        }
        return $array_entrenamientos;
    }

    public function insert(Entrenamiento $entrenamiento): int|bool
    {
        if (!$stmt = $this->conn->prepare("INSERT INTO entrenamiento (id_usuario, dia, rutina, grupo_muscular) VALUES (?, ?, ?, ?)")) {
            echo "Error al preparar la consulta insert: " . $this->conn->error;
            return false;
        }
        var_dump("pp1");
        $id_usuario = $entrenamiento->getIdUsuario();
        $dia = $entrenamiento->getDia();
        $rutina = $entrenamiento->getRutina();
        $grupo_muscular = $entrenamiento->getGrupoMuscular();
        var_dump("pp2");
        var_dump($rutina);
        $stmt->bind_param('isss', $id_usuario, $dia, $rutina, $grupo_muscular);
        var_dump("pp3");
        if ($stmt->execute()) {
            return $stmt->insert_id;
            var_dump("pp4");
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            return false;
        }
    }

    public function delete($id): bool
    {
        if (!$stmt = $this->conn->prepare("DELETE FROM entrenamiento WHERE id = ?")) {
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

    public function update(Entrenamiento $entrenamiento): bool
    {
        if (!$stmt = $this->conn->prepare("UPDATE entrenamiento SET id_usuario=?, dia=?, rutina=?, grupo_muscular=? WHERE id=?")) {
            echo "Error al preparar la consulta update: " . $this->conn->error;
            return false;
        }

        $id = $entrenamiento->getId();
        $id_usuario = $entrenamiento->getIdUsuario();
        $dia = $entrenamiento->getDia();
        $rutina = $entrenamiento->getRutina();
        $grupo_muscular = $entrenamiento->getGrupoMuscular();

        $stmt->bind_param('isssi', $id_usuario, $dia, $rutina, $grupo_muscular, $id);

        return $stmt->execute();
    }
}
