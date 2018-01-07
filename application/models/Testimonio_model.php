<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Testimonio_model extends Eloquent {

    protected $table = "testimonio";
	protected $primaryKey = "id_testimonio";

    protected $fillable = ['comentario','fecha','cliente_rut'];

    protected $dates = ['fecha'];

    public $timestamps = FALSE;

    public function cliente(){

        return $this->belongsTo('Clientes','cliente_rut','rut');
    }

}
