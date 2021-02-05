<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Servicio_c extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Servicio";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM servicio WHERE servicio_estado = 1  ");
	  	$this->vista("Servicio/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Servicio"; 
	  	$this->vista("Servicio/nuevo_v",$data);
	}
	public function guardar(){
		$data=array(
          "servicio_descripcion"=>$this->input->post("descripcion"),
          "servicio_estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('servicio', $data);
		}else{
            $this->db->where('servicio_id',$this->input->post("id"));
	        $estado=$this->db->update('servicio', $data);
		}
    	header('Location: '.base_url()."Servicio_c");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Servicio";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria where categoria_estado=1");
      	$data["id"]=$id;
	  	$this->vista("Servicio/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from servicio where servicio_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update servicio set servicio_estado=0 where servicio_id=".$id);
	} 
}
