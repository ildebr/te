<?php
require_once "conexion.php";


class ProcesoModelo{
    static public function mdlListarProceso(){
        $stmt = Conexion::conectar()->prepare("SELECT  *
                                                FROM proceso "); 
                                                 
        $stmt -> execute();
    
        return $stmt->fetchAll();
    }


    static public function mdlFiltrarProceso($crisol, $fecha_inicio_min, $fecha_inicio_max, $fecha_fin_min, $fecha_fin_max, $estado, $peso_inicial_min, $peso_inicial_max, $peso_final_min, $peso_final_max){
        if($crisol != '') $donde[] = 'crisol_id = :crisol';
        if($fecha_inicio_min != '') $donde[] = 'fecha_inicio >= :fecha_inicio_min';

        if($fecha_inicio_max != '') $donde[] = 'fecha_inicio <= :fecha_inicio_max';
        if($fecha_fin_min != '') $donde[] = 'fecha_fin >= :fecha_fin_min';
        if($fecha_fin_max != '') $donde[] = 'fecha_fin <= :fecha_fin_max';
        if($estado != '') $donde[] = 'estado LIKE :estado';
        if($peso_inicial_min != '') $donde[] = 'peso_inicial >= :peso_inicial_min';
        if($peso_inicial_max != '') $donde[] = 'peso_inicial <= :peso_inicial_max';
        if($peso_final_min != '') $donde[] = 'peso_final >= :peso_final_min';
        if($peso_final_max != '') $donde[] = 'peso_final <= :peso_final_max';



        if(count($donde)){
            $sql = 'SELECT * FROM proceso WHERE '.implode(' AND ',$donde);
            $stmt = Conexion::conectar()->prepare($sql);
            if($crisol != '') $stmt->bindParam(":crisol", $crisol, PDO::PARAM_STR);
            if($fecha_inicio_min != '') $stmt->bindParam(":fecha_inicio_min", $fecha_inicio_min, PDO::PARAM_STR);

            if($fecha_inicio_max != '') $stmt->bindParam(":fecha_inicio_max", $fecha_inicio_max, PDO::PARAM_STR);
            if($fecha_fin_min != '') $donde[] = $stmt->bindParam(":fecha_fin_min", $crisol_id, PDO::PARAM_STR);
            if($fecha_fin_max != '') $donde[] = $stmt->bindParam(":fecha_fin_max", $fecha_fin_max, PDO::PARAM_STR);
            if($estado != '') $donde[] = $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            if($peso_inicial_min != '') $donde[] = $stmt->bindParam(":peso_inicial_min", $peso_inicial_min, PDO::PARAM_STR);
            if($peso_inicial_max != '') $donde[] = $stmt->bindParam(":peso_inicial_max", $peso_inicial_max, PDO::PARAM_STR);
            if($peso_final_min != '') $donde[] = $stmt->bindParam(":peso_final_min", $peso_final_min, PDO::PARAM_STR);
            if($peso_final_max != '') $donde[] = $stmt->bindParam(":peso_final_max", $peso_final_max, PDO::PARAM_STR);
            $stmt -> execute();



            return $stmt->fetchAll();
        }
    }
}