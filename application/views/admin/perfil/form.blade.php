<div class="fileinput fileinput-new text-center" data-provides="fileinput">
    <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
        <img alt="" class="img-responsive center-block" src="{{ $cuenta->avatar == '' ? base_url('assets/common/img/user.png') : base_url('assets/common/uploads/profile/'.$cuenta->id_usuario.'/'.$cuenta->avatar) }}">
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
    <div>
        <span class="btn btn-info btn-file">
            <span class="fileinput-new">Selecciona una imagen</span>
            <span class="fileinput-exists">Cambiar</span>
            <input type="file" name="imagen" value="" >
        </span>
        {{-- <button type="submit" class="btn btn-success fileinput-exists"><i class="fa fa-upload"></i> Subir</button> --}}
        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
    </div>
    <span class="help-block m-b-none font-bold">La imagen no puede pesar mas de 1Mb. Consejo, tu imagen de perfil deberia de ser cuadrada.</span>
</div>
<div class="form-group">
    <label>Correo</label>
    <input type="email" class="form-control" name="correo" value="{{ $cuenta->correo }}">
</div>
<div class="form-group">
<button class="btn btn-info" type="button" id="cc">Cambiar clave</button>
</div>
<div class="form-group">
    <label>Clave Anterior</label>
    <input type="password" class="form-control" disabled name="pass_ant">
</div>
<div class="form-group">
    <label>Nueva clave</label>
    <input type="password" class="form-control" disabled name="clave" id="clave">
</div>
<div class="form-group">
    <label>Repita su nueva clave</label>
    <input type="password" class="form-control" disabled name="claveCheck" >
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary" id="formGuardar">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
