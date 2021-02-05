<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portada extends CI_Controller {

	public function index(){
		$this->load->view('Portada/index.php');
		
	}
}
