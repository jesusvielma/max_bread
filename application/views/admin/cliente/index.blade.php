@extends('templates.admin.default')
@section('title')
    Clientes
@endsection
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
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
                <a href="{{ site_url('administrador/cliente/crear') }}" class="btn btn-primary">Ingresar nuevo</a>
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
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
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
                                                            <a href="" class="btn btn-success btn-sm" title="{{ $cliente->usuario->correo }}" data-toggle="tooltip" data-placament="top"><i class="fa fa-user"></i></a>
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
