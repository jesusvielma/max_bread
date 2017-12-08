<div class="form-group">
    <label for="">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ set_value('nombre')!='' ? set_value('nombre') : (isset($producto) ? $producto->nombre : '') }}" required {{ isset($producto) ? 'readonly' : '' }}>
</div>
<div class="form-group">
    <label>Descripcion</label>
    <textarea name="descripcion" class="form-control" required> {{ isset($producto) && $producto->descripcion !=''  ? $producto->descripcion : ''}}</textarea>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-lg-4">
            <label for="">Precio por mayor</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" name="mayor" class="form-control" required value="{{ set_value('mayor')!='' ? set_value('mayor') : (isset($producto) ? $producto->precio_por_mayor : '') }}">
                <span class="input-group-addon">CLP</span>
            </div>
        </div>
        <div class="col-lg-4">
            <label for="">Precio por menor</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" name="menor" class="form-control" required value="{{ set_value('menor')!='' ? set_value('menor') : (isset($producto) ? $producto->precio_por_menor : '') }}">
                <span class="input-group-addon">CLP</span>
            </div>
        </div>
        <div class="col-lg-4">
            <label for="">Cantidad Por mayor</label>
            <input type="text" name="cantidad" class="form-control" required value="{{ set_value('cantidad')!='' ? set_value('cantidad') : (isset($producto) ? $producto->cant_por_mayor : '') }}">
        </div>
    </div>
</div>
<div class="form-group">
    <label>Categoria</label>
    <select class="form-control select2" name="categoria" required>
        @foreach ($cats as $cat)
            <option></option>
            <option value="{{$cat->id_categoria }}" {{ isset($producto) && $producto->categoria == $cat->id_categoria ? 'selected' : '' }} >{{ $cat->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Imagenes</label>
    <br>
        @php
            $p='';
            $valueP='';
            $s='';
            $valueS = '';
            $t='';
            $valueT = '';
            $c='';
            $valueC = '';
            if (isset($producto)) {
                foreach ($producto->imagen as $imagen) {
                    if ($imagen->puesto == 1) {
                        $p = base_url('assets/common/uploads/').$imagen->url;
                        $valueP = $imagen->url;
                    }elseif ($imagen->puesto == 2) {
                        $s = base_url('assets/common/uploads/').$imagen->url;
                        $valueS = $imagen->url;
                    }elseif ($imagen->puesto == 3) {
                        $t = base_url('assets/common/uploads/').$imagen->url;
                        $valueT = $imagen->url;
                    }else {
                        $c = base_url('assets/common/uploads/').$imagen->url;
                        $valueC = $imagen->url;
                    }
                }
            }
        @endphp
    <div class="row">
        <div class="col-lg-3">
            <label>Primaria</label>
            <img src="{{ $p }}" alt="" id="foto_primaria" class="img-responsive img-thumbnail">
            <br>
            <a data-src="{{ base_url('assets/common/js/filemanager-alone/dialog.php?type=1&field_id=primaria&fldr=productos/:PRODUCTO&lang=es&relative_url=1') }}" class="btn btn-primary btn-outline {{ $p == '' ? 'disabled' : ''}}" data-fancybox data-type="iframe" href="javascript:;"><i class="fa fa-upload"></i> Subir</a>
            <input type="hidden" name="primaria" id="primaria" value="{{ $valueP }}">
        </div>
        <div class="col-lg-3">
            <label>Secundaria</label>
            <img src="{{ $s }}" alt="" id="foto_secundaria" class="img-responsive img-thumbnail">
            <br>
            <a data-src="{{ base_url('assets/common/js/filemanager-alone/dialog.php?type=1&field_id=secundaria&fldr=productos/:PRODUCTO&lang=es&relative_url=1') }}" class="btn btn-success btn-outline {{ $s == '' ? 'disabled' : ''}}" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Subir</a>
            <input type="hidden" name="secundaria" id="secundaria" value="{{ $valueS }}">
        </div>
        <div class="col-lg-3">
            <label>Tercera</label>
            <img src="{{ $t }}" alt="" id="foto_tres" class="img-responsive img-thumbnail">
            <br>
            <a data-src="{{ base_url('assets/common/js/filemanager-alone/dialog.php?type=1&field_id=tres&fldr=productos/:PRODUCTO&lang=es&relative_url=1') }}" class="btn btn-default btn-outline {{ $t == '' ? 'disabled' : ''}}" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Subir</a>
            <input type="hidden" name="tres" id="tres" value="{{ $valueT }}">
        </div>
        <div class="col-lg-3">
            <label>Cuarta</label>
            <img src="{{ $c }}" alt="" id="foto_cuatro" class="img-responsive img-thumbnail">
            <br>
            <a data-src="{{ base_url('assets/common/js/filemanager-alone/dialog.php?type=1&field_id=cuatro&fldr=productos/:PRODUCTO&lang=es&relative_url=1') }}" class="btn btn-default btn-outline {{ $c == '' ? 'disabled' : ''}}" data-fancybox href="javascript:;"><i class="fa fa-upload"></i> Subir</a>
            <input type="hidden" name="cuatro" id="cuatro" value="{{ $valueC }}">
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
