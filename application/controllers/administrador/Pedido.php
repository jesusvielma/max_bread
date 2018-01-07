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

        $data['pedidos'] = Pedido_model::orderBy('fecha','DESC')->get();

        $this->slice->view('admin.pedido.index',$data);
    }

    public function detalle($id_pedido){

        $pedido =  Pedido_model::find($id_pedido);

        $data['pedido'] = $pedido;

        $this->slice->view('admin.pedido.detalle',$data);
    }

    public function estado($estado,$id_pedido){

        $pedido = Pedido_model::find($id_pedido);

        $pedido->estado = $estado;

        $pedido->save();

        redirect('administrador/pedido','refresh');
    }
}
?>
