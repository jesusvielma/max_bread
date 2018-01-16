<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recuperar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Santiago');
        setlocale(LC_ALL, 'es_ES.UTF-8');
		\Carbon\Carbon::setlocale('es');
    }

	public function iniciar_recuperacion(){

		$correo = $this->input->post('correo');

		$usuario = Usuario::where('correo',$correo)->first();
		if($usuario->count() > 0 ){
			$data = [
				'correo' => $correo,
				'token' => random_string('sha1'),
				'validez' => \Carbon\Carbon::now()->addMinutes(31)
			];
			Reseteo_clave_model::create($data);
			$data = [
				'validez' => $data['validez']->toDateTimeString(),
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];
		}else{
			$data = [
				'error' => 'El correo no esta en nuestra base de datos',
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];

		}

		$this->output->set_content_type('application/json')
					 ->set_output(json_encode($data));
	}

	public function index(){
		$this->slice->view('templates.front.recuperar');
	}

	public function recuperar(){

		$token = $this->input->post('token');

		$data = Reseteo_clave_model::where('token',$token)->first();

		if($data->count() > 0){
			$now = \Carbon\Carbon::now();
			$diff =  $now->diffInMinutes($data->validez,false);
			if($diff > 0){
				$usuario = Usuario::where('correo',$data->correo)->first();

				$clave = $this->input->post('clave');

				$usuario->clave = md5($clave);

				$usuario->save();

				$data->validez = $now;

				$data->save();

				$data = [
					'success' => 1,
					'csrf' => [
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					]
				];
			}
			else{
				$data = [
					'error' => 'Parece que el token ya ha caducado, por favor vuelve a comenzar el proceso.',
					'csrf' => [
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					]
				];
			}
		}
		$this->output->set_content_type('application/json')
					 ->set_output(json_encode($data));
	}
}
