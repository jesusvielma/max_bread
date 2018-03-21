@extends('templates.admin.default')
@section('title')
    Configuración
@endsection
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/js/plugins/x-editable/css/bootstrap-editable.css')?>" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
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
            $('input[name=protocol]').change(function (){  
                console.log($(this).val())
                if($(this).val() == 'smtp'){
                    $('#smtpForm input').prop('disabled',false);
                    $('#smtpForm').show();
                }else{
                    $('#smtpForm input').prop('disabled',true);
                    $('#smtpForm').hide();
                }
            });
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Configuración</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
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
                                                    @if ($req->nombre != 'correo')
                                                        <a class="xeditable" href="#" id="{{ $req->nombre }}" data-type="{{ $req->nombre == 'descripcion' ? 'textarea' : 'text' }}" data-pk="{{ $req->id_config }}" data-url="{{ base_url('administrador/config/editar_requerido') }}" data-title="{{ ucfirst(str_replace('_',' ',$req->nombre)) }}">{{ $req->valor }}</a>
                                                    @elseif($req->nombre == 'correo')
                                                        @php
                                                            $correo = json_decode($req->valor);
                                                        @endphp                              
                                                        <a style="border-bottom: dashed 1px #0088cc" href="#" id="correoConf" data-toggle="modal" data-target="#correoModal" >El correo se enviá usando {{ $correo->protocol == 'smtp' ? ' el servidor de correos externo' : ' el servidor de correos interno'}}</a>
                                                        
                                                        <div class="modal inmodal fade" id="correoModal" tabindex="-1" role="dialog"  aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                        <h4 class="modal-title">Configuración de envío de correos</h4>
                                                                    </div>
                                                                    {{ form_open('administrador/config/editar_correo/'.$req->id_config) }}
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="correo">Correo del sitio</label>
                                                                            <input class="form-control input-sm" type="email" name="correo" id="correo" value="{{ $correo->correo }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Servidor</label>
                                                                            <br>
                                                                            <div class="radio radio-warning">
                                                                                <input type="radio" name="protocol" id="smtp" value="smtp" {{ $correo->protocol == 'smtp' ? 'checked' : ''}} >
                                                                                <label for="smtp"> Servidor externo </label>
                                                                            </div>
                                                                            <div class="radio radio-warning">
                                                                                <input type="radio" name="protocol" id="mail" value="mail" {{ $correo->protocol == 'mail' ? 'checked' : ''}}>
                                                                                <label for="mail"> Servidor interno </label>
                                                                            </div>
                                                                        </div>
                                                                        <div id="smtpForm" style="display:{{ $correo->protocol == 'smtp' ? 'block' : 'none' }}">
                                                                            <div class="form-group">
                                                                                <label for="smtp_user">Usuario SMTP</label>
                                                                                <input class="form-control input-sm" type="text" name="smtp_user" value="{{ $correo->protocol == 'smtp' ? $correo->smtp_user : ''}}" {{ $correo->protocol != 'smtp' ? 'disabled' : ''}} >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="smtp_pass">Clave SMTP</label>
                                                                                <input class="form-control input-sm" type="text" name="smtp_pass" value="{{ $correo->protocol == 'smtp' ? $correo->smtp_pass : ''}}" {{ $correo->protocol != 'smtp' ? 'disabled' : ''}} >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="smtp_port">Puerto SMTP</label>
                                                                                <input class="form-control input-sm" type="text" name="smtp_port" value="{{ $correo->protocol == 'smtp' ? $correo->smtp_port : ''}}" {{ $correo->protocol != 'smtp' ? 'disabled' : ''}} >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="smtp_host">Servidor SMTP</label>
                                                                                <input class="form-control input-sm" type="text" name="smtp_host" value="{{ $correo->protocol == 'smtp' ? $correo->smtp_host : ''}}" {{ $correo->protocol != 'smtp' ? 'disabled' : ''}} >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif 
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
