<?php

require_once "../controladores/proceso.controlador.php";
require_once "../modelos/proceso.modelo.php";


class AjaxProceso{

    public function AjaxListarProceso(){
        $procesos = ProcesoControlador::ctrListarProceso();
        echo json_encode($procesos);
    }

    public function AjaxFiltrarProceso($crisol, $fecha_inicio_min, $fecha_inicio_max, $fecha_fin_min, $fecha_fin_max, $estado, $peso_inicial_min, $peso_inicial_max, $peso_final_min, $peso_final_max){
        $procesos = ProcesoControlador::ctrFiltrarProceso($crisol, $fecha_inicio_min, $fecha_inicio_max, $fecha_fin_min, $fecha_fin_max, $estado, $peso_inicial_min, $peso_inicial_max, $peso_final_min, $peso_final_max);
        echo json_encode($procesos);
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $listadoproceso = new AjaxProceso();
    $listadoproceso->AjaxListarProceso();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){
    $listadoproceso = new AjaxProceso();
    $listadoproceso->AjaxFiltrarProceso($_POST['id'],$_POST['fecha_inicio_min'],$_POST['fecha_inicio_max'],$_POST['fecha_fin_min'],$_POST['fecha_fin_max'],$_POST['estado'],$_POST['peso_inicial_min'],$_POST['peso_inicial_max'],$_POST['peso_final_min'],$_POST['peso_final_max']);
}