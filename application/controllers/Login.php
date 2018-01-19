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
    public function login()
    {
		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');

		$this->form_validation->set_message('required', 'El campo %s  es requerido');
		//$this->form_validation->set_message('is_unique', 'El %s ya esta en la base de datos, escoja otro');

		if ($this->form_validation->run()=== FALSE) {
			$error = [
				'error'=>validation_errors('<li>','</li>'),
				'csrf' => [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				]
			];
			$this->output->set_content_type('application/json')
						 ->set_output(json_encode($error));
		}
		else {

			$usuario = Usuario::where('correo',$this->input->post('correo'))->first();
			$passPost = password_verify($this->input->post('clave'), $usuario->clave);
			if ($usuario && $passPost) {
				$session = [
					'correo' => $this->input->post('correo'),
					'datetime' => \Carbon\Carbon::now(),
					'ip' => $this->input->ip_address(),
				];

				$this->session->set_userdata('front',$session);

				$this->output->set_content_type('application/json')
							 ->set_output(json_encode(['success'=>true]));

			}
			else{
				$error = [
					'errorO'=>'Parece que tus datos de acceso no son correctos verificalos',
					'csrf' => [
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					]
				];
				$this->output->set_content_type('application/json')
							 ->set_output(json_encode($error));
			}
		}

    }

	/**
	 * Desloguar al usuario
	 * @return [type] [description]
	 */
    public function salir()
    {
        $this->session->unset_userdata('front');
        $this->session->sess_destroy();
        redirect('/','refresh');
    }
}
