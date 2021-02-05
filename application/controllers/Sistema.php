<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";
class Sistema extends BaseController {

  public function __construct() {
   	parent::__construct();
  }
	public function index(){
    	$data=array();
    	$data["titulo_descripcion"]="Panel de control";
	  	$this->vista("Principal/index",$data);
	}

	
}