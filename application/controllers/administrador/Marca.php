<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {

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
		$data['marcas'] = Marca_model::all();
		$this->slice->view('admin.marca.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear()
	{
		$this->slice->view('admin.marca.crear');
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$marca = new Marca_model;

		$marca->nombre = $this->input->post('nombre');
		$date = strftime('%A');
		$dataF = substr($date, 0, 1);
		$dataL = substr($date, -1, 1);
		$nombre = $this->input->post('nombre');
		$nombre = trim($nombre);
		$nombre = str_replace(' ','_',$nombre);
		$config['upload_path'] = './assets/common/uploads/marca/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '1024';
		$config['file_name'] = strtoupper($dataF) . strtoupper($dataL) . date('Y') . strtoupper(random_string('alpha', 2)) . $nombre;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen')) {
			$this->session->set_flashdata('logo', ['errors' => $this->upload->display_errors()]);
			redirect('administrador/marca/crear', 'refresh');
		} else {
			$marca->logo = $this->upload->data('file_name');
			$marca->save();
			redirect('administrador/marca','refresh');
		}



	}

	public function editar($marca)
	{
		$data['marca'] = Marca_model::find($marca);
		$this->slice->view('admin.marca.editar',$data);
	}

	public function post_editar($marca)
	{
		$marca = Marca_model::find($marca);

		$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : '';
		$redirect = 'administrador/marca/';
		$marca->nombre = $this->input->post('nombre');

		if($imagen != '' && $imagen != $marca->logo){
			$date = strftime('%A');
			$dataF = substr($date, 0, 1);
			$dataL = substr($date, -1, 1);
			$nombre = $this->input->post('nombre');
			$nombre = trim($nombre);
			$nombre = str_replace(' ', '_', $nombre);
			$config['upload_path'] = './assets/common/uploads/marca/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '1024';
			$config['file_name'] = strtoupper($dataF) . strtoupper($dataL) . date('Y') . strtoupper(random_string('alpha', 2)) . $nombre;
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('imagen')) {
				$this->session->set_flashdata('logo', ['errors' => $this->upload->display_errors()]);
				$redirect = 'administrador/marca/editar/' . $marca->id_marca;
			} else {
				$marca->logo = $this->upload->data('file_name');
			}
		}
		
		$marca->save();

		redirect($redirect, 'refresh');
	}


}
