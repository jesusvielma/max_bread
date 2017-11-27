<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

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

		// $this->load->view('admin/base/header');
		$data['hola'] = 'hola';
		//echo $this->blade->view()->make('admin/base/empty',$data)->render();
		$this->slice->view('admin.empty',$data);
		// $this->load->view('admin/base/footer');
	}


}
