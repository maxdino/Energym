<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Cliente  extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }
    public function index()
    {

    	$data=array();
      	$data["titulo_descripcion"]="Lista de Clientes";
       // $data["fecha_actual"]=date("Y-m-d");

      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM cliente where cliente_estado=1");
	  	$this->vista("Cliente/index",$data);
    }
    public function mostrar_cliente()
    {
       $data=array();    
			$data["cliente"]=$this->Mantenimiento_m->consulta3("select * FROM cliente where cliente_estado=1 ");
            foreach ($data["cliente"] as $key => $value) {
                 
                 $datos=$this->Mantenimiento_m->consulta3("SELECT cliente.cliente_id,cliente.cliente_nombre_completo,cliente.cliente_documento_numero,matricula.fecha_inicio,matricula.fecha_fin as fecha_final from cliente
left join matricula on matricula.cliente_id=cliente.cliente_id where cliente.cliente_id=".$value['cliente_id']." and matricula.estado=1 GROUP BY cliente.cliente_id");
                 
                 if(isset($datos[0]["fecha_final"]))
                 {
                    $data["cliente"][$key]["fecha_ini"]=$datos[0]["fecha_inicio"];
                    $data["cliente"][$key]["fecha_fin"]=$datos[0]["fecha_final"];
                 }else
                 {
                    $data["cliente"][$key]["fecha_ini"]=" - ";
                    $data["cliente"][$key]["fecha_fin"]=" - ";
                 }
            }

			echo json_encode($data);exit();

  
    }
    public function nuevo()
    {
          
    	$data=array();
      	$data["titulo_descripcion"]="Nuevo Cliente";
 
	  	$this->vista("Cliente/nuevo",$data);


    }

    public function guardar_cliente()
    {
    	$data=array(
            "cliente_nombre_completo"=>$_POST["nombre"],
            "cliente_documento_numero"=>$_POST["n_documento"],
            "cliente_sexo"=>$_POST["sexo"],
            "cliente_correo"=>$_POST["correo"],
            "cliente_telefono"=>$_POST["celular"],
            "cliente_direccion"=>$_POST["direccion"],
            "cliente_telefono_referencia"=>$_POST["celular_referencia"],



    	);



    	if($_POST["cliente_id"]=="")
    	{
    		$sql="select * from cliente where cliente_estado=1 and cliente_documento_numero='".$_POST["n_documento"]."'";
    	
    		$data1=$this->Mantenimiento_m->consulta3($sql);
    
    		if(sizeof($data1)==0)
    		{
                echo 0;
    		}
    		$this->Mantenimiento_m->insertar("cliente",$data);
    		echo 1;

    	}else{
			$this->Mantenimiento_m->actualizar("cliente",$data,$_POST["cliente_id"],"cliente_id");
			echo 2;

    	}
    }



  public function editar($id)
    {
          
    	$data=array();
      	$data["titulo_descripcion"]="Editar Cliente";
         	$data["id"]=$id;
	  	$this->vista("Cliente/nuevo",$data);


    }
    public function traer_datos()
    {
       $sql="select * FROM cliente where cliente_id=".$_POST["id"];
       $data=$this->Mantenimiento_m->consulta3($sql);
       echo json_encode($data);exit();

    }

    public function eliminar()
    {

$data=array(
            "cliente_estado"=>0,
    	);

	$this->Mantenimiento_m->actualizar("cliente",$data,$_POST["id"],"cliente_id");
			echo 2;


    }


public function agregar_membresia($id_cliente){
$data=array();
$data["nombre"]=$this->Mantenimiento_m->consulta3("select * from cliente where cliente_id=".$id_cliente);
        $data["titulo_descripcion"]="Agregar Membresia para ".$data["nombre"][0]["cliente_nombre_completo"];
      
        //$data["tipo_documento"]=$this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento_cliente where tipo_documento_cliente_estado=1");
$sql="update tipo_membresia set tipo_membresia_estado=0 where tipo_membresia_estado=1 and  tipo_duracion=1 and date(tiempo_duracion)<'".date("Y-m-d")."'";

            $this->Mantenimiento_m->coneliminar($sql);
        
            $data["id"]=$id_cliente;
            $data["tipo_membresia"]= $this->Mantenimiento_m->consulta3("select * from tipo_membresia where tipo_membresia_estado=1");
           $data["fecha"]=date('Y-m-d');
        $this->vista("Cliente/membresia",$data);





}


public function calcular_meses()
{
    $fecha=$_POST["fecha_inicio"];
    $mes=$_POST["meses"];

      $fecha6= date_create($fecha);
              date_add($fecha6, date_interval_create_from_date_string($mes.' month'));
              $dia=date_format($fecha6, 'Y-m-d');
              echo $dia;

}

public function buscar_cliente()
{
    $data=$this->Mantenimiento_m->consulta3("SELECT cliente.cliente_id,cliente.cliente_nombre_completo,cliente.cliente_documento_numero,matricula.fecha_inicio,matricula.fecha_fin as fecha_final from cliente
left join matricula on matricula.cliente_id=cliente.cliente_id where cliente.cliente_estado=1 and cliente_nombre_completo like '%".$_POST['id']."%' or cliente_documento_numero like '%".$_POST['id']."%'  GROUP BY cliente.cliente_id  ");
    echo json_encode($data);
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
public function eliminar_membresia()
{


    $data=array(
         "membresia_estado"=>0,

    );
$this->Mantenimiento_m->actualizar("membresia",$data,$_POST["id"],"membresia_id");
            echo 1;

}


public function validardni(){

  $sql="select * from cliente where cliente_documento_numero='".$_POST["n_documento"]."'";
  //echo $sql;exit();
  $data1=$this->Mantenimiento_m->consulta3($sql);

  if ($data1) {
    echo json_encode(1);
  }else{
    echo json_encode(2);
  }

  }


}
