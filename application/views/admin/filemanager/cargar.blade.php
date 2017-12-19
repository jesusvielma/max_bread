<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ base_url('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/backend/font-awesome/css/font-awesome.css') }}">
    <link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <title>Cargar archivo</title>
</head>
<body style="padding: 2em">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="btn-group">
                <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
    <br>
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
                <span class="help-block m-b-none font-bold">La imagen no puede pesar mas de 3Mb </span>
            </div>
            {{ form_close() }}
        </div>
    </div>
    <script src="{{ base_url('assets/backend/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ base_url('assets/backend/js/bootstrap.js') }}" charset="utf-8"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
