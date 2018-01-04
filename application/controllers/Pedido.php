<?php

class Pedido extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        logueado_front();
        date_default_timezone_set('America/Santiago');
    }

    public function ingresar() {
        $items = $this->input->post('itemId');
        $cantItems = $this->input->post('itemCant');

        $usuario = $this->session->userdata('front')['correo'];

        $usuario = Usuario::where('correo',$usuario)->first();

        $data = [
            'fecha'    => \Carbon\Carbon::now(),
            'cliente_rut' => $usuario->cliente->rut,
            'estado' => 'pedido'
        ];

        $pedido = Pedido_model::create($data);

        foreach($items as $item ){
            $pedido->productos()->attach([$item => ['cantidad'=> $cantItems[$item]]]);
        }

        $this->session->set_flashdata('pedido','1');

        redirect('/','refresh');
    }
}
?>
