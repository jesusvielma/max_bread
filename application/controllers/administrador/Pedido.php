<?php

class Pedido extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        logueado();
        date_default_timezone_set('America/Santiago');
        setlocale(LC_ALL, 'es_ES.UTF-8');
    }

    public function index() {

        $data['pedidos'] = Pedido_model::all();

        $this->slice->view('admin.pedido.index',$data);
    }
}
?>
