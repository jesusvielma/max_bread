@extends('templates/admin/default')
@section('title')
    Editar marca
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('js')
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#form').validate();
        });
    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/cliente') }}">Clientes</a></li>
                <li class="active">
                    <strong>Clientes</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Editar la información</h2>
                        <div class="ibox-content">
                            {{ form_open('administrador/marca/post_editar/'.$marca->id_marca,array('id'=>'form')) }}
                                @include('admin.marca.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
