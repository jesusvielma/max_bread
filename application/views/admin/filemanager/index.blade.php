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
                                <a aria-expanded="false" role="button" href="{{ site_url('upload/carga?dir='.$dir.'&campo='.$campo) }}"> Subir <i class="fa fa-upload"></i></a>
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
                            <div class="col-lg-12">
                            @foreach ($files as $key => $file)
                                <div class="file-box">
                                    <div class="file">
                                        <a class="seleccionar_imagen" data-imagen="{{ $file->imagen }}" data-campo="{{ $campo }}" >
                                            <span class="corner"></span>
                                            <div class="image">
                                                <img alt="image" class="img-responsive" src="{{ $file->url_completa }}">
                                            </div>
                                            <div class="file-name">
                                                {{ $file->imagen }} <small>{{ $file->file_size }}</small>
                                                <br/>
                                                <small>Fecha: {{ strftime('%d/%b/%y %r',$file->file_time) }}</small>
                                            </div>
                                        </a>
                                        <div class="btn-group" style="width:100%; background-color: #f8f8f8;" >
                                            <button data-placement="top" title="Ver imagen en tamaño completo" class="btn btn-default tooltipBtn ver_imagen_grande" data-toggle="modal" data-target="#imagen" data-url="{{ $file->url_completa }}"><i class="fa fa-eye"></i></button>
                                            <a data-placement="top" title="Eliminar esta imagen" href="{{ site_url('upload/borrar?dir='.$dir.'&campo='.$campo.'&file='.$file->imagen) }}" class="btn btn-default tooltipBtn"><i class="fa fa-times-circle"></i></a>
                                        </div>
                                    </div>
                                </div>                                
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal inmodal fade" id="imagen" tabindex="-6" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="" alt="" class="img-responsive" id="imagen_modal">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
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


    <script>
        $(document).ready(function () {
            $('.tooltipBtn').tooltip();
            $('.file-box').each(function () {
                animationHover(this, 'pulse');
            });
            $('.ver_imagen_grande').click(function () {
                var url = $(this).data('url');
                $('#imagen_modal').attr('src',url);
            });
            $('.seleccionar_imagen').click(function () {
                var imagen = $(this).data('imagen');
                var campo = $(this).data('campo');
                var dir = '{{ $dir }}';
                parent.setImage(imagen,campo,dir);

            });
        });
    </script>

</body>

</html>