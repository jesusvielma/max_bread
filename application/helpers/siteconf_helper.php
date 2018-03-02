<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('site_name'))
{
    function site_name()
    {
        $CI =& get_instance();
        $CI->load->database();

        $sql = "SELECT valor FROM config WHERE nombre = 'nombre_del_sitio'";
        $query = $CI->db->query($sql);
        $row = $query->row();
        $return = $row->valor;
        return $return;
    }
}

if(!function_exists('site_descripcion'))
{
    function site_description()
    {
    $CI =& get_instance();
        $CI->load->database();

        $sql = "SELECT valor FROM config WHERE nombre = 'descripcion'";
        $query = $CI->db->query($sql);
        $row = $query->row();
        if (count($row)>0) {
            $return = $row->valor;        
        }else{
            $return = '';
        }
        return $return;
    }
}

if (!function_exists('get_site_config_val')) {
    function get_site_config_val($val)
    {
        $CI = &get_instance();
        $CI->load->database();

        $sql = "SELECT valor FROM config WHERE nombre = '$val'";
        $query = $CI->db->query($sql);
        $row = $query->row();
        if (count($row) > 0) {
            $return = $row->valor;
        } else {
            $return = '';
        }
        return $return;
    }
}

if (!function_exists('get_site_config_section')) {
    function get_site_config_section($val)
    {
        $CI = &get_instance();
        $CI->load->database();

        $sql = "SELECT valor FROM config WHERE nombre = 'section-".$val."'";
        $query = $CI->db->query($sql);
        $row = $query->row();
        if (count($row) > 0) {
            $return = $row->valor;
        } else {
            $return = '';
        }
        return $return;
    }
}