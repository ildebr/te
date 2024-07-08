<?php

class ProcesoControlador{

    /* 
    Validar el acceso del usuario
    */
    static public function ctrListarProceso(){
        $proceso = ProcesoModelo::mdlListarProceso();
        return $proceso;
    }
}