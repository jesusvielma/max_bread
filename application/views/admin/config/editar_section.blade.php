@extends('templates/admin/default')
@section('title')
    Editar sección 
@endsection
@section('css')
    <link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <style>
        #imagenMostrar{ 
            min-height: 50vh;
            padding: 20vh 15px 0;
            background-size: cover !important;
            background-position: center !important;
            border: 5px solid #e6e6e6;
            border-radius: 3px;
        }
    </style>
@endsection
@section('js')
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <script src="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.js')?>"></script>
    <!-- Color picker -->
    <script src="{{ base_url('assets/backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#form').validate();
            $('[data-fancybox]').fancybox({
                iframe: {
                    css: {
                        height: '500px'
                    },
                    scrolling : 'yes'
                }
            });
            var divStyle = $('#backColor')[0].style;
            $('#changeColor').colorpicker({
                format: 'hex',
                useAlpha: false
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
                $('#backColorInput').val(ev.color.toHex());
                });
            var pStyle = $('#textColorP')[0].style;
            $('#textColor').colorpicker({
                format: 'hex',
                useAlpha: false
            }).on('changeColor', function(ev) {
                pStyle.color = ev.color.toHex();
                $('#textColorInput').val(ev.color.toHex());
                });
            $('[data-toggle="tooltip"]').tooltip();
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
            var url = dir+'/'+imagen;
            $('#'+campo).val(url);
            var url = '{{base_url('assets/common/uploads/')}}'+url;
            $('#imagenMostrar').css('background',"url("+url+")")
            close_window();
        }
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Configuración</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/config') }}">Configuraciones</a></li>
                <li class="active">
                    <strong>Secciones</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Editar la información</h2>
                        <div class="ibox-content">
                            {{ form_open('administrador/config/post_editar/'.$sec->id_config,array('id'=>'form')) }}
                                @include('admin.config.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
