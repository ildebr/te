<div class="pagetitle">
      <h1>Reportes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Reportes</a></li>
          <li class="breadcrumb-item active">Reportes</li>
        </ol>
      </nav>
</div>


<section class="section">
<table id="listarProcesos" class="table table-striped w-100 shadow border border-secondary">
    <thead class="bg-gray text-left">
        <th data-priority="2">Crisol</th>
        <th data-priority="3">Fecha Inicio</th>
        <th data-priority="4">Fecha Fin</th>
        <th data-priority="5">Estado</th>
        <th data-priority="6" class="text-center">Peso Inicial</th>
        <th data-priority="7" class="text-center">Accion</th>
    </thead>
    <tbody class="small text-left"></tbody>
</table>
</section>

<script>
    $(document).ready((e) => {

        var data = new FormData()
        data.append('accion', 1)
        var tableReporte

        $.ajax({
            url: 'ajax/proceso.ajax.php',
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

                tableUsuarios = $('#listarProcesos').DataTable({
                    data:respuesta,
                    columns: [
                        { data: 'crisol_id' },
                        { data: 'fecha_inicio' },
                        { data: 'fecha_fin' },
                        { data: 'estado'},
                        { data: 'peso_inicial'}
                    ],
                    language: {
                        "url": "vistas/assets/espano.json"
                    },
                    columnDefs:[
                        {
                            targets: 5,
                            sortable: false,
                            render: function(data, type, full, meta) {
                                return "<center>" +
                                            "<span class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Usuario'> " +
                                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                                            "</span> " +
                                            "<span class='btnEliminarUsuario text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Usuario'> " +
                                            "<i class='fas fa-trash fs-5'> </i> " +
                                            "</span>" +
                                    "</center>";
                            },
                            
                        },
                        { searchPanes: {show: true}, targets: [0]}
                        ,
                        {
                            searchPanes: {
                                options: [
                                    {
                                        label: 'under 20',     
                                        value: function (rowData, rowIdx) {
                                            return rowData[4] < 20;
                                        }
                                    }
                                ]
                            }
                        }
                    ],
                    layout: {
                        top1: {
                            searchPanes: {
                                viewTotal: true,
                                columns: [0]
                            }
                        }
                    },
                })
            },
            error: function(error){
                console.log(error)
                toastr.error('')
            }
        })
    })
</script>