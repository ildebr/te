<?php

class crisolControlador {
    static public function ctlListarCrisoles(){
        $crisoles = CrisolModelo::mdlListarCrisoles();
        return $crisoles;
    }

    static public function ctlDetalleCrisol($id){
        $crisol = CrisolModelo::mdlDetalleCrisol($id);


        if($crisol['id_proceso_actual'] != 0){
            $crisol = CrisolModelo::mdlDetalleCrisolExtendido($id);
        }
        return $crisol;
    }

    static public function ctlFiltrarCrisol($crisol,$fecha_inicio, $fecha_fin, $estado ){
        return 0;
    }

    static public function ctlActualizarEstadoCrisol($id,$usuario,$peso){
        // $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,$estado,$usuario);


        
        $crisol = CrisolModelo::mdlDetalleCrisol($id);

        // return $crisol;


        if($crisol['estado'] == 'd'){
            $id_proceso = 0;
            $max = crisolModelo::mdlCrearIdProceso();
            if($max == null){
                $id_proceso = 1;
                // return 1;
            }else{
                $max = json_decode($max);
                // return $max[1]->mayor;
                // seleccionamos el id el proceso mayor y le sumamos 1 para tener el proceso actual
                $id_proceso = $max->mayor + 1;
                // return $max->mayor + 1;
            }
            // se actualiza el estado del crisol
            $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,'l',$usuario, $id_proceso);
            // se crea el proceso nuevo
            $proceso = crisolModelo::mdlCrearProceso($id, $crisol['peso'], $id_proceso, $usuario);
            // se crea la etapa a la que pasa el crisol
            $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($id_proceso, 'l', $usuario, $crisol['peso']);

            return $actualizar;
        }

        if($crisol['estado'] == 'l'){
            // se actualiza el estado del crisol
            $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,'r',$usuario, $crisol['id_proceso_actual']);
            // se crea el proceso nuevo
            $proceso = crisolModelo::mdlActualizarProcesoRecibido($crisol['id_proceso_actual'], 'r');
            // se crea la etapa a la que pasa el crisol
            $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 'r', $usuario, $crisol['peso']);

            return $actualizar;
        }

        if($crisol['estado'] == 'r'){
            // se actualiza el estado del crisol
            $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,'m',$usuario, $crisol['id_proceso_actual']);

            
            // // $peso_ctualizar = crisolModelo::mdlActualizarPesoCrisol($id,$peso);

            settype($peso, "float");

            // // se actualiza el peso de la llegada de linea 
            $actualproceso = crisolModelo::mdlActualizarProcesoEnviadoAMantenimiento($crisol['id_proceso_actual'], 'm', $peso);

            $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 'm', $usuario, $peso);

            return $actualizar;

            // return $actualproceso;
        }

        if($crisol['estado'] == 'm'){
            // $mantenimiento_superior = crisolModelo::necesitaMantenimientoSuperior($crisol, $peso);


            

            // return  $peso >  ( $crisol['peso'] + 500);

            settype($peso, "float");
            // return  $peso >  ( $crisol['peso'] + 500);

            // si el peso ingresado con el que llego el crisol de mantenimiento es el peso que tenia el crisol antes de ir + 500

            if($peso > ( $crisol['peso'] + 500)){
                // mantenimiento
                $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,'m',$usuario, $crisol['id_proceso_actual']);

                $pesoNuevo = crisolModelo::mdlActualizarPesoCrisol($id,$peso);

                // a;adir peso recibido de mantenmiento

                $proceso = crisolModelo::mdlActualizarProcesoRecibido($crisol['id_proceso_actual'], 'm');

                $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 'm', $usuario, $peso);

                return $actualizar;
            }else if($peso < $crisol['peso']){

                $crisol_extendido = crisolModelo::mdlDetalleCrisolExtendido($id);

                $actualizar = crisolModelo::mdlActualizarEstadoCrisol($id,'s',$usuario, $crisol['id_proceso_actual']);
                // $peso = crisolModelo::mdlActualizarPesoCrisol($id,$peso);
                $proceso = crisolModelo::mdlActualizarProcesoRecibido($crisol['id_proceso_actual'], 's');

                //p peso con el que se envia a mantenimiento superior


                $auxiliar = crisolModelo::mdlActualizarProcesoPesoMantenimientoSuperior($crisol['id_proceso_actual'], $peso);

                
                $material_recuperado =$crisol_extendido['peso_llegada_linea'] - $peso ;
                $recuperado = crisolModelo::mdlActualizarMaterialRecuperado($crisol['id_proceso_actual'],$material_recuperado);

                $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 's', $usuario, $peso);
                return $actualizar;
            }else{

                $crisol_extendido = crisolModelo::mdlDetalleCrisolExtendido($id);

                $material_recuperado =$crisol_extendido['peso_llegada_linea'] - $peso ;
                // se libera
                $actualizar = crisolModelo::mdlActualizarEstadoFinalCrisol($id,'d',$usuario);
                $pesoNuevo = crisolModelo::mdlActualizarPesoCrisol($id,$peso);
                $recuperado = crisolModelo::mdlActualizarProcesoCompletado($crisol['id_proceso_actual'], $peso, $material_recuperado);
                $proceso_pesofinal = crisolModelo::mdlActualizarProcesoPesoFinal($crisol['id_proceso_actual'], $peso);

                $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 'c', $usuario, $peso);
                return $actualizar;
            }

        }

        if($crisol['estado'] == 's'){
            $actualizar = crisolModelo::mdlActualizarEstadoFinalCrisol($id,'d',$usuario);
            $pesoNuevo = crisolModelo::mdlActualizarPesoCrisol($id,$peso);
            $proceso_pesofinal = crisolModelo::mdlActualizarProcesoPesoFinal($crisol['id_proceso_actual'], $peso);
            $recuperado = crisolModelo::mdlActualizarProcesoCompletadoSinPeso($crisol['id_proceso_actual']);

            $proceso_etapa = crisolModelo::mdlCrearProcesoEtapa($crisol['id_proceso_actual'], 'c', $usuario, $peso);
            return $actualizar;


        }
        // else if($crisol['estado'] == 'l')

        // return $actualizar;
    }
}

