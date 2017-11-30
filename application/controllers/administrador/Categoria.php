<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

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
		$data['cats'] = Categoria_model::all();
		$this->slice->view('admin.categoria.index',$data);
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

	public function post_editar($cat)
	{
		$cat = Categoria_model::find($cat);

		$cat->nombre = $this->input->post('nombre');
		$cat->save();

		redirect('administrador/categoria','refresh');
	}


}
