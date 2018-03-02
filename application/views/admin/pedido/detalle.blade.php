@extends('templates/admin/default')
@section('title')
    Detalle del pedido
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#rut').text($.formatRut($('#rut').text()));
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Pedidos</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/cliente') }}">Pedidos</a></li>
                <li class="active">
                    <strong>Detalle del pedido {{ $pedido->codigo_pedido }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-md-9">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{ $pedido->productos->count() }}</strong>) productos</span>
                        <h5>Productos en el pedido</h5>
                    </div>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($pedido->productos as $producto)
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <tr>
                                            <td width="90">
                                                <div class="cart-product-imitation">
                                                    @foreach ($producto->imagen as $imagen)
                                                        @php
                                                            if($imagen->puesto == 1)
                                                            $img = $imagen->url;
                                                            break;
                                                        @endphp
                                                    @endforeach
                                                    <img src="{{ base_url('assets/common/uploads/'.$img) }}" alt="" class="img-responsive">
                                                </div>
                                            </td>
                                            <td class="desc">
                                                <h3>
                                                    <a href="#" class="text-navy">
                                                        {{ $producto->nombre }}
                                                    </a>
                                                </h3>
                                                <p class="small">
                                                    {{ $producto->descripcion }}
                                                </p>
                                                <!--<dl class="small m-b-none">
                                                    <dt>Description lists</dt>
                                                    <dd>A description list is perfect for defining terms.</dd>
                                                </dl>

                                                <div class="m-t-sm">
                                                    <a href="ecommerce-cart.html#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                    |
                                                    <a href="ecommerce-cart.html#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                                </div>-->
                                            </td>

                                            <td>
                                                @if ($producto->pivot->cantidad >= $producto->cant_por_mayor)
                                                    ${{ $producto->precio_por_mayor }}CLP
                                                    <s class="small text-muted">${{ $producto->precio_por_menor }}CLP</s>
                                                @elseif($producto->pivot->oferta != 0)
                                                    @foreach ($producto->ofertas as $oferta)
                                                        @if ($oferta->id_oferta == $producto->pivot->oferta)
                                                            ${{ $oferta->precio }}CLP <small><em>[Oferta]</em></small>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    ${{ $producto->precio_por_menor }}CLP
                                                @endif
                                            </td>
                                            <td width="65">
                                                <input type="text" class="form-control" placeholder="1" readonly value="{{ $producto->pivot->cantidad }}">
                                            </td>
                                            <td>
                                                <h4>
                                                    @php
                                                        if($producto->pivot->cantidad >= $producto->cant_por_mayor)
                                                            $precio = $producto->precio_por_mayor;
                                                        elseif($producto->pivot->oferta != 0)
                                                            foreach ($producto->ofertas as $oferta){
                                                                if ($oferta->id_oferta == $producto->pivot->oferta)
                                                                    $precio = $oferta->precio ;
                                                            }
                                                        else
                                                            $precio = $producto->precio_por_menor;

                                                        $total_P = $producto->pivot->cantidad * $precio;
                                                        $total+= $total_P;
                                                    @endphp
                                                    ${{ $total_P }}CLP
                                                </h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach
                    <div class="ibox-content">
                        @if ($pedido->estado == 'pedido')
                            <a href="{{ site_url('administrador/pedido/estado/ruta/'.$pedido->id_pedido) }}" class="btn btn-success pull-right"><i class="fa fa fa-truck"></i> Enviar al destino</a>
                        @elseif ($pedido->estado == 'ruta')
                            <a href="{{ site_url('administrador/pedido/estado/entregado/'.$pedido->id_pedido) }}" class="btn btn-primary pull-right"><i class="fa fa fa-check"></i> Marcar como entregado</a>
                        @else
                            <a class="btn btn-primary disabled pull-right"><i class="fa fa fa-check"></i> Entregado</a>
                        @endif
                        <a href="{{ site_url('administrador/pedido') }}" class="btn btn-white"><i class="fa fa-arrow-left"></i> Pedidos</a>

                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cliente</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h3>{{ $pedido->cliente->nombre }}</h3>
                        <h4 >RUT <span id="rut">{{ $pedido->cliente->rut }}</span></h4>
                        <h4><i class="fa fa-map-marker"></i> {{ $pedido->cliente->direccion }}</h4>
                        <h3><i class="fa fa-phone"></i> {{ $pedido->cliente->telefono }}</h3>
                        <!--<span class="small">
                            Please contact with us if you have any questions. We are avalible 24h.
                        </span>-->
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Total</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            ${{ $total }}CLP
                        </h2>

                        <hr/>
                        <!--<span class="text-muted small">
                            *For United States, France and Germany applicable sales tax will be applied
                        </span>-->
                        <div class="m-t-sm">
                            <div class="btn-group">
                            <!--<a href="ecommerce-cart.html#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                            <a href="ecommerce-cart.html#" class="btn btn-white btn-sm"> Cancel</a>
                            </div>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
