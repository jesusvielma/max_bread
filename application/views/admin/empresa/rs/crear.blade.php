@extends('templates/admin/default')
@section('title')
    Ingresar Red Social
@endsection
@section('css')
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ base_url('assets/backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/additional-methods.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/validate/messages_es.js') }}"></script>

    <!-- TinyMCE -->
    <script src="{{ base_url('assets/common/js/tinymce/tinymce.min.js')}}"></script>
	<script>

	</script>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('input[name=rs]').change(function (){
                var url = '';
                if($(this).val() == 'fb'){
                        url = 'http://facebook.com/';
                    $('#form').validate({
                        rules: {
                            url:{
                                pattern: /(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/
                            },
                        },
                        messages: {
                            url: "Ingresar una dirección de Facebook valida."
                        }
                    });
                    $('#buttons').hide('fadeOut');
                    $('#btn-selected').html('<i class="fa fa-facebook"></i> Facebook');
                    $('#button-selected').show('fadeIn');
                }
                else if($(this).val() == 'tw'){
                    url = '@';
                    $('#form').validate({
                        rules: {
                            url:{
                                pattern: /(^|[^@\w])@(\w{1,15})\b/
                            },
                        },
                        messages: {
                            url: "El formato de usuario de Twitter no es valido"
                        }
                    });
                    $('#buttons').hide('fadeOut');
                    $('#btn-selected').html('<i class="fa fa-twitter"></i> Twitter');
                    $('#button-selected').show('fadeIn');
                }
                else if($(this).val() == 'in'){
                    url = '@';
                    $('#form').validate({
                        rules: {
                            url:{
                                pattern: /(^|[^@\w])@(\w{1,15})\b/
                            },
                        },
                        messages: {
                            url: "El formato de usuario de Instagram no es valido"
                        }
                    });
                    $('#buttons').hide('fadeOut');
                    $('#btn-selected').html('<i class="fa fa-instagram"></i> Instagram');
                    $('#button-selected').show('fadeIn');
                }
                else if($(this).val() == 'ln'){
                    url = 'http://linkedin.com/';
                    $('#form').validate({
                        rules: {
                            url:{
                                pattern: /(?:www\.)?linkedin\.com\/[a-z0-9_-]{3,16}$/
                            },
                        },
                        messages: {
                            url: "Ingresar una dirección de Linkedin valida."
                        }
                    });
                    $('#buttons').hide('fadeOut');
                    $('#btn-selected').html('<i class="fa fa-linkedin"></i> Linkedin');
                    $('#button-selected').show('fadeIn');
                }
                else 
                    {url = 'http://youtube.com/';
                    $('#buttons').hide('fadeOut');
                    $('#btn-selected').html('<i class="fa fa-youtube-square"></i> Youtube');
                    $('#button-selected').show('fadeIn');}
                
                $('#url').attr('placeholder',url+'empresa');
            });
        });

    </script>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Empresa</h2>
            <ol class="breadcrumb">
                <li><a href="{{ site_url('administrador/empresa') }}">Empresa</a></li>
                <li class="active">
                    <strong>Ingresar red social</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Selecciona la información</h2>
                        <div class="ibox-content">
                            {{ validation_errors() }}
                            {{ form_open('administrador/rs/guardar',array('id'=>'form')) }}
                                @include('admin.empresa.rs.form')
                            {{ form_close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
