<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//require_once "BaseController.php";



class Login extends CI_Controller {
   public function __construct() {
    parent::__construct();
    date_default_timezone_set("America/Lima");
    $this->load->model("Mantenimiento_m");
    session_start();
  }

  public function index(){
    if(!isset($_COOKIE["config_usuario"])|| $_COOKIE["config_usuario"]==""){
      $this->load->view('Login');
    }else{
       header('Location: '.base_url()."Sistema");
    } 
  }

  public function Iniciar(){
      //1 : CORRECTO INGRESA
      //0 : NO EXISTE
      //2 : INACTIVO
    $login = $this->Mantenimiento_m->consulta2("SELECT empleados.empleado_id,empleados.empleado_nombres,empleados.empleado_apellidos,empleados.perfil_id,empleados.empleado_foto_perfil,
      perfiles.perfil_descripcion,  empleados.estado FROM empleados
      INNER JOIN perfiles ON empleados.perfil_id = perfiles.perfil_id
        where empleados.estado=1 and empleado_usuario='".$this->input->post("usuario")."' and empleado_clave='".$this->input->post("clave")."' ");
    if ($this->input->post("validar_captchar")!=0) {
    if ($login) {
      if ($login->estado == 1) {
       $this->setCookie("config_usuario",$this->input->post("usuario"));
       $this->setCookie("config_clave",$this->input->post("clave"));
       $this->setCookie("usuario_id",$login->empleado_id);
       $this->setCookie("usuario_nombre",$login->empleado_nombres.' '.$login->empleado_apellidos);
       $this->setCookie("usuario_perfil",$login->perfil_id);
       $this->setCookie("imagen",$login->empleado_foto_perfil);
       $this->setCookie("perfil",$login->perfil_descripcion);
       $this->setCookie("id_perfil",$login->perfil_id);
       echo 1;
      }else{
        echo  2;
      }
    }else{  
      echo  0;
    }
  }else{
    echo  3;
  }
  }

  public function setCookie($nombre,$valor){
    setcookie($nombre,$valor,time()+604800,'/');
  }


  public function cerrar_session(){
    session_destroy();
    $this->borrarCookie();
    header('Location: '.base_url());
  }
  public function borrarCookie(){
  unset ($_COOKIE ["config_usuario"]);
  unset ($_COOKIE ["config_clave"]);
  unset ($_COOKIE ["usuario_nombre"]);
  unset ($_COOKIE ["usuario_perfil"]);
  unset ($_COOKIE ["imagen"]);
  unset ($_COOKIE ["perfil"]);
  unset ($_COOKIE ["id_perfil"]);
  unset ($_COOKIE ["empresa_sede"]);
  unset ($_COOKIE ["ruc_empresa"]);
  unset ($_COOKIE ["id_sede"]); 
  unset ($_COOKIE["usuario_id"]); 
  setcookie ('config_usuario', '', time()-604800,'/'); 
  setcookie ('config_clave', '', time()-604800,'/');
  setcookie ('usuario_nombre', '', time()-604800,'/');
  setcookie ('usuario_perfil', '', time()-604800,'/');
  setcookie ('imagen', '', time()-604800,'/');
  setcookie ('perfil', '', time()-604800,'/');
  setcookie ('id_perfil', '', time()-604800,'/');
  setcookie ('empresa_sede', '', time()-604800,'/');
  setcookie ('ruc_empresa', '', time()-604800,'/');
  setcookie ('id_sede', '', time()-604800,'/');   
  setcookie ('usuario_id', '', time()-604800,'/');
}
}

