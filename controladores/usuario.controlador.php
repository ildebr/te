<?php

class UsuarioControlador{

    /* 
    Validar el acceso del usuario
    */
    public function login(){

        if(isset($_POST["loginUsuario"])){

            $usuario = $_POST["loginUsuario"];
            // $password = crypt($_POST["loginPassword"],'$2a$07$azybxcags23425sdg23sdfhsd$');
            $password = password_hash($_POST["loginPassword"], PASSWORD_DEFAULT);

            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $password);

            if(count($respuesta) > 0){

                $_SESSION["usuario"] = $respuesta[0];

                echo '
                    <script>
                        window.location = "http://localhost/crisis%20existencial/3/";
                    </script>
                
                ';
            }else{

                echo '
                    <script>
                        fncSweetAlert("error","Usuario y/o password inválido","http://localhost/crisis%20existencial/3/");
                    </script>
                
                ';
            }

        }
    }

    static public function ctrCrearUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol){
        $crearusuario = UsuarioModelo::mdlCrearUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol);
        if ($crearusuario == false){
            $output = array();
            $output[] = array('estado' => 'fallo', 'error'=>true, 'error_msg'=>'cedula o correo ya en uso');
            return $output;
        }
        else if($crearusuario == true){
            $output = array();
            $output[] = array('estado' => 'exitoso', 'error'=>false);
            return $output;
        }
        
    }

    static public function ctrEditarUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol){
        $usuario = UsuarioModelo::mdlEditarUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol);

        if ($usuario == 'ce'){
            $output = array();
            $output[] = array('estado' => 'fallido', 'error'=>true, 'msg' => 'correo ya existe');
            return $output;
        }
        if($usuario > 0){
            $output = array();
            $output[] = array('estado' => 'exitoso', 'error'=>false, 'msg' => 'Datos actualizados');
            return $output;
            // return true;
        }else{
            $output = array();
            $output[] = array('estado' => 'fallido', 'error'=>true, 'msg' => 'Datos no actualizados');
            return $output;
            // return false;
        }
        
    }

    static public function ctrDetalleUsuario($id){
        $usuario = UsuarioModelo::mdlDetalleUsuario($id);
        if($usuario > 0){
            return $usuario;
        }else{
            return false;
        }
    }
    
    static public function ctrListarUsuario(){
        $usuarios = UsuarioModelo::mdlListarUsuario();
        if($usuarios== null){
            return array('error'=>'error');
        }{
            return $usuarios;
        }
    }

    static public function ctrEliminarUsuario($id){
        $usuario = UsuarioModelo::mdlEliminarUsuario($id);
        if($usuario > 0){
            return true;
        }else{
            return false;
        }
    }
}