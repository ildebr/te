<?php

require_once "controladores/usuario.controlador.php";
require_once "modelos/usuario.modelo.php";

session_start();
if (isset($_GET["cerrar_sesion"]) && $_GET["cerrar_sesion"] == 1) {

    session_destroy();

    echo '
            <script>
                window.location = "http://localhost/crisis%20existencial/3/";
            </script>        
        ';
}



?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto Tesis</title>

    <!-- ============================================================================================================= -->
    <!-- REQUIRED CSS -->
    <!-- ============================================================================================================= -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Jquery CSS -->
    <link rel="stylesheet" href="vistas/assets/plugins/jquery-ui/css/jquery-ui.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- ============================================================
    =ESTILOS PARA USO DE DATATABLES JS
    ===============================================================-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">



    <!-- Estilos personzalidos -->
    <link rel="stylesheet" href="vistas/assets/dist/css/plantilla.css">

    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- InputMask -->
    <script src="vistas/assets/plugins/moment/moment.min.js"></script>
    <script src="vistas/assets/plugins/inputmask/jquery.inputmask.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- jquery UI -->
    <script src="vistas/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

    <!-- Jquery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <!-- ============================================================
    =LIBRERIAS PARA USO DE DATATABLES JS
    ===============================================================-->
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


    <!-- ============================================================
    =LIBRERIAS PARA EXPORTAR A ARCHIVOS
    ===============================================================-->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

    <link rel="stylesheet" href="vistas/assets/dist/css/sb-admin.css">

    <style>
        .toast-title{font-weight:700}.toast-message{-ms-word-wrap:break-word;word-wrap:break-word}.toast-message a,.toast-message label{color:#FFF}.toast-message a:hover{color:#CCC;text-decoration:none}.toast-close-button{position:relative;right:-.3em;top:-.3em;float:right;font-size:20px;font-weight:700;color:#FFF;-webkit-text-shadow:0 1px 0 #fff;text-shadow:0 1px 0 #fff;opacity:.8;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=80);filter:alpha(opacity=80);line-height:1}.toast-close-button:focus,.toast-close-button:hover{color:#000;text-decoration:none;cursor:pointer;opacity:.4;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=40);filter:alpha(opacity=40)}.rtl .toast-close-button{left:-.3em;float:left;right:.3em}button.toast-close-button{padding:0;cursor:pointer;background:0 0;border:0;-webkit-appearance:none}.toast-top-center{top:0;right:0;width:100%}.toast-bottom-center{bottom:0;right:0;width:100%}.toast-top-full-width{top:0;right:0;width:100%}.toast-bottom-full-width{bottom:0;right:0;width:100%}.toast-top-left{top:12px;left:12px}.toast-top-right{top:12px;right:12px}.toast-bottom-right{right:12px;bottom:12px}.toast-bottom-left{bottom:12px;left:12px}#toast-container{position:fixed;z-index:999999;pointer-events:none}#toast-container *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}#toast-container>div{position:relative;pointer-events:auto;overflow:hidden;margin:0 0 6px;padding:15px 15px 15px 50px;width:300px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background-position:15px center;background-repeat:no-repeat;-moz-box-shadow:0 0 12px #999;-webkit-box-shadow:0 0 12px #999;box-shadow:0 0 12px #999;color:#FFF;opacity:.8;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=80);filter:alpha(opacity=80)}#toast-container>div.rtl{direction:rtl;padding:15px 50px 15px 15px;background-position:right 15px center}#toast-container>div:hover{-moz-box-shadow:0 0 12px #000;-webkit-box-shadow:0 0 12px #000;box-shadow:0 0 12px #000;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);filter:alpha(opacity=100);cursor:pointer}#toast-container>.toast-info{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=)!important}#toast-container>.toast-error{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=)!important}#toast-container>.toast-success{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==)!important}#toast-container>.toast-warning{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=)!important}#toast-container.toast-bottom-center>div,#toast-container.toast-top-center>div{width:300px;margin-left:auto;margin-right:auto}#toast-container.toast-bottom-full-width>div,#toast-container.toast-top-full-width>div{width:96%;margin-left:auto;margin-right:auto}.toast{background-color:#030303}.toast-success{background-color:#51A351}.toast-error{background-color:#BD362F}.toast-info{background-color:#2F96B4}.toast-warning{background-color:#F89406}.toast-progress{position:absolute;left:0;bottom:0;height:4px;background-color:#000;opacity:.4;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=40);filter:alpha(opacity=40)}@media all and (max-width:240px){#toast-container>div{padding:8px 8px 8px 50px;width:11em}#toast-container>div.rtl{padding:8px 50px 8px 8px}#toast-container .toast-close-button{right:-.2em;top:-.2em}#toast-container .rtl .toast-close-button{left:-.2em;right:.2em}}@media all and (min-width:241px) and (max-width:480px){#toast-container>div{padding:8px 8px 8px 50px;width:18em}#toast-container>div.rtl{padding:8px 50px 8px 8px}#toast-container .toast-close-button{right:-.2em;top:-.2em}#toast-container .rtl .toast-close-button{left:-.2em;right:.2em}}@media all and (min-width:481px) and (max-width:768px){#toast-container>div{padding:15px 15px 15px 50px;width:25em}#toast-container>div.rtl{padding:15px 50px 15px 15px}}
        .invalid{
            border-color: red;
            outline: 1px solid red;
        }

        .valid{
            border-color: green;
            outline: 1px solid green;
        }

        #crisol-nombre,#crisol-id{
            display:inline;
        }
    </style>


