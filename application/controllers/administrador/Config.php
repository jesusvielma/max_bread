<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

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
		$data['required_conf'] = Config_model::where('required',1)->get();
		$data['section_conf'] = Config_model::where('required', '!=' ,1)->where('nombre','like','%section-%')->get();
		$this->slice->view('admin.config.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear()
	{
		$this->slice->view('admin.categoria.crear');
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$usuario = new Categoria_model;

		$usuario->nombre = $this->input->post('nombre');

		$usuario->save();

		redirect('administrador/categoria','refresh');

	}

	public function editar_section($sec)
	{
		$sec = Config_model::find($sec);

		$sec_val = json_decode($sec->valor);

		$data['sec_val'] = $sec_val;
		$data['sec'] = $sec;
		$this->slice->view('admin.config.editar_section',$data);
	}

	public function post_editar($config_id)
	{
	
		$conf = Config_model::find($config_id);

		$data = [
			'backgroundImage' => $this->input->post('imagen'),
			'backgroundColor' => $this->input->post('backgroundColor'),
			'textColor' => $this->input->post('textColor'),
			'estado' => 'configurado'
		];

		$conf->valor = json_encode($data);
		$conf->save();

		redirect('administrador/config','refresh');
	}

	public function editar_requerido()
	{
		$config_id = $this->input->post('pk');

		$conf = Config_model::find($config_id);

		$conf->valor = $this->input->post('value');
		$conf->save();

		//redirect('administrador/config','refresh');
	}

	public function editar_correo($config_id)
	{

		$conf = Config_model::find($config_id);

		$data = [
			'correo' => $this->input->post('correo'),
			'protocol' => $this->input->post('protocol'),
			'smtp_user' => $this->input->post('smtp_user') != '' ? $this->input->post('smtp_user') : 0,
			'smtp_pass' => $this->input->post('smtp_pass') != '' ? $this->input->post('smtp_pass') : 0,
			'smtp_port' => $this->input->post('smtp_port') != '' ? $this->input->post('smtp_port') : 0,
			'smtp_host' => $this->input->post('smtp_host') != '' ? $this->input->post('smtp_host') : 0
		];

		$conf->valor = json_encode($data);
		$conf->save();

		redirect('administrador/config', 'refresh');
	}
}
