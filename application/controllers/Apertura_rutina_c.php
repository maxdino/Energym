<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Apertura_rutina_c extends BaseController {

	public function __construct() {
		parent::__construct();    	
	}

	public function index(){ 
		$data=array();
		$data["titulo_descripcion"]="Lista de Apertura Rutina";
		$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM apertura_rutina left join instructor on instructor.instructor_id=apertura_rutina.instructor_id WHERE estado = 1  ");
		$this->vista("Apertura_rutina/index",$data);
	}

	public function nuevo(){
		$data=array();
		$data["titulo_descripcion"]="Nuevo Apertura Rutina";
		$data["instructor"]=$this->Mantenimiento_m->consulta3("SELECT * FROM instructor WHERE instructor_estado = 1  ");
		$data["rutina"]=$this->Mantenimiento_m->consulta3("SELECT * FROM rutina_paquete WHERE estado = 1  ");
		$this->vista("Apertura_rutina/nuevo_v",$data);
	}
	public function guardar(){
	 
		$data=array(
			"fecha_inicio"=>$this->input->post("fecha_inicio"),
			"fecha_fin"=>$this->input->post("fecha_fin"),
			"hora_inicio"=>$this->input->post("hora_inicio"),
			"hora_fin"=>$this->input->post("hora_fin"),
			"frecuencia"=>$this->input->post("frecuencia"),
 			"rutina_paquete_id"=>$this->input->post("rutina"),
 			"instructor_id"=>$this->input->post("instructor"),
			"estado"=>1
		);

		if($this->input->post("id")==""){
			$estado=$this->db->insert('apertura_rutina', $data);
			
			echo json_encode(1);
		}else{
			$this->db->where('apertura_rutina_id',$this->input->post("id"));
			$estado=$this->db->update('apertura_rutina', $data);
			echo json_encode(2);
		}
		 
	}
	public function editar($id){
		$data=array();
		$data["titulo_descripcion"]="Actualizar Apertura Rutina";
		$data["instructor"]=$this->Mantenimiento_m->consulta3("SELECT * FROM instructor WHERE instructor_estado = 1  ");
		$data["rutina"]=$this->Mantenimiento_m->consulta3("SELECT * FROM rutina_paquete WHERE estado = 1  ");
		$data["id"]=$id;
		$this->vista("Apertura_rutina/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from apertura_rutina where apertura_rutina_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
		$this->Mantenimiento_m->coneliminar("update apertura_rutina set estado=0 where apertura_rutina_id=".$id);
	} 
}
