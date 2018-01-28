<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modificar_campos_oferta extends CI_Migration {

    public function up(){
        $fields = [
            'id_oferta' => [
                'name' => 'id_oferta',
                'type' => 'INT',
                'auto_increment' => true,
            ]
        ];
        $this->dbforge->modify_column('oferta',$fields);

        $this->dbforge->add_column('oferta',[
            'precio' => [
                'type' => 'INT'
            ]
        ]);
    }

    public function down(){
        //
    }
}
