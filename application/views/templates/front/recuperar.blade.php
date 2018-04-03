@extends('templates.front.default')
@section('css')
<style>
    .countdown-counter li {
        background: #FF9800;
    }
    .countdown-container p {
        color: #FFFFFF;
    }
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
                <h3 class="section-heading">Cambio de clave</h3>
            </div>
            @if ($token != '')
                <div class="col-md-7 overflow-hidden wow fadeInLeft" id="about1">
                    {{ form_open('recuperar',['id'=>'form']) }}
                        <div class="form-group">
                            <input type="password" class="form-control" id="clave" name="clave" placeholder="Nueva clave" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confClave" name="confClave" placeholder="Repite tu nueva clave" required>
                        </div>
                        <input type="hidden" id="token" name="token" value="{{ $token }}">
                        <button type="button" id="submitCambio" class="btn btn-primary">Recuperar</button>
                    </form>
                </div>
                <div class="col-md-5 text-center">
                    <h3>Tiempo restante</h3>
                    <div class="countdown-container">
                    <p>Este el tiempo que te resta para realizar el cambio de clave </p>
                        <!-- data in countdown ul from js -->
                        <ul id="countdownPassword" class="countdown-counter wow fadeInUp"></ul>
                        <!-- data in countdown ul from js -->
                    </div>
                </div>
            @else
                <div class="col-md-6 col-md-push-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="token" placeholder="Ingresa el token que recibiste" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" id="tokenBtn" type="button">Verificar código</button>
                    </div>
                </div> 
            @endif

        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ base_url('assets/backend/js/plugins/fullcalendar/moment-timezone-with-data.js') }}"></script>

<script>
@if ($token != '' && $tokenInvalido == 0)
var tiempo = moment.tz('{{ $res->validez->toDateTimeString() }}','America/Santiago');
    $('#countdownPassword').countdown(tiempo.toDate(), function(event) {
        var $this = $(this).html(event.strftime(''
        //+ '<li><span>%w</span> weeks</li> '
        // + '<li><span>%D</span> dias</li> '
        // + '<li><span>%H</span> horas</li> '
        + '<li><span>%M</span> minuto%!M</li> '
        + '<li><span>%S</span> segundo%!S</li>'));
    });
@endif

    $(document).ready(function (){
        $('#tokenBtn').click(function (){
            var token = $('#token').val();
            if(token != '')
            location.href = '{{ site_url('recuperar/') }}'+token;
            else{
                swal({
                    title: "Opps, hay un problema",
                    text:  "Debes ingresar un token para continuar",
                    type: "error",
                    confirmButtonText: "Ok"
                });
            }
        });
        @if ($tokenInvalido == 1)
            swal({
                title: "Opps, hay un problema",
                text:  "Sentimos informarte que el código ingresado para esta solicitud ha caducado o ya no existe, por favor inicia el proceso de nuevo.",
                type: "error",
                confirmButtonText: "Ir allá"
                },function(){
                    location.href = '{{ site_url() }}';
                });
        @endif
        @if ($token != '' && $tokenInvalido == 0)    
        setTimeout(function (){
            swal({
                title: "El tiempo se ha agotado",
                text:  'Comienza de nuevo el proceso.',
                type: "error",
                confirmButtonText: "Ir allá",
            }, function (isConfirm){
                var token = $('#token').val();
                if(isConfirm){
                    location.href= '{{ site_url('recuperar/agotado/') }}'+token;
                }
            });
        },{{ $diff }})
        @endif
    });
    $('#submitCambio').click(function (e) {
        e.preventDefault();
        var clave = $('#clave').val();
        var confClave = $('#confClave').val();
        var errors = '';
        if(clave == ''){
            errors += '<li>No puedes cambiar tu clave y no escribir una nueva clave</li>';
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
        if(!validarClave(clave) ){
            errors += '<li>La nueva clave debe tener una combinación de letras mayúsculas y minúsculas, números y carácteres especiales</li>';
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
                text: "Ahora vamos a realizar el cambio de clave, si todo sale bien podrás ir la pagina de inicio e iniciar sesión con tu cuenta.",
                type: "info",
                timer: 5000
            });
            $.post('{{ site_url('recuperar/recuperar') }}',$('#form').serialize(), function (data) {
                if(data.error){
                    swal({
                        title: "Parece que los datos no son validos",
                        text:  '<ul class="styled-list">'+data.error+'</ul>',
                        type: "error",
                        confirmButtonText: "Revisar",
                        html: true
                    });
                    var csrfName = data.csrf.name;
                    var csrfHash = data.csrf.hash;
                    $('input[name='+csrfName+']').val(csrfHash);
                }else{
                    var csrfName = data.csrf.name;
                    var csrfHash = data.csrf.hash;
                    $('input[name='+csrfName+']').val(csrfHash);
                    swal({
                        title: "¡Felicidades!",
                        text:  'Haz completado el proceso de recuperación de tu clave cuando presiones el botón aceptar serás redirigido a la pagina de inicio.',
                        type: "success",
                        confirmButtonText: "Aceptar",
                    }, function (){
                        location.href = '{{ site_url() }}';
                    });
                }
            });
        }
    });
</script>
@endsection