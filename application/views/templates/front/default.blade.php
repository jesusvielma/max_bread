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
	<link href="<?=base_url('assets/backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
	<link id="pagestyle" href="<?=base_url('assets/frontend/css/theme-light.css')?>" rel="stylesheet">

	<link href="{{ base_url('assets/backend/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert -->
	<link href="{{ base_url('assets/backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
	<style>
		.cart-item-name .oferta{
			color: #ff9800;
    		font-size: 10px;
		}
		.pedidos tr:nth-child(odd) .oferta{
			color: black;
    		font-size: 13px;
		}

		.pedidos tr:nth-child(even) .oferta{
			color: #ff9800;
    		font-size: 13px;
		}
		.producto-marca {
			display: none;
		}
		
	</style>
	@yield('css')
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

				<a class="navbar-brand" href="{{ site_url() }}"> <img src="<?=base_url('assets/frontend/img/max_bread2.png')?>" alt="logo"> </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					@if ($this->uri->uri_string() == '')
						@if ($slider->count() > 0)	
						<li><a href="#inicio">inicio</a></li>
						@else
						<li><a href="{{ site_url() }}">inicio</a></li>
						@endif
						@if ($productos->count() > 0 )
						<li><a href="#productos">productos</a></li>
						@endif
						<li><a href="#nosotros">Nosotros</a></li>
						@if ($ofertas->count() > 0 )	
						<li><a href="#ofertas">ofertas</a></li>
						@endif
						@if ($testimonios->count() > 0 )
						<li><a href="#comentarios">comentarios</a></li>
						@endif
						<li><a href="#contacto">contacto</a></li>
						@if ($this->session->userdata('front'))
							<li><a href="{{ site_url('mi_cuenta') }}">Mi Cuenta</a></li>
							<li><a href="{{ site_url('login/salir') }}" >Salir</a></li>
						@else
							<li><a href="" data-target="#entrar" data-toggle="modal">Entrar</a></li>
						@endif
					@else
						<li><a href="{{ site_url() }}">inicio</a></li>
						<li><a href="#perfil">Perfil</a></li>
						<li><a href="#pedido">pedido</a></li>
						<li><a href="#testimonials">mis testimonios</a></li>
						<li><a href="{{ site_url('login/salir') }}" >Salir</a></li>
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
					<div class="col-md-4 col-md-push-4 text-center"> 
						<img class="footer-logo" src="assets/frontend/img/max_bread2.png" alt="footer-logo">
						@if (isset($redes) && $redes->count() > 0 )	
							<div class="social">
								<ul>
									@foreach ($redes as $red)
										@if ($red->tipo == 'fb')
											<li><a href="{{ $red->url }}" target="_blank"><span class="ti-facebook"></span></a></li>
										@endif
										@if ($red->tipo == 'tw')
											<li><a href="{{ $red->url }}" target="_blank"><span class="ti-twitter-alt"></span></a></li>
										@endif
										@if ($red->tipo == 'in')
											<li><a href="{{ $red->url }}" target="_blank"><span class="ti-instagram"></span></a></li>
										@endif
										@if ($red->tipo == 'ln')
											<li><a href="{{ $red->url }}" target="_blank"><span class="ti-linkedin"></span></a></li>
										@endif
										@if ($red->tipo == 'yb')
											<li><a href="{{ $red->url }}" target="_blank"><span class="ti-youtube"></span></a></li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
						@endif
					</div>
					<div class="clearfix"></div>
					<div class="col-md-4 col-md-offset-4 col-sm-12">
						<div class="footer-newsletter">
							<div class="center text-center">
								<h4>Diseño y Desarrollo por </h4>
								<a href="http://jesusvielma.github.io" target="_blank">Jesus Vielma</a> y Mayerli Pirela 2017-2018
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="modal fade login-modal" id="comentarioModal" role="dialog" tabindex="-1" >
		    <div class="modal-dialog">
		        <div class="modal-content shadow">
		            <a class="close" data-dismiss="modal"> <span class="ti-close"></span></a>
		            <div class="modal-body">
		                <div class="container">
		                    <div class="row">
		                        <div class="col-md-4 col-md-push-3">
		                            <h3 class="section-heading">Dejanos tus comentarios</h3>
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-4 col-md-push-3">
	                                {{ form_open('mi_cuenta/comentario',['id'=>'comentarioForm']) }}
	                                    <div class="form-group">
	                                        <textarea name="comentario" rows="5" class="form-control" maxlength="255" id="comment"></textarea>
											<span class="help-block" id>Tu comentario debe tener un maximo de 255 carácteres, <span class="text-primary" id="commentRaminColor">te quedan <span id="commentRemain">255</span> carácteres.</span></span>
	                                    </div>
										<input type="hidden" name="_referrer" value="{{ $this->uri->segment(1) }}">
										<div class="form-group">
											<button class="btn btn-primary">Enviar</button>
										</div>
	                                </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
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
		$('#comment').keyup(function () {
			var used = $(this).val(), remain = 255;
			remain = remain - used.length;
			if (remain<255/4) {
				$('#commentRaminColor').removeClass('text-primary').addClass('text-danger');
			}
			else if (remain>255/4) {
				$('#commentRaminColor').removeClass('text-danger').addClass('text-primary');
			}
			$('#commentRemain').html(remain);
		});
		$('.producto-marca-select').click(function(e){
			e.preventDefault();
			var marca = $(this).data('marca');
			console.log(marca);
			$('.producto-marca').show();
			$('.producto-marca-li').each(function (){
				var marcaP = $(this).data('producto-marca');
				if(marca != marcaP)
				$(this).hide();
			});
			var swiper = new Swiper('.product-list-slider', {
				slidesPerView: 3,
				pagination: '.product-list-pagination',
				paginationClickable: true,
				nextButton: '.product-list-slider-next',
				prevButton: '.product-list-slider-prev',
				spaceBetween: 30,
				breakpoints: {
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					640: {
						slidesPerView: 2,
						spaceBetween: 20
					},
					420: {
						slidesPerView: 1,
						spaceBetween: 10
					}
				}
			});

		})
	</script>
	@if ($this->uri->segment(1) == '')

		<script>

		$(".add-item").click(function(event){
			event.preventDefault();
			var name = $(this).data("name");
			var price = Number($(this).data("cost"));
			var itemId = Number($(this).data("id"));
			var image = $(this).data("image");
			var oferta = $(this).data('oferta') ? $(this).data('oferta') : 0;

			var cartArray = shoppingCart.listCart();
			if(cartArray.length > 0 ){
				for(var i in cartArray){
					if(cartArray[i].itemId == itemId && oferta > 0 ){
						var cant = cartArray[i].count +1;
						shoppingCart.removeItemFromCart(cartArray[i].itemId);
						shoppingCart.addItemToCart(name, itemId, price, image, oferta, cant);		
					}else{
						shoppingCart.addItemToCart(name, itemId, price, image, oferta, 1);
					}
				}
			}else{
				shoppingCart.addItemToCart(name, itemId, price, image, oferta, 1);
			}
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
				output+= "<div class='cart-item ' id='item' data-id='"+ cartArray[i].itemId +"'>";
				output+= "<span class='cart-item-image'><img alt='"+ cartArray[i].name +"' src='"+ cartArray[i].image +"'/></span>";
				output+= "<span class='cart-item-name h4'>"+ cartArray[i].name +(cartArray[i].oferta > 0 ? '<em class="oferta">[Oferta]</em>': '')+"</span>";
				output+= "<span class='cart-item-price'>$<span class='cvalue'>"+ cartArray[i].price +"</span>CLP</span>";
				output+= "<br /><div style='display:inline-block'>";
				output+= "<input type='number' data-id='"+ cartArray[i].itemId +"' name='itemCant["+ cartArray[i].itemId +"]' value='"+ cartArray[i].count +"' class='form-control item-count' min='1'/> <input type='hidden' name='itemId["+ cartArray[i].itemId +"]' value='"+ cartArray[i].itemId +"'/> <input type='hidden' name='itemOferta["+ cartArray[i].itemId +"]' value='"+ cartArray[i].oferta +"'>"
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
			shoppingCart.addItemToCart('',itemId, 0, '','', 1);
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
	@endif
	@yield('js')
	@yield('jsLogin')
</body>

</html>
