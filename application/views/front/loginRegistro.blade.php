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
                                {{ form_open('',['id'=>'formLogin']) }}
                                    <div class="form-group">
                                        <input type="text" name="correo" value="" class="form-control" placeholder="Correo electrónico">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="clave" value="" class="form-control" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="entrar" class="btn btn-primary">Entrar</button>
                                    </div>
                                </form>
                                ¿No tiene una cuenta?<a href="#" id="registro">Registrese</a><br>
                                <a href="#" id="olvido">¿Olvido su contraseña?</a>
                            </div>
                            <div class="olvido">
                                <div id="olvidoCorreo">
                                    {{ form_open('',['id'=>'formOlvido']) }}
                                        <h5>Empecemos con la recuperación de su clave</h5>
                                        <a href="#" class="divLogin"><i class="ti-arrow-left"></i>Iniciar sesión</a>
                                        <div class="form-group">
                                            <input type="text" name="correo" value="" class="form-control" placeholder="Correo electrónico">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="comenzarOlvido" class="btn btn-primary">Comenzar</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="olvidoClave">
                                    {{ form_open('',['id'=>'formOlvidoClave']) }}
                                        <h5>Adelante todo esta listo para cambiar su clave</h5>
                                        <ul id="countdownClave" class="countdown-counter wow fadeInUp"></ul>
                                        <a href="#" class="divLogin"><i class="ti-arrow-left"></i>Iniciar sesión</a>
                                        <div class="form-group">
                                            <input type="text" name="token" value="" class="form-control" placeholder="Ingrese el Token ">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="claveOlvido" value="" class="form-control" placeholder="Nueva clave">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="claveOlvidoRepetir" value="" class="form-control" placeholder="Repita su nueva clave">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="cambioOlvido" class="btn btn-primary">Cambiar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="registro">
                                <h5>Registro</h5>
                                <a href="#" class="divLogin"><i class="ti-arrow-left"></i>Iniciar sesión</a>
                                {{ form_open('',['id'=>'formRegistro']) }}
                                    <div class="form-group">
                                        <label>¿Eres una empresa o una persona?</label>
                                        <div class="btn-group" data-toggle="buttons">
                                              <label class="btn btn-primary" id="persona">
                                                <input type="radio" name="tipo" value="natural" autocomplete="off"> Persona
                                              </label>
                                              <label class="btn btn-primary" id="empresa">
                                                <input type="radio" name="tipo" value="empresa" autocomplete="off"> Empresa
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
                                        <button type="button" id="guardarRegistro" class="btn btn-primary">Registrarse</button>
                                    </div>
                                </form>
                            </div>
                            <div class="registroClave">
                                <h5>Ingresa tu nueva clave</h5>
                                {{ form_open('',['id'=>'formCambioClave']) }}
                                    <div class="form-group">
                                        <input type="text" class="form-control" readonly value="" placeholder="Correo electrónico" id="email" name="correoCambio">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="claveNue" placeholder="Clave">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confClave" placeholder="Repite la clave">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="cambiar">Cambiar clave e ingresar</button>
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

