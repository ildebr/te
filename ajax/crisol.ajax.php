<?php
require_once "../controladores/crisol.controlador.php";
require_once "../modelos/crisol.modelo.php";

class AjaxCrisol{
    public function ajaxObtenerCrisoles(){
        $crisoles = CrisolControlador::ctlListarCrisoles();
        echo json_encode($crisoles);
    }

    public function ajaxObtenerDetalle($id){
        $crisol = CrisolControlador::ctlDetalleCrisol($id);
        echo json_encode($crisol);
    }

    public function ajaxActualizarCrisol($id,$usuario,$peso){
        $crisol = CrisolControlador::ctlActualizarEstadoCrisol($id,$usuario,$peso);
        echo json_encode($crisol);
    }

    public function ajaxInhabilitarCrisol($id,$usuario){
        $crisol = CrisolControlador::ctlInhabilitarCrisol($id,$usuario);
        // echo json_encode(array("hello"=>"alo"));
        echo json_encode($crisol);
    }

    public function ajaxCrearCrisol($nombre,$peso){
        $crisol = CrisolControlador::ctlCrearCrisol($nombre,$peso);
        echo json_encode($crisol);
    }
}


if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $crisolListado = new AjaxCrisol();
    $crisolListado->ajaxObtenerCrisoles();
}elseif(isset($_POST['accion']) && isset($_POST['id']) && $_POST['accion'] == 2) {
    // detalle del crisol
    $crisolDetalle = new AjaxCrisol();
    $crisolDetalle->ajaxObtenerDetalle($_POST['id']);
}elseif(isset($_POST['accion']) && isset($_POST['id']) && isset($_POST['usuario']) && $_POST['accion'] == 3){
    //actualizar estado del crisol
    $actualizarCrisol = new AjaxCrisol();
    if(isset($_POST['peso'])){
        $actualizarCrisol->ajaxActualizarCrisol($_POST['id'], $_POST['usuario'], $_POST['peso']);
    }else{
        $actualizarCrisol->ajaxActualizarCrisol($_POST['id'], $_POST['usuario'], 0);
    }
    
}elseif(isset($_POST['accion']) && $_POST['accion'] == 4 && $_POST['crisol'] && $_POST['usuario']){
    // inhabilitar/habilitar crisol
    $actualizarCrisol = new AjaxCrisol();
    $actualizarCrisol->ajaxInhabilitarCrisol($_POST['crisol'],$_POST['usuario']);
}elseif(isset($_POST['accion']) && $_POST['accion'] == 5 && $_POST['nombre'] && $_POST['peso']){
    //crear crisol
    $crearCrisol = new AjaxCrisol();
    $crearCrisol->ajaxCrearCrisol($_POST['nombre'],$_POST['peso']);
}



// var_dump($_POST);