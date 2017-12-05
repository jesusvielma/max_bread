@extends('templates/admin/default')
@section('title')
    Creación del slider {{ $this->uri->segment(4) }}
@endsection
@section('css')
    <link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
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
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#form').validate();
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
                    }
                }
            });

        });
        function close_window() {
            $.fancybox.close('all');
        }

        function responsive_filemanager_callback(field_id){
            var url=$('#'+field_id).val();
            //$('#'+field_id).attr('src','<?=base_url('assets/common/thumbs/')?>'+url);
            url = '<?=base_url('assets/common/uploads/')?>'+url;
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
                            {{ form_open('administrador/slider/guardar/'.$this->uri->segment(4),array('id'=>'form')) }}
                                @include('admin/slider/form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
