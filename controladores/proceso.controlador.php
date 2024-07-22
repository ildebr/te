<?php

class ProcesoControlador{

    /* 
    Validar el acceso del usuario
    */
    static public function ctrListarProceso(){
        $proceso = ProcesoModelo::mdlListarProceso();
        return $proceso;
    }

    static public function ctrFiltrarProceso($crisol, $fecha_inicio_min, $fecha_inicio_max, $fecha_fin_min, $fecha_fin_max, $estado, $peso_inicial_min, $peso_inicial_max, $peso_final_min, $peso_final_max){
        $proceso = ProcesoModelo::mdlFiltrarProceso($crisol, $fecha_inicio_min, $fecha_inicio_max, $fecha_fin_min, $fecha_fin_max, $estado, $peso_inicial_min, $peso_inicial_max, $peso_final_min, $peso_final_max);
        return $proceso;
    }
}