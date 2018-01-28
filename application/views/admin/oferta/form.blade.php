<div class="form-group">
    <label for="">Nombre de la oferta</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($oferta) ? $oferta->nombre : '') }}" required >
</div>
<div class="form-group">
    <label>Descripcion</label>
    <textarea name="descripcion" class="form-control" required> {{ isset($oferta) && $oferta->descripcion !=''  ? $oferta->descripcion : ''}}</textarea>
</div>
<div class="form-group">
    <label for="">Precio de oferta</label>
    <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" name="precio" class="form-control" required value="{{ set_value('precio')!='' ? set_value('precio') : (isset($oferta) ? $oferta->precio : '') }}">
        <span class="input-group-addon">CLP</span>
    </div>
</div>
<div class="form-group">
    <label >Vigente hasta</label>
    <div class="row">
        <div class="col-lg-6" id="vigente">
            <div class="input-group date">
            <input type="text" class="form-control" value="{{ set_value('fecha')!='' ? set_value('fecha') : (isset($oferta) ? $oferta->fin->format('dd-mm-yyyy') : '') }}" id="fecha" name="fecha">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" class="form-control" value="{{ set_value('hora')!='' ? set_value('hora') : (isset($oferta) ? $oferta->fin->format('hh:mm a') : '') }}" id="hora" name="hora">
                <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                </span>
            </div>
        </div>
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
