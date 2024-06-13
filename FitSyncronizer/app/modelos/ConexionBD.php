<?php 

class ConexionBD {

    private $conn;

    function __construct($user, $password, $host, $database)
    {
        $this->conn = new mysqli($host, $user, $password, $database);
        if ($this->conn->connect_error) {
            die('Error al conectar con MySQL');
        }
    }
    
    function getConnexion(){
        return $this->conn;
    }

    function getDatabaseName(){
        // Realizar una consulta para obtener el nombre de la base de datos actual
        $result = $this->conn->query("SELECT DATABASE()");
        $row = $result->fetch_row();
        return $row[0]; // Devuelve el primer resultado, que es el nombre de la base de datos
    }
}