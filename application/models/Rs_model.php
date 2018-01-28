<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Rs_model extends Eloquent {

    protected $table = "red_social"; // table name
	protected $primaryKey = "id_red";

    protected $fillable = ['nombre','url','tipo'];

    public $timestamps = FALSE;

}
