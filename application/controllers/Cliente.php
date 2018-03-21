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
			$correo = json_decode(get_site_config_val('correo'));
			$correoAdmin = $correo->correo;

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
					'cuerpo' => 'Felicidades '.$nombreCorreo.' te haz registrado correctamente en el sitio <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a>. <br /> Recuerda que para acceder al mismo deberás ingresar el tu correo electrónico y la clave que haz cread, entra <a style="color:#FF9800;" href="'.site_url(). '">max-bread.cl</a> y presiona el link <b>Entrar</b> en la parte superior derecha de la pantalla .',
					'alertas' => [
						'clave'=>'Una vez que ingresas al sitio recuerda cambiar tu clave por una mas segura.',
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comunicate con el administrador <a href="mailto:' . $correoAdmin . '">' . $correoAdmin . '</a>.'
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
	
		$this->email->from('maxbread@max-bread.cl', 'Max Bread');
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

		$usuario->clave = sha1($this->input->post('clave'));

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

}
