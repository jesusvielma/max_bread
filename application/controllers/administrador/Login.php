<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Santiago');

	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		$this->slice->view('admin.login.login');
	}


    /**
     * Loguear al usuario
     */
    public function post_login()
    {
		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');

		$this->form_validation->set_message('required', 'El campo %s  es requerido');
		//$this->form_validation->set_message('is_unique', 'El %s ya esta en la base de datos, escoja otro');

		if ($this->form_validation->run()=== FALSE) {
			$this->index();
		}
		else {

			$usuario = Usuario::where('correo',$this->input->post('correo'))->first();
			$passPost = password_verify($this->input->post('clave'),$usuario->clave);
			if ($usuario && $passPost) {
				$session = [
					'correo' => $this->input->post('correo'),
					'datetime' => \Carbon\Carbon::now(),
					'ip' => $this->input->ip_address(),
					'avatar' => $usuario->id_usuario.'/'.$usuario->avatar,
				];

				$this->session->set_userdata('admin',$session);

				redirect('administrador','refresh');

			}
			else{
				$data['error'] = 'Incio de sesion incorrecto';
				$this->slice->view('admin.login.login',$data);
			}
		}

    }

	/**
	 * Desloguar al usuario
	 * @return [type] [description]
	 */
    public function salir()
    {
        $this->session->unset_userdata('admin');
        $this->session->sess_destroy();
        redirect('administrador','refresh');
    }
}
