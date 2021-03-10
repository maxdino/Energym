	<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";
class Permisos extends BaseController {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data = array();
		$data["titulo_descripcion"]="Configuración de Permisos";
		$data["perfiles"]=$this->Mantenimiento_m->consulta3("SELECT * FROM perfiles where estado=1"); 

		$this->vista("Permisos/index",$data);
	}

 
	public function traermodulos(){
 
		
		$data = $this->db->query("SELECT modulohijo.modulo_id,modulohijo.modulo_padre,modulohijo.modulo_nombre as nombre_padre
			FROM
			modulos 
			INNER JOIN modulos AS modulohijo ON modulos.modulo_padre = modulohijo.modulo_id
 			WHERE modulohijo.modulo_id != 1 and modulos.estado=1
			GROUP BY modulohijo.modulo_padre,modulohijo.modulo_nombre")->result_array();//padre
		foreach ($data as $key => $value) {
			$mod = $this->db->query("SELECT modulos.modulo_id,modulos.modulo_nombre
				FROM
				modulos
				INNER JOIN modulos AS modulohijo ON modulos.modulo_padre = modulohijo.modulo_id 
				WHERE
				modulos.estado=1 and
				modulohijo.modulo_id =".$value["modulo_id"])->result_array();//hijo
			$data[$key]["lista"] = $mod;
		}
 
		$data[$key+1]["permisos"] = $this->db->get_where('permisos_sede', array('persed_id_perfil' =>$this->input->post("id")))->result_array();

 
		echo json_encode($data);

	}

	public function procesamiento(){
		$post=file_get_contents("php://input"); 
		$res=json_decode($post, true);
		$params=array();
		parse_str($res["documento"], $params); 
		if(!isset($params["permisos"])){
			echo '1';
		}else{
			$cantidad = count($params["permisos"]);	
			$this->db->query("DELETE FROM permisos_sede WHERE persed_id_perfil=".$params["perfil"] );
			for ($i=0; $i < $cantidad; $i++) { 
				$data=array(
					"persed_id_perfil"=>$params["perfil"],
					"persed_id_modulo" => $params["permisos"][$i] 
				);
				$estado=$this->db->insert('permisos_sede', $data);
			}	
			

			echo 2;
		}

	}

	

	

	



}