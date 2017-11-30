<div class="form-group">
    <label for="">¿Qué vas a almacenar?</label>
    <br>
    <div class="radio-inline i-checks">
        <label > <input type="radio" value="sobre" name="tipo" required id="sobre" {{ isset($empresa->tipo) && $empresa->tipo == 'sobre' ? 'checked': set_radio('tipo','sobre')}}> <i></i> Sobre nosotros</label>
    </div>
    <div class="radio-inline i-checks">
        <label > <input type="radio" value="telefono" name="tipo" id="telefono" required {{ isset($empresa->tipo) && $empresa->tipo == 'telefono' ? 'checked': set_radio('tipo','telefono')}}> <i></i> Teléfono </label>
    </div>
    <!--<div class="radio-inline i-checks">
        <label > <input type="radio" value="mapa" name="tipo" id="mapa" required {{ isset($empresa->tipo) && $empresa->tipo == 'mapa' ? 'checked': set_radio('tipo','mapa')}}> <i></i> Mapa </label>
    </div>-->
    <div class="radio-inline i-checks">
        <label > <input type="radio" value="correo" name="tipo" id="correo" required {{ isset($empresa->tipo) && $empresa->tipo == 'correo' ? 'checked': set_radio('tipo','correo')}}> <i></i> Correo empresarial </label>
    </div>
</div>
<div class="form-group" id="cosas" >
    <div id="sobre_camp" {{ isset($empresa) && $empresa->tipo == 'sobre' ? '' : 'style="display:none"'}}>
        <label>Texto</label>
        <textarea name="descripcion" rows="8" class="form-control" id="descripcion" disabled>{{ isset($empresa) && $empresa->tipo == 'sobre' ? $empresa->descripcion : ''}}</textarea>
    </div>
    <div id="telef" {{ isset($empresa) && $empresa->tipo == 'telefono' ? '' : 'style="display:none"' }}>
        @php
            if (isset($empresa)) {
                $telef = json_decode($empresa->descripcion);
            }
        @endphp
        <label>Identificación</label>
        <input type="text" name="tipo_telef" value="{{ isset($empresa) && $empresa->tipo == 'telefono' ? $telef->{'tipo_telef'} : '' }}" class="form-control">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" disabled data-mask="+56 999-999-999" value="{{ isset($empresa) && $empresa->tipo == 'telefono' ? $telef->{'telefono'} : '' }}">
    </div>
    <div id="correo_camp" {{ isset($empresa) && $empresa->tipo == 'correo' ? '': 'style="display:none"' }}>
        <label>Correo</label>
        <input type="email" name="correo" class="form-control" disabled value="{{ isset($empresa) && $empresa->tipo == 'correo' ? $empresa->descripcion : '' }}">
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
