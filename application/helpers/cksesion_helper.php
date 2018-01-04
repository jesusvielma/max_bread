<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    if(!function_exists('logueado'))
    {
        function logueado()
        {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('admin');
           if(!isset($is_logged_in) || $is_logged_in != true)
           {
            //echo 'You don\'t have permission to access this page. <a href="'.site_url('administrador').'">Login</a>';
            //
            //die();
            redirect('administrador/login');
           }
        }
    }

    if(!function_exists('logueado_front'))
    {
        function logueado_front()
        {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('front');
           if(!isset($is_logged_in) || $is_logged_in != true)
           {
            //echo 'You don\'t have permission to access this page. <a href="'.site_url('administrador').'">Login</a>';
            //
            //die();
            redirect('administrador/login');
           }
        }
    }
