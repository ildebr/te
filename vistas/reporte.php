<style>
    .areadebusqueda p {
        display: inline-block;
        margin-bottom: 0;
    }

    .areadebusqueda{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        gap: 10px;
    }
</style>
<main id="area-reporte">
<div class="pagetitle">
      <h1>Reportes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Reportes</a></li>
          <li class="breadcrumb-item active">Reportes</li>
        </ol>
      </nav>
</div>

<!-- <div class="areadebusqueda">
    <span>Crisol</span>
    <span >Fecha Inicio</span>
    <span >Fecha Fin</span>
    <span >Estado</span>
    <span  >Peso Inicial</span>
    <span  >Peso Final</span>
    <span  >Accion</span>
</div> -->

<form method="POST" action="vistas/generarReportePDF.php" id="filtros-reporte">
<div class="areadebusqueda">
    <span>
        <p>Crisol Id</p>
        <input type="text" placeholder="Crisol" value='' name="crisol" class="form-control" data-index="0" fdprocessedid="rl8gby"></span>
    <span>
        <p>Fecha Inicio Min</p>
        <input type="date" class="form-control" value='' placeholder="Fecha Inicio Min" name='fecha_inicio_min' data-index="1" fdprocessedid="70q9de"></span>
    <span>
        <p>Fecha Inicio Max</p>
        <input type="date" class="form-control" value='' placeholder="Fecha Inicio Max" name='fecha_inicio_max' data-index="1" fdprocessedid="70q9de"></span>
    <span>
        <p>Fecha Final Min</p>
        <input type="date" class="form-control" value='' placeholder="Fecha Fin Min" name="fecha_fin_min" data-index="2" fdprocessedid="qdy0za"></span>
    <span>
        <p>Fecha Final Max</p>
        <input type="date" class="form-control" value='' placeholder="Fecha Fin Max" name="fecha_fin_max" data-index="2" fdprocessedid="qdy0za"></span>
    <span>
        <p>Estado</p>
        <input type="text" class="form-control" name='estado' value='' placeholder="Estado" data-index="3" fdprocessedid="hfh82m"></span>
    <span>
        <p>Peso Inicial Min</p>
        <input type="text" class="form-control" value='' placeholder="Peso Inicial Min" name="peso_inicial_min" data-index="4" fdprocessedid="ce91r7"></span>
    <span>
        <p>Peso Inicial Max</p>
        <input type="text" class="form-control" value='' placeholder="Peso Inicial Max" name="peso_inicial_max" data-index="4" fdprocessedid="ce91r7"></span>
    <span>
        <p>Peso Final Min</p>
        <input type="text" class="form-control" value='' placeholder="Peso Final Min" name="peso_final_min" data-index="5" fdprocessedid="o1ao5"></span>
    <span>
        <p>Peso Final Max</p>
        <input type="text" class="form-control" value='' placeholder="Peso Final Max" name="peso_final_max" data-index="5" fdprocessedid="o1ao5"></span>
</div>
<button id='crear-reporte' class='btn btn-primary' >Generar PDF</button>
<button id='filtrar-proceso-btn' class='btn btn-primary' >Filtrar</button>
</form>




<section class="section">
<table id="listarProcesos" class="table table-striped w-100 shadow border border-secondary">
    <thead class="bg-gray text-left">
        <tr>
        <th data-priority="2">Crisol</th>
        <th data-priority="3">Fecha Inicio</th>
        <th data-priority="4">Fecha Fin</th>
        <th data-priority="5">Estado</th>
        <th data-priority="6" class="text-center">Peso Inicial</th>
        <th data-priority="7" class="text-center">Peso Final</th>
        <!-- <th data-priority="8" class="text-center">Accion</th> -->
        </tr>
    </thead>
    <tbody class="small text-left" id="tabla-reporte"></tbody>
</table>
</section>
</main>

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

                tableReporte = $('#listarProcesos').DataTable({
                    data:respuesta,
                    columns: [
                        { data: 'crisol_id' },
                        { data: 'fecha_inicio' },
                        { data: 'fecha_fin' },
                        { data: 'estado'},
                        { data: 'peso_inicial'},
                        { data: 'peso_final'}
                    ],
                    language: {
                        "url": "vistas/assets/espano.json"
                    },
                    columnDefs:[
                        // {
                        //     targets: 6,
                        //     sortable: false,
                        //     render: function(data, type, full, meta) {
                        //         return "<center>" +
                        //                     "<span class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Usuario'> " +
                        //                     "<i class='fas fa-pencil-alt fs-5'></i> " +
                        //                     "</span> " +
                        //                     "<span class='btnEliminarUsuario text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Usuario'> " +
                        //                     "<i class='fas fa-trash fs-5'> </i> " +
                        //                     "</span>" +
                        //             "</center>";
                        //     },
                            
                        // },
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


        // $('.areadebusqueda span').each(function (i) {
        //     console.log($(this).index())
        //     var title = $('#listarProcesos thead th')
        //         .eq($(this).index())
        //         .text();
        //     console.log(title)
        //     $(this).html(
        //         '<input type="text" placeholder="' + title + '" data-index="' + i + '" />'
        //     );
        // });


        // $('#area-reporte').on('keyup', '.areadebusqueda input', function () {
        //     tableReporte
        //         .column($(this).data('index'))
        //         .search(this.value)
        //         .draw();
        // });



        $('#filtrar-proceso-btn').click((e)=>{
            e.preventDefault()
            todosvacio = true
            inputsele = $('.areadebusqueda input')
            inputsele.each((idx, ele) =>{
                if($(ele).val() != '') todosvacio = false
            })

            if(todosvacio){
                toastr.error('Debes llenar al menos un campo para filtrar', 'Error')
                return
            }

            e.preventDefault()
            var datan = new FormData()
            datan.append('accion', 2)
            datan.append('id', $("input[name='crisol']").val())
            datan.append('fecha_inicio_min', $("input[name='fecha_inicio_min']").val())
            datan.append('fecha_inicio_max', $("input[name='fecha_inicio_max']").val())
            datan.append('fecha_fin_min', $("input[name='fecha_fin_min']").val())
            datan.append('fecha_fin_max', $("input[name='fecha_fin_max']").val())
            datan.append('estado', $("input[name='estado']").val())
            datan.append('peso_inicial_min', $("input[name='peso_inicial_min']").val())
            datan.append('peso_inicial_max', $("input[name='peso_inicial_max']").val())
            datan.append('peso_final_min', $("input[name='peso_final_min']").val())
            datan.append('peso_final_max', $("input[name='peso_final_max']").val())
            $.ajax({
                url: 'ajax/proceso.ajax.php',
                type: "POST",
                data: datan,
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    console.log('loading')
                },
                success: function (respuesta){
                    console.log(respuesta)
                    $('#listarProcesos').dataTable().fnClearTable();
                    if(respuesta.length != 0) $('#listarProcesos').dataTable().fnAddData(respuesta);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                }
            })
        })
    })

    $('#filtros-reporte').submit(e=>{
        todosvacio = true
        inputsele = $('.areadebusqueda input')
        inputsele.each((idx, ele) =>{
            if($(ele).val() != '') todosvacio = false
        })

        if(todosvacio){
            toastr.error('Debes llenar al menos un campo para crear el pdf', 'Error')
            e.preventDefault()
            return
        }
        
    })
</script>