<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Imagen_Producto_model extends Eloquent {

    protected $table = "imagen_producto";
	protected $primaryKey = "id_imagen_producto";

    protected $fillable = [
        'url',
        'puesto',
        'id_producto'
    ];

    public $timestamps = FALSE;

    public function producto()
    {
        return $this->belongsTo('Producto_model','id_producto','id_imagen_prodcuto');
    }

}
