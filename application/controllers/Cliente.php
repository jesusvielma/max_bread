<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
   	}	

	/**
	 * Store client info in database and create and array with 
	 * all de information to display on welcome email.
	 */
	public function guardar()
	{

		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|is_unique[cliente.correo]|is_unique[usuario.correo]');
		$this->form_validation->set_rules('rut','RUT','required|callback_check_rut');

		if($this->form_validation->run() === FALSE){
			$error = [
				'error'=>validation_errors(),
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];
			$this->output->set_content_type('application/json')
						 ->set_output(json_encode($error));
		}
		else
		{
			$usuario = new Usuario;

			$usuario->correo = $this->input->post('correo');
			$clave = random_string('alnum', 8);
			$timeTarget = 0.05; // 50 milisegundos 
			$coste = 8;
			do {
				$coste++;
				$inicio = microtime(true);
				$clave2 = password_hash($clave, PASSWORD_BCRYPT, ["cost" => $coste]);
				$fin = microtime(true);
			} while (($fin - $inicio) < $timeTarget);

			$verifyCode = random_string('alnum', 20);
			$usuario->codigo_verificacion = $verifyCode;

			$usuario->clave = $clave2;

			$usuario->save();

			$data = [
				'rut' => $this->formatoRUTbd($this->input->post('rut')),
				'nombre' => $this->input->post('nombre'),
				'tipo' => $this->input->post('tipo'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'correo' => $this->input->post('correo'),
				'nombre_fantasia' => $this->input->post('fantasia'),
				'responsable' => $this->input->post('responsable'),
				'id_usuario' => $usuario->id_usuario
			];
			$nombreCorreo = $data['tipo'] == 'natural' ? $data['nombre'] : $data['responsable'];

			$correo = [
				'correo' => $usuario->correo,
				'clave'  => $clave,
				'url'	 => site_url(),
				'destinatario' => (object)[
					'tipo' => $data['tipo'],
					'nombre' => $nombreCorreo ,
					'empresa' => $data['nombre']
				],
				'contenido' => (object)[
					'cuerpo' => 'Felicidades '.$nombreCorreo.' te haz registrado correctamente en el sitio <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a>. <br /> Recuerda que para acceder al mismo deberás ingresar tu correo electrónico y la clave que haz creado, entra <a style="color:#FF9800;" href="'.site_url(). '">max-bread.cl</a> y presiona el link <b>Entrar</b> en la parte superior derecha de la pantalla .',
					'alertas' => [
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comunicate con el administrador <a href="mailto:' . get_site_email() . '">' . get_site_email() . '</a>.'
					]
				],
				'asunto' => $nombreCorreo.' - Registro de usuario exitoso en max-bread.cl'
			];

			$this->correo_ingreso($correo);
			
			Clientes::create($data);
			$data = [
				'correo'=>$usuario->correo,
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
					]
				];
				//redirect('administrador/cliente','refresh');
				$this->output->set_content_type('application/json')
				->set_output(json_encode($data));
			}

	}

	/**
	 * Loads Codeigniter Email Library and compose 
	 * email to new client registration.
	 * 
	 * @param $_data array Data to display in email
	 */
	public function correo_ingreso($_data)
	{
		$this->load->library('email');
	
		$this->email->from(get_site_email(), 'Max Bread');
		$this->email->to($_data['correo']);
	
		$this->email->subject($_data['asunto']);
		$msg = $this->slice->view('admin.email.crear_usuario',$_data,true);
		$this->email->message($msg);
		$this->email->set_mailtype('html');
	
		$this->email->send();
	}

	/**
	 * Make format to the client RUT.
	 */
	private function formatoRUTbd($rut)
	{
		return strtoupper(str_replace(['.','-'],'',$rut));
	}

	/**
	 * Validate if client RUT is in DB 
	 * 
	 * @return bool 
	 */
	public function check_rut($rut)
	{
		$rut = $this->formatoRUTbd($rut);

		if (Clientes::find($rut)) {
			 $this->form_validation->set_message('check_rut', 'El campo {field} ya existe en la base de datos.');
			 return FALSE;
		}
		else{
			return true;
		}
	}

	/**
	 * Change de user client password and log in user
	 */
	public function cambiar_clave()
	{
		$correo = $this->input->post('correoCambio');

		$usuario = Usuario::where('correo',$correo)->first();

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

		$session = [
			'correo' => $correo,
			'datetime' => \Carbon\Carbon::now(),
			'ip' => $this->input->ip_address(),
		];

		$this->session->set_userdata('front',$session);

		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(['success'=>true]));
	}

	public function validar($token, $step = 1)
	{
		$data['tokenOrg'] = $token;
		$token = $this->base64urldecode($token);

		$token = explode('|',$token);
		
		$usuario = Usuario::find($token[1]);

		$data['usuario'] = $usuario;

		if($usuario->estado == 0){
			$data['validado'] = 'false';
			if($step == 1){
				$this->slice->view('front.validar',$data);
			}else{
				$clave = $this->input->post('clave');
				$timeTarget = 0.05; // 50 milisegundos 
				$coste = 8;
				do {
					$coste++;
					$inicio = microtime(true);
					$clave2 = password_hash($clave, PASSWORD_BCRYPT, ["cost" => $coste]);
					$fin = microtime(true);
				} while (($fin - $inicio) < $timeTarget);
	
				$usuario->estado = 1;
	
				$imagen = $_FILES['imagen']['name'];
				if ($imagen != '' ) {
					$date = strftime('%A');
					$dataF = substr($date, 0, 1);
					$dataL = substr($date, -1, 1);
					if (!is_dir('assets/common/uploads/profile/' . $usuario->cliente->rut)) {
						mkdir('assets/common/uploads/profile/' . $usuario->cliente->rut, 0777);
					}
					$config['upload_path'] = './assets/common/uploads/profile/' . $usuario->cliente->rut . '/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '1024';
					$config['file_name'] = strtoupper($dataF) . strtoupper($dataL) . date('Y') . strtoupper(random_string('alpha', 2)) . $usuario->cliente->rut;
	
					$this->load->library('upload', $config);
	
					if (!$this->upload->do_upload('imagen')) {
						$this->session->set_flashdata('avatar', ['errors' => $this->upload->display_errors()]);
					} else {
						$usuario->avatar = $this->upload->data('file_name');
						$cambio = true;
					}
				}
	
				$usuario->clave = $clave2;
	
				$usuario->save();
	
				$session = [
					'correo' => $usuario->correo,
					'datetime' => \Carbon\Carbon::now(),
					'ip' => $this->input->ip_address(),
				];
	
				$this->session->set_userdata('front', $session);
	
				redirect('/','refresh');
			}
		}else{
			$data['validado'] = 'true';
			$this->slice->view('front.validar', $data);
		}
	}

	/**
	 * Decode a token in the format of base64 without 
	 * restricted characters.
	 * 
	 * @param string $data 
	 * @return string
	 */
	private function base64urldecode($data)
	{
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

}
