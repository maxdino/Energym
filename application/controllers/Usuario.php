<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Usuario  extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }
    public function index()
    {

    	$data=array();
      	$data["titulo_descripcion"]="Lista de Usuarios";
       // $data["fecha_actual"]=date("Y-m-d");

      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM cliente where cliente_estado=1");
	  	$this->vista("Usuario/index",$data);
    }
    public function mostrar_usuario() {
       $data=array();    
			$data["usuario"]=$this->Mantenimiento_m->consulta3("SELECT * from empleados INNER JOIN perfiles on empleados.perfil_id = perfiles.perfil_id
where empleados.estado=1");
			echo json_encode($data);exit();

  
    }

    public function nuevo()
    {
          
    	$data=array();
      	$data["titulo_descripcion"]="Nuevo Usuario";
        $data["perfil"]=$this->Mantenimiento_m->consulta3("SELECT * FROM perfiles where estado=1");
	  	$this->vista("Usuario/nuevo",$data);


    }



    public function guardar_usuario()
    {
    	$data=array(
            "empleado_nombres"=>$_POST["nombre"],
            "empleado_apellidos"=>$_POST["apellidos"],
            "empleado_dni"=>$_POST["n_documento"],
            "perfil_id"=>$_POST["perfil"],
            "empleado_sexo"=>$_POST["sexo"],
            "empleado_email"=>$_POST["correo"],
            "empleado_telefono"=>$_POST["celular"],
            "empleado_direccion"=>$_POST["direccion"],
            "empleado_usuario"=>$_POST["usuario"],
            "empleado_clave"=>$_POST["contrasena"],
            "empresa_sede"=>1,
            "empresa_ruc"=>'20709965293'



    	);



    	if($_POST["empleado_id"]=="")
    	{
    		$sql="select * from empleados where estado=1 and empleado_dni='".$_POST["n_documento"]."'";
    	
    		$data1=$this->Mantenimiento_m->consulta3($sql);
    
    		if(($data1))
    		{
                echo 0;
    		}
    		$this->Mantenimiento_m->insertar("empleados",$data);
    		echo 1;

    	}else{
			$this->Mantenimiento_m->actualizar("empleados",$data,$_POST["empleado_id"],"empleado_id");
			echo 2;

    	}
    }



  public function editar($id)
    {
          
    	$data=array();
      	$data["titulo_descripcion"]="Editar Usuario";
        $data["perfil"]=$this->Mantenimiento_m->consulta3("SELECT * FROM perfiles where estado=1");
         	$data["id"]=$id;
	  	$this->vista("Usuario/nuevo",$data);
    }

    public function traer_datos()
    {
       $sql="select *
FROM
empleados
where empleado_id=".$_POST["id"];
       $data=$this->Mantenimiento_m->consulta3($sql);
       echo json_encode($data);exit();

    }

    public function eliminar()
    {

$data=array(
            "estado"=>0,
    	);

	$this->Mantenimiento_m->actualizar("empleados",$data,$_POST["id"],"empleado_id");
			echo 2;


    }



public function guardar()
{

    $data=array(
      "tipo_membresia_id"=>$_POST["tipo_membresia"],
      "cliente_id"=>$_POST["cliente_id"],
      "membresia_fecha_inicio"=>$_POST["fecha_inicio"],
      "membresia_fecha_fin"=>$_POST["fecha_final"],
      "membresia_precio_mes"=>$_POST["precio_mensual"],
      "membresia_meses"=>$_POST["meses"],
      "membresia_precio_total"=>$_POST["precio_total"],
      "membresia_fecha_registro"=>date("Y-m-d")

    );
    if($_POST["membresia_id"]=="")
        {
           
            $this->Mantenimiento_m->insertar("membresia",$data);
            echo 1;

        }else{
            $this->Mantenimiento_m->actualizar("membresia",$data,$_POST["membresia_id"],"membresia_id");
            echo 2;

        }
}




public function enviar_tabla()
{

    $data=$this->Mantenimiento_m->consulta3("SELECT *
FROM
tipo_membresia
INNER JOIN membresia ON membresia.tipo_membresia_id = tipo_membresia.tipo_membresia_id where cliente_id=".$_POST["id"]." and membresia_estado!=0 order by membresia_id desc");

    echo json_encode($data);
}
public function actualizar_data()
{


    $data=array(
         "membresia_fecha_fin"=>$_POST["fecha"],

    );
$this->Mantenimiento_m->actualizar("membresia",$data,$_POST["id"],"membresia_id");
            echo 1;

}


  }
