<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Producto_model extends Eloquent {

    protected $table = "producto";
	protected $primaryKey = "id_producto";

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_por_mayor',
        'precio_por_menor',
        'cant_por_mayor',
        'disponibilidad',
        'categoria'
    ];

    public $timestamps = FALSE;

    public function cat()
    {
        return $this->belongsTo('Categoria_model','categoria','id_categoria');
    }

    public function imagen()
    {
        return $this->hasMany('Imagen_Producto_model','id_producto','id_producto');
    }

    public function pedido()
    {
        return $this->belongsToMany('Pedido_model','pedido_tiene_producto','id_producto','id_pedido')->withPivot('cantidad');
    }

}
