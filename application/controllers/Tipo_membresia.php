<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Tipo_membresia  extends BaseController {

  public function __construct() {
    parent::__construct();    	
  }
  public function index()
  {
   $data=array();
   $data["titulo_descripcion"]="Lista Membresia";
   $data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_membresia where tipo_membresia_estado=1");
   $this->vista("Tipo_membresia/index",$data);
 }
 public function mostrar_cliente()
 {
   $data=array();    
   $data["cliente"]=$this->Mantenimiento_m->consulta3("select *
    FROM
    cliente
    INNER JOIN tipo_documento_cliente ON cliente.tipo_documento_cliente_id = tipo_documento_cliente.tipo_documento_cliente_id
    where cliente_estado=1 ");

   echo json_encode($data);exit();


 }
 public function nuevo()
 {
   $data=array();
   $data["servicio"]=$this->Mantenimiento_m->consulta3("SELECT * FROM servicio where servicio_estado=1");
   $data["titulo_descripcion"]="Nuevo Tipo de membresia";
       // $data["tipo_documento"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento_cliente where tipo_documento_cliente_estado=1");
   $this->vista("Tipo_membresia/nuevo",$data);
 }

 public function guardar()
 {
   $data=array(
    "tipo_membresia_descripcion"=>$_POST["descripcion"],
    "tipo_membresia_mes"=>$_POST["meses"],
    "tipo_membresia_precio_mes"=>$_POST["precio_mensual"],
    "tiempo_duracion"=>$_POST["fecha"],
    "tipo_duracion"=>$_POST["tipo_periodo"],
    "tipo_membresia_fecha_registro"=>date("Y-m-d"),
    "estado_asistencia" => $_POST["estado_asistencia"],
    "cantidad_personas" => $_POST["cantidad_personas"]

  );
   if($_POST["id"]=="")
   {
    $id = $this->Mantenimiento_m->insertar("tipo_membresia",$data);
    for ($i=0; $i <count($_POST["servicio"]) ; $i++) { 
      $data=array(
        "tipo_membresia_id"=>$id,
        "servicio_id"=>$_POST["servicio"][$i]
      );
      $this->Mantenimiento_m->insertar("detalle_servicio",$data);
    }
    echo 1;
  }else{
   $this->Mantenimiento_m->actualizar("tipo_membresia",$data,$_POST["id"],"tipo_membresia_id");
   $this->db->where('tipo_membresia_id',$_POST["id"]);
   $this->db->delete('detalle_servicio');
   for ($i=0; $i <count($_POST["servicio"]) ; $i++) { 
    $datos=array(
      "tipo_membresia_id"=>$_POST["id"],
      "servicio_id"=>$_POST["servicio"][$i]
    );
    $this->Mantenimiento_m->insertar("detalle_servicio",$datos);
  }
  echo 2;
}
}



public function editar($id)
{

 $data=array();
 $data["titulo_descripcion"]="Editar Tipo Membresia";
 $data["servicio"]=$this->Mantenimiento_m->consulta3("SELECT * FROM servicio where servicio_estado=1");
 $data["id"]=$id;
 $this->vista("Tipo_membresia/nuevo",$data);


}
public function traer_datos()
{
 $sql="select * from tipo_membresia where tipo_membresia_id=".$_POST["id"];
 $sql1="select * from detalle_servicio where tipo_membresia_id=".$_POST["id"];
 $data['tipo_membresia']=$this->Mantenimiento_m->consulta3($sql);
 $data['servicio']=$this->Mantenimiento_m->consulta($sql1);
 echo json_encode($data);exit();

}

public function eliminar(){
  $id=$_POST['id'];
  $this->Mantenimiento_m->coneliminar("update tipo_membresia set tipo_membresia_estado=0 where tipo_membresia_id=".$id);
}

}
