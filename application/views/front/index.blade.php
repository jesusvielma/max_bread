@extends('templates.front.default')
@section('content')
    @if ($slider->count()>0)
        <section class="home section image-slider" id="home">
            <div class="home-slider text-center">
                <div class="swiper-wrapper">
                    @foreach ($slider as $slide)
                        <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.$slide->url) }});">
                            <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
                            <h2 class="home-slider-title-main">{{ $slide->texto_imagen }}</h2>
                            <div class="home-buttons text-center"> <a href="#products" class="btn btn-lg  btn-primary">{{ $slide->texto_boton }}</a> </div>
                            <a class="arrow bounce text-center" href="#about"> <span class="ti-mouse"></span> <span class="ti-angle-double-down"></span> </a>
                        </div>
                    @endforeach
                </div>
                <div class="home-pagination"></div>
                <div class="home-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
                <div class="home-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
            </div>
        </section>
    @endif

    <span id="items-counter" class="h3 cart-items-counter" style="display: none">0</span>
    <div class="cart-widget-container">
        <div class="cart-widget text-center">
            <a class="close" id="cart-widget-close">
                <span class="ti-close"></span>
            </a>
            <img class="cart-logo" src="{{ base_url('assets/frontend/img/max_bread2.png') }}" width="200" alt="store logo">
            <h3 class="section-heading">Su pedido</h3>
            <div id="cart-empty" class="cart-empty"><h4>esta vacio. <span class="ti-face-sad icon"></span> </h4></div>
            {{ form_open('pedido/ingresar',['id'=>'pedido']) }}
                <!-- container for js inject cart items content -->
                <div class="items-container" id="items"></div>
                <!-- container for js inject cart items content -->
            {{ form_close() }}
            <div>
        		<button class="btn btn-primary" id="clear-cart" type="button">Borrar pedido</button>
        	</div>
            <div class="cart-summary" id="cart-summary">
                <h4 class="section-heading">Resumen</h4>
                <!--<div class="cart-summary-row" id="cart-total">Total productos <span class="cart-value">$<span id="cost_value">0.00</span></span>CLP
                </div>
                <div class="cart-summary-row">Shipping <span class="cart-value">$<span id="cost_delivery">0</span></span></div-->
                <div class="cart-summary-row cart-summary-row-total">Total <span class="cart-value">$<span id="total-total"></span>CLP</span></div>
            </div>
            @if (!$this->session->userdata('front'))
                <div>
                    <h4 class="section-heading">No haz iniciado sesion</h4>
                    <p>Aun no haz inicado tu sesión, ingresa con tu correo y contraseña para que puedas realizar tu pedido</p>
            		<button class="btn btn-primary" id="entrarBotonCart" data-target="#entrar" data-toggle="modal" type="button">Entrar</button>
            	</div>
            @else
                <div>
                    <button class="btn btn-primary" id="pedir" type="button">Relizar pedido</button>
                </div>
            @endif
        </div>
        <div class="cart-widget-close-overlay"></div>
    </div>
    @if ($productos->count()>0)
        <section class="section-min section product white-bg" id="products">
            <div class="container overflow-hidden">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-heading">Productos</h3>
                    </div>
                </div>
                @foreach ($productos as $cat)
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="section-heading">{{ $cat->nombre }}</h4>
                        </div>
                        @if ($cat->productos->count() > 0 )
                            <div class="col-md-12">
                                <div class="product-list-slider">
                                    <ul class="swiper-wrapper product-list product-list-vertical">
                                        @foreach ($cat->productos as $producto)
                                            <li class="swiper-slide wow fadeInUp text-center" data-wow-delay=".2s">
                                                <span class="product-list-left pull-left">
                                                    @foreach ($producto->imagen as $imagen)
                                                        @if ($imagen->puesto == 1)
                                                            @php
                                                            $img_prin = $imagen->url;
                                                            @endphp
                                                        @elseif ($imagen->puesto == 2)
                                                            @php
                                                            $img_seg = $imagen->url;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <a href="#" data-target="#product-{{ $producto->id_producto }}" data-toggle="modal">
                                                        <img alt="" class="product-list-primary-img" src="{{ base_url('assets/common/uploads/'.$img_prin) }}">
                                                        <img alt="" class="product-list-secondary-img" src="{{ base_url('assets/common/uploads/'.$img_seg) }}">
                                                    </a>

                                                </span>

                                                <a href="#" data-target="#product-{{ $producto->id_producto }}" data-toggle="modal">
                                                    <span class="product-list-right pull-left">
                                                        <span class="product-list-name h4 black-color">{{ $producto->nombre }}</span>
                                                        <span class="product-list-price">${{ $producto->precio_por_menor }}CLP</span>
                                                    </span>
                                                </a>

                                                <button class="btn btn-default add-item" type="button" data-image="{{ base_url('assets/common/uploads/'.$img_prin) }}" data-name="{{ $producto->nombre }}" data-cost="{{ $producto->precio_por_menor }}" data-id="{{ $producto->id_producto }}" >
                                                    <span class="ti-shopping-cart"></span>Pedir
                                                </button>

                                            </li>

                                            @endforeach
                                        </ul>
                                        <!-- Add Pagination -->
                                        <div class="product-list-pagination text-center"> </div>
                                        <div class="product-list-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
                                        <div class="product-list-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <h6>Lo sentimos pero aún no hay productos en esta categoria</h6>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @foreach ($productos as $cat)
                @foreach ($cat->productos as $producto)
                    <!-- PRODUCT MODAL -->
                    <div class="modal fade product-modal" id="product-{{ $producto->id_producto }}" role="dialog" tabindex="-1">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content shadow">
                                <a class="close" data-dismiss="modal"> <span class="ti-close"></span></a>
                                <div class="modal-body">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel slide product-slide" id="product-carousel-{{ $producto->id_producto }}">
                                        <div class="carousel-inner cont-slider">
                                            @foreach ($producto->imagen as $imagen1)
                                                <div class="item {{ $imagen1->puesto == 1 ? 'active' : '' }}"> <img alt="" src="{{ base_url('assets/common/uploads/'.$imagen1->url) }}" title=""> </div>
                                            @endforeach
                                        </div>
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @foreach ($producto->imagen as $imagen2)
                                                <li class="{{ $imagen2->puesto == 1 ? 'active' : '' }}" data-slide-to="{{ $imagen2->puesto -1  }}" data-target="#product-carousel-{{ $producto->id_producto }}"> <img alt="" src="{{ base_url('assets/common/uploads/'.$imagen2->url) }}"> </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                    <!-- Wrapper for slides -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-md-push-2">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h3 class="pull-left section-heading">{{ $producto->nombre }}</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="product-right-section">
                                                            <span>${{ $producto->precio_por_menor }}CLP</span>
                                                            <button class="btn btn-default add-item" type="button" data-image="{{ base_url('assets/common/uploads/'.$img_prin) }}" data-name="{{ $producto->nombre }}" data-cost="{{ $producto->precio_por_menor }}" data-id="8">
                                                                <span class="ti-shopping-cart"></span>Pedir </button>
                                                            </span>
                                                            @php
                                                                $img_prin='';
                                                            @endphp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-push-2 product-description">
                                                    {{ $producto->descripcion }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / PRODUCT MODAL -->
                @endforeach

            @endforeach
        </section>
    @endif

    <section class="about white-color" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Sobre Nosotros</h3>
                </div>
                <div class="col-md-7 overflow-hidden wow fadeInLeft" id="about1">
                    <h4>Best furniture ever!</h4>
                    @foreach ($abouts as $about)
                        {{ $about->descripcion }}
                    @endforeach
                </div>
                <div class="col-md-4 col-md-push-1 wow fadeInRight">
                    <h4>Our mission</h4>
                    <ul class="">
                        <li>1. Duis aute irure dolor </li>
                        <li>2. Excepteur sint occaecat</li>
                        <li>3. Deserunt mollit anim</li>
                        <li>4. Nostrud exercitation</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="countdown" id="special">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">special!</h3>
                </div>
                <div class="col-md-5">
                    <ul class="product-list product-list-vertical">
                        <li class="wow fadeInUp" data-wow-delay=".2s">
                            <span class="product-list-left pull-left">
                                    <a href="#" data-target="#product-01" data-toggle="modal">
                                        <img alt="product image" class="product-list-primary-img" src="assets/frontend/img/product3.png">
                                        <img alt="product image" class="product-list-secondary-img" src="assets/frontend/img/product4.png">
                                    </a>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 text-center">
                    <div class="countdown-container">
                        <h3 class="wow fadeInDown">Yellow textile chair</h3>
                        <p class="wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        <!-- data in countdown ul from js -->
                        <ul id="countdown" class="countdown-counter wow fadeInUp"></ul>
                        <!-- data in countdown ul from js --><span class="countdown-price h3 wow fadeInUp">$420.00</span>
                        <button class="btn btn-default add-item wow swing" type="button" data-image="assets/frontend/img/product.png" data-name="Yellow textile chair [promo]" data-cost="420.00" data-id="9">
                            <span class="ti-shopping-cart"></span>add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($testimonios->count()>0)
        <section class="testimonials" id="testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-heading white-color">Testimonios</h3>
                    </div>
                    <div class="testimonials-slider text-center col-md-12">

                        <div class="swiper-wrapper">
                            @foreach ($testimonios as $testimonio)
                                <div class="swiper-slide">
                                    <div class="testimonials-container shadow"> <img alt="user avatar" class="wow fadeInUp" src="{{ base_url('assets/common/uploads/profile/'.$testimonio->cliente->rut.'/'.$testimonio->cliente->usuario->avatar) }}">
                                        <h3 class="wow fadeInUp" data-wow-delay=".4s">
                                            {{ $testimonio->cliente->tipo == 'natural' ? $testimonio->cliente->nombre : $testimonio->cliente->responsable}}
                                            @if ($testimonio->cliente->tipo == 'empresa')
                                                <span>{{ $testimonio->cliente->nombre }}</span>
                                            @endif
                                        </h3>
                                        <p class="wow fadeInUp" data-wow-delay=".6s">
                                            {{ $testimonio->comentario }}
                                        </p>
                                        <p class="wow fadeInUp fecha" data-wow-delay=".6s">
                                            <i class="fa fa-calendar"></i> {{ $testimonio->fecha->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="testimonials-pagination"></div>
                        <div class="testimonials-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
                        <div class="testimonials-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
                    </div>
                    @if ($this->session->userdata('front'))
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary" data-target="#comentarioModal" data-toggle="modal">Agregar otro testomonio/comentario</button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- <section class="text-center shadow section section-min">
        <div class="about-counter" id="about-counter">

            <div class="container">
                <div class="row">
                    <div class="col-md-3 wow fadeInLeft about-counter-single" data-wow-delay="0.2s" data-wow-duration="1s" data-wow-offset="0">
                        <div class="counter"> <span class="ti-crown icon"></span>
                            <h2 class="timer">250</h2>
                            <p> Projects Finished </p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInLeft about-counter-single" data-wow-delay="0.3s" data-wow-duration="1s" data-wow-offset="0">
                        <div class="counter"> <span class="ti-shortcode icon"></span>
                            <h2 class="timer">28256</h2>
                            <p> Line Of Coding </p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInLeft about-counter-single" data-wow-delay="0.4s" data-wow-duration="1s" data-wow-offset="0">
                        <div class="counter"> <span class="ti-cup icon"></span>
                            <h2 class="timer">42</h2>
                            <p> Award Won </p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1s" data-wow-offset="0">
                        <div class="counter"> <span class="ti-comments-smiley icon"></span>
                            <h2 class="timer">240</h2>
                            <p> Satisfied Clients </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->



    <section id="contact" class="contact contact-with-map">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">contact</h3>
                </div>
                <div class="col-md-3">
                    <div class="contact-data">
                        <ul>
                            @foreach ($telefs as $telef)
                                @php
                                    $telefb = json_decode($telef->descripcion);
                                @endphp
                                <li><span class="ti-mobile icon"></span>{{ $telefb->{'tipo_telef'}.' '.$telefb->{'telefono'} }}</li>
                            @endforeach
                            @foreach ($mails as $mail)
                                <li><span class="ti-email icon"></span>{{ $mail->descripcion }}</li>
                            @endforeach
                            {{-- <li><span class="ti-skype icon"></span>@interio</li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-md-push-1">
                    <div class="contact-form">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="contact-email" name="contact-email" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                            </div>

                            <button type="button" id="submit" name="submit" class="btn btn-primary btn-lg text-center float-right">Submit your message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="google-maps">
            <div id="map-canvas"></div>
        </div>
    </section>
@endsection