</head>

<?php if (isset($_SESSION["nombre"])) : ?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <div class="container">
            <a href="index.php">Volver a la pagina principal</a>
            </div>
        </nav>

        <div class="container">


        <h1 class="h3 mb-0 text-gray-800">Detalle crisol</h1>

        <div id="detalle_crisol">
            <div>Nombre identificador: <h3 id="crisol-nombre"></h3></div>
            <div>Numero identificador del crisol: <p id="crisol-id"></p></div>
            <p>Estado actual: <span id="crisol-estadoactual"></span></p>
            <p>Peso actual: <span id="crisol-pesoactual"></span>kg</p>
            <!-- <select name="estado" id="estado">
                <option value="a">En almacen</option>
                <option value="p">En produccion</option>
                <option value="m">En mantenimiento</option>
            </select> -->


        </div>

        <!-- ETAPA 1 -->
        <div class="crisol-etapa" id="etapa_1" data-estado-etapa='disponible'>
            <h2>ESTE CRISOL SE ENCUENTRA DISPONIBLE PARA ASIGNAR A UNA LINEA DE PRODUCCION</h2>
            <button class="actualizar btn btn-primary" data-etapa="disponible">ENVIADO A LINEA DE PRODUCCION</button>
        </div>

        <!-- ETAPA 2 -->
        <div class="crisol-etapa" id="etapa_2" data-estado-etapa='linea'>
            <h2>Si el crisol llego de linea de produccion puedes marcarlo como recibido</h2>
            <button class="actualizar btn btn-primary" data-etapa="recibido">RECIBIDO</button>
        </div>



        <!-- ETAPA 3 -->
        <div class="crisol-etapa" id="etapa_3" data-estado-etapa='linea'>
            <h2>Registar el peso con el que llego el crisol y enviar a mantenimiento</h2>
            <p>Expresa el peso en kilos y fracciones con punto.</p>
            <!-- <form id="peso_recibido"> -->
                <input type="text" id="peso_linea" name="peso" placeholder="Peso Recibido">

                <button class="actualizar btn btn-primary" data-etapa="mantenimiento">ENVIAR A MANTENIMIENTO</button>
            <!-- </form> -->
        </div>

        <!-- ETAPA 4 -->
        <div class="crisol-etapa" id="etapa_4" data-estado-etapa='linea'>
            <h2>Registrar el peso con el que llego de mantenimiento</h2>

            <h3>PESO INICIAL: <span class="peso_inicial"></span></h3>

            <h3>PESO PREVIO A MANTENIMIENTO (Llegada de linea): <span id="prev_mantenimiento"></span></h3>

            <h3>PESO ACTUAL POST MANTENIMIENTO (ACTUAL) : <span id="post_mantenimiento"></span></h3>

            <h3>DIFERENCIA/MATERIAL RECUPERADO: <span id="recuperado"></span></h3>

            <p>si el peso despues del mantenimiento es mayor al peso original del crisol + 500 kilos pasa mantenimiento mayor</p>
            <p>su es menor se libera</p>

            <h3 id="destino_crisol"></h3>

            <input type="text" class="peso_mantenimiento" placeholder="Peso a la llegada de mantenimiento" name="peso">
            <button class="actualizar btn btn-primary" data-etapa="postmantenmiento">CONFIRMAR</button>
        </div>
        

        <!-- Mantenimiento superior -->
        <div class="crisol-etapa" id="etapa_5" data-estado-etapa='ms'>
            <h2>Registrar el peso con el que llego de mantenimiento MAYOR</h2>

            <h3>PESO INICIAL: <span class="peso_inicial"></span></h3>

            <h3>PESO PREVIO A MANTENIMIENTO (Llegada de linea): <span id="prev_mantenimiento"></span></h3>

            <h3>PESO ACTUAL POST MANTENIMIENTO MAYOR (ACTUAL) : <span id="post_mantenimiento"></span></h3>

            <h3>DIFERENCIA/MATERIAL RECUPERADO: <span id="recuperado"></span></h3>

            <p>si el peso despues del mantenimiento es mayor al peso original del crisol + 500 kilos pasa mantenimiento mayor</p>
            <p>su es menor se libera</p>

            <h3 id="destino_crisol"></h3>

            <input type="text" class="peso_mantenimiento" placeholder="Peso a la llegada de mantenimiento" name="peso">
            <button class="actualizar btn btn-primary" data-etapa="postmantenmiento">CONFIRMAR</button>
        </div>

        
        <!-- <?php var_dump($_SESSION) ?> -->
        </div>

    </body>


