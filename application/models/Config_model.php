<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Config_model extends Eloquent {

    protected $table = "config";
	protected $primaryKey = "id_config";

    protected $fillable = ['nombre','valor'];

    public $timestamps = FALSE;

}
