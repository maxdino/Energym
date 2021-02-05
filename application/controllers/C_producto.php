<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class C_producto extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Categoría Producto";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto WHERE categoria_producto_estado = 1 and id_sede = " .$_COOKIE["id_sede"]);
	  	$this->vista("C_producto/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Categoria Producto"; 
	  	$this->vista("C_producto/nuevo",$data);
	}
	public function guardar(){
		$data=array(
          "categoria_producto_descripcion"=>$this->input->post("descripcion"),
          "id_sede" => $_COOKIE["id_sede"]
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('categoria_producto', $data);
		}else{
            $this->db->where('categoria_producto_id',$this->input->post("id"));
	        $estado=$this->db->update('categoria_producto', $data);
		}
    	header('Location: '.base_url()."C_producto");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Categoria Producto";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria_producto where categoria_producto_estado=1");
      	$data["id"]=$id;
	  	$this->vista("C_producto/nuevo",$data);
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
