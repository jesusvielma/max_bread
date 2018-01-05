@extends('templates/admin/default')
@section('title')
    Ingresar nuevo cliente
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
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("input#rut").rut().on('rutInvalido', function(e) {
                if($(this).val() != '')

                swal({
                    title: "Opps, hay un problema",
                    text:  "El RUT <strong>"+$(this).val()+"</strong> ingresado no es valido verificalo",
                    type: "error",
                    confirmButtonText: "Ok",
                    timer: 5000,
                    html: true
                });
                $(this).removeClass('valid').addClass('error').focus();
            });
            $('.i-checks').iCheck({
                radioClass: 'iradio_square-green',
            });
            $('#natural').on('ifChecked', function(){
				$('#nombre').text('Nombres y Apellidos');
                $('#form_hide').hide();
                $('#fantasia').prop('disabled',true).prop('required',false);
                $('#responsable').prop('disabled',true).prop('required',false);
			});
            $('#empresa').on('ifChecked', function(){
				$('#nombre').text('Razon Social');
                $('#fantasia').prop('disabled',false).prop('required',true);
                $('#responsable').prop('disabled',false).prop('required',true);
                $('#form_hide').fadeIn();
			});

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
                        <h2>Ingresar nuevo cliente</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            {{ form_open('administrador/cliente/guardar',array('id'=>'form')) }}
                                @include('admin/cliente/form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
