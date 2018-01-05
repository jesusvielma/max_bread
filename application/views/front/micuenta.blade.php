@extends('templates.front.default')
@section('css')
    <link href="<?=base_url('assets/backend/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
@endsection
@section('content')
    <section class="about white-color" id="perfil">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Mi perfil</h3>
                    @if ($this->session->flashdata('actualicacionExitosa'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ $this->session->flashdata('actualicacionExitosa')['msg'] }}
                        </div>
                    @endif
                    @if ($this->session->flashdata('avatar'))
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ $this->session->flashdata('avatar')['errors'] }}
                        </div>
                    @endif
                </div>
                <div class="col-md-7 overflow-hidden wow fadeInLeft" id="about1">
                    <h4>Mi Información</h4>
                    <div class="perfil-form">
                        {{ form_open('mi_cuenta/informacion',['id'=>'formInfo']) }}
                            <input type="hidden" name="tipo" value="{{ $usuario->cliente->tipo }}">
                            <input type="hidden" name="rut" value="{{ $usuario->cliente->rut }}">
                            <div class="form-group">
                                <input type="text" name="rutShow" class="form-control " id="rut" value="{{ $usuario->cliente->rut }}" required placeholder="RUT" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nombre" class="form-control " required value="{{ $usuario->cliente->nombre }}" placeholder="Nombre y Apellidos o Razón Social">
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Dirección" name="direccion" rows="4" class="form-control " required>{{ $usuario->cliente->direccion }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefono" class="form-control " data-mask="+56 999-999-999" required value="{{ $usuario->cliente->telefono }}" placeholder="Teléfono">
                            </div>
                            <div class="form-group">
                                <input type="email" name="correo" id="" class="form-control " required value="{{ $usuario->cliente->correo }}" placeholder="Correo electronico">
                            </div>
                            <div id="form_hide" {{ $usuario->cliente->tipo == 'natural' ? 'style="display:none"': '' }} >
                                <div class="form-group">
                                    <label for="">Nombre fantasia</label>
                                    <input type="text" name="fantasia" class="form-control" id="fantasia" {{ $usuario->cliente->tipo == 'natural' ? 'disabled' : ''}} value="{{ $usuario->cliente->nombre_fantasia }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Persona Responsable</label>
                                    <input type="text" name="responsable" class="form-control" id="responsable" {{ $usuario->cliente->tipo == 'natural' ? 'disabled' : ''}} value="{{ $usuario->cliente->responsable }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-md-push-1 wow fadeInRight">
                    <h4>Datos de acceso</h4>
                    <div class="perfil-form">
                        {{ form_open_multipart('mi_cuenta/perfil',['id'=>'formPerfil']) }}
                            <p>El correo de acceso es el mismo que el de tu información</p>
                            <div class="form-group">
                                <input type="password" class="form-control" name="clave" placeholder="Clave">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confClave" placeholder="Repite la clave">
                            </div>
                            <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                    <img alt="" class="img-responsive center-block" src="{{ $usuario->avatar == '' ? base_url('assets/common/img/user.png') : base_url('assets/common/uploads/profile/'.$usuario->cliente->rut.'/'.$usuario->avatar) }}">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Selecciona una imagen</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="imagen" value="" accept=".png, .jpg, .jpeg">
                                    </span>
                                    {{-- <button type="submit" class="btn btn-success fileinput-exists"><i class="fa fa-upload"></i> Subir</button> --}}
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                </div>
                                <span style="color:#fff" class="help-block m-b-none font-bold">La imagen no puede pesar mas de 1Mb. Consejo, tu imagen de perfil deberia de ser cuadrada.</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="cambiar">Actualizar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-min section product white-bg" id="pedido">
        <div class="container overflow-hidden">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Historial de Pedidos</h3>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-12">
                    <p>Este es tu historial de pedidos</p>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered pedidos">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pedidos->count()>0)
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->codigo_pedido }}</td>
                                        <td>{{ $pedido->fecha->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                                        <td>
                                            <ul class="styled-list">
                                                @foreach ($pedido->productos as $producto)
                                                    <li>{{ $producto->pivot->cantidad }} {{ $producto->nombre }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <span style="font-size: 80%" class="label label-{{ $pedido->estado == 'pedido' ? 'primary' : ($pedido->estado == 'ruta' ? 'info' : 'success') }}">
                                                <i class="fa fa-{{ $pedido->estado == 'pedido' ? 'calculator' : ($pedido->estado == 'ruta' ? 'truck' : 'check') }}"></i>
                                                {{ ucfirst($pedido->estado) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No hay pedidos registrados</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading white-color">Mis testimonios</h3>
                </div>
                <div class="testimonials-slider text-center col-md-12">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar" class="wow fadeInUp" src="assets/frontend/img/user.png">
                                <h3 class="wow fadeInUp" data-wow-delay=".4s"> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p class="wow fadeInUp" data-wow-delay=".6s"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar" class="wow fadeInUp" src="assets/frontend/img/user.png">
                                <h3 class="wow fadeInUp" data-wow-delay=".4s"> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p class="wow fadeInUp" data-wow-delay=".6s"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonials-container shadow"> <img alt="user avatar" class="wow fadeInUp" src="assets/frontend/img/user.png">
                                <h3 class="wow fadeInUp" data-wow-delay=".4s"> Martin Johe, Co-Founder / CEO <span>Fastcompany ltd.</span> </h3>
                                <p class="wow fadeInUp" data-wow-delay=".6s"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonials-pagination"></div>
                    <div class="testimonials-slider-next right-arrow-negative"> <span class="ti-arrow-right"></span> </div>
                    <div class="testimonials-slider-prev left-arrow-negative"> <span class="ti-arrow-left"></span> </div>
                </div>
            </div>
        </div>
    </section>

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
@endsection
@section('js')
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var rut = $('input#rut').val();
            $('input#rut').val($.formatRut(rut));
            $('.pedidos').DataTable({
                pageLength: 10,
                responsive: true,
				language: {
					url : '{{ base_url('assets/backend/js/plugins/dataTables/i18n/es.json') }}',
				},
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            });

            @if ($this->session->flashdata('actualicacionExitosa'))
            setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 5000);
            @endif
        });
    </script>
@endsection
