@extends('templates/admin/default')
@section('title')
    Creación del slider
@endsection
@section('css')
    <link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
<style >
    h2.home-slider-title-main {
    color: #fff;
    max-width: 600px;
    padding: 0 45px;
    margin: 30px auto;
    position: relative;
    text-transform: uppercase;
    font-weight: 700;
    }

    .swiper-slide {
    min-height: 50vh;
    padding: 20vh 15px 0;
    background-size: cover !important;
    background-position: center !important;
    }
</style>
@endsection
@section('js')
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <script src="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.js')?>"></script>
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#guardar').click(function (e){
                e.preventDefault();
                if($('#imagen').val() == ''){
                    swal({
                        title: "Opps, hay un problema",
                        text:  "No haz seleccionado la imagen para mostrar en este slider. Por favor seleccionala",
                        type: "error",
                        confirmButtonText: "Ok"
                    });
                }else{
                    $('#form').submit()
                }
            });
            $('#botonSI').click(function (){
                $('#disicionBoton').hide('fadeOut');
                $('#divBotonSlider').fadeIn();
            });
            $('#botonNo').click(function (){
                $('#disicionBoton').hide('fadeOut');
                $('#botonSlider').hide()
            });
            $('#enlaceInterno').click(function (){
                $('#EnlaceTipo').hide('fadeOut');
                $('#enlace_select').fadeIn().prop('disabled',false);
            });
            $('#enlaceExterno').click(function (){
                $('#EnlaceTipo').hide('fadeOut');
                $('#enlace_boton').fadeIn().prop('disabled',false);
            });
            $('#texto_imagen').keyup(function () {
                var txt = $(this).val();
                $('.home-slider-title-main').text(txt);
            });
            $('#texto_boton').keyup(function () {
                var txt = $(this).val();
                $('.home-buttons > a').text(txt);
            });
            $('#enlace_boton').blur(function () {
                var txt = $(this).val();
                $('.home-buttons > a').attr('href',txt);
            });
            $('[data-fancybox]').fancybox({
                iframe: {
                    css: {
                        height: '500px'
                    },
                    scrolling : 'yes'
                }
            });

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
            $('.swiper-slide').css('background',"url("+url+")")
            close_window();
        }

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Destacados</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/cliente') }}">Destacados</a></li>
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
                        <h2>Crear el slider {{ $this->uri->segment(4) }}</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            {{ form_open('administrador/slider/guardar/',array('id'=>'form')) }}
                                @include('admin/slider/form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
