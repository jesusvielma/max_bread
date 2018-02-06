<div class="form-group">
    <label>Correo</label>
    <input type="email" class="form-control" name="correo" value="{{ $cuenta->correo }}">
</div>
<div class="form-group">
    <label>Clave Anterior</label>
    <input type="password" class="form-control" required name="pass_ant">
</div>
<div class="form-group">
    <label>Nueva clave</label>
    <input type="password" class="form-control" required name="clave" id="clave">
</div>
<div class="form-group">
    <label>Repita su nueva clave</label>
    <input type="password" class="form-control" required name="claveCheck" >
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary" id="formGuardar">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
