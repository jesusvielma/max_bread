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

                                {{ $tiempo }} <img src="{{ base_url('assets/backend/email/user.png') }}" alt="user" width="16px"><strong>{{ $destinatario->nombre }}</strong> {{ $destinatario->tipo == 'empresa' ? 'responsable de <strong><img src="'.base_url('assets/backend/email/store.png').'" alt="user" width="16px"> '.$destinatario->empresa.'</strong>' : ''}}.
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 20px;vertical-align: top;">
                                {{ $contenido->cuerpo }}
                                <br><br>
                                {{ $contenido->botonURL }}
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
