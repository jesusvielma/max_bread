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

	public function editar($cat)
	{
		$data['cat'] = Categoria_model::find($cat);
		$this->slice->view('admin.categoria.editar',$data);
	}

	public function post_editar()
	{
		$config_id = $this->input->post('pk');
	
		$conf = Config_model::find($config_id);

		$conf->nombre = $this->input->post('nombre');
		$conf->save();

		//redirect('administrador/config','refresh');
	}

	public function editar_requerido()
	{
		$config_id = $this->input->post('pk');

		$conf = Config_model::find($config_id);

		$conf->valor = $this->input->post('value');
		$conf->save();

		//redirect('administrador/config','refresh');
	}


}
