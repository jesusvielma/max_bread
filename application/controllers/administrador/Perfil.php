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

}
