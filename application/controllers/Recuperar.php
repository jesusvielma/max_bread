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
		$validez = \Carbon\Carbon::now()->addMinutes(31);
		$ahora = \Carbon\Carbon::now();

		$usuario = Usuario::where('correo',$correo)->first();
		if ($usuario->count() > 0) {
			$data1 = [
				'correo' => $correo,
				'token' => random_string('sha1'),
				'validez' => $validez
			];
			Reseteo_clave_model::create($data1);
			$data = [
				'validez' => $data1['validez']->toDateTimeString(),
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];
			$correo = json_decode(get_site_config_val('correo'));
			$correoAdmin = $correo->correo;
			$correo = [
				'correo' => $data1['correo'],
				'destinatario' => (object)[
					'tipo' => $usuario->cliente->tipo,
					'nombre' => $usuario->cliente->tipo == 'natural' ? $usuario->cliente->nombre : $usuario->cliente->responsable ,
					'empresa' => $usuario->cliente->nombre
				],
				'contenido' => (object)[
					'cuerpo' => 'Hemos recibido tu solicitud de restauración de clave de acceso al sitio, haz click en botón que tienes abajo para continuar con el proceso de restauración de u clave, <br> El link es valido desde las ' . $ahora->toTimeString() . ' hasta las ' . $data1['validez']->toTimeString() . ', si en este tiempo no puedes realizar el cambio de tu clave deberás comenzar el proceso de nuevo.',
					'botonURL' => '<a href="'.site_url('recuperar/'. $data1['token'] ).'" style="text-decoration: none;color: #FFF;background-color: #ff9800;border: solid #ff9800;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">Continuar con la recuperación</a> <br><br> Ó <br> Puedes ingresar la dirección <a href="'.site_url('recuperar'). '">' . site_url('recuperar') . '</a> en tu navegador y luego ingresar el código <strong>'. $data1['token'] .'</strong>',
					'alertas' => [
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comunicate con el administrador <a href="mailto:' . $correoAdmin . '">' . $correoAdmin . '</a>.'
					]
				],
				'asunto' => 'Solicitud de recuperación de clave ['.$data1['correo'].']'
			];
			$this->load->library('email');

			$this->email->from('maxbread@max-bread.cl', 'Max Bread');
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

	public function inicio($token = ''){

		$data['token'] = $token;
		if ($token != '') {
			$data['res'] = $res = Reseteo_clave_model::where('token', $token)->first();
			if ($res != null) {
				$validez = $res->validez;
				$ahora = \Carbon\Carbon::now();
		
				$data['diff'] = ($ahora->diffInSeconds($validez,false))*1000;	
				$data['tokenInvalido'] = 0;
			}else{
				$data['tokenInvalido'] = 1;
			}
		}
		else{
			$data['res'] = '';
			$data['diff'] = '';
			$data['tokenInvalido'] = 0;
		}

		$this->slice->view('templates.front.recuperar',$data);
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

				$timeTarget = 0.05; // 50 milisegundos 
				$coste = 8;
				do {
					$coste++;
					$inicio = microtime(true);
					$clave2 = password_hash($clave, PASSWORD_BCRYPT, ["cost" => $coste]);
					$fin = microtime(true);
				} while (($fin - $inicio) < $timeTarget);

				$usuario->clave = $clave2;

				$usuario->save();

				$data->delete();

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

	public function agotado($token)
	{
		$data = Reseteo_clave_model::where('token', $token)->first();	
		$data->delete();
		redirect('/','refresh');
	}
}
