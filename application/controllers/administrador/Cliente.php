<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

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
		$data['clientes'] = Clientes::all();
		$this->slice->view('admin.cliente.index',$data);
	}

	/**
	 * Shows form to create new client from backend
	 */
	public function crear()
	{
		$this->slice->view('admin/cliente/crear');
	}

	/**
	 * Store data in DB and create an array with data to display in email 
	 * registration
	 */
	public function guardar()
	{

		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|is_unique[cliente.correo]|is_unique[usuario.correo]');
		$this->form_validation->set_rules('rut','RUT','required|callback_check_rut');

		if($this->form_validation->run()=== FALSE){
			$this->crear();
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
					'nombre' => $nombreCorreo,
					'empresa' => $data['nombre']
				],
				'contenido' => (object)[
					'cuerpo' => 'Es un gusto saludarte '.$nombreCorreo.', te informamos que haz recibido este correo porque el administrador del sitio <a style="color:#FF9800;" href="' . site_url() . '">max-bread.cl</a> ha ingresado tus datos en el mismo como parte del proceso de modernización y mejora del servicio de pedidos. <br /> Se ha creado un usuario con su correo electrónico para acceder al sitio visite la página <a style="color:#FF9800;" href="' . site_url() . '">max-bread.cl</a> o copie el link '.site_url().' directamente en su barra de navegación y presione el link entrar en la parte superior derecha.',
					'alertas' => [
						'clave' => 'Una vez que ingresas al sitio recuerda cambiar tu clave por una mas segura.',
						'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comunicate con el administrador <a href="mailto:'.$correoAdmin.'">'.$correoAdmin.'</a>.'
					]
				],
				'asunto' => 'Bienvenido al sitio de Maxbread, '. $nombreCorreo
			];

			$this->correo_ingreso($correo);


			Clientes::create($data);

			redirect('administrador/cliente','refresh');
		}

	}

	/**
	 * Show form to edit client data
	 */
	public function editar($cliente)
	{
		$data['cliente'] = Clientes::find($cliente);
		$this->slice->view('admin.cliente.editar',$data);
	}

	/**
	 * Update client data
	 */
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

	/**
	 * Loads Codeigniter Email Library to send
	 * email registration to client
	 */
	public function correo_ingreso($_data)
	{
		$this->load->library('email');

		$this->email->from('maxbread@max-bread.cl', 'Max Bread');
		$this->email->to($_data['correo']);

		$this->email->subject($_data['asunto']);
		$msg = $this->slice->view('admin.email.crear_usuario', $_data, true);
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

}
