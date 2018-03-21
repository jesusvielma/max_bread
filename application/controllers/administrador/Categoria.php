<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
        logueado();
   	}

	/**
	 * Show a table with all categories.
	 *
	 */
	public function index()
	{
		$data['cats'] = Categoria_model::all();
		$this->slice->view('admin.categoria.index',$data);
	}

	/**
	 * Shows form to create a new category
	 */
	public function crear()
	{
		$this->slice->view('admin.categoria.crear');
	}

	/**
	 * Store category
	 */
	public function guardar()
	{
		$usuario = new Categoria_model;

		$usuario->nombre = $this->input->post('nombre');

		$usuario->save();

		redirect('administrador/categoria','refresh');

	}

	/**
	 * Shows form to update category
	 */
	public function editar($cat)
	{
		$data['cat'] = Categoria_model::find($cat);
		$this->slice->view('admin.categoria.editar',$data);
	}

	/**
	 * Update category
	 */
	public function post_editar($cat)
	{
		$cat = Categoria_model::find($cat);

		$cat->nombre = $this->input->post('nombre');
		$cat->save();

		redirect('administrador/categoria','refresh');
	}


}
