<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Instructor_c extends BaseController {

	public function __construct() {
		parent::__construct();    	
	}

	public function index(){ 
		$data=array();
		$data["titulo_descripcion"]="Lista de Instructores";
		$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM instructor WHERE instructor_estado = 1  ");
		$this->vista("Instructor/index",$data);
	}

	public function nuevo(){
		$data=array();
		$data["titulo_descripcion"]="Nuevo Instructor"; 
		$this->vista("Instructor/nuevo_v",$data);
	}
	public function guardar(){
		if ($_FILES['fileToUpload']['name']==null) {
			$imagen = $_POST['imagen_valida'];
		}else{
			$cadena = str_replace(' ','', $_FILES['fileToUpload']['name']);
			$imagen = "instructor/".$cadena;  
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'public/imagen/'.$imagen);
		}

		$data=array(
			"instructor_nombre"=>$this->input->post("nombre"),
			"instructor_dni"=>$this->input->post("dni"),
			"instructor_imagen"=>$imagen,
			"instructor_estado"=>1
		);

		if($this->input->post("id")==""){
			$estado=$this->db->insert('instructor', $data);
		}else{
			$this->db->where('instructor_id',$this->input->post("id"));
			$estado=$this->db->update('instructor', $data);
		}
		header('Location: '.base_url()."Instructor_c");
	}
	public function editar($id){
		$data=array();
		$data["titulo_descripcion"]="Actualizar Instructor";
		$data["id"]=$id;
		$this->vista("Instructor/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from instructor where instructor_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
		$this->Mantenimiento_m->coneliminar("update instructor set estado=0 where instructor_id=".$id);
	} 
}
