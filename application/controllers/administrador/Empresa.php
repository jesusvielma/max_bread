<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

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
		$data['items'] = Empresa_model::all();
		$data['telefs'] = Empresa_model::where('tipo','telefono')->get();
		$data['sobres'] = Empresa_model::where('tipo','sobre')->get();
		$data['correos'] = Empresa_model::where('tipo','correo')->get();
		$this->slice->view('admin.empresa.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function nuevo()
	{
		$this->slice->view('admin.empresa.crear');
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$desc = $this->input->post('descripcion');
		$telef = $this->input->post('telefono');
		$correo = $this->input->post('correo');

		$guardar = '';
		if ($desc) {
			$guardar = $desc;
		}
		elseif ($correo) {
			$guardar = $correo;
		}
		elseif ($telef) {
			$guardar = ['telefono'=> $telef,'tipo_telef'=>$this->input->post('tipo_telef')];
			$guardar = json_encode($guardar);
		}

		$item = new Empresa_model;

		$item->tipo = $this->input->post('tipo');
		$item->descripcion = $guardar;

		$item->save();

		redirect('administrador/empresa','refresh');
	}

	public function editar_item($item)
	{
		$data['empresa'] = Empresa_model::find($item);
		$this->slice->view('admin.empresa.editar',$data);
	}

	public function post_editar($item)
	{
		$desc = $this->input->post('descripcion');
		$telef = $this->input->post('telefono');
		$correo = $this->input->post('correo');

		$guardar = '';
		if ($desc) {
			$guardar = $desc;
		}
		elseif ($correo) {
			$guardar = $correo;
		}
		elseif ($telef) {
			$guardar = ['telefono'=> $telef,'tipo_telef'=>$this->input->post('tipo_telef')];
			$guardar = json_encode($guardar);
		}

		$item = Empresa_model::find($item);

		$item->descripcion = $guardar;

		$item->save();

		redirect('administrador/empresa','refresh');
	}

	public function borrar($item)
	{
		$item = Empresa_model::find($item);

		$item->delete();

		redirect('administrador/empresa','refresh');
	}

}
