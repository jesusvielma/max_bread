<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Clientes extends Eloquent {

    protected $table = "cliente"; // table name
	protected $primaryKey = "rut";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rut',
        'nombre',
        'telefono',
        'direccion',
        'correo',
        'tipo',
        'responsable',
        'id_usuario',
        'nombre_fantasia',
        'avatar'
    ];

    public $timestamps = FALSE;

    public function usuario()
    {
        return $this->hasOne('Usuario','id_usuario','id_usuario');
    }

}
