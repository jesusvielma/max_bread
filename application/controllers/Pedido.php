<?php

class Pedido extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        logueado_front();
        date_default_timezone_set('America/Santiago');
        setlocale(LC_ALL, 'es_ES.UTF-8');
    }

    public function ingresar() {
        $items = $this->input->post('itemId');
        $cantItems = $this->input->post('itemCant');

        $usuario = $this->session->userdata('front')['correo'];

        $usuario = Usuario::where('correo',$usuario)->first();

        $date = strftime('%A');
        $dataF = substr($date,0,1);
        $dataL = substr($date,-1,1);

        $data = [
            'codigo_pedido' => strtoupper($dataF).strtoupper($dataL).date('ymd').strtoupper(random_string('alpha',2)).date('His'),
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
