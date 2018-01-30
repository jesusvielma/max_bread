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
		$data['sliders'] = Slider_model::where('estado',1)->orderby('posicion','ASC')->get();
		$this->slice->view('admin.slider.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear()
	{
		$this->slice->view('admin.slider.crear');	
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$posicion = Slider_model::select('posicion')->orderBy('posicion','DESC')->first();

		$posicion = $posicion->posicion + 1;

		$slider = new Slider_model;
		
		$slider->url = $this->input->post('imagen');
		$slider->posicion = $posicion;
		$slider->estado = 1;
		$slider->texto_imagen = $this->input->post('texto_imagen');
		$slider->texto_boton = $this->input->post('texto_boton');
		$slider->enlace_boton = $this->input->post('enlace_boton');

		$slider->save(); 

		redirect('administrador/slider','refresh');

	}

	public function editar($cat)
	{
		$data['slider'] = Slider_model::find($cat);
		$this->slice->view('admin.slider.editar',$data);
	}

	public function post_editar($slider)
	{
		$slider = Slider_model::find($slider);

		$slider->url = $this->input->post('imagen');
		$slider->texto_imagen = $this->input->post('texto_imagen');
		$slider->texto_boton = $this->input->post('texto_boton');

		$slider->save();

		redirect('administrador/slider','refresh');
	}


}
