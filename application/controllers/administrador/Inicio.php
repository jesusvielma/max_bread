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

		$data['hola'] = 'hola';
		$this->slice->view('admin.empty',$data);
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
