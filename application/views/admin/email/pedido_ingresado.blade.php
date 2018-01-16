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
                                <strong>{{ $tiempo }}</strong> hemos recibido tu <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwIDYwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MCA2MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8cGF0aCBkPSJNMTEuNjgsMTNsLTAuODMzLTVoLTIuOTlDNy40MTEsNi4yOCw1Ljg1OSw1LDQsNUMxLjc5NCw1LDAsNi43OTQsMCw5czEuNzk0LDQsNCw0YzEuODU5LDAsMy40MTEtMS4yOCwzLjg1OC0zaDEuMjk0bDAuNSwzICBIOS42MTRsNS4xNzEsMjYuMDE2Yy0yLjQ2NSwwLjE4OC00LjUxOCwyLjA4Ni00Ljc2LDQuNDc0Yy0wLjE0MiwxLjQwNSwwLjMyLDIuODEyLDEuMjY4LDMuODU4QzEyLjI0Miw0OC4zOTcsMTMuNTk0LDQ5LDE1LDQ5aDIgIGMwLDMuMzA5LDIuNjkxLDYsNiw2czYtMi42OTEsNi02aDExYzAsMy4zMDksMi42OTEsNiw2LDZzNi0yLjY5MSw2LTZoNGMwLjU1MywwLDEtMC40NDcsMS0xcy0wLjQ0Ny0xLTEtMWgtNC4zNSAgYy0wLjgyNi0yLjMyNy0zLjA0My00LTUuNjUtNHMtNC44MjQsMS42NzMtNS42NSw0aC0xMS43Yy0wLjgyNi0yLjMyNy0zLjA0My00LTUuNjUtNHMtNC44MjQsMS42NzMtNS42NSw0SDE1ICBjLTAuODQyLDAtMS42NTItMC4zNjItMi4yMjQtMC45OTNjLTAuNTc3LTAuNjM5LTAuODQ4LTEuNDYxLTAuNzYxLTIuMzE2YzAuMTUyLTEuNTA5LDEuNTQ2LTIuNjksMy4xNzMtMi42OWgwLjc5MSAgYzAuMDE0LDAsMC4wMjUsMCwwLjAzOSwwaDM4Ljk5NEM1Ny43NjMsNDEsNjAsMzguNzYzLDYwLDM2LjAxM1YxM0gxMS42OHogTTQsMTFjLTEuMTAzLDAtMi0wLjg5Ny0yLTJzMC44OTctMiwyLTJzMiwwLjg5NywyLDIgIFM1LjEwMywxMSw0LDExeiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
                                pedido, a continuación te mostramos el detalles:
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 20px;vertical-align: top;">
                                <table style="margin: 40px auto;text-align: left;width: 80%;">
                                    <tr>
                                        <td>
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwIDYwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MCA2MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8cGF0aCBkPSJNNDguMDE0LDQyLjg4OWwtOS41NTMtNC43NzZDMzcuNTYsMzcuNjYyLDM3LDM2Ljc1NiwzNywzNS43NDh2LTMuMzgxYzAuMjI5LTAuMjgsMC40Ny0wLjU5OSwwLjcxOS0wLjk1MSAgYzEuMjM5LTEuNzUsMi4yMzItMy42OTgsMi45NTQtNS43OTlDNDIuMDg0LDI0Ljk3LDQzLDIzLjU3NSw0MywyMnYtNGMwLTAuOTYzLTAuMzYtMS44OTYtMS0yLjYyNXYtNS4zMTkgIGMwLjA1Ni0wLjU1LDAuMjc2LTMuODI0LTIuMDkyLTYuNTI1QzM3Ljg1NCwxLjE4OCwzNC41MjEsMCwzMCwwcy03Ljg1NCwxLjE4OC05LjkwOCwzLjUzQzE3LjcyNCw2LjIzMSwxNy45NDQsOS41MDYsMTgsMTAuMDU2ICB2NS4zMTljLTAuNjQsMC43MjktMSwxLjY2Mi0xLDIuNjI1djRjMCwxLjIxNywwLjU1MywyLjM1MiwxLjQ5NywzLjEwOWMwLjkxNiwzLjYyNywyLjgzMyw2LjM2LDMuNTAzLDcuMjM3djMuMzA5ICBjMCwwLjk2OC0wLjUyOCwxLjg1Ni0xLjM3NywyLjMybC04LjkyMSw0Ljg2NkM4LjgwMSw0NC40MjQsNyw0Ny40NTgsNyw1MC43NjJWNTRjMCw0Ljc0NiwxNS4wNDUsNiwyMyw2czIzLTEuMjU0LDIzLTZ2LTMuMDQzICBDNTMsNDcuNTE5LDUxLjA4OSw0NC40MjcsNDguMDE0LDQyLjg4OXoiIGZpbGw9IiMwMDAwMDAiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                            {{ $pedido->cliente->nombre }}
                                            <br>
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwIDYwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MCA2MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8cGF0aCBkPSJNMTEuNjgsMTNsLTAuODMzLTVoLTIuOTlDNy40MTEsNi4yOCw1Ljg1OSw1LDQsNUMxLjc5NCw1LDAsNi43OTQsMCw5czEuNzk0LDQsNCw0YzEuODU5LDAsMy40MTEtMS4yOCwzLjg1OC0zaDEuMjk0bDAuNSwzICBIOS42MTRsNS4xNzEsMjYuMDE2Yy0yLjQ2NSwwLjE4OC00LjUxOCwyLjA4Ni00Ljc2LDQuNDc0Yy0wLjE0MiwxLjQwNSwwLjMyLDIuODEyLDEuMjY4LDMuODU4QzEyLjI0Miw0OC4zOTcsMTMuNTk0LDQ5LDE1LDQ5aDIgIGMwLDMuMzA5LDIuNjkxLDYsNiw2czYtMi42OTEsNi02aDExYzAsMy4zMDksMi42OTEsNiw2LDZzNi0yLjY5MSw2LTZoNGMwLjU1MywwLDEtMC40NDcsMS0xcy0wLjQ0Ny0xLTEtMWgtNC4zNSAgYy0wLjgyNi0yLjMyNy0zLjA0My00LTUuNjUtNHMtNC44MjQsMS42NzMtNS42NSw0aC0xMS43Yy0wLjgyNi0yLjMyNy0zLjA0My00LTUuNjUtNHMtNC44MjQsMS42NzMtNS42NSw0SDE1ICBjLTAuODQyLDAtMS42NTItMC4zNjItMi4yMjQtMC45OTNjLTAuNTc3LTAuNjM5LTAuODQ4LTEuNDYxLTAuNzYxLTIuMzE2YzAuMTUyLTEuNTA5LDEuNTQ2LTIuNjksMy4xNzMtMi42OWgwLjc5MSAgYzAuMDE0LDAsMC4wMjUsMCwwLjAzOSwwaDM4Ljk5NEM1Ny43NjMsNDEsNjAsMzguNzYzLDYwLDM2LjAxM1YxM0gxMS42OHogTTQsMTFjLTEuMTAzLDAtMi0wLjg5Ny0yLTJzMC44OTctMiwyLTJzMiwwLjg5NywyLDIgIFM1LjEwMywxMSw0LDExeiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
                                            Pedido {{ $pedido->codigo_pedido }}
                                            <br>
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwIDYwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MCA2MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8Zz4KCTxwYXRoIGQ9Ik01MC4yNSwxMWMtMS41NjMtMC44MzgtMTEuMjgyLTYuMDctMTYuNjIzLTkuNDIxQzMyLjcxNSwwLjYxMiwzMS40MzEsMCwzMCwwcy0yLjcxNSwwLjYxMi0zLjYyNywxLjU3OSAgIEMyMS4wMzEsNC45MjksMTEuMzEzLDEwLjE2Miw5Ljc1LDExSDB2NDloNjBWMTFINTAuMjV6IE0yNS4wMDYsNC43NTRDMjUuMDAyLDQuODM2LDI1LDQuOTE4LDI1LDVjMCwyLjc1NywyLjI0Myw1LDUsNXM1LTIuMjQzLDUtNSAgIGMwLTAuMDgyLTAuMDAyLTAuMTY0LTAuMDA2LTAuMjQ2QzM4LjU4Nyw2Ljg5LDQzLjAyOSw5LjM1MSw0Ni4wNTEsMTFIMTMuOTQ5QzE2Ljk3MSw5LjM1MSwyMS40MTMsNi44OSwyNS4wMDYsNC43NTR6IE0yLDU4VjIwaDU2ICAgdjM4SDJ6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIyMyIgY3k9IjI4IiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIzMCIgY3k9IjI4IiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIzNyIgY3k9IjI4IiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSI0NCIgY3k9IjI4IiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSI1MSIgY3k9IjI4IiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSI5IiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjE2IiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjIzIiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjMwIiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjM3IiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjQ0IiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjUxIiBjeT0iMzYiIHI9IjEiIGZpbGw9IiMwMDAwMDAiLz4KCTxjaXJjbGUgY3g9IjkiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iMTYiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iMjMiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iMzAiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iMzciIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iNDQiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iNTEiIGN5PSI0MyIgcj0iMSIgZmlsbD0iIzAwMDAwMCIvPgoJPGNpcmNsZSBjeD0iOSIgY3k9IjUxIiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIxNiIgY3k9IjUxIiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIyMyIgY3k9IjUxIiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIzMCIgY3k9IjUxIiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+Cgk8Y2lyY2xlIGN4PSIzNyIgY3k9IjUxIiByPSIxIiBmaWxsPSIjMDAwMDAwIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                            {{ $pedido->fecha->formatLocalized('%d de %B de %Y') }}
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
