<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Control_asistencia_c extends BaseController {

	public function __construct() {
		parent::__construct();    	
	}

	public function index(){ 
		$data=array();
		$data["titulo_descripcion"]="Lista de Control Asistencia";
		$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM control_asistencia inner join  apertura_rutina on apertura_rutina.apertura_rutina_id=control_asistencia.apertura_rutina_id inner join instructor on apertura_rutina.instructor_id=instructor.instructor_id  WHERE asistencia_estado = 1  ");
		$this->vista("Control_asistencia/index",$data);
	}

	public function nuevo(){
		$data=array();
		$data["titulo_descripcion"]="Nuevo Control Asistencia"; 
		$data["apertura_rutina"]=$this->Mantenimiento_m->consulta3("SELECT * FROM apertura_rutina left join instructor on instructor.instructor_id=apertura_rutina.instructor_id WHERE estado = 1  ");
		$this->vista("Control_asistencia/nuevo_v",$data);
	}
	public function guardar(){
		$verificar = $this->Mantenimiento_m->consulta3("select * from control_asistencia where asistencia_fecha='".date('Y-m-d')."' and apertura_rutina_id=".$this->input->post("rutina"));
		
		$data=array(
			"asistencia_fecha_hora"=>date('Y-m-d H:i:s'),
			"asistencia_fecha"=>date('Y-m-d'),
			"asistencia_estado"=>1,
			"apertura_rutina_id"=>$this->input->post("rutina")
		);

		if($this->input->post("id")==""){
			if (count($verificar)==0) { 
			$id_control  = $this->Mantenimiento_m->insertar('control_asistencia', $data);
			$alumnos_matriculados = $this->Mantenimiento_m->consulta3("select cliente.cliente_nombre_completo,matricula.matricula_id
				from apertura_rutina LEFT JOIN matricula on matricula.apertura_rutina_id=apertura_rutina.apertura_rutina_id
				LEFT JOIN  cliente on cliente.cliente_id=matricula.cliente_id where cliente.cliente_estado=1 and matricula.fecha_inicio<='".date('Y-m-d')."' and matricula.fecha_fin>='".date('Y-m-d')."' and matricula.apertura_rutina_id=".$this->input->post("rutina") );
			foreach ($alumnos_matriculados as $key => $value)  { 

				$datos =array(
					"asistencia_id"=>$id_control,
					"matricula_id"=>$value['matricula_id'],
					"estado"=>0
				);
				$this->db->insert('asistencia', $datos);
				
			} 
			echo 1;
			}else{
				echo  3;
			}
			

		}else{
			$this->db->where('asistencia_id',$this->input->post("id"));
			$estado=$this->db->update('control_asistencia', $data);
		}
		
	}

	public function editar($id){
		$data=array();
		$data["titulo_descripcion"]="Actualizar Control Asistencia";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria where categoria_estado=1");
		$data["id"]=$id;
		$this->vista("Control_asistencia/nuevo_v",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from control_asistencia where asistencia_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
		$this->Mantenimiento_m->coneliminar("update control_asistencia set asistencia_estado=0 where asistencia_id=".$id);
	} 
}
