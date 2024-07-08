<?php

require_once "../controladores/proceso.controlador.php";
require_once "../modelos/proceso.modelo.php";


class AjaxProceso{

    public function AjaxListarProceso(){
        $procesos = ProcesoControlador::ctrListarProceso();
        echo json_encode($procesos);
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $listadoproceso = new AjaxProceso();
    $listadoproceso->AjaxListarProceso();
}