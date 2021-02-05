<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Asistencia  extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }
    public function index()
    {
     $data=array();
      	$data["titulo_descripcion"]="Asistencia de Clientes";
       // $data["fecha_actual"]=date("Y-m-d");

      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM cliente where cliente_estado=1");
	  	$this->vista("Asistencia/index",$data);
   }
   public function buscar_cliente()
   {
     // $data=$this->Mantenimiento_m->consulta3("select * from cliente where cliente_documento_numero='".$_POST["dni"]."'");
      $this->busqueda_asistencia($_POST["dni"]);

   }

}