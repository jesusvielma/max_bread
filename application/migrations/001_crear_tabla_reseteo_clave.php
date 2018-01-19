<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Crear_tabla_reseteo_clave extends CI_Migration {

    public function up(){
        $this->dbforge->add_field([
            'id_reseteo' => [
                'type' => 'INT',
                'auto_increment'=> true
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'validez' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->dbforge->add_key('id_reseteo', TRUE);
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('reseteo_clave',FALSE, $attributes);
    }

    public function down(){
        $this->dbforge->drop_table('reseteo_clave');
    }
}
