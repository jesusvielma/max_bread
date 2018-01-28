<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modificar_id_oferta extends CI_Migration {

    public function up(){
        $fields = [
            'id_oferta' => [
                'name' => 'id_oferta',
                'type' => 'INT',
                'auto_increment' => true,
            ]
        ];
        $this->dbforge->modify_column('oferta',$fields);
    }

    public function down(){
        //
    }
}
