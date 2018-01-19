<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();

        logueado();
   }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{

		// $this->load->view('admin/base/header');
		$data['hola'] = 'hola';
		//echo $this->blade->view()->make('admin/base/empty',$data)->render();
		$this->slice->view('admin.empty',$data);
		// $this->load->view('admin/base/footer');
	}

	public function correo()
	{
		$this->load->library('email');

		$config = array(
		  'protocol' => 'smtp',
		  'smtp_host' => '52.5.224.12',
		  'smtp_port' => 2525,
		  'smtp_user' => 'b925f466454dfe',
		  'smtp_pass' => '2959353274233b',
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		);

		$this->email->initialize($config);

		$this->email->from('ventas@max-bread.cl', 'Ventas Max bread');
		$this->email->to('jesusvielma309@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
	}

	public function obtener_notificaciones(){

		$notifis = Notificacion_model::orderBy('fecha','DESC')->get();

		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(['notifs'=>$notifis]));
	}

	public function marcar(){

		$notifs = Notificacion_model::where('estado',0)->get();

		foreach($notifs as $notif){

			$notif->estado = 1;
			$notif->save();
		}
		$this->output->set_content_type('application/json')
			->set_output(json_encode(['success' => 1]));	
	}


}
