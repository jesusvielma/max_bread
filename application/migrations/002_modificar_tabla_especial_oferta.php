<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modificar_tabla_especial_oferta extends CI_Migration {

    public function up(){

        $this->dbforge->rename_table('especial', 'oferta');
        $fields = [
            'id_producto INT NOT NULL',
            'CONSTRAINT fk_id_producto FOREIGN KEY(id_producto) REFERENCES producto(id_producto)'
        ];
        $this->dbforge->add_column('oferta',$fields);
    }

    public function down(){
        //
    }
}