@section('jsLogin')
    <script src="{{ base_url('assets/backend/js/plugins/jquery.rut.js') }}"></script>
    <script src="{{ base_url('assets/backend/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
	<!-- Sweet alert -->
    <script src="{{ base_url('assets/backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('#nosotros').find('ul').addClass('styled-list');
			$('#registro').click(function () {
				$('.login').hide('fadeOut');
				$('.registro').show('fadeIn');
				$('#formRegistro .all').prop('disabled',false);
			});
			$('.divLogin').click(function () {
				$('.registro').hide('fadeIn');
                $('#olvidoClave').hide('fadeOut');
                $('#olvidoCorreo').hide('fadeOut');
                $('.login').show('fadeOut');
			});
            $('#olvido').click(function () {
				$('.registro').hide('fadeOut');
				$('.login').hide('fadeOut');
                $('#olvidoClave').hide('fadeOut');
                $('#olvidoCorreo').fadeIn();
                $('.olvido').show('fadeIn');
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
			$('#guardarRegistro').click(function () {
				$.post('{{ site_url('cliente/guardar') }}',$('#formRegistro').serialize(), function (data) {
					if (data.error) {
						swal({
		                    title: "Los datos parecen tener errores",
		                    text:  data.error,
		                    type: "error",
		                    confirmButtonText: "Revisar",
		                    html: true
		                });
						var csrfName = data.csrf.name;
						var csrfHash = data.csrf.hash;
						$('input[name='+csrfName+']').val(csrfHash);
					}else{
						swal({
		                    title: "Felicidades ya te has registrado.",
		                    text:  'Ya estas registrado en nuestra página, te hemos enviado un correo con una clave que podrás usar si no puedes completar el siguiente paso. Si deseas continuar haz click en Continuar de lo contrario haz click en Cancelar.',
		                    type: "success",
							showCancelButton: true,
		                    confirmButtonText: "Continuar",
							cancelButtonText: "Cancelar",
		                }, function (isConfirm) {
		                	if (isConfirm) {
								$('.registro').hide('fadeOut');
								$('.login').hide('fadeOut');
								$('#email').val(data.correo);
								var csrfName = data.csrf.name;
								var csrfHash = data.csrf.hash;
								$('input[name='+csrfName+']').val(csrfHash);
								$('.registroClave').show('fadeIn');
		                	}
							else {
								location.reload();
							}
		                });
					}
				});
			});
			$('button#cambiar').click(function () {
				var clave = $('input[name=claveNue]').val();
				var confClave = $('input[name=confClave]').val();
				if(clave != confClave){
					swal({
						title: "Las claves no coinciden",
						text:  'Las claves que has ingresado no coinciden verificalas',
						type: "error",
						confirmButtonText: "Verificar",
					});
				}
				else {
					swal({
		                title: "¡Perfecto!",
		                text: "Ahora vamos a realizar el cambio de clave y luego recargaremos la pagina y ya habrás iniciado sesión.",
		                type: "info",
						timer: 5000
		            });
					$.post('{{ site_url('cliente/cambiar_clave') }}',$('#formCambioClave').serialize(),function (data) {
						if(data.success){
							location.reload();
						}
					});
				}
            });
            
            
            $('button#comenzarOlvido').click(function () {
                $.post('{{ site_url('recuperar/iniciar_recuperacion') }}',$('#formOlvido').serialize(),function (data) {
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
                            title: "Se ha enviado un correo",
                            text:  'Hemos enviado al correo indicado la información para recuperación de la clave revisa tu correo y continua con la operación.',
                            type: "success",
                            confirmButtonText: "Ok",
                        }, function (isConfirm){
                            if(isConfirm){
                                location.reload();
                            }
                        });
                    }
                });
            });

			$('button#entrar').click(function () {
				if (
					($('input[name=correo]').val() == '' && $('input[name=clave]').val() == '' ) || ($('input[name=correo]').val() != '' && $('input[name=clave]').val() == '' ) || ($('input[name=correo]').val() == '' && $('input[name=clave]').val() != '' )
				) {
					swal({
						title: "Recuerda ingresar todos los datos",
						text:  'Parece que haz olvidado ingresar algunos datos verificalos.',
						type: "error",
						confirmButtonText: "Revisar",
						html: true
					});
				}else{
					$.post('{{ site_url('login/login') }}',$('#formLogin').serialize(), function (data) {
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
						}else if (data.errorO) {
							swal({
								title: "¿Haz escrito algo mal?",
								text:  data.errorO,
								type: "error",
								confirmButtonText: "Revisar",
								html: true
							});
							var csrfName = data.csrf.name;
							var csrfHash = data.csrf.hash;
							$('input[name='+csrfName+']').val(csrfHash);
						}else{
							location.reload();
						}
					});
				}
			});
		});
	</script>
@endsection
