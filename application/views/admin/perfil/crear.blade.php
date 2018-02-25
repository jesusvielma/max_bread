@extends('templates/admin/default')
@section('title')
    Mi perfil
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <style>
        .tour-step-backdrop{
            background: #fff;
            padding: 5px;
        }
    </style>
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                radioClass: 'iradio_square-green',
            });
            $.validator.addMethod("securePass", function (value) {
                var validated =  true;
                if(!/\d/.test(value))
                    validated = false;
                if(!/[a-z]/.test(value))
                    validated = false;
                if(!/[A-Z]/.test(value))
                    validated = false;
                if(!/[^0-9]/.test(value))
                    validated = false;
                if(!/[!-/:-@{-~!"^_`\[\]¡¿]/.test(value))
                    validated = false;
                return validated;
            },'Insecure password');
            $('#cc').click(function (){
                $('input[name=pass_ant]').prop('disabled',false);
                $('input[name=clave]').prop('disabled',false);
                $('input[name=claveCheck]').prop('disabled',false);
                $(this).fadeOut();
            });
            $('#form').validate({
                rules: {
                    pass_ant: {
                        minlength: 8,
                    },
                    clave: {
                        minlength: 8,
                        securePass: true
                    },
                    claveCheck: {
                        minlength: 8,
                        equalTo: '#clave',
                    }
                },
                messages: {
                    clave: {
                        securePass: "La nueva clave debe tener una combinación de letras mayúsculas y minúsculas, números y carácteres especiales"
                    },
                    claveCheck: {
                        equalTo: "Por favor, escriba la misma clave que el campo anterior"
                    }
                }
            });
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Mi Perfil</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Mi Perfil</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Cambiar mi información</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            @if ($this->session->flashdata('error'))
                                <div class="alert alert-danger">
                                    {{ $this->session->flashdata('error')['msg'] }}
                                </div>
                            @endif
                            {{ form_open_multipart('administrador/perfil/guardar',array('id'=>'form')) }}
                                @include('admin/perfil/form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
