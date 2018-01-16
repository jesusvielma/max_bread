<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Reseteo_clave_model extends Eloquent {

    protected $table = "reseteo_clave";
	protected $primaryKey = "id_reseteo";

    protected $fillable = ['correo','token','validez'];

    protected $dates = ['validez'];

    public $timestamps = FALSE;

    

}
