<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once("convertirAletra.php");
class BaseController extends CI_Controller {
  public function __construct() {
    parent::__construct();
    date_default_timezone_set("America/Lima");
    $this->load->model("Mantenimiento_m");
    session_start();
    if(!isset($_COOKIE["config_usuario"])|| $_COOKIE["config_usuario"]==""){
      $this->load->view('Login');
    }
  }

  public function vista($cuerpo,$data=array()){
    if(!isset($_COOKIE["config_usuario"])|| $_COOKIE["config_usuario"]==""){
      header('Location: '.base_url());
      exit();
    }
    $url= $_SERVER["REQUEST_URI"];


    
    $data["datos_usuario"]=$this->Mantenimiento_m->consulta3("SELECT * FROM empleados INNER JOIN perfiles ON empleados.perfil_id = perfiles.perfil_id AND empleados.empleado_id=".$_COOKIE["usuario_id"]);
    $url_array=explode("/",$url);

    $modulos = $this->Mantenimiento_m->consulta3("SELECT modulos.modulo_nombre ,modulos.modulo_id,modulos.modulo_orden,modulos.modulo_icono,modulos.modulo_url,
      modulos.modulo_padre,modulos.estado
      FROM modulos
      INNER JOIN modulos AS MODULOHIJO ON (modulos.modulo_id = MODULOHIJO.modulo_padre)
      INNER JOIN permisos_sede ON permisos_sede.persed_id_modulo = MODULOHIJO.modulo_id
      WHERE
      modulos.modulo_padre=1   and modulos.modulo_id!=1 and
      permisos_sede.persed_id_perfil=".$_COOKIE["usuario_perfil"]."  
      GROUP BY
      MODULOHIJO.modulo_padre
      order by modulo_orden asc"); 

    if($url_array[2]!="tienda"){
          //  header('Location: '.base_url()."tienda");
    }
    
    foreach ($modulos as $key => $value){
      $mod = $this->Mantenimiento_m->consulta3("select modulos.* from modulos inner join permisos_sede on(modulos.modulo_id=permisos_sede.persed_id_modulo) inner join perfiles on(perfiles.perfil_id=permisos_sede.persed_id_perfil) where permisos_sede.persed_id_perfil=".$_COOKIE["usuario_perfil"]."   and modulos.modulo_padre=".$value["modulo_id"]." and modulos.estado=1 GROUP BY modulos.modulo_id");
      $modulos[$key]["lista"] = $mod;
    }
    if($_COOKIE["config_usuario"]){
     $data["titulo"]='Energym';
     $data["logo_empresa"]='1234567';
     $data["titulo_corto"]= 'qwe'; 
     $this->load->view('Layout',compact("data","modulos"));
     $this->load->view($cuerpo,compact("data"));
     $this->load->view('Footer',compact("data"));
   }else{
    header('Location: '.base_url());
  }
}

public function validar_sesion(){
  if(!isset($_COOKIE["config_usuario"])|| $_COOKIE["config_usuario"]==""){
    $this->load->view('Login');
    exit();
  }
}

public function busqueda_asistencia($dni)
{
  $json=array();
  $alerta = '0';
  $cliente=$this->Mantenimiento_m->consulta3("select * from cliente where cliente_documento_numero='".$_POST["dni"]."'");
  if(sizeof($cliente)>0){
    $data=$this->Mantenimiento_m->consulta3("SELECT max(fecha_fin) as fecha_final ,matricula.*
      from matricula where matricula.cliente_id=".$cliente[0]["cliente_id"]." and matricula.estado=1"); 
    if(($data[0]["fecha_final"]))
    {
      $fecha1 = new DateTime(date("Y-m-d"));
      $fecha2 = new DateTime($data[0]["fecha_final"]);
      $resultado = $fecha1->diff($fecha2);
      $dias =  $resultado->format('%a'); 
      if ($dias  <= 7 ) { 
        $alerta= '1';
      }else{ 
       $alerta = '2';
     }

     $fecha_actual=strtotime(date("Y-m-d"));
     $fecha_final=strtotime($data[0]["fecha_final"]);
     if($fecha_actual<=$fecha_final)
     {

     $fecha_actual=strtotime(date("Y-m-d"));
     $fecha_inicio=strtotime($data[0]["fecha_inicio"]);
      if ($fecha_inicio<=$fecha_actual) {
 
      $verficar=$this->Mantenimiento_m->consulta3("select * from asistencia inner JOIN control_asistencia on control_asistencia.asistencia_id=asistencia.asistencia_id where matricula_id=".$data[0]["matricula_id"]." and control_asistencia.asistencia_fecha='".date("Y-m-d")."'")  ;
      if($verficar[0]["fecha"]==''&&$verficar[0]["hora"]==''){
       $fecha_hora = date('Y-m-d H:i:s');
        $datos=array(
         "estado"=>1,
         "fecha"=>date("Y-m-d"),
         "hora"=>date("H:i:s")
       );
        $this->db->where('asistencia_id',$verficar[0]["asistencia_id"]);
        $this->db->where('matricula_id',$data[0]["matricula_id"]);
        $this->db->update('asistencia',$datos);
        $json=array(
         "mensaje"=>"SE REGISTRO CORRECTAMENTE",
         "estado"=>1,
         "fecha"=>$fecha_hora,
         "dni"=>$dni,
         "nombre"=>$cliente[0]["cliente_nombre_completo"],
         "dias" => 'Quedan '.$dias.' dias',
         "alerta" => $alerta
       );

      }else{

        $json=array(
         "mensaje"=>"YA SE REGISTRO SU ASISTENCIA",
         "estado"=>2,
         "fecha"=>$verficar[0]["fecha"].' '.$verficar[0]["hora"],
         "dni"=>$dni,
         "nombre"=>$cliente[0]["cliente_nombre_completo"],
         "dias" => 'Quedan '.$dias.' dias',
         "alerta" => $alerta
       );  
      }
    }else{
      $fecha1 = new DateTime(date("Y-m-d"));
      $fecha2 = new DateTime($data[0]["fecha_inicio"]);
      $resultado = $fecha1->diff($fecha2);
      $dias =  $resultado->format('%a'); 
       $alerta = '2';

      $json=array(
     "mensaje"=>"AUN NO COMIENZA SU MATRICULA",
     "estado"=>2,
     "fecha"=>" ",
     "dni"=>$dni,
     "nombre"=>$cliente[0]["cliente_nombre_completo"],
     "dias" => 'Le faltan '.$dias.' dias para que comienze su matricula',
     "alerta" => $alerta
      );
    }

    }else
    {
     $json=array(
       "mensaje"=>"NO TIENE UNA MATRICULA ACTIVA ",
       "estado"=>2,
       "fecha"=>"necesita actulizar su matricula",
       "dni"=>$dni,
       "nombre"=>$cliente[0]["cliente_nombre_completo"],
       "dias" => '',
       "alerta" => $alerta
     );  

   }



 }else
 {
   $json=array(
     "mensaje"=>"NO TIENE UNA MATRICULA ACTIVA ",
     "estado"=>2,
     "fecha"=>"necesita actualizar su matricula",
     "dni"=>$dni,
     "nombre"=>$cliente[0]["cliente_nombre_completo"],
     "dias" => '',
     "alerta" => $alerta
   );  

 }
}else
{

 $json=array(
   "mensaje"=>"NO EXISTE EN LA BASE DE DATOS ESTE CLIENTE",
   "estado"=>2,
   "fecha"=>"si desea puede crearlo",
   "dni"=>$dni,
   "nombre"=>"Si deseas puedes registrar <a href='".base_url()."Cliente/nuevo'>aqui</a>",
   "dias" => '',
   "alerta" => $alerta
 );  

}

echo json_encode($json);


}

}
?>