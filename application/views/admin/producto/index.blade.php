@extends('templates.admin.default')
@section('title')
    Pedidos
@endsection
@section('css')
    <!-- FooTable -->
    <link href="{{ base_url('assets/backend/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
@endsection
@section('js')
    <!-- FooTable -->
    <script src="{{ base_url('assets/backend/js/plugins/footable/footable.all.min.js')}}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.footable').footable()
        });
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Prodcutos</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Productos</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ site_url('administrador/producto/crear') }}" class="btn btn-primary">Nuevo</a>
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
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Buscar en la tabla">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" data-filter=#filter>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio por menor</th>
                                        <th>Dispnibilidad</th>
                                        <th data-hide="all">Precio por mayor</th>
                                        <th data-hide="all">Cantidad Por mayor</th>
                                        <th data-hide="all">Cartegoria</th>
                                        <th data-hide="all">Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>${{ $producto->precio_por_menor}} CLP</td>
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
                                            <td class="btn-group tooltip-demo">
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
                                                <button type="button" class="btn btn-sm btn-primary" title="Ver imagenes del producto" data-toggle="modal" data-target="#{{ $producto->id_producto }}"><i class="fa fa-picture-o"></i></button>
                                                <a href="{{ site_url('administrador/producto/editar/'.$producto->id_producto) }}" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <p>No se han registrado produdctos, use el boton de la parte superior para agregar uno nuevo</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endsection
