<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function check_login($_data){
        $query_user = $this->db->select('correo')
                          ->where('correo',$_data->post('correo'))
                          ->get('usuario');


        if($query_user->num_rows() > 0){
            $query_pass = $this->db->select('correo, id_usuario')
                          ->where('correo',$_data->post('correo'))
                          ->where('clave',md5($_data->post('clave')))
                          ->get('usuario');
            if($query_pass->num_rows() > 0){
                foreach($query_pass->result() as $row){
                    $data[] = $row;
                }
            return $data;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
}
