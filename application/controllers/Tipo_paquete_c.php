<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Tipo_paquete_c extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Tipo Paquete";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_paquete WHERE estado = 1  ");
	  	$this->vista("Tipo_paquete/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Tipo Paquete"; 
	  	$this->vista("Tipo_paquete/nuevo_v",$data);
	}
	public function guardar(){
		$data=array(
          "tipo_paquete_descripcion"=>$this->input->post("descripcion"),
          "estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('tipo_paquete', $data);
		}else{
            $this->db->where('tipo_paquete_id',$this->input->post("id"));
	        $estado=$this->db->update('tipo_paquete', $data);
		}
    	header('Location: '.base_url()."Tipo_paquete_c");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Tipo Paquete";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria where categoria_estado=1");
      	$data["id"]=$id;
	  	$this->vista("Tipo_paquete/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from tipo_paquete where tipo_paquete_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update tipo_paquete set tipo_paquete_estado=0 where tipo_paquete_id=".$id);
	} 
}
