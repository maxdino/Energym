<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Tipo_documento extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Tipo Documento";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento WHERE tipodoc_estado = 1 ");
	  	$this->vista("Tipo_doc/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Tipo Documento"; 
	  	$this->vista("Tipo_doc/nuevo",$data);
	}
	public function guardar(){
		$data=array(
          "tipodoc_descripcion"=>$this->input->post("descripcion"),
          "tipodoc_abreviacion" =>$this->input->post("abreviacion")
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('tipo_documento', $data);
		}else{
            $this->db->where('tipodoc_id',$this->input->post("id"));
	        $estado=$this->db->update('tipo_documento', $data);
		}
    	header('Location: '.base_url()."Tipo_documento");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Tipo Documento"; 
      	$data["id"]=$id;
	  	$this->vista("Tipo_doc/nuevo",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from tipo_documento where tipodoc_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar($id){
      $this->Mantenimiento_m->consulta1("update tipo_documento set tipodoc_estado=0 where tipodoc_id=".$id);
	} 
}
