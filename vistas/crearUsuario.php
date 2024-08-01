
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
          <li class="breadcrumb-item active">Crear usuario</li>
        </ol>
      </nav>
</div>

<section class="section">
    <div class="row">
    <div class="card card-5">
<div class="card-heading">
<h2 class="title">Registro de nuevo usuario</h2>
</div>
<div class="card-body">
<form method="POST" class="registrar-usuario-form" >
    <div class="row form-group mt-2">
        <div class="col-3">Nombre</div>
        <div class="col-9">
            <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">Apellido</div>
        <div class="col-9">
            <input type="text" name="apellido" placeholder="apellido" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">cedula</div>
        <div class="col-9">
            <input type="number" name="cedula" placeholder="cedula" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">correo</div>
        <div class="col-9">
            <input type="email" name="correo" placeholder="correo" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">telefono</div>
        <div class="col-9">
            <input type="text" name="telefono" placeholder="telefono" class="form-control">
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">turno</div>
        <div class="col-9">
            <!-- <input type="text" name="turno" placeholder="turno" class="form-control"> -->
            <select class='form-control' name="turno" id="turno">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">rol</div>
        <div class="col-9">
            <!-- <input type="text" name="rol" placeholder="rol"> -->
            <select class='form-control' name="rol" id="rol">
                <option value="administrador">Administrador</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
    </div>

    <div class="row form-group mt-2">
        <div class="col-3">contrasena</div>
        <div class="col-9">
            <input type="text" name="contrasena" placeholder="contrasena" class='form-control'>
        </div>
    </div>

    <button class="btn btn-primary" type="submit" >Registrar usuario</button>
</div>
</form>
</div>
</div>
    </div>
</section>


<script>
    $('.registrar-usuario-form').submit(e =>{
        console.log('here')
        e.preventDefault()

        // si el formulario no es valido no se pasa la informacion
        if(!$('.registrar-usuario-form').valid()) return
        data = new FormData();
        data.append('accion', '1')
        data.append('nombre', $('[name=nombre]').val())
        data.append('apellido', $('[name=apellido]').val())
        data.append('cedula', $('[name=cedula]').val())
        data.append('correo', $('[name=correo]').val())
        data.append('telefono', $('[name=telefono]').val())
        data.append('turno', $('[name=turno]').val())
        data.append('rol', $('[name=rol]').val())
        data.append('contrasena', $('[name=contrasena]').val())

        // console.log(data)
        // for (var pair of data.entries()) {
        // console.log(pair[0]+ ', ' + pair[1]);
        // }

        $.ajax({
            url: 'ajax/usuario.ajax.php',
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


                if(respuesta[0].error == true){
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


    $('.registrar-usuario-form').validate({
        rules:{
            nombre: {
                required: true,
                lettersonly: true,
                minlength: 3,  // <- here
                maxlength: 20,
            },
            apellido: {
                required: true,
                lettersonly: true,
                minlength: 3,  // <- here
                maxlength: 20,
            },
            cedula:{
                digits: true,
                minlength:7,
                maxlength: 10,
                required: true
            },
            correo:{
                email: true,
                required: true
            },
            telefono:{
                digits: true,
                minlength:7,
                maxlength: 11
            },
            contrasena:{
                required: true,

            }
        },
        messages:{
            nombre:{
                required: "Este campo es requerido",
                lettersonly: "Solo se puede ingresar letras",
                minlength: "Minimo 3 letras",
                maxlength: "Maximo 20 letras",
            },
            apellido:{
                required: "Este campo es requerido",
                lettersonly: "Solo se puede ingresar letras",
                minlength: "Minimo 3 letras",
                maxlength: "Maximo 20 letras",
            },
            cedula:{
                digits: "Solo se permiten numeros",
                minlength: "Minimo 7 numeros",
                maxlength: "Maximo 10 numeros",
                required: "Este campo es obligatorio"
            },
            correo:{
                email: "Ingresa un email valido",
                required: "Este campo es obligatorio"
            },
            telefono:{
                digits: "Solo se permiten numeros",
                minlength: "Minimo 7 numeros",
                maxlength: "Maximo 11 numeros"
            },
            contrasena:{
                required: "Este campo es obligatorio"
            }
        }
    })
</script>