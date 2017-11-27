<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Usuario extends Eloquent {

    protected $table = "usuario"; // table name
	protected $primaryKey = "id_usuario";

    public $timestamps = FALSE;


}
