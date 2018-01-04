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
	<script src="<?=base_url('assets/frontend/js/shoppingCart.js')?>"></script>
	<script src="<?=base_url('assets/frontend/js/main.js')?>"></script>
	<script>

		$(".add-item").click(function(event){
			event.preventDefault();
			var name = $(this).data("name");
			var price = Number($(this).data("cost"));
			var itemId = Number($(this).data("id"));
			var image = $(this).data("image");


			shoppingCart.addItemToCart(name, itemId, price, image, 1);
			displayCart();
		});

		$("#clear-cart").click(function(event){
			shoppingCart.clearCart();
			displayCart();
		});

		function displayCart() {
			var cartArray = shoppingCart.listCart();
			//console.log(cartArray);
			var output = "";

			for (var i in cartArray) {
				output+= "<div class='cart-item ' id='item' data-id=''>";
				output+= "<span class='cart-item-image'><img alt='"+ cartArray[i].name +"' src='"+ cartArray[i].image +"'/></span>";
				output+= "<span class='cart-item-name h4'>"+ cartArray[i].name +"</span>";
				output+= "<span class='cart-item-price'>$<span class='cvalue'>"+ cartArray[i].price +"</span>CLP</span>";
				output+= "<br /><div style='display:inline-block'>";
				output+= "<input type='number' data-id='"+ cartArray[i].itemId +"' name='itemCant["+ cartArray[i].itemId +"]' value='"+ cartArray[i].count +"' class='form-control item-count' min='1'/> <input type='hidden' name='itemId["+ cartArray[i].itemId +"]' value='"+ cartArray[i].itemId +"'/>"
				output+= "<span class='cart-item-remove' data-id='"+ cartArray[i].itemId +"'><span class='ti-close'></span></span>";
				output+= "<span class='cart-item-plus' data-id='"+ cartArray[i].itemId +"'><span class='ti-plus'></span></span>";
				if (cartArray[i].count > 1) {
					output+= "<span class='cart-item-minus' data-id='"+ cartArray[i].itemId +"'><span class='ti-minus'></span></span>";
				}
				output+= "</div>";
				output+= "</div>";
			}

			$("#items").html(output);
			var count = shoppingCart.countCart();
			var counterHTML = "<span class='animate'>"+ count;
			counterHTML+= "<span class='circle'></span></span>";
			if (count>0) {
				$("#cart-empty").hide('fadeOut');
				$("#items-counter").html(counterHTML).show();
				$('#clear-cart').show('fadeInUp');
				$('#pedir').show('fadeIn');
			}else {
				$("#cart-empty").show('fadeInUp');
				$("#items-counter").html('0').hide();
				$('#clear-cart').hide('fadeOut');
				$('#pedir').hide('fadeOut');
			}
			$("#total-total").html( shoppingCart.totalCart() );
		}

		$("#items").on("click", ".cart-item-remove", function(event){
			var itemId = $(this).data("id");
			shoppingCart.removeItemFromCartAll(itemId);
			displayCart();
		});

		$("#items").on("click", ".cart-item-minus", function(event){
			var itemId = $(this).data("id");
			shoppingCart.removeItemFromCart(itemId);
			displayCart();
		});

		$("#items").on("click", ".cart-item-plus", function(event){
			var itemId = $(this).data("id");
			shoppingCart.addItemToCart('',itemId, 0, '', 1);
			displayCart();
		});

		$("#items").on("change", ".item-count", function(event){
			var itemId = $(this).data("id");
			var count = Number($(this).val());
			shoppingCart.setCountForItem(itemId, count);
			displayCart();
		});


		displayCart();

		$('#pedir').click(function (event) {
			$('#pedido').submit();
		});

		$("#entrarBotonCart").click(function() {
	        $("body").toggleClass("cart-widget-open");
			$("#items-counter").hide();
	    });

		@if ($this->session->flashdata('pedido'))
			shoppingCart.clearCart();
			displayCart();
		@endif

	</script>
	@yield('js')
</body>

</html>
