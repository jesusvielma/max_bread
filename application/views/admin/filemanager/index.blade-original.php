<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ base_url('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/backend/font-awesome/css/font-awesome.css') }}">
    <title>Mostrar archivo</title>
    <style >
        .seleccionar_imagen{
            cursor: pointer;
        }
        .seleccionar_imagen:hover{
            text-decoration: none;
        }
        .info {
            display: none;
            font-size: x-small;
            color: black;
            cursor: default;
        }
    </style>
</head>
<body style="padding: 2em">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="btn-group">
                <a href="{{ site_url('upload/carga?dir='.$dir.'&campo='.$campo) }}" class="btn btn-default"><i class="fa fa-upload"></i></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach ($files as $key => $file)
                    <a class="seleccionar_imagen" data-imagen="{{ $file->imagen }}" data-campo="{{ $campo }}">
                        <div class="col-md-2">
                            <img src="{{ $file->url_completa }}" alt="" class="img-responsive img-thumbnail" >
                            <dl class="info info info-{{ $key }}">
                                <dt>Nombre: </dt> <dd>{{ $file->imagen }}</dd>
                                <dt>Tamaño: </dt> <dd>{{ $file->file_size }}</dd>
                                <dt>Fecha: </dt> <dd>{{ strftime('%d de %B del %Y a las %r',$file->file_time) }}</dd>
                            </dl>
                        </a>
                            <div class="btn-group ">
                                <button class="btn btn-xs btn-default ver_imagen_grande" data-toggle="modal" data-target="#imagen" data-url="{{ $file->url_completa }}"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
                                <a href="{{ site_url('upload/borrar?dir='.$dir.'&campo='.$campo.'&file='.$file->imagen) }}" class="btn btn-xs btn-default"><i class="fa fa-times-circle"></i></a>
                                <button class="btn btn-xs btn-default show-info" data-info="{{ $key }}"><i class="fa fa-info-circle"></i></button>
                            </div>
                        </div>
                @endforeach
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
    <script src="{{ base_url('assets/backend/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ base_url('assets/backend/js/bootstrap.js') }}" charset="utf-8"></script>
    <script>
        $(document).ready(function () {
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
            $('.show-info').click(function () {
                var id = $(this).data('info');
                if (!$('.info-'+id).is(':visible')) {
                    $('.info-'+id).show('fadeIn');
                    setTimeout(function () {
                        $('.info-'+id).hide('fadeOut');
                    },5000);
                }
                else {
                    $('.info-'+id).hide('fadeOut');
                }
            });
        });
    </script>
</body>
</html>
