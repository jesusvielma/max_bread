<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

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
		$data['cuenta'] = Usuario::where('correo',$this->session->userdata('admin')['correo'])->first();
		$this->slice->view('admin.perfil.crear',$data);
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$clave_ant = $this->input->post('pass_ant');
		
		$usuario = Usuario::where('correo', $this->session->userdata('admin')['correo'])->first();
		
		$usuario->correo = $this->input->post('correo');

		if (password_verify($clave_ant,$usuario->clave)) {
			$clave = $this->input->post('clave');
			if ($clave != '') {
				$timeTarget = 0.05; // 50 milisegundos 
				$coste = 8;
				do {
					$coste++;
					$inicio = microtime(true);
					$clave2 = password_hash($clave, PASSWORD_BCRYPT, ["cost" => $coste]);
					$fin = microtime(true);
				} while (($fin - $inicio) < $timeTarget);
				$usuario->clave = $clave2;
			}
			$usuario->save();
		}else{
			$this->session->set_flashdata('error',['msg'=>'Su clave anterior no coincide con la registrada']);
		}

		redirect('administrador/perfil','refresh');
	}	

	public function reseteo($usuario){

		$usuario = Usuario::find($usuario);

		$timeTarget = 0.05; // 50 milisegundos 
		$coste = 8;
		$clave = random_string('alnum', 8);
		do {
			$coste++;
			$inicio = microtime(true);
			$clave2 = password_hash($clave, PASSWORD_BCRYPT, ["cost" => $coste]);
			$fin = microtime(true);
		} while (($fin - $inicio) < $timeTarget);

		$usuario->clave = $clave2;

		$usuario->save();

		$this->session->set_flashdata('clave',['msg'=>'Se ha cambiado la clave del usuario '.$usuario->cliente->nombre.' y se le ha enviado al correo eléctronico. Clave: '.$clave]);

		$correo = [
			'correo' => $usuario->correo,
			'clave' => $clave,
			'url' => site_url(),
			'destinatario' => (object)[
				'tipo' => $usuario->cliente->tipo,
				'nombre' => $usuario->cliente->tipo == 'natural' ? $usuario->cliente->nombre : $usuario->cliente->responsable,
				'empresa' => $usuario->cliente->nombre
			],
			'contenido' => (object)[
				'cuerpo' => 'Usted ha recibido este correo porque el administrador de sitio <a style="color:#FF9800;" href="' . site_url() . '">max-bread.cl</a> ha realizado una restauración de su clave. <br /> Recuerde que una vez que acceda a su cuenta por seguridad debe cambiar su esta clave.',
				'alertas' => [
					'clave' => 'Una vez que ingresas al sitio recuerda cambiar tu clave por una mas segura.',
					'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
				]
			],
			'asunto' => 'Se ha reestablecido si clave.'
		];

		$this->correo_ingreso($correo);

		redirect('administrador/cliente','refresh');
	}

	public function correo_ingreso($_data)
	{
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

		$this->email->from('maxbread@max-bread.cl', 'Max Bread');
		$this->email->to($_data['correo']);

		$this->email->subject($_data['asunto']);
		$msg = $this->slice->view('admin.email.crear_usuario', $_data, true);
		$this->email->message($msg);
		$this->email->set_mailtype('html');

		$this->email->send();
	}

}
