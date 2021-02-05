<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Editarusuario extends BaseController {

 	public function __construct() {
        parent::__construct();      	
    }

	public function index(){
     	$data=array();
      $data["titulo_descripcion"]="Perfil Usuario";
      $data["tabla"]=$this->Mantenimiento_m->consulta2("SELECT * FROM empleados INNER JOIN perfiles ON empleados.perfil_id = perfiles.perfil_id where empleado_id=".$_COOKIE["usuario_id"]." ");
	  	$this->vista("PerfilUsuario/index",$data);
	}
 

function actualizar(){
      $post = $_POST;
      $file = $_FILES; 
       if($file['fileToUpload']['name']!=""){   
        $dir_subida = $_SERVER['DOCUMENT_ROOT']."/energym/public/assets/images/foto_perfil/";
        $nombre=basename($file['fileToUpload']['name']) ;
        $datos_url=explode(".", $nombre);
        $can=sizeof($datos_url);
        $res=$can-1;
        $url=md5(rand().time()).".".$datos_url[$res];
        $fichero_subido = $dir_subida.$url;   
        if (copy($file['fileToUpload']['tmp_name'], $fichero_subido)){ 
        }else {
          echo "Error al subir la foto es demasiado grande";                 
        }      
        $nombre_imagen=$url;
      }else{
        $producto = $this->Mantenimiento_m->consulta("SELECT empleado_foto FROM empleados WHERE empleado_id = ".$_POST["id"]); 
        $nombre_imagen = $producto[0]->empleado_foto;
      }

    $dat= array( "empleado_nombres" => $post["nombreempleado"],
          "empleado_apellidos" => $post["apellidoempleado"],
          "empleado_dni" => $post["dni"],
          "empleado_direccion" => $post["direccionempleado"],
          "empleado_email" => $post["correo"],
          "empleado_telefono" => $post["telefonoempleado"],
          "empleado_clave" => $post["contrasenia"],
          "empleado_nombre_completo" => $post["nombreempleado"]." ".$post["apellidoempleado"],
          "empleado_fecha_nacimiento" => $post["mdate"],
          "empleado_sexo" => $post["sexoempleado"],
          "empleado_foto " =>  $nombre_imagen  );
      $this->db->where('empleado_id',$_COOKIE["usuario_id"]);
      $estado=$this->db->update('empleados', $dat);

    if ($estado == 1) {
      header('Location: '.base_url()."Editarusuario");
    }else{
      echo 'Error';
    }
  }

  
	public function guardar(){ 
		$data=array(
          "empleado_nombres"=>$this->input->post("nombreempleado"),
          "empleado_apellidos"=>$this->input->post("apellidoempleado"),
          "empleado_dni"=>$this->input->post("dni"),
          "empleado_direccion"=>$this->input->post("direccionempleado"),
          "empleado_email"=>$this->input->post("correo"),
          "empleado_telefono"=>$this->input->post("telefonoempleado"),
          "empleado_clave"=>$this->input->post("contrasenia"),
          "empleado_nombre_completo"=>$this->input->post("nombreempleado").' '.$this->input->post("apellidoempleado"),
          "empleado_fecha_nacimiento"=>$this->input->post("mdate"),
          "empleado_sexo"=>$this->input->post("sexoempleado")
		);  
 
      $this->db->where('empleado_id',$_COOKIE["usuario_id"]);
	    $estado=$this->db->update('empleados', $data); 
	}
}
