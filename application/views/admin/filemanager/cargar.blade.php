<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ site_name() }} Administrador | FileManager</title>

    <link href="{{ base_url('assets/backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed"
                            type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="#" class="navbar-brand">FileManager</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a aria-expanded="false" role="button" href="javascript:history.back()"><i class="fa fa-arrow-left"> </i>Ir atras</a>
                            </li>                            
                        </ul>
                        <!-- <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="login.html">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12 animated fadeInRight">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-4">
                            @if (isset($error))
                                <div class="alert alert-warning">
                                    {{ $error }}
                                </div>
                            @endif
                            {{ form_open_multipart('upload/do_upload') }}
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                                    <img alt="" class="img-responsive center-block" src="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">Selecciona una imagen</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="imagen" value="" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="dir" value="{{ $dir }}">
                                        <input type="hidden" name="campo" value="{{ $campo }}">
                                    </span>
                                    <button type="submit" class="btn btn-success fileinput-exists"><i class="fa fa-upload"></i> Subir</button>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                </div>
                                <span class="help-block m-b-none font-bold">La imagen no puede pesar mas de 1Mb </span>
                            </div>
                            {{ form_close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer fixed">
                <div class="pull-right">
                    2018
                </div>
                <div>
                    <strong> Jesús Vielma &copy;</strong>
                </div>
            </div>

        </div>
    </div>



    <!-- Mainly scripts -->
    <script src="{{ base_url('assets/backend/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/bootstrap.min.js')}}"></script>
    <script src="<?=base_url('assets/backend/js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
        <script src="<?=base_url('assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ base_url('assets/backend/js/inspinia.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function () {
        });
    </script>

</body>

</html>