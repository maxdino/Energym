<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Errores extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]=""; 
	  	$this->vista("Errores",$data);
	}

 
}
