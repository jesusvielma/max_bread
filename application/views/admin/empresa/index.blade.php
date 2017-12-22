@extends('templates.admin.default')
@section('title')
    Empresa
@endsection
@section('css')
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('js')
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.borrar_item').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                swal({
                    title: "¡Atención!",
                    text:  "Estas a punto de eliminar infomración de la empresa, esta dejara de ser mostrada en la pagina principal del sitio web.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Borrar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Perfecto!", "Vamos a borrar la información indicada.", "success");
                            setTimeout(function () {
                                window.location.href = url
                            },'2000');
                        } else {
                            swal("Cancelado", "No haremos nada", "error");
                        }
                    });
            });
        });
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Empresa</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Empresa</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ site_url('administrador/empresa/nuevo') }}" class="btn btn-primary">Ingresar información</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <?php if ($items->count()): ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Sobre Nosotros</h2>
                        </div>
                        <div class="ibox-content">
                            @if ($sobres->count())
                                <fieldset class="border-left-right border-top-bottom border-size-sm p-xs">
                                    @foreach ($sobres as $sobre)
                                        {{ $sobre->descripcion }}
                                    @endforeach
                                    <a href="{{ site_url('administrador/empresa/editar_item/'.$sobre->id_item) }}">Editar esta información</a>
                                </fieldset>
                            @else
                                <div class="alert alert-info">
                                    No hay información registrada
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Telefonos</h2>
                        </div>
                        <div class="ibox-content">
                            @if ($telefs->count())
                                <ul>
                                    @foreach ($telefs as $telef)
                                        <li>@php
                                            $telefb = json_decode($telef->descripcion);
                                            @endphp
                                            {{ $telefb->{'tipo_telef'}.' '.$telefb->{'telefono'} }}
                                            <span class="pull-right tooltip-demo" >
                                                <a title="Editar" data-toggle="tooltip" data-placement="top"  href="{{ site_url('administrador/empresa/editar_item/'.$telef->id_item) }}" ><i class="fa fa-pencil"></i></a>
                                                <a class="borrar_item text-danger" href="{{ site_url('administrador/empresa/borrar/'.$telef->id_item) }}" title="Borrar" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-info">
                                    No hay información registrada
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Correos</h2>
                        </div>
                        <div class="ibox-content">
                            @if ($correos->count())
                                <ul>
                                    @foreach ($correos as $correo)
                                        <li>{{ $correo->descripcion }}
                                            <span class="pull-right tooltip-demo">
                                                <a href="{{ site_url('administrador/empresa/editar_item/'.$correo->id_item) }}" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
                                                <a class="borrar_item text-danger" href="{{ site_url('administrador/empresa/borrar/'.$correo->id_item) }}" title="Borrar" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-info">
                                    No hay información registrada
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="alert alert-info">
                        <h3>No hay información </h3>
                        <p>No hay datos ingresados sobre la empresa</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
