<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Oferta_model extends Eloquent {

    protected $table = "oferta";
	protected $primaryKey = "id_oferta";

    protected $fillable = [
        'nombre',
        'inicio',
        'fin',
        'descripcion',
        'id_producto'
    ];

    protected $dates = [
        'inicio','fin'
    ];

    public $timestamps = FALSE;

    public function producto()
    {
        return $this->belongsTo('Producto_model','id_producto','id_producto');
    }

}
