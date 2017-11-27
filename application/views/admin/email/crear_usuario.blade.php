@extends('templates.admin.email')
@section('content')
    <tr>
        <td class="content-wrap">
            <table  cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <img class="img-responsive" src="img/header.jpg"/>
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        <h3>Hola {{ $nombre }}</h3>
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        Usted ha recibido este correo poque ha sido ingresado en el nuevo sistema de base de datos de MAx bread
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        Ingrese en el link que esta acontuanción para acceder al sistema.
                    </td>
                </tr>
                <tr>
                    <td class="content-block aligncenter">
                        <a href="" class="btn-primary">Confirm email address</a>
                    </td>
                </tr>
              </table>
        </td>
    </tr>

@endsection
