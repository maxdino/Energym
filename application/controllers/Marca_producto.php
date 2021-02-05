<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Marca_producto extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Marca";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM marca WHERE marca_estado = 1  ");
	  	$this->vista("Marca/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Marca"; 
	  	$this->vista("Marca/nuevo",$data);
	}
	public function guardar(){
		$data=array(
          "marca_descripcion"=>$this->input->post("descripcion"),
          "marca_estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('marca', $data);
		}else{
            $this->db->where('marca_id',$this->input->post("id"));
	        $estado=$this->db->update('marca', $data);
		}
    	header('Location: '.base_url()."Marca_producto");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Marca";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from marca where marca_estado=1");
      	$data["id"]=$id;
	  	$this->vista("Marca/nuevo",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from marca where marca_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update marca set marca_estado=0 where marca_id=".$id);
	} 
}
