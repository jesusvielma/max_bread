@extends('templates.admin.default')
@section('title')
    Clientes
@endsection
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ base_url('assets/backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <!-- Toastr script -->
    <script src="{{ base_url('assets/backend/js/plugins/toastr/toastr.min.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
				language: {
					url : '{{ base_url('assets/backend/js/plugins/dataTables/i18n/es.json') }}',
				},
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],

            });
            var rut ;
            $('.rut').each(function () {
                rut = $(this).text();
                if($.validateRut(rut))
                $(this).text($.formatRut(rut));
                else {
                    $(this).parent().addClass('danger');
                }
            });
            @if ($this->session->flashdata('clave'))
                toastr.options = {
                    "preventDuplicates": true,
                    "positionClass": "toast-top-center",
                };
                toastr.success('{{ $this->session->flashdata("clave")["msg"] }}','Operación exitosa')
            @endif
        });

    </script>
    <script>

    $(document).ready(function (){

        // Instance the tour
        var tour = new Tour({
            template: "<div class='popover tour'> <div class='arrow'></div><h3 class='popover-title'></h3> <div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default'data-role='prev'> <i class='fa fa-angle-left'></i> Ant</button><span data-role='separator'>|</span><button class='btn btn-default' data-role='next'>Sig <i class='fa fa-angle-right'></i> </button><button class='btn btn-default' data-role='end'>Fin</button></div></div>",
            steps: [{

                    element: "#IngresarCliente",
                    title: "Ingresar Cliente",
                    content: "Presiona este botón para ir al formulario de registro de clientes",
                    placement: "left",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#tablaCliente",
                    title: "Listado de clientes",
                    content: "Este es un listado de todos tus clientes, se muestran 10 clientes por defecto pero puede modificarlo.",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#DataTables_Table_0_length",
                    title: "Listado de Clientes",
                    content: "Aquí puede cambiar la cantidad de resultados que ves.",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#accionesTabla",
                    title: "Acciones sobre tus clientes",
                    content: "Aqui encuentras las acciones como editar la información del cliente.",
                    placement: "right"
                },
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){
            tour.restart();

            // Start the tour
            // tour.start();
        })

    });

</script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Clientes</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ site_url('administrador/cliente/crear') }}" class="btn btn-primary" id="IngresarCliente">Ingresar nuevo</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <?php if ($clientes->count()): ?>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Clientes </h5>
                        </div>
                        <div class="ibox-content" id="tablaCliente">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Tipo</th>
                                            <th id="accionesTabla">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <tr>
                                                <td class="rut" data-rut="{{ $cliente->rut }}">{{ $cliente->rut }}</td>
                                                <td><?=$cliente->nombre?></td>
                                                <td><?=$cliente->direccion?></td>
                                                <td><?=$cliente->tipo?></td>
                                                <td>
                                                    <div class="tooltip-demo btn-group">
                                                        <a href="{{ site_url('administrador/cliente/editar/'.$cliente->rut) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" data-toggle="tooltip" data-placament="top" title="Editar la información de {{ $cliente->nombre }}"></i></a>
                                                        @if ($cliente->id_usuario)
                                                            <!--<a href="{{ site_url('administrador/perfil/reseteo/'.$cliente->usuario->id_usuario) }}" class="btn btn-success btn-sm" title="Resetear clave {{ $cliente->usuario->correo }}" data-toggle="tooltip" data-placament="top"><i class="fa fa-key"></i></a>-->
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="alert alert-info">
                        <h3>No hay información de clientes</h3>
                        <p>No se encuentran datos o información de clientes por favor utilice el boton Nuevo Cliente para ingresar uno nuevo.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
