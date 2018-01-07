@extends('templates.admin.email')
@section('email_title')
{{ $asunto }}
@endsection
@section('content')
    <tr>
        <td >
            <tr>
                <td class="alert alert-good">
                    {{ $asunto }}
                </td>
            </tr>
            <tr>
                <td class="content-wrap">
                    <table  cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="content-block">
                                @php
                                $tiempo = '';
                                    if(date('H')<12)
                                        $tiempo = 'Buenos días,';
                                    elseif(date('H')>11 && date('H')<20)
                                        $tiempo = 'Buenas tardes,';
                                    elseif(date('H')>19 )
                                        $tiempo = 'Buenas noches,';
                                @endphp
                                <strong>{{ $tiempo }}</strong> hemos recibido tu <i class="fa fa-shopping-cart"></i> pedido, a continuación te mostramos el detalles:
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block">
                                <table class="invoice">
                                    <tr>
                                        <td><i class="fa fa-user"></i> {{ $pedido->cliente->nombre }}<br><i class="fa fa-shopping-cart"></i> Pedido {{ $pedido->codigo_pedido }}<br><i class="fa fa-calendar"></i> {{ $pedido->fecha->formatLocalized('%d de %B de %Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <th><acronym title="Cantidad">Cant</acronym></th>
                                                    <th>Producto</th>
                                                    <th>Total</th>
                                                </tr>
                                                @foreach ($pedido->productos as $producto)
                                                    <tr>
                                                        <td>{{ $producto->pivot->cantidad }}</td>
                                                        <td>{{ $producto->nombre }}</td>
                                                        @php
                                                        $total = 0;
                                                            if($producto->pivot->cantidad >= $producto->cant_por_mayor)
                                                                $precio = $producto->precio_por_mayor;
                                                            else
                                                                $precio = $producto->precio_por_menor;

                                                            $total_P = $producto->pivot->cantidad * $precio;
                                                            $total+= $total_P;
                                                        @endphp
                                                        <td class="alignright">$ {{ $total_P }}CLP</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="total">
                                                    <td colspan="2" class="alignright" width="80%">Total</td>
                                                    <td class="alignright">$ {{ $total }}CLP</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @if ($contenido->alertas)
                            <tr>
                                <td class="content-block" style="font-size: x-small">
                                    @foreach ($contenido->alertas as $alerta)
                                        {{ $alerta }} <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </td>
    </tr>

@endsection
