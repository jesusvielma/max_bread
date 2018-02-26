@extends('templates.admin.default')
@section('title')
    Marcas
@endsection
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/dataTables/datatables.min.js') }}"></script>
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
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Marcas</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Marcas</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ site_url('administrador/marca/crear') }}" class="btn btn-primary">Nueva</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <?php if ($marcas->count()): ?>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Marcas </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="width:15%">Nombre</th>
                                            <th>Cantidad de Productos</th>
                                            <th>Logo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($marcas as $marca): ?>
                                            <tr>
                                                <td >{{ $marca->nombre }}</td>
                                                <td> {{ $marca->productos->count() }}</td>
                                                <td><img src="{{ base_url('assets/common/uploads/marca/'.$marca->logo) }}" alt="Logo {{ $marca->nombre }} " class="img-responsive" ></td>
                                                <td>
                                                    <div class="tooltip-demo btn-group">
                                                        <a href="{{ site_url('administrador/marca/editar/'.$marca->id_marca) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" data-toggle="tooltip" data-placament="top" title="Editar la información de {{ $marca->nombre }}"></i></a>
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
                        <h3>No hay marcas registradas</h3>
                        <p></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
