<?php
require_once "conexion.php";


class CrisolModelo{
    static public function mdlListarCrisoles(){
        $stmt = Conexion::conectar()->prepare("SELECT  *
                                                FROM crisol "); 
                                                 
        $stmt -> execute();
    
        return $stmt->fetchAll();
    }

    static public function mdlDetalleCrisol($id){
        // $stmt = Conexion::conectar()->prepare("SELECT  *
        //                                         FROM crisol WHERE id=:id"); 

        $stmt = Conexion::conectar()->prepare("SELECT  *
                                                FROM crisol  WHERE id=:id"); 
        
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

                                                 
        $stmt -> execute();
    
        return $stmt->fetch();
    }

    static public function mdlDetalleCrisolExtendido($id){
        $stmt = Conexion::conectar()->prepare("SELECT  *, crisol.estado as estado,proceso.estado as proceso_estado
                                                FROM crisol LEFT JOIN proceso ON crisol.id_proceso_actual = proceso.id_proceso  WHERE crisol.id=:id AND proceso.estado = 'a'"); 
        
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                                                 
        $stmt -> execute();
    
        return $stmt->fetch();
    }

    static public function mdlActualizarEstadoCrisol($id, $estado, $usuario, $proceso){

        $stmt = Conexion::conectar()->prepare("UPDATE crisol SET estado = :estado, id_proceso_actual = :proceso WHERE id=:id"); 
        
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":proceso", $proceso, PDO::PARAM_STR);
                                                 
        $stmt -> execute();
        if($stmt->rowCount() > 0){
            $stmt2 = Conexion::conectar()->prepare("SELECT  *
                                                FROM crisol WHERE id=:id"); 
        
            $stmt2->bindParam(":id", $id, PDO::PARAM_STR);
                                                    
            $stmt2 -> execute();
            return array("estado" => true, "result" => $stmt2->fetch());
        }

        return false;
        
    }

    static public function mdlActualizarEstadoFinalCrisol($id, $estado, $usuario){
        $stmt = Conexion::conectar()->prepare("UPDATE crisol SET estado = :estado, id_proceso_actual = 0 WHERE id=:id"); 
        
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
                                                 
        $stmt -> execute();
        if($stmt->rowCount() > 0){
            $stmt2 = Conexion::conectar()->prepare("SELECT  *
                                                FROM crisol WHERE id=:id"); 
        
            $stmt2->bindParam(":id", $id, PDO::PARAM_STR);
                                                    
            $stmt2 -> execute();
            return array("estado" => true, "result" => $stmt2->fetch());
        }

        return false;
        
    }


    static public function mdlCrearIdProceso(){
        $stmt =  Conexion::conectar()->prepare("SELECT max(id) as mayor FROM proceso");
        $stmt -> execute();
        return json_encode($stmt -> fetch());
    }


    static public function mdlCrearProceso($crisol_id, $peso_inicial, $proceso, $usuario){
        date_default_timezone_set('America/Caracas');
        $fecha = date('Y-m-d H:i:s');
        $etapa = 'l';
        $estado = 'a';
        $stmt = Conexion::conectar()->prepare("INSERT INTO proceso(crisol_id, fecha_inicio, id_proceso, etapa, estado, usuario_inicia, peso_inicial) VALUES(:crisol_id, :fecha_inicio, :proceso, :etapa, :estado, :usuario_inicia, :peso_inicial)");

        $stmt->bindParam(":proceso", $proceso, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":peso_inicial", $peso_inicial, PDO::PARAM_STR);
        $stmt->bindParam(":crisol_id", $crisol_id, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_inicia", $usuario, PDO::PARAM_STR);
        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
        
    }

    static public function mdlActualizarProcesoRecibido($proceso, $etapa){
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET etapa = :etapa WHERE id_proceso = :proceso");

        $stmt->bindParam(":proceso", $proceso, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);
        $stmt -> execute();
        return Conexion::conectar()->lastInsertId();
    }


    static public function mdlCrearProcesoEtapa($proceso, $etapa, $usuario, $peso_crisol){
        $stmt = Conexion::conectar()->prepare("INSERT INTO proceso_etapa(id_proceso, etapa, usuario, peso_crisol) VALUES(:proceso, :etapa, :usuario, :peso_crisol)");
        $stmt->bindParam(":proceso", $proceso, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":peso_crisol", $peso_crisol, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarPesoCrisol($crisol, $peso_nuevo){
        $stmt = Conexion::conectar()->prepare("UPDATE crisol SET peso = :peso WHERE id = :crisol");
        $stmt->bindParam(":crisol", $crisol, PDO::PARAM_STR);
        $stmt->bindParam(":peso", $peso_nuevo, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarProcesoPesoLlegadaLinea($id_proceso, $peso){
        
    }


    static public function mdlActualizarProcesoEnviadoAMantenimiento($id_proceso, $etapa, $peso){
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET etapa = :etapa, peso_llegada_linea = :peso WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);
        $stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
        // return $peso + 10;
    }

    static public function mdlActualizarProcesoPesoMantenimientoSuperior($id_proceso, $peso){
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET peso_mantenimiento_superior = :peso WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarMaterialRecuperado($id_proceso, $peso){
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET material_recuperado = :peso WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

        $stmt -> execute();
        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarProcesoCompletado($id_proceso, $peso, $recuperado){
        date_default_timezone_set('America/Caracas');
        $fecha_fin = date('Y-m-d H:i:s');
        $estado = 'i';
        $etapa = 'c';
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET peso_final = :peso, material_recuperado = :recuperado, estado = :estado, etapa = :etapa, fecha_fin = :fecha_fin WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":peso", $peso, PDO::PARAM_STR);
        $stmt->bindParam(":recuperado", $recuperado, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarProcesoCompletadoSinPeso($id_proceso){
        $estado = 'i';
        $etapa = 'c';
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET  estado = :estado, etapa = :etapa WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_STR);

        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }

    static public function mdlActualizarProcesoPesoFinal($id_proceso, $peso){
        date_default_timezone_set('America/Caracas');
        $fecha_fin = date('Y-m-d H:i:s');
        $stmt = Conexion::conectar()->prepare("UPDATE proceso SET peso_final = :peso, fecha_fin = :fecha_fin WHERE id_proceso = :id_proceso");
        $stmt->bindParam(":peso", $peso, PDO::PARAM_STR);
        $stmt->bindParam(":id_proceso", $id_proceso, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
        $stmt -> execute();

        return Conexion::conectar()->lastInsertId();
    }


    static public function mdlInhabilitarCrisol($id,$usuario){
        // se busca el usuario y se confirma que tenga permisos de administrador
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam(":id", $usuario, PDO::PARAM_STR);

        $stmt -> execute();
        $result = $stmt->fetch();
        if(isset($result)){
            if($result['rol']=='administrador'){
                // return $id;
                $stmt2 = Conexion::conectar()->prepare("SELECT * FROM crisol WHERE id = :id");
                $stmt2->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt2 -> execute();
                $result2 = $stmt2->fetch();
                // si el usuario es administrador y el crisol existe se actualiza a disponible o inhabilitado acordemente
                if($result2['estado'] == 'd'){
                    $stmt3 = Conexion::conectar()->prepare("UPDATE crisol set estado = 'i' WHERE id = :id");
                    $stmt3->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmt3->execute();
                    
                    if($stmt3->rowCount() > 0){
                        return array("estado" => true, "result" => Conexion::conectar()->lastInsertId(), "exito_msg"=>"Crisol inhabilitado");
                    }else{
                        return array("estado"=>false,  "error_msg"=>"Crisol no existe o ya esta inhabilitado", "exito_msg"=>"");
                    }
                    
                }else{
                    $stmt3 = Conexion::conectar()->prepare("UPDATE crisol set estado = 'd' WHERE id = :id");
                    $stmt3->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmt3->execute();
                    if($stmt3->rowCount() > 0){
                        return array("estado" => true, "result" => Conexion::conectar()->lastInsertId(), "exito_msg"=>"Crisol habilitado");
                    }else{
                        return array("estado"=>false,  "error_msg"=>"Crisol no existe o ya esta inhabilitado", "exito_msg"=>"");
                    }
                    // return array("estado"=>true, "result"=>$result2, "error_msg"=>"", "exito_msg"=>"Crisol Habilitado");
                }
                // return $result2;
            }else{
                return array("estado"=>false, "error_msg"=>"No tiene los permisos necesarios");
            }
        }else{
            return array("error_msg"=>"El usuario no existe");
        }
        return array("estado"=>true, "result"=>$result, "error_msg"=>"");
    }


    // static public function 
}