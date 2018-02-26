<div class="form-group">
    <label for="">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($marca) ? $marca->nombre : '') }}" required>
</div>
<div class="fileinput fileinput-new text-center" data-provides="fileinput">
    <div class="fileinput-new thumbnail" style="width: 250px; height: 250px;">
        <img alt="" class="img-responsive center-block" src="{{ isset($marca->logo) ? base_url('assets/common/uploads/marca/'.$marca->logo) : '' }}">
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
    <div>
        <span class="btn btn-success btn-outline btn-file">
            <span class="fileinput-new">Selecciona una imagen</span>
            <span class="fileinput-exists">Cambiar</span>
            <input type="file" name="imagen" value="" >
        </span>
        {{-- <button type="submit" class="btn btn-success fileinput-exists"><i class="fa fa-upload"></i> Subir</button> --}}
        <a href="#" class="btn btn-danger btn-outline fileinput-exists" data-dismiss="fileinput">Quitar</a>
    </div>
    <span class="help-block m-b-none font-bold">La imagen no puede pesar mas de 1Mb. Consejo, tu imagen de perfil deberia de ser cuadrada.</span>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
