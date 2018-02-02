@extends('templates.admin.default')
@section('title')
    Pedidos
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
            <h2>Pedidos</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Pedidos</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <?php if ($pedidos->count() > 0 ): ?>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pedidos </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="width:20%">Fecha</th>
                                            <th>Código de Pedido</th>
                                            <th style="width:15%">RUT cliente</th>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pedidos as $pedido): ?>
                                            <tr>
                                                <td><?=$pedido->fecha->formatLocalized('%d de %B de %Y a las %H:%M:%S')?></td>
                                                <td>{{ $pedido->codigo_pedido }}</td>
                                                <td class="rut" data-rut="{{ $pedido->cliente_rut }}">{{ $pedido->cliente_rut }}</td>
                                                <td><?=$pedido->cliente->nombre?></td>
                                                <td>{{ ucfirst($pedido->estado) }}</td>
                                                <td>
                                                    <div class="tooltip-demo btn-group">
                                                        <a href="{{ site_url('administrador/pedido/detalle/'.$pedido->id_pedido) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placament="top" title="Ver completo" ><i class="fa fa-search"></i></a>
                                                        @if ($pedido->estado == 'pedido')
                                                            <a href="{{ site_url('administrador/pedido/estado/ruta/'.$pedido->id_pedido) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placament="top" title="Enviar al destino" ><i class="fa fa-truck" ></i></a>
                                                        @elseif($pedido->estado == 'ruta')
                                                            <a href="{{ site_url('administrador/pedido/estado/entregado/'.$pedido->id_pedido) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placament="top" title="Mas como entregado"><i class="fa fa-check"></i></a>
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
                        <h3>No hay información de pedidos</h3>
                        <p>No se encuentran datos o información de clientes por favor utilice el boton Nuevo Cliente para ingresar uno nuevo.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
