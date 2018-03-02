<div class="form-group">
    <label for="">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($cat) ? $cat->nombre : '') }}" required>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
