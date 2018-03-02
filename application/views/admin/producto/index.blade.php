@extends('templates.admin.default')
@section('title')
    Productos
@endsection
@section('css')
    <!-- FooTable -->
    <link href="{{ base_url('assets/backend/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <style>
        .ofertasTable {
            display: none;
        }
        .modal-content > .sk-spinner {
            display: none;
        }
        .modal-content.sk-loading {
            position: relative;
        }
        .modal-content.sk-loading:after {
            content: '';
            background-color: rgba(255, 255, 255, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .modal-content.sk-loading > .sk-spinner {
            display: block;
            position: absolute;
            top: 40%;
            left: 0;
            right: 0;
            z-index: 2000;
        }
    </style>
@endsection
@section('js')
    <!-- FooTable -->
    <script src="{{ base_url('assets/backend/js/plugins/footable/footable.all.min.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment.es.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/tour-options/producto/index.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.footable').footable();
            $('[data-tooltip="tooltip"]').tooltip();
            $('.ofertaButton').click(function (){
                $('#Oferta .modal-content').toggleClass('sk-loading');
                moment.locale('es');

                var prod = $(this).data('id');
                var ofertas = '';
                var ofertasActivas = 0;
                $.get('{{ site_url('administrador/oferta/get_ofertas/') }}'+prod, function(data){
                    if(data.vacio != 1){
                        $('#ofertaTitle').html(data.title).fadeIn();
                        for(var i in data.ofertas){
                            ofertas+= '<tr>';
                                ofertas+= '<td>'+data.ofertas[i].nombre+'</td>';
                                ofertas+= '<td>'+moment(data.ofertas[i].inicio).startOf().fromNow()+'</td>';
                                ofertas+= '<td>'+moment(data.ofertas[i].fin).endOf().fromNow()+'</td>';
                                ofertas+= '<td>$'+ data.ofertas[i].precio +'CLP</td>'
                            ofertas+='</tr>';
                            console.log(moment(data.ofertas[i].fin).isAfter(moment()));
                            if(moment(data.ofertas[i].fin).isAfter(moment()) === true ){
                                ofertasActivas = 1;
                            }
                        }
                        if(ofertasActivas == 1 ){
                            $('#crearOferta').addClass('disabled');
                        }else{
                            $('#crearOferta').attr('href','{{ site_url('administrador/oferta/crear/') }}'+prod);
                        }
                        $('#ofertaFilas tr').remove();
                        $(ofertas).appendTo($('#ofertaFilas'));
                        $('#ofertaMsg').hide('fadeOut');
                        $('#ofertasTable').fadeIn();
                    }else{
                        $('#crearOferta').attr('href','{{ site_url('administrador/oferta/crear/') }}'+prod);
                        $('#crearOferta').removeClass('disabled');
                        $('#ofertaTitle').html(data.title).fadeIn();
                        $('#ofertasTable').hide('fadeOut');
                        $('#ofertaMsg').html(data.msg);
                        $('#ofertaMsg').fadeIn();
                    }

                    setTimeout(function (){
                        $('#Oferta .modal-content').toggleClass('sk-loading');
                    },3000)
                });
            });
        });
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Productos</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Productos</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a id="IngresarProd" href="{{ site_url('administrador/producto/crear') }}" class="btn btn-primary">Nuevo</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <?php if ($productos->count()): ?>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Productos</h1>
                        </div>
                        <div class="ibox-content" id="tablaProd">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Buscar en la tabla">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" data-filter=#filter>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th style="width: 10%">Precio por menor</th>
                                        <th>Marca</th>
                                        <th style="width: 15%">Disponibilidad</th>
                                        <th data-hide="all">Precio por mayor</th>
                                        <th data-hide="all">Cantidad Por mayor</th>
                                        <th data-hide="all">Categorías</th>
                                        <th data-hide="all">Descripción</th>
                                        <th style="width: 19%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $key => $producto)
                                        <tr id="fila-{{$key}}">
                                            <td>{{ $producto->nombre }}</td>
                                            <td>${{ $producto->precio_por_menor}} CLP</td>
                                            <td>{{ $producto->marca->nombre }}</td>
                                            <td >
                                                @if ($producto->disponibilidad == 1)
                                                    <span class="label label-primary">Disponible</span>
                                                @else
                                                    <span class="label label-danger">No Disponible</span>
                                                @endif
                                            </td>
                                            <td>${{ $producto->precio_por_mayor }} CLP</td>
                                            <td>{{ $producto->cant_por_mayor }}</td>
                                            <td>{{ $producto->cat->nombre }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td class="btn-group tooltip-demo" id="acciones-{{$key}}">
                                                @php
                                                    if ($producto->disponibilidad == 1 ) {
                                                        $title = 'Hacer no disponible';
                                                        $icon = 'on';
                                                    }else {
                                                        $title = 'Hacer disponible';
                                                        $icon = 'off';
                                                    }
                                                @endphp
                                                <a href="{{ site_url('administrador/producto/disponibilidad/'.$producto->id_producto) }}" class="btn btn-default btn-sm" title="{{ $title }}" data-toggle="tooltip" data-placement="left"> <i class="fa fa-toggle-{{ $icon }}"></i></a>

                                                <button  data-id="{{ $producto->id_producto }}" class="btn btn-warning btn-sm ofertaButton" title="Ofertas de {{ $producto->nombre }}" data-toggle="modal" data-target="#Oferta" data-tooltip="tooltip" data-placement="top"> <i class="fa fa-tag"></i></button>

                                                <button type="button" class="btn btn-sm btn-primary" data-placement="top" data-tooltip="tooltip" title="Ver imágenes del producto" data-toggle="modal" data-target="#{{ $producto->id_producto }}"><i class="fa fa-picture-o"></i></button>

                                                <a href="{{ site_url('administrador/producto/editar/'.$producto->id_producto) }}" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal inmodal fade" id="Oferta" tabindex="-6" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                                <h4 class="modal-title" id="ofertaTitle"></h4>
                            </div>
                            <div class="modal-body text-center">

                                <div id="ofertasTable">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ofertaFilas" >

                                        </tbody>
                                    </table>
                                </div>

                                <div id="ofertaMsg">

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                <a id="crearOferta" href="" class="btn btn-primary"> Crear Nueva oferta</a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($productos as $producto)
                    <div class="modal inmodal fade" id="{{ $producto->id_producto }}" tabindex="-6" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                                    <h4 class="modal-title">Producto {{ $producto->nombre }}</h4>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @foreach ($producto->imagen as $imagen)
                                                @if ($imagen->puesto == 1)
                                                    <img src="{{ base_url('assets/common/uploads/').$imagen->url }}" alt="{{ $producto->nombre }}" class="img-responsive img-thumbnail"><br>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-6">
                                            @foreach ($producto->imagen as $imagen)
                                                @if ($imagen->puesto == 2)
                                                    <img src="{{ base_url('assets/common/uploads/').$imagen->url }}" alt="{{ $producto->nombre }}" class="img-responsive img-thumbnail"><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @foreach ($producto->imagen as $imagen)
                                                @if ($imagen->puesto == 3)
                                                    <img src="{{ base_url('assets/common/uploads/').$imagen->url }}" alt="{{ $producto->nombre }}" class="img-responsive img-thumbnail"><br>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-6">
                                            @foreach ($producto->imagen as $imagen)
                                                @if ($imagen->puesto == 4)
                                                    <img src="{{ base_url('assets/common/uploads/').$imagen->url }}" alt="{{ $producto->nombre }}" class="img-responsive img-thumbnail"><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="alert alert-info">
                        <h3>No hay productos registrados</h3>
                        <p>No se han registrado productos, use el botón de la parte superior para agregar uno nuevo</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
