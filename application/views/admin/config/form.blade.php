<div class="form-group">
    <a data-src="{{ site_url('upload/dir?campo=imagen&dir=section') }}" class="btn btn-primary btn-outline" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Seleccionar o subir imagen</a>
    <input type="hidden" name="imagen" id="imagen" value="{{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? $sec_val->backgroundImage : '' }}">
</div>
<div class="form-group">
    <div {{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? 'style="background: url('.base_url('assets/common/uploads/'.$sec_val->backgroundImage).')"' : '' }} alt="" id="imagenMostrar" >
    <p id="textColorP" {{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? 'style="color:'.$sec_val->textColor.'"' : '' }}>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia dignissimos veritatis alias modi? Iusto qui, doloremque magni totam quaerat quisquam, ipsam delectus dicta dignissimos maxime facilis, laboriosam quod. Sit, repudiandae!</p>
    </div>
</div>
<div class="form-group">
    <input type="hidden" name="backgroundColor" id="backColorInput" value="{{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? $sec_val->backgroundColor : '' }}">
    <a data-color="{{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? $sec_val->backgroundColor : '' }}" id="changeColor" class="btn btn-white btn-block colorpicker-element" href="#" data-toggle="tooltip" title="Seleccionar un color para mostrar en caso que la imagen no se muestre correctamente">Selecciona el color de fondo</a>
    <div class="panel panel-default">
        <div class="panel-heading" id="backColor" {{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? 'style="background-color: '.$sec_val->backgroundColor.'"' : '' }} >
            Texto de pruebas
        </div>
    </div>
</div>

<div class="form-group">
    <input type="hidden" name="textColor" id="textColorInput" value="{{ isset($sec_val) && $sec_val->estado != 'porconfigurar' ? $sec_val->textColor : '' }}"> 
    <a id="textColor" class="btn btn-white btn-block colorpicker-element" href="#" data-toggle="tooltip" title="Seleccionar un color para las letras sobre la imagen">Selecciona el color de la letra</a>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
