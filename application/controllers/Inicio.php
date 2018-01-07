<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Santiago');
        setlocale(LC_ALL, 'es_ES.UTF-8');
		\Carbon\Carbon::setlocale('es');
    }

	public function index()
	{
		$data['abouts'] = Empresa_model::where('tipo','sobre')->get();
		$data['telefs'] = Empresa_model::where('tipo','telefono')->get();
		$data['mails'] = Empresa_model::where('tipo','correo')->get();
		$data['productos'] = Categoria_model::with(['productos' => function($query){
			$query->where('disponibilidad','1');
		}])->get();
		$data['testimonios'] = Testimonio_model::orderBy('fecha','DESC')->limit(5)->get();
		$data['slider'] = Slider_model::where('estado',1)->orderBy('posicion','ASC')->get();
		$this->slice->view('front.index',$data);
	}


	// public function email($tipo){
    //
	// 	$pedido = Pedido_model::find(18);
	// 	$correo = [
	// 		'correo' => 'correo@corre.com',
	// 		'pedido' => $pedido,
	// 		'url'	 => site_url(),
	// 		'destinatario' => (object)[
	// 			'tipo' => $tipo,
	// 			'nombre' => '<i class="fa fa-user"></i> Jose Perez',
	// 			'empresa' => '<i class="fa fa-building"></i> Nombre de la empresa'
	// 		],
	// 		'contenido' => (object)[
	// 			'cuerpo' => 'Usted ha recibido este correo porque el administrador de sitio <a href="'.site_url().'">max-bread.cl</a> ha ingresado sus datos en el mismo. <br /> Se ha creado un <i class="fa fa-user-circle"></i> usuario con su correo electrónico para acceder al sitio visite la página <a href="'.site_url().'">max-bread.cl</a> y presione el link entrar en la parte superior derecha.',
	// 			'alertas' => [
	// 				'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
	// 			]
	// 		],
	// 		'asunto' => 'Hemos recibido tu pedido'
	// 	];
    //
	// 	$this->slice->view('admin.email.pedido_ingresado',$correo);
	// }
}
