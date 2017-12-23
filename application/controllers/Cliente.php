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

		if($this->form_validation->run()=== FALSE){
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
			$usuario->clave = md5('secreto');

			$usuario->save();

			$correo = [
				'correo' => $usuario->correo,
				'clave'  => 'secreto',
				'url'	 => site_url('administrador/login'),
				'nombre' => $this->input->post('nombre'),
			];

			//$this->correo_ingreso($correo);

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

	// public function correo_ingreso($_data)
	// {
	// 	$this->load->library('email');
	//
	// 	$config = array(
	// 	  'protocol' => 'smtp',
	// 	  'smtp_host' => '52.5.224.12',
	// 	  'smtp_port' => 2525,
	// 	  'smtp_user' => 'b925f466454dfe',
	// 	  'smtp_pass' => '2959353274233b',
	// 	  'crlf' => "\r\n",
	// 	  'newline' => "\r\n",
	// 	  'mailtype' => 'html'
	// 	);
	//
	// 	$this->email->initialize($config);
	//
	// 	$this->email->from('ventas@max-bread.cl', 'Ventas Max bread');
	// 	$this->email->to($_data['correo']);
	//
	// 	$this->email->subject('Usuario creado');
	// 	$msg = $this->slice->view('admin.email.crear_usuario',$_data,true);
	// 	$this->email->message($msg);
	//
	// 	$this->email->send();
	// }

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

		$usuario->clave = md5($this->input->post('clave'));

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
