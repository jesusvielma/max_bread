<div class="form-group">
    <a data-src="{{ site_url('upload/dir?campo=imagen&dir=slider') }}" class="btn btn-primary btn-outline" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Selecionar o subir imagen</a>
    <input type="hidden" name="imagen" id="imagen" value="{{ isset($slider) ? $slider->url : '' }}">
</div>
<div class="form-group">
    <label for="">Titulo</label>
    <input type="text" name="texto_imagen" class="form-control" id="texto_imagen" value="{{ set_value('texto_imagen')!='' ? set_value('texto_imagen') : (isset($slider) ? $slider->texto_imagen : '') }}" >
</div>
<div class="form-group">
    <label for="">Texto del boton</label>
    <input type="text" name="texto_boton" class="form-control" id="texto_boton" value="{{ set_value('texto_boton')!='' ? set_value('texto_boton') : (isset($slider) ? $slider->texto_boton : '') }}" >
</div>
<!--<div class="form-group">
    <label for="">Enlace del boton del boton</label>
    <input type="url" name="enlace_boton" class="form-control" id="enlace_boton" value="{{ set_value('enlace_boton')!='' ? set_value('enlace_boton') : (isset($slider) ? $slider->enlace_boton : '') }}" >
</div>-->
<div class="form-group">
    <div class="swiper-slide" style="background: url({{ base_url('assets/common/uploads/'.(isset($slider) ? $slider->url : '')) }});">
        <!-- <img src="assets/frontend/img/logo-white.png" alt="store logo"> -->
        <h2 class="home-slider-title-main">{{ isset($slider) ? $slider->texto_imagen : '' }}</h2>
        <div class="home-buttons text-center"> <a href="" class="btn btn-lg  btn-primary">{{ isset($slider) ? $slider->texto_boton : '' }}</a> </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
