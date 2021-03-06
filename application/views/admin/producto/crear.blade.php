@extends('templates/admin/default')
@section('title')
    Ingresar nuevo producto
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
    @if ($this->session->flashdata('NoCats'))        
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    @endif
@endsection
@section('js')
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ base_url('assets/common/js/tinymce/tinymce.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ base_url('assets/backend/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.js')?>"></script>
    @if ($this->session->flashdata('NoCats'))        
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    @endif
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
            $(".select2").select2({
                placeholder: "Selecciona",
                allowClear: true
            });
            $('#form').validate({
                rules: {
                    mayor: {
                        required: true,
                        number: true,
                        lowerThan: 'input[name="menor"]'
                    },
                    menor: {
                        required: true,
                        number: true,
                        greaterThan: 'input[name="mayor"]'
                    },
                    cantidad: {
                        required: true,
                        number: true
                    }
                }
            });
            $('input[name="mayor"]').focus(function(){
                if($(this).val() == 0)
                $(this).val('');
            });
            $('input[name="mayor"]').keyup(function(){
                var monto = $(this).val();
                monto++;
                $('input[name="menor"]').val(monto);
            });
            $.validator.addMethod("greaterThan",
            function (value, element, param) {
                var $otherElement = $(param);
                return parseInt(value, 10) > parseInt($otherElement.val(), 10);
            },'El precio por menor debe ser mas alto que el precio por mayor');
            $.validator.addMethod("lowerThan",
            function (value, element, param) {
                var $otherElement = $(param);
                return parseInt(value, 10) < parseInt($otherElement.val(), 10);
            },'El precio por mayor debe ser mas alto que el precio por menor');
            $('#nombre').blur(function () {
                var nombre = $(this).val();
                $.post('{{ site_url('administrador/producto/crearDir/') }}',{nombre:nombre} , function (data) {
                    nombre = data.nombre;
                    $('a').each(function () {
                        box = $(this).data('src');
                        if(box)
                        {
                            box = box.replace(':PRODUCTO',nombre);
                            $(this).removeData('src');
                            $(this).data('src',box);
                            $(this).removeClass('disabled');
                        }
                    })
                });
            });
            $('[data-fancybox]').fancybox({
    			iframe: {
    				css: {
    					height: '500px'
    				},
                    scrolling : 'yes'
    			}
            });
            
            @if ($this->session->flashdata('NoCats'))        
            swal({
                title: "Opps, hay un problema",
                text:  " {{ $this->session->flashdata('NoCats')['msg'] }} ",
                type: "error",
                confirmButtonText: "Vamos allá ",
                confirmButtonColor: "#1ab394",
                closeOnConfirm: false,
                closeOnCancel: false,
                html: true,
                closeOnClickOutside: false
            },
            function(isConfirm){
                if(isConfirm){
                    location.href="{{ $this->session->flashdata('NoCats')['url'] }}";
                }
            });
            @endif
            @if ($this->session->flashdata('NoMarcas'))        
            swal({
                title: "Opps, hay un problema",
                text:  " {{ $this->session->flashdata('NoMarcas')['msg'] }} ",
                type: "error",
                confirmButtonText: "Vamos allá ",
                confirmButtonColor: "#1ab394",
                closeOnConfirm: false,
                closeOnCancel: false,
                html: true,
                closeOnClickOutside: false
            },
            function(isConfirm){
                if(isConfirm){
                    location.href="{{ $this->session->flashdata('NoCats')['url'] }}";
                }
            });
            @endif
        });
        function close_window() {
            $.fancybox.close('all');
            $.get('{{ site_url('upload/get_csrf_fields') }}',function(data){
                var csrfName = data.csrf.name;
                var csrfHash = data.csrf.hash;
                $('input[name='+csrfName+']').val(csrfHash);
            });
        }

        function setImage(imagen,campo,dir) {
            close_window();
            $('#'+campo).val(dir+'/'+imagen);
            $('#foto_'+campo).attr('src','{{base_url('assets/common/uploads/')}}'+dir+'/'+imagen);
        }

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Productos</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/producto') }}">Producto</a></li>
                <li class="active">
                    <strong>Nuevo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Ingresar nuevo producto</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            {{ form_open('administrador/producto/guardar',array('id'=>'form')) }}
                                @include('admin.producto.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
