<?php
require_once "conexion.php";


class ProcesoModelo{
    static public function mdlListarProceso(){
        $stmt = Conexion::conectar()->prepare("SELECT  *
                                                FROM proceso "); 
                                                 
        $stmt -> execute();
    
        return $stmt->fetchAll();
    }
}