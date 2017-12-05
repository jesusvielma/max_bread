@extends('templates.admin.default')
@section('title')
    Clientes
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
            <h2>Categorias</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Categorias</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ site_url('administrador/categoria/crear') }}" class="btn btn-primary">Nueva</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h5>Descatado 1 {{ $slider1 ? '' : '<small>Sin configurar</small>'}}</h5>
                        <div class="ibox-tools">
                            @if (!$slider1)
                                <a href="{{ site_url('administrador/slider/crear/1') }}"><i class="fa fa-plus"></i></a>
                            @else
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a href="{{ site_url('administrador/slider/editar/'.$slider1->id_imagen) }}"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slider1->url) }});">
                            <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                            <h2 class="home-slider-title-main">{{ $slider1->texto_imagen }}</h2>
                            <div class="home-buttons text-center"> <a href="" class="btn btn-lg  btn-primary">{{ $slider1->texto_boton }}</a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h5>Descatado 2 {{ $slider2 ? '' : '<small>Sin configurar</small>'}}</h5>
                        <div class="ibox-tools">
                            @if (!$slider2)
                                <a href="{{ site_url('administrador/slider/crear/2') }}"><i class="fa fa-plus"></i></a>
                            @else
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a href="{{ site_url('administrador/slider/editar/'.$slider2->id_imagen) }}"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slider2->url) }});">
                            <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                            <h2 class="home-slider-title-main">{{ $slider2->texto_imagen }}</h2>
                            <div class="home-buttons text-center"> <a href="" class="btn btn-lg  btn-primary">{{ $slider2->texto_boton }}</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h5>Descatado 3 {{ $slider3 ? '' : '<small>Sin configurar</small>'}}</h5>
                        <div class="ibox-tools">
                            @if (!$slider3)
                                <a href="{{ site_url('administrador/slider/crear/3') }}"><i class="fa fa-plus"></i></a>
                            @else
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a href="{{ site_url('administrador/slider/editar/'.$slider3->id_imagen) }}"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                    @if ($slider3)
                        <div class="ibox-content">
                            <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slider3->url) }});">
                                <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                                <h2 class="home-slider-title-main">{{ $slider3->texto_imagen }}</h2>
                                <div class="home-buttons text-center"> <a href="" class="btn btn-lg  btn-primary">{{ $slider3->texto_boton }}</a> </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h5>Descatado 4 {{ $slider4 ? '' : '<small>Sin configurar</small>'}}</h5>
                        <div class="ibox-tools">
                            @if (!$slider4)
                                <a href="{{ site_url('administrador/slider/crear/4') }}"><i class="fa fa-plus"></i></a>
                            @else
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a href="{{ site_url('administrador/slider/editar/'.$slider4->id_imagen) }}"><i class="fa fa-pencil"></i></a>
                            @endif
                        </div>
                    </div>
                    @if ($slider4)
                        <div class="ibox-content">
                            <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slider4->url) }});">
                                <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                                <h2 class="home-slider-title-main">{{ $slider4->texto_imagen }}</h2>
                                <div class="home-buttons text-center"> <a href="" class="btn btn-lg  btn-primary">{{ $slider4->texto_boton }}</a> </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
