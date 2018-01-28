<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rs extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
        logueado();
   	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function nuevo()
	{
		$data['existentes'] = Rs_model::all();
		$this->slice->view('admin.empresa.rs.crear',$data);
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		if ($this->input->post('rs') == 'tw') {
			$url = 'http://twitter.com/' . str_replace('@', '', $this->input->post('url'));
		}
		elseif($this->input->post('rs') == 'in') {
			$url = 'http://instagram.com/' . str_replace('@','',$this->input->post('url'));
		}
		else{
			$url = $this->input->post('url');
		}
		$rs = [
			'nombre' =>  trim($this->input->post('nombre')),
			'url'    => $url,
			'tipo'   => $this->input->post('rs')
		];

		print_r($rs);

		Rs_model::create($rs);

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
		$item = Rs_model::find($item);

		$item->delete();

		redirect('administrador/empresa','refresh');
	}

}
