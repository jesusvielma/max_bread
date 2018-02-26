<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Marca_model extends Eloquent {

    protected $table = "marca";
	protected $primaryKey = "id_marca";

    protected $fillable = ['nombre','logo'];

    public $timestamps = FALSE;

    public function productos()
    {
        return $this->hasMany('Producto_model','id_marca','id_marca');
    }

}
