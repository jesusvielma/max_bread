<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Notificacion_model extends Eloquent {

    protected $table = "notificacion";
	protected $primaryKey = "id_notificacion";

    protected $fillable = ['fecha','contenido','estado'];

    protected $dates = ['fecha'];

    public $timestamps = FALSE;

}
