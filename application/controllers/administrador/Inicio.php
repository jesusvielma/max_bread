<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();

        logueado();
   }

	/**
	 * Shows index page for backend
	 *
	 */
	public function index()
	{

		$data['hola'] = 'hola';
		$this->slice->view('admin.empty',$data);
	}	

	/**
	 * Get all the notification on backend
	 */
	public function obtener_notificaciones(){

		$notifis = Notificacion_model::orderBy('fecha','DESC')->get();

		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(['notifs'=>$notifis]));
	}

	/**
	 * Change the state to a notification
	 */
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
