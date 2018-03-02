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
}
