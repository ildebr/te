<?php 
require_once(realpath(dirname(__FILE__)).'\dompdf-2.0.8\dompdf\autoload.inc.php');
require_once "../controladores/proceso.controlador.php";
require_once "../modelos/proceso.modelo.php";
use Dompdf\Dompdf;
    
    $resultado = ProcesoControlador::ctrFiltrarProceso($_POST['crisol'],$_POST['fecha_inicio_min'],$_POST['fecha_inicio_max'],$_POST['fecha_fin_min'],$_POST['fecha_fin_max'],$_POST['estado'],$_POST['peso_inicial_min'],$_POST['peso_inicial_max'],$_POST['peso_final_min'],$_POST['peso_final_max']);

    // print_r($resultado);
    $html = '
        <div>
        <h1>Reporte</h1>
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
            $estado = 'completado';
        }else{
            $estado = 'Activo';
        }
        $etapa = $result[5];

        if($result[5] == 'l'){ $etapa ='Poduccion';}
        else if($result[5] == 'm'){ $etapa = 'Mantenimiento';}
        else if($result[5] == 's'){ $etapa = 'Mantenimiento superior';}
        else if($result[5] == 'r'){ $etapa = 'Recibido';}
        else if($result[5] == 'c'){ $etapa = 'Completado';}
        $html.= "
            <tr>
                <td> $result[1] </td>
                <td> $result[0] </td>
                <td> $result[2] </td>
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


    $dompdf = new Dompdf();
    $dompdf ->set_paper("A4", "landscape");
    $dompdf ->load_html(utf8_decode($html));
    $dompdf ->render();
    $dompdf ->stream('mipdf.pdf');



?>