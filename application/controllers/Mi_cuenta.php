<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mi_cuenta extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        logueado_front();
        date_default_timezone_set('America/Santiago');
        setlocale(LC_ALL, 'es_ES.UTF-8');
    }

	public function index()
	{
		$usuario = $this->session->userdata('front')['correo'];
		$usuario = Usuario::where('correo',$usuario)->first();
		$data['usuario'] = $usuario;

		$data['pedidos'] = Pedido_model::where('cliente_rut',$usuario->cliente->rut)->get();
		$this->slice->view('front.micuenta',$data);
	}

	public function informacion(){

		$cliente = Clientes::find($this->input->post('rut'));

		$cliente->nombre = $this->input->post('nombre');
		$cliente->direccion = $this->input->post('direccion');
		$cliente->telefono = $this->input->post('telefono');
		$cliente->nombre_fantasia = $this->input->post('fantasia');
		$cliente->responsable = $this->input->post('responsable');

		if($cliente->correo != $this->input->post('correo')){
			$usuario = Usuario::find($cliente->id_usuario);
			$usuario->correo = $this->input->post('correo');
			$cliente->usuario()->save($usuario);
			$cliente->correo = $this->input->post('correo');

			$this->session->set_flashdata('cierreSesion',['motivo'=>'Haz cambiado tu correo electrónico por lo que debemos cerrar tu sesión para actualizar los datos y que sigas disfrutando de nuestro servicio. <br /> En 5 segundos seras redirigido al inicio para que puedas iniciar sesión de nuevo.']);
		}

		$cliente->save();

		$this->session->set_flashdata('actualicacionExitosa',['msg'=>'Hemos actualizado su información personal o empresarial.']);

		redirect('mi_cuenta','refresh');
	}

	public function perfil(){

		$usuario = Usuario::find($this->input->post('id_usuario'));

		$claveNueva = md5($this->input->post('clave'));

		$cambio = false;

		if($usuario->clave != $claveNueva){
			$usuario->clave = $claveNueva;
			$cambio = true;
		}

		$imagen = $_FILES['imagen']['name'];
		if($imagen != '' && $usuario->avatar != $imagen){
			$date = strftime('%A');
	        $dataF = substr($date,0,1);
	        $dataL = substr($date,-1,1);
			if(!is_dir('assets/common/uploads/profile/'.$usuario->cliente->rut)){
				mkdir('assets/common/uploads/profile/'.$usuario->cliente->rut,0777);
			}
			$config['upload_path']          = './assets/common/uploads/profile/'.$usuario->cliente->rut.'/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = '1024';
			$config['file_name']            = strtoupper($dataF).strtoupper($dataL).date('Y').strtoupper(random_string('alpha',2)).$usuario->cliente->rut;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('imagen')){
				$this->session->set_flashdata('avatar',['errors'=>$this->upload->display_errors()]);
			}else{
				$usuario->avatar = $this->upload->data('file_name');
				$cambio = true;
			}
		}

		$usuario->save();
		if($cambio)
		$this->session->set_flashdata('actualicacionExitosa',['msg'=>'Hemos actualizado su perfil exitoxamente.']);

		redirect('mi_cuenta','refresh');
	}
}
