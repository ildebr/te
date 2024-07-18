<?php

require_once "conexion.php";

class UsuarioModelo{

    static public function mdlIniciarSesion($usuario, $password){

        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, date("d/m/Y H:i:s"). '  ' . $usuario.'-'.$password."\n") or die("Error escribiendo en el archivo");

        fclose($logFile);

        // $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = Conexion::conectar()->prepare("select * from usuario WHERE cedula = :cedula AND contrasena = :contrasena");

        $stmt->bindParam(":cedula", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $password, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt-> fetchAll(PDO::FETCH_CLASS);

    }

    static public function mdlCrearUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol){
        $check = Conexion::conectar()->prepare("select id from usuario where cedula = :cedula OR correo = :correo");
        $check->bindParam(":cedula", $cedula, PDO::PARAM_STR);
        $check->bindParam(":correo", $correo, PDO::PARAM_STR);

        $check->execute();

        if ($check->rowCount() > 0) {
            // return json_encode(array('data'=>var_dump($check->fetchAll()), 'error' => 'existe' ));
            return false;
        }else{
            // $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $contrasena_n = hash('sha1', $contrasena);

            $stmt = Conexion::conectar()->prepare("insert into usuario(nombre,apellido,cedula,telefono,correo,turno,rol,contrasena) values(:nombre,:apellido,:cedula,:telefono,:correo,:turno,:rol,:contrasena)");

            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":turno", $turno, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $rol, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasena_n, PDO::PARAM_STR);

            $result = $stmt->execute();


            return $result;
        }
    }

    static public function mdlEditarUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol){

        $check = Conexion::conectar()->prepare("select id from usuario where correo = :correo");
        $check->bindParam(":correo", $correo, PDO::PARAM_STR);
        if ($check->rowCount() > 0) {
            // si el correo existe se manda un error
            return 'ce';
        }

        if($contrasena != ''){
            $contrasena_n = hash('sha1', $contrasena);

            $stmt = Conexion::conectar()->prepare("UPDATE usuario SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo, turno = :turno, rol = :rol, contrasena =:contrasena WHERE cedula = :cedula");
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":turno", $turno, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $rol, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasena_n, PDO::PARAM_STR);

            $result = $stmt->execute();

            return $stmt->rowCount();
        }else{
            $stmt = Conexion::conectar()->prepare("UPDATE usuario SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo, turno = :turno, rol = :rol WHERE cedula = :cedula");
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":turno", $turno, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $rol, PDO::PARAM_STR);

            $result = $stmt->execute();

            return $stmt->rowCount();
        }

        

        
    }


    static public function mdlDetalleUsuario($id){
        $stmt = Conexion::conectar()->prepare("select * from usuario where id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $result = $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlListarUsuario(){
        

        $stmt = Conexion::conectar()->prepare("SELECT  id,nombre,apellido,correo,cedula,telefono,rol,turno
                                                FROM usuario"); 
                                                 
        $stmt -> execute();
    
        return $stmt->fetchAll();
        
    }

    static public function mdlEliminarUsuario($id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt -> execute();
    
        return $stmt->rowCount();
    }
    
}