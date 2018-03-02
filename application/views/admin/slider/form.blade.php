<div class="form-group">
    <a data-src="{{ site_url('upload/dir?campo=imagen&dir=slider') }}" class="btn btn-primary btn-outline" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Seleccionar o subir imagen</a>
    <input type="hidden" name="imagen" id="imagen" value="{{ isset($slider) ? $slider->url : '' }}">
</div>
<div class="form-group">
    <label for="">Titulo</label>
    <input type="text" name="texto_imagen" class="form-control" id="texto_imagen" value="{{ set_value('texto_imagen')!='' ? set_value('texto_imagen') : (isset($slider) ? $slider->texto_imagen : '') }}" >
</div>
<div id="disicionBoton">
    <div class="form-group">
        <label>¿Desea que el slider tenga un enlace?</label>
        <br>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="botonSI">SI</button>
            <button type="button" class="btn btn-danger" id="botonNo">NO</button>
        </div>
    </div>
</div>
<div id="divBotonSlider" style="display:none">
    <div class="form-group">
        <label for="">Texto del boton</label>
        <input type="text" name="texto_boton" class="form-control" id="texto_boton" value="{{ set_value('texto_boton')!='' ? set_value('texto_boton') : (isset($slider) ? $slider->texto_boton : '') }}" >
    </div>
    <div class="form-group">
        <label for="">Enlace del boton del boton</label>
        <br>
        <div id="EnlaceTipo">
            <button type="button" class="btn btn-primary btn-outline" id="enlaceInterno">Enlace Interno</button>
            <button type="button" class="btn btn-info btn-outline" id="enlaceExterno">Enlace Externo</button>
        </div>
        <input style="display:none" disabled type="url" name="enlace_boton" class="form-control" id="enlace_boton" value="{{ set_value('enlace_boton')!='' ? set_value('enlace_boton') : (isset($slider) ? $slider->enlace_boton : '') }}" >
        <select name="enlace_boton" id="enlace_select" class="form-control" style="display:none" disabled>
            <option value="#productos">Productos</option>
            <option value="#nosotros">Nosotros</option>
            <option value="#ofertas">Ofertas</option>
            <option value="#comentarios">Comentarios</option>
            <option value="#productos">Contacto</option>
            {{-- <option value="{{ site-url('') }}">Mi Cuenta</option> --}}
        </select>
    </div>
</div>
<div class="form-group">
    <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.(isset($slider) ? $slider->url : '')) }});">
        <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
        <h2 class="home-slider-title-main">{{ isset($slider) ? $slider->texto_imagen : '' }}</h2>
        <div class="home-buttons text-center"> <a id="botonSlider" href="" class="btn btn-lg  btn-primary">{{ isset($slider) ? $slider->texto_boton : '' }}</a> </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
