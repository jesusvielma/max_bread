@extends('templates.front.default')
@section('css')
<style>
    .form-control {
        color: #FFFFFF;
    }
    .form-control::-moz-placeholder {
        color: #FFF;
        opacity: 1;
        font-weight: 800;
    }
    .form-control:-ms-input-placeholder {
        color: #FFF;
        font-weight: 800;
    }
    .form-control::-webkit-input-placeholder {
        color: #FFF;
        font-weight: 800;
    }
</style>
@endsection
@section('content')
<section class="about white-color">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-heading">Hola {{ $usuario->cliente->tipo == 'natural' ? $usuario->cliente->nombre : $usuario->cliente->responsable.' de '.$usuario->cliente->nombre}}</h3>
                @if ($validado == 'false')    
                    <p>Estamos felices de que estes aquí, estas viendo este formulario puesto que tus datos están fueron ingresados en el sitio por el administrador, completa tu perfil y comienza a usar {{ site_name() }}.</p>
                @else
                    <p>Lo sentmimos pero ya se ha validado este perfil</p>
                @endif
            </div>
            @if ($validado == false)
                <div class="col-md-6 col-md-push-3 overflow-hidden wow fadeInLeft" id="about1">
                    {{ form_open_multipart('validar/'.$tokenOrg.'/2',['id'=>'form']) }}
                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                    <img alt="" class="img-responsive center-block" src="{{ $usuario->avatar == '' ? base_url('assets/common/img/user.png') : base_url('assets/common/uploads/profile/'.$usuario->cliente->rut.'/'.$usuario->avatar) }}">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Selecciona una imagen</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="imagen" value="" accept=".png, .jpg, .jpeg" id="imagen">
                                    </span>
                                    {{-- <button type="submit" class="btn btn-success fileinput-exists"><i class="fa fa-upload"></i> Subir</button> --}}
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                </div>
                                <span style="color:#fff" class="help-block m-b-none font-bold">La imagen no puede pesar mas de 1Mb. Consejo, tu imagen de perfil debería de ser cuadrada.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="clave" name="clave" placeholder="Nueva clave" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confClave" name="confClave" placeholder="Repite tu nueva clave" required>
                        </div>
                        <button type="button" id="comenzar" class="btn btn-primary">Comenzar</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('js')

<script>
    $(document).ready(function (){
        @if ($validado == true)
            swal({
                title: "No puedes estar aquí",
                text:  'Lo sentimos, el perfil que intentas validar ya  ha sido validado, seras redirigido al la pagina de inicio para inicies sesión, si no recuerdas tus datos de acceso puedes ingresar en Olvido su clave.',
                type: "error",
                confirmButtonText: "De Acuerdo",
            },function (){
                location.href = '{{ site_url() }}'
            });
        @endif

        $('#comenzar').click(function (e) {
            e.preventDefault();
            var clave = $('#clave').val();
            var confClave = $('#confClave').val();
            var errors = '';
            if(clave == ''){
                errors += '<li>Ingresa una clave para seguir</li>';
            }
            function validarClave (value){
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
            }
            if(confClave != clave){
                errors += '<li>Las claves no coinciden entre si.</li>'
            }
            if(!validarClave(clave) && clave != ''){
                errors += '<li>La nueva clave debe tener una combinación de letras mayúsculas y minúsculas, números y caracteres especiales</li>';
            }
            var file = $('#imagen');
            if(file[0].value == ''){
                errors += '<li>Carga una foto para tu cuenta</li>';
            }else{
                var file_size = file[0].files[0].size/1024;
                file_size = file_size.toPrecision(4);

                if(file_size > 1024 ){
                    errors += '<li>Tu foto es muy pesada, por favor escoge una mas liviana.</li>';
                }
            }
            if(errors != ''){
                swal({
                    title: "Hay errores en la información",
                    text:  'Verifica los errores siguientes: <ul class="styled-list">'+errors+'</ul>',
                    type: "error",
                    confirmButtonText: "Verificar",
                    html: true
                });
            }
            else {
                swal({
                    title: "¡Perfecto!",
                    text: "Vamos a procesar la solicitud una vez hecha habrás iniciado sesión",
                    type: "info",
                    timer: 5000
                },function (){
                    $('#form').submit();
                });

            }
        });
    });
</script>
@endsection