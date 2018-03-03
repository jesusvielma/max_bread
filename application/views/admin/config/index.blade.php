@extends('templates.admin.default')
@section('title')
    Configuración
@endsection
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/js/plugins/x-editable/css/bootstrap-editable.css')?>" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/x-editable/js/bootstrap-editable.js') }}"></script>
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
                order: [0,'desc']
            });
            $.fn.editable.defaults.mode = 'inline';
            $('.xeditable').editable();
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Configuración</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuraciones </h5>
                    </div>
                    
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($required_conf as $req): ?>
                                        @if ($req->required == 1)
                                            <tr>
                                                <td >{{ ucfirst(str_replace('_',' ',$req->nombre)) }}</td>
                                                <td> 
                                                    <a class="xeditable" href="#" id="{{ $req->nombre }}" data-type="{{ $req->nombre == 'descripcion' ? 'textarea' : 'text' }}" data-pk="{{ $req->id_config }}" data-url="{{ base_url('administrador/config/editar_requerido') }}" data-title="{{ ucfirst(str_replace('_',' ',$req->nombre)) }}">{{ $req->valor }}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Otras configuraciones</h5>
                    </div>
                    <div class="ibox-content">
                        <ul >
                            <li><strong>Secciones</strong>
                                <ul>
                                    @foreach ($section_conf as $conf)
                                        @php
                                        $section = explode('-',$conf->nombre);
                                        @endphp
                                            <li>{{ $section[1] }} 
                                            <span class="pull-right tooltip-demo" >
                                                <a class="" title="Editar" data-toggle="tooltip" data-placement="top"  href="{{ site_url('administrador/config/editar_section/'.$conf->id_config) }}" ><i class="fa fa-pencil"></i></a>
                                            </span></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
