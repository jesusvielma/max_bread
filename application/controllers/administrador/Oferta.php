<?php 
use Carbon\Carbon;
defined('BASEPATH') OR exit('No direct script access allowed');

class Oferta extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
        logueado();
   	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function get_ofertas($producto)
	{
		$ofertas = Oferta_model::where('id_producto',$producto)->limit(10)->orderBy('inicio','DESC')->get();

		$producto = Producto_model::find($producto);

		if ($ofertas->count() > 0 ) {			
			$return = [
				'vacio' => 0,
				'ofertas' => $ofertas,
				'title' => 'Ofertas del prodcuto '.$producto->nombre,
			];
		}else{
			$return = [
				'vacio' => 1,
				'title' => 'Este producto no tiene ofertas',
				'msg'   => $producto->nombre .' no tiene ofertas activas o inactivas, te invitamos a que crees una oferta'
			];
		}


		$this->output->set_content_type('application/json')
			->set_output(json_encode($return));
	}

	/**
	 * Muestra el formulario para ingresar nuevos clientes
	 */
	public function crear($producto)
	{
		$data['producto'] = Producto_model::find($producto);
		$this->slice->view('admin.oferta.crear',$data);
	}

	/**
	 * Almacena los datos en la base de datos
	 */
	public function guardar($producto)
	{	
		
		$oferta = new Oferta_model;

		$oferta->nombre = $this->input->post('nombre');
		$oferta->precio = $this->input->post('precio');
		$oferta->descripcion = $this->input->post('descripcion');
		$oferta->inicio = Carbon::now()->toDateTimeString();
		$oferta->fin = Carbon::parse($this->input->post('fecha').' '. $this->input->post('hora'))->toDateTimeString();
		$oferta->id_producto = $producto;

		$oferta->save();

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
