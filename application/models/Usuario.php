<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Usuario extends Eloquent {

    protected $table = "usuario"; // table name
	protected $primaryKey = "id_usuario";

    public $timestamps = FALSE;


    public function cliente(){
        return $this->hasOne('Clientes','id_usuario','id_usuario');
    }
}
