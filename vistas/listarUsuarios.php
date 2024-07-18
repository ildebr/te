<div class="pagetitle">
      <h1>Administrador</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Administrador</a></li>
          <li class="breadcrumb-item active">Lisar usuario</li>
        </ol>
      </nav>
</div>


<section class="section">
<table id="listarUsuarios" class="table table-striped w-100 shadow border border-secondary">
    <thead class="bg-gray text-left">
        <th data-priority="2">nombre</th>
        <th data-priority="3">apellido</th>
        <th data-priority="4">cedula</th>
        <th data-priority="5">correo</th>
        <th data-priority="6" class="text-center">telefono</th>
        <th data-priority="7" class="text-center">Accion</th>
    </thead>
    <tbody class="small text-left"></tbody>
</table>
</section>


<script>
    $(document).ready(()=>{
        var data = new FormData()
        data.append('accion', 2)
        // var tableUsuarios = $('#listarUsuarios').DataTable({
        //     ajax: {
        //         url: 'ajax/usuario.ajax.php',
        //         dataSrc: "",
        //         data: 'accion=2',
        //         success: function(e){
        //             console.log(e)
        //         }
        //     },
        // })

        var tableUsuarios

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

                tableUsuarios = $('#listarUsuarios').DataTable({
                    data:respuesta,
                    columns: [
                        { data: 'nombre' },
                        { data: 'apellido' },
                        { data: 'cedula' },
                        { data: 'correo'},
                        { telefono: 'telefono'}
                    ],
                    language: {
                        "url": "vistas/assets/espano.json"
                    },
                    columnDefs:[
                        {
                        targets: 5,
                        sortable: false,
                        render: function(data, type, full, meta) {
                            console.log(full,'p')
                            return "<center>" +
                                        "<a href ='editarUsuario.php?id="+ full.id +"' class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Usuario'> " +
                                        "<i class='fas fa-pencil-alt fs-5'></i> " +
                                        "</a> " +
                                        "<span class='btnEliminarUsuario text-danger px-1'style='cursor:pointer;' data-usuario='" +full.id + "' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Usuario'> " +
                                        "<i class='fas fa-trash fs-5'> </i> " +
                                        "</span>" +
                                "</center>";
                        }
                    }
                    ]
                })


                
            },
            error: function(error){
                console.log(error)
                toastr.error('')
            }
        })
    })

    $('#listarUsuarios tbody').on('click', '.btnEliminarUsuario', function(e) {

        // var data = tableUsuarios.row($(this).parents('tr')).data();

        console.log(e.currentTarget)

        $('.currentDeleteSelected').removeClass('currentDeleteSelected')

        $(e.currentTarget).addClass('currentDeleteSelected')

        console.log($('.currentDeleteSelected').attr('data-usuario'))

        Swal.fire({
            title: 'Está seguro de eliminar a este usuario'+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            console.log(result)
            if (result.isConfirmed) {
                var data = new FormData()
                data.append('accion', 3)
                data.append('usuario', $('.currentDeleteSelected').attr('data-usuario'))
                $.ajax({
                    url: 'ajax/usuario.ajax.php',
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success : function (respuesta){
                        console.log(respuesta, 'a')

                        if(respuesta == true){
                            CargarContenido('vistas/landing.php','content-wrapper')
                            toastr.success('Usuario eliminado', 'Exito')
                        }else{
                            toastr.error('Hubo un error con tu solicitud', 'Error')
                        }

                        // if(respuesta.estado == true){
                        //     console.log('alos')
                        //     $("#crisol-estadoactual").text(respuesta.result.estado)

                        // }
                    }
                })
                
                
            }
        })
        })


        
</script>