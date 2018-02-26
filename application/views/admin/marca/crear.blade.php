@extends('templates/admin/default')
@section('title')
    Ingresar nueva marca
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
            <h2>Marcas</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/marca') }}">Marcas</a></li>
                <li class="active">
                    <strong>Marcas</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Ingresar nueva marca</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            @if ($this->session->flashdata('logo'))
                                <div class="alert alert-danger">
                                    {{ $this->session->flashdata('logo')['errors'] }}
                                </div>
                            @endif
                            {{ form_open_multipart('administrador/marca/guardar',array('id'=>'form')) }}
                                @include('admin/marca/form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
