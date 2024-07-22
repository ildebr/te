<style>

    
    .crisoles_contenedor{
        display: grid;
        grid-template-columns:1fr 1fr 1fr 1fr;
        gap: .5rem;
    }

    @media (max-width: 631px){
        .crisoles_contenedor{
            grid-template-columns:1fr 1fr;
        }
    }

    @media (max-width: 980px){
        .crisoles_contenedor{
            grid-template-columns:1fr 1fr 1fr;
        }
    }

    .crisol_elemento img{
        max-width: 100px;
    display: block;
    margin: 0 auto;
    }

    .crisol_elemento{
        background: #dedede;
        border-radius: 5px;
        padding:.5rem;
        text-align:center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<div class="pagetitle">
      <h1>Inicio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        </ol>
      </nav>
</div>

<div class="helper">
    
    <h3 class='h3'>Listado de Crisoles</h3>

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
                    $('.crisoles_contenedor').append(`<div class="crisol_elemento">
                    <img src="vistas/assets/imagenes/crisol.png" />
                    <p class='h5'> <strong> ${resp.nombre_identificador} </strong> </p>
                    <p> Estado: ${establecerEstado(resp.estado)} </p>
                    <a class='btn btn-primary' href="detalleCrisol.php?crisol=${resp.id}">Detalle</a>
                    
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

    function establecerEstado(estado){
        let m = 'no definido'

        if(estado == 'd' ){
            m = 'Disponible'
        }
        if(estado == 'm' ){
            m = 'Mantenimiento'
        }
        if(estado == 'l' ){
            m = 'En linea'
        }
        if(estado == 'r' ){
            m = 'Recibido'
        }
        if(estado == 's' ){
            m = 'Mantenimiento mayor'
        }

        return m
    }

    

    function cargarExtra(extra){
        console.log(extra)
    }
</script>