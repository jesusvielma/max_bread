@extends('templates/admin/default')
@section('title')
    Crear Oferta
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
@endsection
@section('js')
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ base_url('assets/common/js/tinymce/tinymce.min.js')}}"></script>

    <!-- Data picker -->
   <script src="{{ base_url('assets/backend/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
   <script src="{{ base_url('assets/backend/js/plugins/datapicker/bootstrap-datepicker.es.min.js')}}"></script>

    <!-- Moment js -->
   <script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment.min.js')}}"></script>
   <script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment.es.js')}}"></script>

   <!-- Clock picker -->
    <script src="{{ base_url('assets/backend/js/plugins/clockpicker/clockpicker.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            tinymce.init({
                selector: 'textarea',
                language: 'es',
                height: 200,
                toolbar1: 'undo redo | preview | styleselect | bold italic forecolor backcolor ',
                toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist | table | link image ',
                plugins: [
                  'advlist autolink link lists charmap preview hr anchor pagebreak',
                  'wordcount visualblocks visualchars insertdatetime media nonbreaking',
                  'save table paste image table contextmenu',
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
                /*external_filemanager_path:"<?=base_url('assets/common/js/filemanager/')?>",
                filemanager_title:"Manejador de archivos" ,
                external_plugins: { "filemanager" : "<?=base_url('assets/common/js/filemanager/plugin.min.js')?>"},*/
                //extended_valid_elements : "img[usemap|class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],map[id|name],area[shape|alt|coords|href|target]",
            });
            var now = moment();
            var dia = now.format('DD-MM-YYYY');
            var hora = now.format('hh:mm A');
            
            $('#fecha').attr('placeholder',dia);
            $('#hora').attr('placeholder',hora);
            $('#vigente .input-group.date').datepicker({
                todayBtn: "linked",
                format: 'dd-mm-yyyy',
                autoclose: true,
                language: 'es',
                weekStart: 0,
                startDate: dia,
            })/*.on('changeDate',function (e){
              $('#hora').focus();
            })*/;
            $('.clockpicker').clockpicker({
                placement: 'top',
                twelvehour: true,
                default: 'now',
                align: 'right'
            });
            $('#form').validate({
                rules: {
                    precio: {
                        required: true,
                        number: true,
                        max: {{ $producto->precio_por_menor }},
                        min: {{ $producto->precio_por_mayor }}
                    },
                }
            });
        });    
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Producto - Oferta</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/producto') }}">Productos</a></li>
                <li class="active">
                    <strong>Crear Oferta para {{ $producto->nombre }} </strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Ingrese la información</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            {{ form_open('administrador/oferta/guardar/'.$producto->id_producto,array('id'=>'form')) }}
                                @include('admin.oferta.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
