@extends('templates/admin/default')
@section('title')
    Editar información de la empresa
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ base_url('assets/common/js/tinymce/tinymce.min.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                radioClass: 'iradio_square-green',
            });
            $('#sobre').on('ifChecked', function(){
                $('#sobre_camp').prependTo('#cosas');
                $('#descripcion').prop('disabled',false);
                $('#telef > input').prop('disabled',true);
                $('#correo_camp > input').prop('disabled',true);
                $('#telef').hide();
                $('#mapa_camp').hide();
                $('#correo_camp').hide();
                    tinymce.init({
                	selector: 'textarea',
                	language: 'es',
                    height: 200,
                	toolbar1: 'undo redo | preview | styleselect | bold italic forecolor backcolor ',
                    toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist | table | responsivefilemanager link image ',
                	plugins: [
                      'advlist autolink link lists charmap preview hr anchor pagebreak',
                      'wordcount visualblocks visualchars insertdatetime media nonbreaking',
                      'save table paste image responsivefilemanager table contextmenu imgmap',
                      'colorpicker textcolor'
                    ],
                	image_class_list: [
                		{title: 'Predefinida', value: 'img-responsive'},
                		{title: 'Retrato', value: 'img-responsive img-thumbnail'},
                		{title: 'Puntas redondas', value: 'img-responsive img-rounded'},
                		{title: 'Forma circular', value: 'img-responsive img-circle'}
                	],
                	/*content_css: [
                		'<?=base_url("assets/frontend/css/tinymce.style.css")?>'
                	],*/
                	menubar: false,
                  	relative_urls :false,
                  	//allow_script_urls: true,
                  	external_filemanager_path:"<?=base_url('assets/common/js/filemanager/')?>",
                  	filemanager_title:"Manejador de archivos" ,
                  	external_plugins: { "filemanager" : "<?=base_url('assets/common/js/filemanager/plugin.min.js')?>"},
                  	//extended_valid_elements : "img[usemap|class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],map[id|name],area[shape|alt|coords|href|target]",
            	});
                $('#sobre_camp').fadeIn();
			});
            $('#telefono').on('ifChecked', function(){
                $('#telef').prependTo('#cosas');
                $('#descripcion').prop('disabled',true);
                $('#telef > input').prop('disabled',false);
                $('#correo_camp > input').prop('disabled',true);
                $('#sobre_camp').hide();
                $('#correo_camp').hide();
                $('#mapa_camp').hide();
                $('#telef').fadeIn();
                tinymce.remove('#descripcion');
			});
            $('#correo').on('ifChecked', function(){
                $('#correo_camp').prependTo('#cosas');
                $('#descripcion').prop('disabled',true);
                $('#telef > input').prop('disabled',true);
                $('#correo_camp > input').prop('disabled',false);
                $('#sobre_camp').hide();
                $('#telef').hide();
                $('#mapa_camp').hide();
                $('#correo_camp').fadeIn();
                tinymce.remove('#descripcion');
			});
            $('#form').validate();
            @if (isset($empresa) && $empresa->tipo == 'sobre')
            $('#descripcion').prop('disabled',false);
            tinymce.init({
            selector: 'textarea',
            language: 'es',
            height: 200,
            toolbar1: 'undo redo | preview | styleselect | bold italic forecolor backcolor ',
            toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist | table | responsivefilemanager link image ',
            plugins: [
              'advlist autolink link lists charmap preview hr anchor pagebreak',
              'wordcount visualblocks visualchars insertdatetime media nonbreaking',
              'save table paste image responsivefilemanager table contextmenu imgmap',
              'colorpicker textcolor'
            ],
            image_class_list: [
                {title: 'Predefinida', value: 'img-responsive'},
                {title: 'Retrato', value: 'img-responsive img-thumbnail'},
                {title: 'Puntas redondas', value: 'img-responsive img-rounded'},
                {title: 'Forma circular', value: 'img-responsive img-circle'}
            ],
            /*content_css: [
                '<?=base_url("assets/frontend/css/tinymce.style.css")?>'
            ],*/
            menubar: false,
            relative_urls :false,
            //allow_script_urls: true,
            external_filemanager_path:"<?=base_url('assets/common/js/filemanager/')?>",
            filemanager_title:"Manejador de archivos" ,
            external_plugins: { "filemanager" : "<?=base_url('assets/common/js/filemanager/plugin.min.js')?>"},
            //extended_valid_elements : "img[usemap|class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],map[id|name],area[shape|alt|coords|href|target]",
            });
            @elseif($empresa->tipo == 'telefono')
                $('#telef > input').prop('disabled',false);
            @elseif ($empresa->tipo == 'correo')
                $('#correo_camp > input').prop('disabled',false);
            @endif
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/cliente') }}">Clientes</a></li>
                <li class="active">
                    <strong>Clientes</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Editar la información solicitada</h2>
                        <div class="ibox-content">
                            {{ form_open('administrador/empresa/post_editar/'.$empresa->id_item,array('id'=>'form')) }}
                                @include('admin.empresa.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
