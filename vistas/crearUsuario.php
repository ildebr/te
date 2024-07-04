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
    <div class="row">
        <div class="col-3">Nombre</div>
        <div class="col-9">
            <input type="text" name="nombre" placeholder="nombre">
        </div>
    </div>

    <div class="row">
        <div class="col-3">Apellido</div>
        <div class="col-9">
            <input type="text" name="apellido" placeholder="apellido">
        </div>
    </div>

    <div class="row">
        <div class="col-3">cedula</div>
        <div class="col-9">
            <input type="number" name="cedula" placeholder="cedula">
        </div>
    </div>

    <div class="row">
        <div class="col-3">correo</div>
        <div class="col-9">
            <input type="email" name="correo" placeholder="correo">
        </div>
    </div>

    <div class="row">
        <div class="col-3">telefono</div>
        <div class="col-9">
            <input type="text" name="telefono" placeholder="telefono">
        </div>
    </div>

    <div class="row">
        <div class="col-3">turno</div>
        <div class="col-9">
            <input type="text" name="turno" placeholder="turno">
        </div>
    </div>

    <div class="row">
        <div class="col-3">rol</div>
        <div class="col-9">
            <input type="text" name="rol" placeholder="rol">
        </div>
    </div>

    <div class="row">
        <div class="col-3">contrasena</div>
        <div class="col-9">
            <input type="text" name="contrasena" placeholder="contrasena">
        </div>
    </div>

    <button class="" type="submit" >Register</button>
</div>
</form>
</div>
</div>
    </div>
</sectioon>


<script>
    $('.registrar-usuario-form').submit(e =>{
        console.log('here')
        e.preventDefault()
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

        console.log(data)
        for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
        }

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
                }else{
                    toastr.success('Usuario Creado exitosamente', 'Exito')
                    CargarContenido('vistas/landing.php','content-wrapper')
                }

                
            },
            error: function(error){
                console.log(error)
                toastr.error('')
            }
        })
    })
</script>