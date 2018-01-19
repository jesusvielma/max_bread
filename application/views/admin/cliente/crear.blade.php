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
    <script>

    $(document).ready(function (){

        // Instance the tour
        var tour = new Tour({
            template: "<div class='popover tour'> <div class='arrow'></div><h3 class='popover-title'></h3> <div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default'data-role='prev'> <i class='fa fa-angle-left'></i> Ant</button><span data-role='separator'>|</span><button class='btn btn-default' data-role='next'>Sig <i class='fa fa-angle-right'></i> </button><button class='btn btn-default' data-role='end'>Fin</button></div></div>",
            steps: [{

                    element: "#formRUT",
                    title: "Ingresar el RUT",
                    content: "Cuando esta en este campo escribe el RUT sin signos o guiones, el campo automaticamente va a formatear y validar el RUT que escribas, si este correcto podras avanzar con el formulario, si no lo es una alerta de lo indicará.",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#formTipo",
                    title: "Selecciona el tipo de cliente",
                    content: "Selecciona el tipo de cliente, una vez que los hagas los siguientes campos van a cambiar.",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#formNombre",
                    title: "Nombre o Razón Social",
                    content: "Si seleccionaste en el tipo un cliente Natural, ingresa en este campo el nombre del cliente, si Seleccionaste Empresa ingresa el nombre de la misma",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#formDireccion",
                    title: "Dirección",
                    content: "Ingresa la dirección del cliente",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#formTelefono",
                    title: "Teléfono",
                    content: "Cuando estes ingresando el número telefonico del cliente vez que este ya se esta formateando correctamente",
                    placement: "bottom",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#formGuardar",
                    title: "Guarda la información",
                    content: "Si ya estas listo presiona este botón para guardar la información",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){
            tour.restart();

            // Start the tour
            // tour.start();
        })

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
