<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Agregar_tipo_red extends CI_Migration {

    public function up(){
        $fields = ['tipo ENUM ("fb","tw","in","ln","yb") NOT NULL'];

        $this->dbforge->add_column('red_social',$fields);
    }

    public function down(){
        //
    }
}
