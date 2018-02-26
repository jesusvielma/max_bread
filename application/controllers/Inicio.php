<?php

use Carbon\Carbon;
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
			$query->where('disponibilidad','1')->orderby('id_marca','ASC');
		}])->get();
		$data['marcas'] = Marca_model::all();
		$data['testimonios'] = Testimonio_model::orderBy('fecha','DESC')->limit(5)->get();
		$data['slider'] = Slider_model::where('estado',1)->orderBy('posicion','ASC')->get();
		$data['ofertas'] = Oferta_model::where('fin','>=',Carbon::now()->format('Y-m-d H:i:s'))->orderby('fin','ASC')->get();
		$data['redes'] = Rs_model::all();
		$this->slice->view('front.index',$data);
	}


	public function email($tipo){

		// $pedido = Pedido_model::find(18);
		// $correo = [
		// 	'correo' => 'jesusvielma309@gmail.com',
		// 	'pedido' => $pedido,
		// 	'url'	 => site_url(),
		// 	'destinatario' => (object)[
		// 		'tipo' => $tipo,
		// 		'nombre' => '<i class="fa fa-user"></i> Jose Perez',
		// 		'empresa' => '<i class="fa fa-building"></i> Nombre de la empresa'
		// 	],
		// 	'contenido' => (object)[
		// 		'cuerpo' => 'Usted ha recibido este correo porque el administrador de sitio <a href="'.site_url().'">max-bread.cl</a> ha ingresado sus datos en el mismo. <br /> Se ha creado un <i class="fa fa-user-circle"></i> usuario con su correo electrónico para acceder al sitio visite la página <a href="'.site_url().'">max-bread.cl</a> y presione el link entrar en la parte superior derecha.',
		// 		'alertas' => [
		// 			'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
		// 		]
		// 	],
		// 	'asunto' => 'Hemos recibido tu pedido'
		// ];

		// $this->slice->view('admin.email.pedido_ingresado',$correo);

		// $correo = [
		// 	'correo' => 'jesusvielma309@gmail.com',
		// 	'token' => random_string('sha1'),
		// 	'destinatario' => (object)[
		// 		'tipo' => $tipo,
		// 		'nombre' => 'Jose Perez',
		// 		'empresa' => 'Nombre de la empresa'
		// 	],
		// 	'contenido' => (object)[
		// 		'cuerpo' => 'Hemos ricibidio tu solicutud de restauración de clave de acceso al sitio, al final este correo encontrar el token que deberas ingresar para poder realizar el cambio de la clave.',
		// 		'alertas' => [
		// 			'tokenMsg'=>'El token es valido durante 30 minutos, si en este tiempo no puedes realizar el cambio de tu clave deberas comenzar el proceso de nuevo.',
		// 			'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
		// 		]
		// 	],
		// 	'asunto' => 'Hemos recibido tu pedido'
		// ];

		// $this->slice->view('admin.email.recuperar_clave', $correo);

		/* $correo = [
			'correo' => 'jesusvielma309@outlook.com',
			'clave'  => 'secreto',
			'url'	 => site_url(),
			'destinatario' => (object)[
				'tipo' => $tipo,
				'nombre' => $tipo== 'natural' ? 'Pedro Peres' : 'Pedro Preex',
				'empresa' => 'Nombre de la empresa'
			],
			'contenido' => (object)[
				'cuerpo' => 'Usted ha recibido este correo porque el administrador de sitio <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a> ha ingresado sus datos en el mismo. <br /> Se ha creado un usuario con su correo electrónico para acceder al sitio visite la página <a style="color:#FF9800;" href="'.site_url().'">max-bread.cl</a> y presione el link entrar en la parte superior derecha.',
				'alertas' => [
					'clave'=>'Una vez que ingresas al sitio recuerda cambiar tu clave por una mas segura.',
					'noResponder' => 'Este correo es parte del sistema de notificaciones del sitio, le agradecemos no responderlo. Para cualquier duda por favor comuniquese con el administrador del sitio.'
				]
			],
			'asunto' => 'Bienvenido al sitio de Maxbread'
		];
		//$this->slice->view('admin.email.crear_usuario',$correo);

		$this->load->library('email');

			$config = array(
				'protocol' => 'smtp',
			    'smtp_host' => 'phx.hn.cl',
			    'smtp_port' => 26,
			    'smtp_user' => '_mainaccount@max-bread.cl',
			    'smtp_pass' => 'jconcha.5283',
			    'crlf' => "\r\n",
			    'newline' => "\r\n",
			    'send_multipart' => false,
			);

			$this->email->initialize($config);

			$this->email->from('ventas@max-bread.cl', 'Ventas Max bread');
			$this->email->to($correo['correo']);

			$this->email->subject($correo['asunto']);
			$msg = $this->slice->view('admin.email.crear_usuario',$correo,true);;
			$this->email->message($msg);
			$this->email->set_mailtype('html');

			$this->email->send(FALSE);

			$this->email->print_debugger(array('headers'));*/
	} 
}
