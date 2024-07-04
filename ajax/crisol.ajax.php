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
}


if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $crisolListado = new AjaxCrisol();
    $crisolListado->ajaxObtenerCrisoles();
}elseif(isset($_POST['accion']) && isset($_POST['id']) && $_POST['accion'] == 2) {
    $crisolDetalle = new AjaxCrisol();
    $crisolDetalle->ajaxObtenerDetalle($_POST['id']);
}elseif(isset($_POST['accion']) && isset($_POST['id']) && isset($_POST['usuario']) && $_POST['accion'] == 3){
    $actualizarCrisol = new AjaxCrisol();
    if(isset($_POST['peso'])){
        $actualizarCrisol->ajaxActualizarCrisol($_POST['id'], $_POST['usuario'], $_POST['peso']);
    }else{
        $actualizarCrisol->ajaxActualizarCrisol($_POST['id'], $_POST['usuario'], 0);
    }
    
}



// var_dump($_POST);