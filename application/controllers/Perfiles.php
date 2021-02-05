<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Perfiles extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de perfiles";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from perfiles where estado=1");
	  	$this->vista("Perfil/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Perfil"; 
	  	$this->vista("Perfil/nuevo",$data);
	}
	public function guardar(){
		$data=array(
          "perfil_descripcion"=>$this->input->post("descripcion")
		); 
		if($this->input->post("id")==""){
         	$estado=$this->db->insert('perfiles', $data);
		}else{
            $this->db->where('perfil_id',$this->input->post("id"));
	        $estado=$this->db->update('perfiles', $data);
		}
    	header('Location: '.base_url()."perfiles");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Perfil";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from perfiles where estado=1");
      	$data["id"]=$id;
	  	$this->vista("Perfil/nuevo",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from perfiles where perfil_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update perfiles set estado=0 where perfil_id=".$id);
	} 
}
