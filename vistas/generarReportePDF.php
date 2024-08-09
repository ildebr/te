<?php 
require_once(realpath(dirname(__FILE__)).'\dompdf-2.0.8\dompdf\autoload.inc.php');
require_once "../controladores/proceso.controlador.php";
require_once "../modelos/proceso.modelo.php";
session_start();

use Dompdf\Dompdf;
define("DOMPDF_ENABLE_REMOTE", false);
    
    // $resultado = ProcesoControlador::ctrFiltrarProceso($_POST['crisol'],$_POST['fecha_inicio_min'],$_POST['fecha_inicio_max'],$_POST['fecha_fin_min'],$_POST['fecha_fin_max'],$_POST['estado'],$_POST['peso_inicial_min'],$_POST['peso_inicial_max'],$_POST['peso_final_min'],$_POST['peso_final_max']);
    $resultado = ProcesoControlador::ctrFiltrarProceso($_POST['crisol'],'','','','','','','','','');

    $date = date('m/d/Y', time());
    $rootdir = $_SERVER["DOCUMENT_ROOT"];
    // print_r($resultado);


    $html= '<style>
    .header{
        display:flex; justify-content:space-between; align-items:space-between;
    }
        .header .derecha{
        float:right;
}
        h1,.derecha{
        display:inline-block;}

        .membrete{
        width:100%;
        text-align: center;
        border:none;
        }

        .membrete, .membrete tr, .membrete td{
        border:none;
        }

        .membrete p{
        line-height:1;
        margin: 0;
        font-family: sans-serif;
        margin-bottom: 5px;
}
        .
        </style>';
    $html.= '
        <table class="membrete">
            <tr>
                <td colspan="30">
                    <img style="height:80px;" src="data:image/png;base64, '.base64_encode(file_get_contents('assets/imagenes/cvg.png')).' "/>
                </td>
                <td colspan="40">
                    <p><strong>Industria Venezolana de Aluminio</strong></p>
                    <p><strong>SuperIntendencia de Servicios a Reducción</strong></p>
                    <p><strong>Departamento de Servicios Auxiliares</strong></p>
                    </br>
                    <p><strong>Reporte de Mantenimiento de Crisoles</strong></p>
                </td>
                    <img style="height:80px;" src="data:image/png;base64, '.base64_encode(file_get_contents('assets/imagenes/venalum.png')).' "/>
                hello
                </td>
            </tr>
        </table>
        <div class="header">
        <h1>Reporte</h1>
        <div class="derecha">
        <p>'.$date.'</p>
        <p>'.$_SESSION['nombre'].' '.$_SESSION['apellido'] .'</p>
        </div>
        </div>
    ';

    function obtener_estado($estado){
        if($estado == 'i'){
            return 'completado';
        }else{
            return 'Activo';
        }
    }

    function obtener_etapa($etapa){
        if($etapa == 'l') return 'Poduccion';
        if($etapa == 'm') return 'Mantenimiento';
        if($etapa == 's') return 'Mantenimiento superior';
        if($etapa == 'r') return 'Recibido';
    }

    $html.= "
    <style>
    table td{
    border:1px solid #000000;
    padding:5px;
}
    .header{
        display:flex; justify-content:space-between; align-items:center;
    }
    table th{
   border:2px solid #000;
   padding:5px;
}
    </style>
    

        <table style='border-collapse: collapse; 
    border:1px solid #69899F;'>
            <thead>
                <th>ID </th>
                <th>Proceso </th>
                <th>Fecha Inicio </th>
                <th>Fecha Fin</th>
                <th>Estado </th>
                <th>Etapa </th>
                <th>Peso Inicial</th>
                <th>Peso Final </th>
                <th>Peso Llegada Linea</th>
                <th>Material Recuperado</th>

            </thead>
            
    ";

    // echo $resultado[0][0];

    foreach($resultado as $result){
        $etapa = obtener_etapa($result[4]);
        // $estado = obtener_etapa($result[5]);
        $estado = $result[4];
        if($result[4] == 'i'){
            $estado = 'Completo';
        }else{
            $estado = 'Activo';
        }
        $etapa = $result[5];

        if($result[5] == 'l'){ $etapa ='Poduccion';}
        else if($result[5] == 'm'){ $etapa = 'Mantenimiento';}
        else if($result[5] == 's'){ $etapa = 'Mantenimiento superior';}
        else if($result[5] == 'r'){ $etapa = 'Recibido';}
        else if($result[5] == 'c'){ $etapa = 'Completo';}
        $html.= "
            <tr>
                <td> $result[1] </td>
                <td> $result[0] </td>
                <td> $result[16] </td>
                <td> $result[3] </td>
                <td> $estado </td>
                <td> $etapa </td>
                <td> $result[6] </td>
                <td> $result[7] </td>
                <td> $result[9] </td>
                <td> $result[8] </td>
            </tr>

        ";
    }
    

    $html.= "
        </table>
    ";
    // $options = new Options();
    // $options->set('isRemoteEnabled',true);      
    // $dompdf = new Dompdf( $options );

    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf ->set_paper("A4", "landscape");
    $dompdf ->load_html(utf8_decode($html));
    $dompdf ->render();
    $dompdf ->stream('mipdf.pdf');



?>