<?php

class Conexion {
    static public function conectar() {
        try {
            $conn = new PDO('mysql:host=localhost;port=3306;dbname=systhesis', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $conn;
        }
        catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
            return null;
        }
    }
}
?>