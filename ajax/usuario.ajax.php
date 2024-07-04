<?php

require_once "../controladores/usuario.controlador.php";
require_once "../modelos/usuario.modelo.php";


class AjaxUsuario{
    public function AjaxCrearUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol){
        $usuario = UsuarioControlador::ctrCrearUsuario($nombre, $contrasena, $apellido, $cedula, $correo, $telefono, $turno, $rol);


        echo json_encode($usuario);
    }

    public function AjaxListarUsuario(){
        $usuarios = UsuarioControlador::ctrListarUsuario();
        echo json_encode($usuarios);
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $nuevousuario = new AjaxUsuario();
    $nuevousuario->AjaxCrearUsuario($_POST['nombre'],$_POST['contrasena'],$_POST['apellido'],$_POST['cedula'],$_POST['correo'],$_POST['telefono'],$_POST['turno'],$_POST['rol']);
}elseif(isset($_POST['accion']) && $_POST['accion'] == 2){
    $usuarios = new AjaxUsuario();
    $usuarios->AjaxListarUsuario();
}