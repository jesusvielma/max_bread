<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Categoria_model extends Eloquent {

    protected $table = "categoria_producto";
	protected $primaryKey = "id_categoria";

    protected $fillable = ['nombre'];

    public $timestamps = FALSE;

}
