<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Crear_tabla_marca extends CI_Migration {

    public function up(){
        $this->dbforge->add_field([
            'id_marca' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->dbforge->add_key('id_marca', true);
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('marca', false, $attributes);
    }

    public function down(){
        //
    }
}
