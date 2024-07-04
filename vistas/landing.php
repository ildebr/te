<style>
    .crisoles_contenedor{
        display: grid;
        grid-template-columns:1fr 1fr 1fr 1fr;
    }
</style>

<div class="pagetitle">
      <h1>Inicio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
        </ol>
      </nav>
</div>

<div class="helper">
    

    <div class="crisoles_contenedor">

    </div>

    

    <div class="extra"></div>
</div>



<script>
    $(document).ready(function (){
        console.log('a')

        var data = new FormData();
        data.append('accion', 1)
        $.ajax({
            url: 'ajax/crisol.ajax.php',
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success : function (respuesta){
                console.log(respuesta)
                console.log('here')

                respuesta.forEach((resp)=>{
                    $('.crisoles_contenedor').append(`<div>
                    ${resp.nombre_identificador} estado:${resp.estado}
                    <a href="detalleCrisol.php?crisol=${resp.id}">Detalle</a>
                    
                    </div>`)
                })

                // <a href="vistas/actualizarCrisol.php?crisol=${resp.id}" id="manual-ajax">Dete</a>
                // <button onclick="cargarExtra({"id":${resp.id}})" >alo</button>
            }
        })

        // $('#manual-ajax').click(function(event) {
        //     event.preventDefault();
        //     this.blur(); // Manually remove focus from clicked link.
        //     $.get(this.href, function(html) {
        //         $(html).appendTo('body').modal();
        //     });
        // });

        // $('.helper').on('click', '#manual-ajax', function(){
        //     event.preventDefault();
        //     console.log('here')
        //     this.blur(); // Manually remove focus from clicked link.
        //     $.get(this.href, function(html) {
        //         $(html).appendTo('body').modal();
        //     });
        // })
    })

    

    function cargarExtra(extra){
        console.log(extra)
    }
</script>