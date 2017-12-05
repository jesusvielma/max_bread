<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$data['abouts'] = Empresa_model::where('tipo','sobre')->get();
		$data['telefs'] = Empresa_model::where('tipo','telefono')->get();
		$data['mails'] = Empresa_model::where('tipo','correo')->get();
		$data['productos'] = Categoria_model::with('productos')->get();
		$data['slider'] = Slider_model::where('estado',1)->orderBy('posicion','ASC')->get();
		$this->slice->view('front.index',$data);
	}
}
