
<style>
    .error{
        font-size: 1rem;
        color: red;
        width: 100% !important;
    }
</style>
<div class="pagetitle">
      <h1>Administrador</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Administrador</a></li>
          <li class="breadcrumb-item active">Crear Crisol</li>
        </ol>
      </nav>
</div>

<section class="section">
    <div class="row">
    <div class="card card-5">
<div class="card-heading">
<h2 class="title">Registro de nuevo crisol</h2>
</div>
<div class="card-body">
<form method="POST" class="crear-crisol-form" >
    <div class="row form-group mt-2">
        <div class="col-3">Nombre</div>
        <div class="col-9">
            <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">Peso</div>
        <div class="col-9">
            <input type="text" name="peso" placeholder="peso" class="form-control">
        </div>
    </div>


    <button class="btn btn-primary" type="submit" >Crear crisol</button>
</div>
</form>
</div>
</div>
    </div>
</section>

<script>
    $('.crear-crisol-form').submit(e =>{
        // console.log(e)
        e.preventDefault()


        if (!$('.crear-crisol-form').valid()) return 

        if ($('[name=peso]').val() < 7200 || $('[name=peso]').val() > 7500) {
            toastr.error('El peso debe estar entre 7200kg y 7500kg', 'Error')
            return
        }
        data = new FormData();
        data.append('accion', '5')
        data.append('nombre', $('[name=nombre]').val())
        data.append('peso', $('[name=peso]').val())


        $.ajax({
            url: 'ajax/crisol.ajax.php',
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(){
                console.log('loading')
            },
            success: function(respuesta) {
                console.log('done')
                console.log(respuesta)


                if(!respuesta){
                    toastr.error(respuesta[0].error_msg, 'Error')
                    console.log('here')
                }else{
                    toastr.success('Usuario Creado exitosamente', 'Exito')
                    CargarContenido('vistas/landing.php','content-wrapper')
                }

                
            },
            error: function(error){
                console.log(error)
                toastr.error(error, "Error")
            }
        })
    })


    $('.crear-crisol-form').validate({
        rules:{
            nombre: {
                required: true,
                // lettersonly: true,
                minlength: 3,  // <- here
                maxlength: 20,
            },
            peso: {
                digits: true,
                required: true
            }
        },
        messages:{
            nombre:{
                required: "Este campo es requerido",
                lettersonly: "Solo se puede ingresar letras",
                minlength: "Minimo 3 letras",
                maxlength: "Maximo 20 letras",
            },
            peso:{
                digits: "El peso solo puede tener digitos",
                required: "Este campo es obligatorio"
            }
        }
    })
</script>