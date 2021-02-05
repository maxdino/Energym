<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Triage_c extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Triage";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM triage 
inner JOIN matricula on matricula.matricula_id=triage.matricula_id
inner JOIN cliente on cliente.cliente_id= matricula.cliente_id  ");
	  	$this->vista("Triage/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Triage"; 
      	$data["matricula"]=$this->Mantenimiento_m->consulta3("SELECT * FROM matricula inner JOIN cliente on cliente.cliente_id= matricula.cliente_id  where matricula.fecha_inicio<='".date('Y-m-d')."' and matricula.fecha_fin>='".date('Y-m-d')."'");
	  	$this->vista("Triage/nuevo_v",$data);
	}
	public function guardar(){
		$verificar = $this->Mantenimiento_m->consulta3("SELECT * FROM triage where triage.matricula_id=".$this->input->post("matricula")." and triage.fecha='".date('Y-m-d')."'");
		if (!($verificar[0]['matricula_id'])) {
		$data=array(
          "peso"=>$this->input->post("peso"),
          "biceps"=>$this->input->post("biceps"),
          "imc"=>$this->input->post("imc"),
          "triceps"=>$this->input->post("triceps"),
          "cintura"=>$this->input->post("cintura"),
          "matricula_id"=>$this->input->post("matricula"),
          "fecha"=>date('Y-m-d'),
          "estado"=>1
      	);

		if($this->input->post("id")==""){
         	$estado=$this->db->insert('triage', $data);
		}else{
            $this->db->where('triage_id',$this->input->post("id"));
	        $estado=$this->db->update('triage', $data);
		}
    	
    }
    header('Location: '.base_url()."Triage_c");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Triage";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from Triage where Triage_estado=1");
      	$data["id"]=$id;
	  	$this->vista("Triage/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from triage inner join matricula on matricula.matricula_id=triage.matricula_id where matricula.matricula_id=".$this->input->post("id"));
		if (!($dat)) {
			$datos['valida'] =0;
		}else{
			$datos['valida']=1 ;
			$c=0;
			foreach ($dat as $value) {
				$datos['peso'][$c]=$value['peso'];
				$datos['imc'][$c]=$value['imc'];
				$datos['biceps'][$c]=$value['biceps'];
				$datos['triceps'][$c]=$value['triceps'];
				$datos['cintura'][$c]=$value['cintura'];
				$datos['fecha'][$c]=$value['fecha'];
				$c++;
			}
		}
		
		echo json_encode($datos);
	}

	public function traer_peso(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Triage"; 
      	 
	  	$this->vista("Triage/peso_v",$data);
	}



	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update Triage_producto set Triage_producto_estado=0 where triage_id=".$id);
	} 
}
