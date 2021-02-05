<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Rutina_c extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Rutina Paquete";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM rutina_paquete WHERE estado = 1  ");
	  	$this->vista("Rutina/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Rutina Paquete"; 
      	$data["tipo_paquete"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_paquete WHERE estado = 1  ");
	  	$this->vista("Rutina/nuevo_v",$data);
	}
	public function guardar(){
		$data=array(
          "rutina_paquete_descripcion"=>$this->input->post("descripcion"),
          "tipo_paquete_id"=>$this->input->post("tipo_paquete"),
          "estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('rutina_paquete', $data);
		}else{
            $this->db->where('rutina_paquete_id',$this->input->post("id"));
	        $estado=$this->db->update('rutina_paquete', $data);
		}
    	header('Location: '.base_url()."Rutina_c");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Rutina Paquete";
      	$data["tipo_paquete"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_paquete WHERE estado = 1  ");
      	$data["id"]=$id;
	  	$this->vista("Rutina/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from rutina_paquete where rutina_paquete_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update rutina_paquete set estado=0 where rutina_paquete_id=".$id);
	} 
}
