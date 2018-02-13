<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
   	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		$data['clientes'] = Clientes::all();
		$this->slice->view('admin.cliente.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear()
	{
		$this->slice->view('admin/cliente/crear');
	}

	/**
	 * Almacena los datos en la base de datos
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

			$correo = [
				'correo' => $usuario->correo,
				'clave'  => $clave,
				'url'	 => site_url(),
				'destinatario' => (object)[
					'tipo' => $data['tipo'],
					'nombre' => $data['tipo']== 'natural' ? $data['nombre'] : $data['responsable'] ,
					'empresa' => $data['nombre']
				],
				'contenido' => (object)[
					'cuerpo' => 'Usted ha recibido este correo porque se ha registrado en el sitio <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a>. <br /> Se ha creado un usuario con su correo electrónico para acceder al sitio visite la página <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a> y presione el link entrar en la parte superior derecha.',
					'alertas' => [
						'clave'=>'Una vez que ingresas al sitio recuerda cambiar tu clave por una mas segura.',
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
					]
				],
				'asunto' => 'Registro de usuario exitoso en max-bread.cl'
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

	public function editar($cliente)
	{
		$data['cliente'] = Clientes::find($cliente);
		$this->slice->view('admin.cliente.editar',$data);
	}

	public function post_editar($cliente)
	{
		$cliente = Clientes::find($cliente);

		$data = [
			'rut' => $this->input->post('rut'),
			'nombre' => $this->input->post('nombre'),
			'tipo' => $this->input->post('tipo'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'correo' => $this->input->post('correo'),
			'nombre_fantasia' => $this->input->post('nombre_fantasia'),
			'responsable' => $this->input->post('responsable')
		];

		$cliente->fill($data);
		$cliente->save();

		redirect('administrador/cliente','refresh');
	}

	public function correo_ingreso($_data)
	{
		$this->load->library('email');

		/* $config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'phx.hn.cl',
			'smtp_port' => 26,
			'smtp_user' => '_mainaccount@max-bread.cl',
			'smtp_pass' => 'concha.5283',
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'send_multipart' => false,
		);
	
		$this->email->initialize($config); */
	
		$this->email->from('maxbread@max-bread.cl', 'Max Bread');
		$this->email->to($_data['correo']);
	
		$this->email->subject($_data['asunto']);
		$msg = $this->slice->view('admin.email.crear_usuario',$_data,true);
		$this->email->message($msg);
		$this->email->set_mailtype('html');
	
		$this->email->send();
	}

	private function formatoRUTbd($rut)
	{
		return strtoupper(str_replace(['.','-'],'',$rut));
	}

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
