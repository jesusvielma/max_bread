<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Empresa_model extends Eloquent {

    protected $table = "empresa"; // table name
	protected $primaryKey = "id_item";

    protected $fillable = ['tipo','descripcion'];

    public $timestamps = FALSE;

}
