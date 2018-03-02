@extends('templates.admin.default')
@section('title')
    Destacados
@endsection
@section('css')
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

@endsection
@section('script')
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Destacados</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Destacados</strong>
                </li>
            </ol>
        </div>
        @if ($sliders->count() <10)
            <div class="col-sm-8">
                <div class="title-action">
                    <a id="IngresarProd" href="{{ site_url('administrador/slider/crear') }}" class="btn btn-primary">Nuevo</a>
                </div>
            </div>
        @endif
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        @if ($sliders->count() > 0 )
            @foreach ($sliders as $key => $slider)
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="ibox collapsed">
                            <div class="ibox-title">
                                <h5>Destacado {{ $slider->posicion }} <small>{{ $slider->texto_imagen }}</small></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a href="{{ site_url('administrador/slider/editar/'.$slider->id_imagen) }}"><i class="fa fa-pencil"></i></a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slider->url) }});">
                                    <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                                    @if ($slider->texto_imagen != '')
                                        <h2 class="home-slider-title-main">{{ $slider->texto_imagen }}</h2>
                                    @endif
                                    @if ($slider->texto_boton != '' && $slider->enlace_boton != '')    
                                        <div class="home-buttons text-center"> 
                                            <a href="{{ $slider->enlace_boton }}" class="btn btn-lg  btn-primary">{{ $slider->texto_boton }}</a> 
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
