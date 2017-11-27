<div class="form-group">
    <label for="">RUT</label>
    <input type="text" name="rut" class="form-control" id="rut" value="{{ set_value('rut')!='' ? set_value('rut') : (isset($cliente) ? $cliente->rut : '') }}" required>
</div>
<div class="form-group">
    <label for="">Tipo de cliente</label>
    <br>
    <div class="radio-inline i-checks">
        <label > <input type="radio" value="natural" name="tipo" required id="natural" {{ isset($cliente->tipo) && $cliente->tipo == 'natural' ? 'checked':''}}> <i></i> Persona Natural</label>
    </div>
    <div class="radio-inline i-checks">
        <label > <input type="radio" value="empresa" name="tipo" id="empresa" required {{ isset($cliente->tipo) && $cliente->tipo == 'empresa' ? 'checked':''}}> <i></i> Empresa </label>
    </div>
</div>
<div class="form-group">
    <label for="" id="nombre">Nombres y Apellidos</label>
    <input type="text" name="nombre" class="form-control" required value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($cliente) ? $cliente->nombre : '') }}">
</div>
<div class="form-group">
    <label for="">Dirección</label>
    <textarea name="direccion" rows="4" class="form-control" required>{{ set_value('direccion')!='' ? set_value('direccion') : (isset($cliente) ? $cliente->direccion : '') }}</textarea>
</div>
<div class="form-group">
    <label for="">Teléfono</label>
    <input type="text" name="telefono" class="form-control" data-mask="+56 999-999-999" required value="{{ set_value('telefono')!='' ? set_value('telefono') : (isset($cliente) ? $cliente->telefono : '') }}">
</div>
<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="correo" id="" class="form-control" required value="{{ set_value('correo')!='' ? set_value('correo') : (isset($cliente) ? $cliente->correo : '') }}">
</div>
<div id="form_hide" style="display:none">
    <div class="form-group">
        <label for="">Nombre fantasia</label>
        <input type="text" name="fantasia" class="form-control" id="fantasia" disabled value="{{ set_value('nombre_fantasia')!='' ? set_value('nombre_fantasia') : (isset($cliente) && $cliente->tipo == 'empresa' ? $cliente->nombre_fantasia : '') }}">
    </div>
    <div class="form-group">
        <label for="">Persona Responsable</label>
        <input type="text" name="responsable" class="form-control" id="responsable" disabled value="{{ set_value('responsable')!='' ? set_value('responsable') : (isset($cliente) && $cliente->tipo == 'empresa' ? $cliente->responsable : '') }}">
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
