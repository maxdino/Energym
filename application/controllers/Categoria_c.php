<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Categoria_c extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Categoria";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto WHERE categoria_producto_estado = 1  ");
	  	$this->vista("Categoria/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo categoria"; 
	  	$this->vista("Categoria/nuevo_v",$data);
	}
	public function guardar(){
		$data=array(
          "categoria_producto_descripcion"=>$this->input->post("descripcion"),
          "categoria_producto_estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('categoria_producto', $data);
		}else{
            $this->db->where('categoria_producto_id',$this->input->post("id"));
	        $estado=$this->db->update('categoria_producto', $data);
		}
    	header('Location: '.base_url()."Categoria_c");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Categoria";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria where categoria_estado=1");
      	$data["id"]=$id;
	  	$this->vista("categoria/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from categoria_producto where categoria_producto_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update categoria_producto set categoria_producto_estado=0 where categoria_producto_id=".$id);
	} 
}
