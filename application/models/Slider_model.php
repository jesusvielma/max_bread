<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Slider_model extends Eloquent {

    protected $table = "slider";
	protected $primaryKey = "id_imagen";

    protected $fillable = ['url','posicion','texto-boton','enlance_boton','texto_imagen','estado'];

    public $timestamps = FALSE;

}
