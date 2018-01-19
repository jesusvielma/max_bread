@extends('templates.admin.email')
@section('email_title')
{{ $asunto }}
@endsection
@section('content')
    <tr>
        <td >
            <tr>
                <td style="font-size: 16px;color: #fff;font-weight: 500;padding: 20px;text-align: center;border-radius: 3px 3px 0 0;background: #ff9800;">
                    {{ $asunto }}
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;">
                    <table  cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 0 0 20px;vertical-align: top;">
                                @php
                                $tiempo = '';
                                    if(date('H')<12)
                                        $tiempo = 'Buenos días,';
                                    elseif(date('H')>11 && date('H')<20)
                                        $tiempo = 'Buenas tardes,';
                                    elseif(date('H')>19 )
                                        $tiempo = 'Buenas noches,';
                                @endphp
                                <strong>{{ $tiempo }}</strong> hemos recibido tu  <img src="{{ base_url('assets/backend/email/cart.png') }}" alt="user" width="16px"> pedido, a continuación te mostramos los detalles del mismo:
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 20px;vertical-align: top;">
                                <table style="margin: 40px auto;text-align: left;width: 80%;">
                                    <tr>
                                        <td>
                                            @if ($pedido->cliente->tipo == 'natural')
                                                <img src="{{ base_url('assets/backend/email/user.png') }}" alt="user" width="16px">
                                            @else
                                                <img src="{{ base_url('assets/backend/email/store.png') }}" alt="user" width="16px">
                                            @endif
                                              {{ $pedido->cliente->nombre }}
                                            <br>
                                             <img src="{{ base_url('assets/backend/email/cart.png') }}" alt="user" width="16px"> Pedido {{ $pedido->codigo_pedido }}
                                            <br>
                                             <img src="{{ base_url('assets/backend/email/calendar.png') }}" alt="user" width="16px"> {{ $pedido->fecha->formatLocalized('%d de %B de %Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%;" cellpadding="0" cellspacing="0">
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
                                                <tr >
                                                    <td style="border-top: 2px solid #333;border-bottom: 2px solid #333;font-weight: 700;text-align: right;" colspan="2" width="80%">Total</td>
                                                    <td style="border-top: 2px solid #333;border-bottom: 2px solid #333;font-weight: 700;text-align: right;" >$ {{ $total }}CLP</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @if ($contenido->alertas)
                            <tr>
                                <td style="padding: 0 0 20px;vertical-align: top;font-size: x-small">
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
