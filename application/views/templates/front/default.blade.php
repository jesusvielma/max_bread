<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>MaxBread</title>
	<meta content="" name="description">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="width=device-width" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<link rel="shortcut icon" href="{{ base_url('assets/common/img/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="<?=base_url('assets/frontend/css/bootstrap-light.css')?>" rel="stylesheet">
	<link id="pagestyle" href="<?=base_url('assets/frontend/css/theme-light.css')?>" rel="stylesheet">
	<link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<!-- Sweet Alert -->
    <link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
	<style>
		.registro{
			display: none;
		}
	</style>
</head>

<body data-offset="50" data-spy="scroll" data-target=".navbar" class="dark-theme">
	<nav class="navbar navbar-fixed-top shadow" id="js-nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle" data-target="#myNavbar" data-toggle="collapse" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="#"> <img src="<?=base_url('assets/frontend/img/max_bread2.png')?>" alt="logo"> </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="#home">inicio</a></li>
					<li><a href="#products">productos</a></li>
					<li><a href="#about">Nosotros</a></li>
					<li><a href="#special">especial</a></li>
					<li><a href="#testimonials">testimonios</a></li>
					<li><a href="#contact">contacto</a></li>
					<li><a href="" data-target="#entrar" data-toggle="modal">Entrar</a></li>
				</ul>
			</div>
		</div>
	</nav>

    @yield('content')

	<div class="modal fade login-modal" id="entrar" role="dialog" tabindex="-1" >
		<div class="modal-dialog">
			<div class="modal-content shadow">
				<a class="close" data-dismiss="modal"> <span class="ti-close"></span></a>
				<div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-md-push-3">
								<h3 class="section-heading">Hola, bienvenido.</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-push-3">
								<div class="login">
									<h5>Iniciar sesión</h5>
									<form class="" action="index.html" method="post">
										<div class="form-group">
											<input type="text" name="" value="" class="form-control" placeholder="Correo electrónico">
										</div>
										<div class="form-group">
											<input type="password" name="" value="" class="form-control" placeholder="Contraseña">
										</div>
										<div class="form-group">
											<button type="button" name="button" class="btn btn-primary">Entrar</button>
										</div>
									</form>
									¿No tiene una cuenta?<a href="#" id="registro">Registrese</a><br>
									<a href="">¿Olvido su contraseña?</a>
								</div>
								<div class="registro">
									<h5>Registro</h5>
									<form class="" action="index.html" method="post" id="formRegistro">
										<div class="form-group">
											<label>¿Eres una empresa o una persona?</label>
											<div class="btn-group" data-toggle="buttons">
												  <label class="btn btn-primary" id="persona">
												    <input type="radio" name="options"  autocomplete="off"> Persona
												  </label>
												  <label class="btn btn-primary" id="empresa">
												    <input type="radio" name="options"  autocomplete="off"> Empresa
												  </label>
											</div>
										</div>
										<div class="form-group">
										    <label for="">RUT</label>
										    <input type="text" name="rut" class="form-control all" id="rut" value="{{ set_value('rut')!='' ? set_value('rut') : (isset($cliente) ? $cliente->rut : '') }}" required disabled>
										</div>
										<div class="form-group">
										    <label for="" id="nombre">Nombres y Apellidos</label>
										    <input type="text" name="nombre" class="form-control all" required value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($cliente) ? $cliente->nombre : '') }}" disabled>
										</div>
										<div class="form-group">
										    <label for="">Dirección</label>
										    <textarea disabled name="direccion" rows="4" class="form-control all" required>{{ set_value('direccion')!='' ? set_value('direccion') : (isset($cliente) ? $cliente->direccion : '') }}</textarea>
										</div>
										<div class="form-group">
										    <label for="">Teléfono</label>
										    <input type="text" name="telefono" class="form-control all" data-mask="+56 999-999-999" required value="{{ set_value('telefono')!='' ? set_value('telefono') : (isset($cliente) ? $cliente->telefono : '') }}" disabled>
										</div>
										<div class="form-group">
										    <label for="">Email</label>
										    <input type="email" name="correo" id="" class="form-control all" required value="{{ set_value('correo')!='' ? set_value('correo') : (isset($cliente) ? $cliente->correo : '') }}" disabled>
										</div>
										<div id="form_hide" style="display:none">
										    <div class="form-group">
										        <label for="">Nombre fantasia</label>
										        <input type="text" name="fantasia" class="form-control" id="fantasia" disabled value="{{ set_value('fantasia')!='' ? set_value('fantasia') : (isset($cliente) && $cliente->tipo == 'empresa' ? $cliente->nombre_fantasia : '') }}">
										    </div>
										    <div class="form-group">
										        <label for="">Persona Responsable</label>
										        <input type="text" name="responsable" class="form-control" id="responsable" disabled value="{{ set_value('responsable')!='' ? set_value('responsable') : (isset($cliente) && $cliente->tipo == 'empresa' ? $cliente->responsable : '') }}">
										    </div>
										</div>
										<div class="form-group">
											<button type="button" name="button" class="btn btn-primary">Registrarse</button>
										</div>
									</form>
									<a href="#" id="login">Inicar sesión</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-min">
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-push-4 text-center"> <img class="footer-logo" src="assets/frontend/img/max_bread2.png" alt="footer-logo">
						<div class="social">
							<ul>
								<li><a href="http://facebook.com/" target="_blank"><span class="ti-facebook"></span></a></li>
								<li><a href="https://twitter.com/" target="_blank"><span class="ti-twitter-alt"></span></a></li>
								<li><a href="http://linkedin.com/" target="_blank"><span class="ti-linkedin"></span></a></li>
								<li><a href="https://vimeo.com/" target="_blank"><span class="ti-vimeo-alt"></span></a></li>
								<li><a href="http://youtube.com/" target="_blank"><span class="ti-youtube"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- <div class="col-md-4 col-md-offset-4 col-sm-12">
						<div class="footer-newsletter">
							<div class="center text-center">
								<h4>stay tuned</h4>
								<form action="#" method="post">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="e-mail">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button"><span class="ti-arrow-right"></span></button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</footer>
	</div>
	<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/wow.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/jquery-1.11.2.min.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/swiper.min.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/jquery.countTo.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/jquery.inview.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/vendor/jquery.countdown.js')?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_6m6Glf1-P7jvVdHZ00e3Ue_EoUNe39g"></script>
	<script src="<?=base_url('assets/frontend/js/tt-cart.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/main.js')?>"></script>
	<script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
	<!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('#about').find('ul').addClass('styled-list');
			$('#registro').click(function () {
				$('.login').hide('fadeOut');
				$('.registro').show('fadeIn');
				$('#formRegistro .all').prop('disabled',false);
			});
			$('#login').click(function () {
				$('.registro').hide('fadeIn');
				$('.login').show('fadeOut');
			});
			$('#persona').click(function () {
				$('#nombre').text('Nombres y Apellidos');
                $('#form_hide').hide();
				$('#fantasia').prop('disabled',true).prop('required',false);
                $('#responsable').prop('disabled',true).prop('required',false);
			});
			$('#empresa').click(function () {
				$('#nombre').text('Razon Social');
                $('#fantasia').prop('disabled',false).prop('required',true);
                $('#responsable').prop('disabled',false).prop('required',true);
                $('#form_hide').fadeIn();
			});
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
		});
	</script>
</body>

</html>
