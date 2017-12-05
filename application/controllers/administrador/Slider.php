<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

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
		$data['slider1'] = Slider_model::where('posicion','1')->where('estado',1)->first();
		$data['slider2'] = Slider_model::where('posicion','2')->where('estado',1)->first();
		$data['slider3'] = Slider_model::where('posicion','3')->where('estado',1)->first();
		$data['slider4'] = Slider_model::where('posicion','4')->where('estado',1)->first();
		$this->slice->view('admin.slider.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear($posicion)
	{
		if ($posicion<5) {
			$this->slice->view('admin.slider.crear');
		}else{
			redirect('administrador/slider');
		}
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar($posicion)
	{
		$slider = new Slider_model;

		$slider->url = $this->input->post('imagen');
		$slider->posicion = $posicion;
		$slider->estado = 1;
		$slider->texto_imagen = $this->input->post('texto_imagen');
		$slider->texto_boton = $this->input->post('texto_boton');

		$slider->save();

		redirect('administrador/slider','refresh');

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
