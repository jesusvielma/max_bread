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
        .registroClave{
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
					@if ($this->session->userdata('front'))
						<li><a href="{{ site_url('login/salir') }}" >Salir</a></li>
					@else
						<li><a href="" data-target="#entrar" data-toggle="modal">Entrar</a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
    @yield('content')
	@if (!$this->session->userdata('front'))
		@include('front.loginRegistro')
	@endif
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
	{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_6m6Glf1-P7jvVdHZ00e3Ue_EoUNe39g"></script> --}}
	<script src="<?=base_url('assets/frontend/js/tt-cart.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/main.js')?>"></script>
	@yield('js')
</body>

</html>
