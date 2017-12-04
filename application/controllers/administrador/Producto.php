<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

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
		$data['productos'] = Producto_model::all();
		$this->slice->view('admin.producto.index',$data);
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear()
	{
		$data['cats'] = Categoria_model::all();
		$this->slice->view('admin.producto.crear',$data);
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar()
	{
		$producto = new Producto_model;

		$producto->nombre = $this->input->post('nombre');
		$producto->precio_por_mayor = $this->input->post('mayor');
		$producto->precio_por_menor = $this->input->post('menor');
		$producto->cant_por_mayor = $this->input->post('cantidad');
		$producto->disponibilidad = 1;
		$producto->categoria = $this->input->post('categoria');
		$producto->descripcion = $this->input->post('descripcion');

		$producto->save();

		$producto->imagen()->createMany([
			[
				'url' => $this->input->post('primaria'),
				'puesto' => 1
			],
			[
				'url' => $this->input->post('secundaria'),
				'puesto' => 2
			],
			[
				'url' => $this->input->post('tres'),
				'puesto' => 3
			],
			[
				'url' => $this->input->post('cuatro'),
				'puesto' => 4
			],
		]);

		redirect('administrador/producto','refresh');

	}

	public function editar($producto)
	{
		$data['producto'] = Producto_model::find($producto);
		$data['cats'] = Categoria_model::all();
		$this->slice->view('admin.producto.editar',$data);
	}

	public function post_editar($producto)
	{
		$producto = Producto_model::find($producto);
		if($producto->nombre != $this->input->post('nombre')){
			$nombre = $this->input->post('nombre');
			$nombre = trim(strtolower($nombre));
			$nombre = str_replace(' ','_',$nombre);

			$nombre_1 = $producto->nombre;
			$nombre_1 = trim(strtolower($nombre_1));
			$nombre_1 = str_replace(' ','_',$nombre_1);

			rename('assets/common/uploads/productos/'.$nombre_1,'assets/common/uploads/productos/'.$nombre);
		}
		$producto->nombre = $this->input->post('nombre');
		$producto->precio_por_mayor = $this->input->post('mayor');
		$producto->precio_por_menor = $this->input->post('menor');
		$producto->cant_por_mayor = $this->input->post('cantidad');
		$producto->categoria = $this->input->post('categoria');
		$producto->descripcion = $this->input->post('descripcion');

		$producto->save();

		foreach ($producto->imagen as $imagen) {
			if ($imagen->puesto == 1) {
				if ($imagen->url != $this->input->post('primaria')) {
					$imagen = Imagen_Producto_model::find($imagen->id_imagen_producto);
					$imagen->url = $this->input->post('primaria');
					$imagen->save();
				}
			}elseif ($imagen->puesto == 2) {
				if ($imagen->url != $this->input->post('secundaria')) {
					$imagen = Imagen_Producto_model::find($imagen->id_imagen_producto);
					$imagen->url = $this->input->post('secundaria');
					$imagen->save();
				}
			}elseif ($imagen->puesto == 3) {
				if ($imagen->url != $this->input->post('tres')) {
					$imagen = Imagen_Producto_model::find($imagen->id_imagen_producto);
					$imagen->url = $this->input->post('tres');
					$imagen->save();
				}
			}elseif ($imagen->puesto == 4) {
				if ($imagen->url != $this->input->post('cuatro')) {
					$imagen = Imagen_Producto_model::find($imagen->id_imagen_producto);
					$imagen->url = $this->input->post('cuatro');
					$imagen->save();
				}
			}
		}

		redirect('administrador/producto','refresh');
	}

	public function crearDir()
	{
		$nombre = $this->input->post('nombre');
		$nombre = trim(strtolower($nombre));
		$nombre = str_replace(' ','_',$nombre);

		if(!is_dir('assets/common/uploads/productos/'.$nombre)){
			mkdir('assets/common/uploads/productos/'.$nombre,0777);
		}

		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(['nombre'=>$nombre]));
	}

	public function disponibilidad($producto)
	{
		$producto = Producto_model::find($producto);

		if($producto->disponibilidad == 1)
			$producto->disponibilidad = 0;
		else
			$producto->disponibilidad = 1;

		$producto->save();

		redirect('administrador/producto','refresh');
	}



}
