<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Agregar_oferta_pedido_tiene_producto extends CI_Migration {

    public function up(){
        $fields = [
            'oferta' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ]
        ];
        $this->dbforge->add_column('pedido_tiene_producto',$fields);
    }

    public function down(){
        //
    }
}
