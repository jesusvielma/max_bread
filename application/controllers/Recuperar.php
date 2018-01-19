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
		$now = \Carbon\Carbon::now();

		$usuario = Usuario::where('correo',$correo)->first();
		if($usuario->count() > 0 ){
			$data1 = [
				'correo' => $correo,
				'token' => random_string('sha1'),
				'validez' => $now->addMinutes(31)
			];
			Reseteo_clave_model::create($data1);
			$data = [
				'validez' => $data1['validez']->toDateTimeString(),
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];

			$correo = [
				'correo' => $data1['correo'],
				'token' => $data1['token'] ,
				'destinatario' => (object)[
					'tipo' => $usuario->cliente->tipo,
					'nombre' => $usuario->cliente->tipo == 'natural' ? $usuario->cliente->nombre : $usuario->cliente->responsable ,
					'empresa' => $usuario->cliente->nombre
				],
				'contenido' => (object)[
					'cuerpo' => 'Hemos ricibidio tu solicutud de restauración de clave de acceso al sitio, al final este correo encontrar el token que deberas ingresar para poder realizar el cambio de la clave. <br> El token es valido desde las' . $now->toTimeString() . ' hasta las ' . $data1['validez']->toTimeString() . ', si en este tiempo no puedes realizar el cambio de tu clave deberas comenzar el proceso de nuevo.',
					'alertas' => [
						'msg' => 'Nota, por favor no cierres la página donde iniciaste el proceso si lo haces no podras completar y proceso y tendras que volver a comenzar',
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
					]
				],
				'asunto' => 'Solicutud de cambio recuperación de clave'
			];
			$this->load->library('email');

			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'phx.hn.cl',
				'smtp_port' => 26,
				'smtp_user' => '_mainaccount@max-bread.cl',
				'smtp_pass' => 'jconcha.5283',
				'crlf' => "\r\n",
				'newline' => "\r\n",
				'send_multipart' => false,
			);

			$this->email->initialize($config);

			$this->email->from('ventas@max-bread.cl', 'Ventas Max Bread');
			$this->email->to($correo['correo']);

			$this->email->subject($correo['asunto']);
			$msg = $this->slice->view('admin.email.recuperar_clave', $correo,TRUE);
			$this->email->message($msg);
			$this->email->set_mailtype('html');

			$this->email->send();

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
