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

                                {{ $tiempo }} <strong>{{ $destinatario->nombre }}</strong> {{ $destinatario->tipo == 'empresa' ? 'responsable de <strong>'.$destinatario->empresa.'</strong>' : ''}}.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block">
                                {{ $contenido->cuerpo }}
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block">
                                <strong>Usuario: </strong>{{ $correo }} <br>
                                <strong>Clave: </strong> {{ $clave }} <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block aligncenter">
                                <a href="{{ $url }}" class="btn-primary">maxbread</a>
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
