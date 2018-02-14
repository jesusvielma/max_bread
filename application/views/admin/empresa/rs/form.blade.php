<div class="form-group" >
    <label for="rs">Red Social</label>
    <br>
    <div class="btn-group" data-toggle="buttons" id="buttons">
        @php
        $fb = false;
        $tw = false;
        $in = false;
        $ln = false;
        $yb = false;
        @endphp
        @if ($existentes->count() > 0)
            @php
                foreach ($existentes as $e){
                    if ($e->tipo == 'fb')
                        $fb = true;
                    elseif ($e->tipo == 'tw')
                        $tw = true;
                    elseif ($e->tipo == 'in')
                        $in = true;
                    elseif ($e->tipo == 'ln')
                        $ln = true;
                    else
                        $yb = true;
                }
            @endphp

        @endif
        @if (!$fb)    
            <label class="btn btn-default btn-outline">
                <input type="radio" name="rs" value="fb" > <i class="fa fa-facebook"></i> Facebook
            </label>
        @endif
        @if (!$tw)
            <label class="btn btn-default btn-outline">
                <input type="radio" name="rs" value="tw" > <i class="fa fa-twitter"></i> Twitter
            </label>
        @endif
        @if (!$in)
            <label class="btn btn-default btn-outline">
                <input type="radio" name="rs" value="in" > <i class="fa fa-instagram"></i> Instagram
            </label>
        @endif
        @if (!$ln)    
            <label class="btn btn-default btn-outline">
                <input type="radio" name="rs" value="ln" > <i class="fa fa-linkedin"></i> Linkedin
            </label>
        @endif
        @if (!$yb)
            <label class="btn btn-default btn-outline">
                <input type="radio" name="rs" value="yb" > <i class="fa fa-youtube-square"></i> YouTube
            </label>
        @endif
    </div>
    <div id="button-selected" style="display:none">
        <button class="btn btn-success btn-outline" id="btn-selected" type="button">

        </button>
    </div>
</div>
<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" placeholder="Escriba el nombre de su empresa en la Red Social">
</div>
<div class="form-group">
    <label>URL</label>
    <input type="text" name="url" class="form-control" placeholder="" id="url">
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
        </div>
    </div>
</div>
