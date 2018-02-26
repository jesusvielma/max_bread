<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Agregar_id_marca_producto extends CI_Migration {

    public function up(){
        $fields = [
            'id_marca INT ',
            'CONSTRAINT fk_id_marca FOREIGN KEY(id_marca) REFERENCES marca(id_marca)'
        ];

        $this->dbforge->add_column('producto',$fields);
    }

    public function down(){
        //
    }
}
