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
    <title>Software</title>

    <!-- ============================================================================================================= -->
    <!-- REQUIRED CSS -->
    <!-- ============================================================================================================= -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">


    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- REQUIRED SCRIPTS -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->

    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <style>
        .invalid{
            border-color: red;
            outline: 1px solid red;
        }

        .valid{
            border-color: green;
            outline: 1px solid green;
        }
    </style>


</head>

<?php if (isset($_SESSION["nombre"])) : ?>

    <body class="hold-transition sidebar-mini layout-fixed">

        alo <?=$_GET['crisol']?>

        <div id="detalle_crisol">
            <h3 id="crisol-nombre"></h3>
            <p id="crisol-id"></p>
            <p>Estado actual: <span id="crisol-estadoactual"></span></p>
            <p>Peso actual <span id="crisol-pesoactual"></span></p>
            <!-- <select name="estado" id="estado">
                <option value="a">En almacen</option>
                <option value="p">En produccion</option>
                <option value="m">En mantenimiento</option>
            </select> -->


        </div>

        <!-- ETAPA 1 -->
        <div class="crisol-etapa" id="etapa_1" data-estado-etapa='disponible'>
            <h2>ESTE CRISOL SE ENCUENTRA DISPONIBLE PARA ASIGNAR A UNA PLANTA</h2>
            <button class="actualizar" data-etapa="disponible">ENVIADO A PLANTA</button>
        </div>

        <!-- ETAPA 2 -->
        <div class="crisol-etapa" id="etapa_2" data-estado-etapa='linea'>
            <h2>Si el crisol llego de planta puedes marcarlo como recibido</h2>
            <button class="actualizar" data-etapa="recibido">RECIBIDO</button>
        </div>



        <!-- ETAPA 3 -->
        <div class="crisol-etapa" id="etapa_3" data-estado-etapa='linea'>
            <h2>Registar el peso con el que llego el crisol y enviar a mantenimiento</h2>
            <p>Expresa el peso en kilos y fracciones con punto.</p>
            <!-- <form id="peso_recibido"> -->
                <input type="text" id="peso_linea" name="peso" placeholder="Peso Recibido">

                <button class="actualizar" data-etapa="mantenimiento">ENVIAR A MANTENIMIENTO</button>
            <!-- </form> -->
        </div>

        <!-- ETAPA 4 -->
        <div class="crisol-etapa" id="etapa_4" data-estado-etapa='linea'>
            <h2>Registrar el peso con el que llego de mantenimiento</h2>

            <h3>PESO INICIAL: <span id="peso_inicial"></span></h3>

            <h3>PESO PREVIO A MANTENIMIENTO (Llegada de linea): <span id="prev_mantenimiento"></span></h3>

            <h3>PESO ACTUAL POST MANTENIMIENTO (ACTUAL) : <span id="post_mantenimiento"></span></h3>

            <h3>DIFERENCIA/MATERIAL RECUPERADO: <span id="recuperado"></span></h3>

            <p>si el peso despues del mantenimiento es mayor al peso original del crisol + 500 kilos pasa mantenimiento mayor</p>
            <p>su es menor se libera</p>

            <h3 id="destino_crisol"></h3>

            <input type="text" id="peso_mantenimiento" placeholder="Peso a la llegada de mantenimiento" name="peso">
            <button class="actualizar" data-etapa="postmantenmiento">ENVIADO A PLANTA</button>
        </div>
        
        <!-- <?php var_dump($_SESSION) ?> -->

    </body>


<?php endif; ?>

<?php 
// echo $_SESSION['permisos'];
// var_dump($_SESSION);
// print_r($_SESSION["nombre"]);
?>
<!-- <script>location.replace("login.php")</script> -->

<script>
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
                $("#crisol-estadoactual").text(respuesta.estado)
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
                    $("#peso_inicial").text(respuesta.peso)
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
                    // window.location.replace('index.php')
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


    $('#etapa_4').on('keyup', 'input', function(e){
        console.log($('#peso_mantenimiento').val())
        // console.log(e.keyCode)
        // console.log(Number.isInteger(Number(String.fromCharCode(e.keyCode))))
        // console.log(String.fromCharCode(e.keyCode), 'a')

        var isBackspaceOrDelete = e.keyCode === 8 || e.keyCode === 46;

        if(isBackspaceOrDelete){
            e.preventDefault()
        }

        let peso = $('#peso_mantenimiento').val()

        if(esSoloNumeroYFraccion.test(peso) == false){
            toastr.error('Solo se permiten numeros enteros o fracciones con punto ej: 1000.5', 'Error')
            $("#peso_mantenimiento").removeClass('valid')
            $("#peso_mantenimiento").addClass('invalid')
            return
        }
        if(!Number($('#peso_mantenimiento').val())){
            toastr.error('Ingresa un numero valido', 'Error')
            $("#peso_mantenimiento").removeClass('valid')
            $("#peso_mantenimiento").addClass('invalid')
            return
        }
        $("#peso_mantenimiento").removeClass('invalid')
            $("#peso_mantenimiento").addClass('valid')
        $("#post_mantenimiento").text($('#peso_mantenimiento').val())
        calcularPesos()

    })

    $( "#peso_recibido" ).submit(e=>{
        e.preventDefault()
    })


    function calcularPesos(){
        $('#destino_crisol').text('')
        let recuperado = Number($("#prev_mantenimiento").text()) - Number($('#post_mantenimiento').text())
        $('#recuperado').text(recuperado)

        let diferencia_peso = Number($("#peso_inicial").text()) - Number($('#post_mantenimiento').text())
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