<?php endif; ?>

<?php 
// echo $_SESSION['permisos'];
// var_dump($_SESSION);
// print_r($_SESSION["nombre"]);
?>
<!-- <script>location.replace("login.php")</script> -->

<script>

    function imprimirEstado(estado){
        if(estado == 'm'){
            return 'Mantenimiento'
        }
        if(estado == 'd'){
            return 'Disponible'
        }
        if(estado == 'l'){
            return 'En linea'
        }
        if(estado == 's'){
            return 'Mantenimiento mayor'
        }
        if(estado == 'r'){
            return 'Recibido'
        }
    }
    $(document).ready(function(){

        $('.crisol-etapa').hide()


        var data = new FormData();
        data.append('accion', 2)
        data.append('id', <?=$_GET['crisol']?>)
        data.append('usuario', <?=$_SESSION['id']?>)
        console.log('alo')
        $.ajax({
            url: 'ajax/crisol.ajax.php',
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success : function (respuesta){
                console.log(respuesta, 'here')
                $("#crisol-nombre").text(respuesta.nombre_identificador)
                $("#crisol-id").text(respuesta.id)
                $("#crisol-estadoactual").text(imprimirEstado(respuesta.estado))
                $("#crisol-pesoactual").text(respuesta.peso)

                if(respuesta.id_proceso_actual ==  0){
                    $("#etapa_1").show()
                    console.log('h')
                }else if (respuesta.id_proceso_actual != 0 && respuesta.estado == 'l'){
                    $("#etapa_2").show()
                    console.log('2')
                }else if (respuesta.id_proceso_actual != 0 && respuesta.estado == 'r'){
                    $("#etapa_3").show()
                    console.log('2')
                }else if (respuesta.id_proceso_actual != 0 && respuesta.estado == 'm'){
                    $("#etapa_4").show()
                    $(".peso_inicial").text(respuesta.peso)
                    $("#prev_mantenimiento").text(respuesta.peso_llegada_linea)

                }else if (respuesta.id_proceso_actual != 0 && respuesta.estado == 's'){
                    $("#etapa_5").show()
                    $(".peso_inicial").text(respuesta.peso_inicial)
                    console.log(respuesta.peso_inicial, 'a;')
                    $("#prev_mantenimiento").text(respuesta.peso_llegada_linea)

                }


            }
        })
    })

    let esSoloNumeroYFraccion = /^(0|[1-9]\d*)(\.\d+)?$/

    $('body').on('click', 'button.actualizar', function(e){
        var etapa = e.target.getAttribute('data-etapa')
        
        var etapa_post
        var data = new FormData();
        data.append('accion', 3)
        data.append('id', <?=$_GET['crisol']?>)
        data.append('usuario', <?=$_SESSION['id']?>)
        

        
        
        if(etapa == 'mantenimiento'){
            if($('#peso_linea').val() == ''){
                toastr.error('El input no puede estar vacio', 'Error')
                return
            }

            let peso = $('#peso_linea').val()

            if(esSoloNumeroYFraccion.test(peso) == false){
                toastr.error('Solo se permiten numeros enteros o fracciones con punto ej: 1000.5', 'Error')
                return
            }


            data.append('peso', $('#peso_linea').val())
            console.log($('#peso_linea').val(), 'all')

            // data.append('peso_linea', peso)


        }else{
            data.append('peso_linea', 0)
        }

        

        $.ajax({
            url: 'ajax/crisol.ajax.php',
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success : function (respuesta){
                console.log(respuesta, 'a')

                if(respuesta.estado == true){
                    window.location.replace('index.php')
                }else{
                    toastr.error('Hubo un error con tu solicitud', 'Error')
                }

                // if(respuesta.estado == true){
                //     console.log('alos')
                //     $("#crisol-estadoactual").text(respuesta.result.estado)

                // }
            }
        })



        console.log(etapa, etapa_post)
        
    })


    function imprimirCalculoDePeso(e){
        console.log($('.peso_mantenimiento').val())
        // console.log(e.keyCode)
        // console.log(Number.isInteger(Number(String.fromCharCode(e.keyCode))))
        // console.log(String.fromCharCode(e.keyCode), 'a')

        var isBackspaceOrDelete = e.keyCode === 8 || e.keyCode === 46;

        if(isBackspaceOrDelete){
            e.preventDefault()
        }

        let peso = $('#etapa_5 .peso_mantenimiento').val()

        if(esSoloNumeroYFraccion.test(peso) == false){
            toastr.error('Solo se permiten numeros enteros o fracciones con punto ej: 1000.5', 'Error')
            $("#etapa_5 .peso_mantenimiento").removeClass('valid')
            $("#etapa_5 .peso_mantenimiento").addClass('invalid')
            return
        }
        if(!Number($('#etapa_5 .peso_mantenimiento').val())){
            toastr.error('Ingresa un numero valido', 'Error')
            $("#etapa_5 .peso_mantenimiento").removeClass('valid')
            $("#etapa_5 .peso_mantenimiento").addClass('invalid')
            return
        }
        $("#etapa_5 .peso_mantenimiento").removeClass('invalid')
            $("#etapa_5 .peso_mantenimiento").addClass('valid')
        $("#post_mantenimiento").text($('.peso_mantenimiento').val())
        calcularPesos()
    }


    $('#etapa_4').on('keyup', 'input', imprimirCalculoDePeso)
    $('#etapa_5').on('keyup', 'input', imprimirCalculoDePeso)

    $( "#peso_recibido" ).submit(e=>{
        e.preventDefault()
    })


    function calcularPesos(){
        $('#destino_crisol').text('')
        let recuperado = Number($("#prev_mantenimiento").text()) - Number($('#post_mantenimiento').text())
        $('#recuperado').text(recuperado)

        let diferencia_peso = Number($(".peso_inicial").text()) - Number($('#post_mantenimiento').text())
        console.log(diferencia_peso)
        if(diferencia_peso <= 0 && Math.abs(diferencia_peso) >= 500){
            $('#destino_crisol').text('El crisol se debe dirigir a mantenimiento')
        }else if (diferencia_peso > 0){
            $('#destino_crisol').text('El crisol se debe dirigir a mantenimiento mayor')
        }else{
            $('#destino_crisol').text('El crisol quedara disponible')
        }
    }

    // $( "#peso_recibido" ).validate({
    //     rules: {
    //         peso: {
    //             required: true,
    //             number: true
    //         }
    //     }
    //     });
</script>

</html>