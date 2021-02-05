<?php   
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";


class VentaServicio  extends BaseController {

  public function __construct() {
    parent::__construct();    	
  }
  public function index() {
   $data=array();
      //$data["titulo_descripcion"]="Venta de Productos";
   $data["ventas"] = $this->Mantenimiento_m->consulta3("SELECT * FROM ventas  WHERE estado = 1");
   $this->vista("VentaServicio/index",$data);
 }

 public function nuevo(){          
   $data=array();
   $data["titulo_descripcion"]="Nueva Venta";
   $estilo = '';
   $data["categorias"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto where categoria_producto.categoria_producto_estado = 1 ");
   $data["tipocomprobantes"] = $this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento WHERE tipodoc_estado = 1");
   $data["clientes"]=$this->Mantenimiento_m->consulta3(" SELECT cliente.cliente_nombre_completo,cliente.cliente_id,membresia_fecha_fin,
    CASE WHEN membresia.membresia_fecha_fin >= '".date('Y-m-d')."' THEN 'disabled style=".$estilo."' ELSE '' END AS estado FROM cliente
    left JOIN membresia_cliente on membresia_cliente.cliente_id=cliente.cliente_id
    left JOIN membresia ON membresia.membresia_id = membresia_cliente.membresia_id 
    where cliente.cliente_estado = 1  ");
        //LEFT JOIN membresia ON membresia.cliente_id = cliente.cliente_id where cliente.cliente_estado = 1  
   $this->vista("VentaServicio/nuevo",$data);


 }

 public function mostrar_ventas(){
  $data["ventas"] = $this->Mantenimiento_m->consulta3("SELECT *
    FROM
    ventas
    INNER JOIN empleados ON empleados.empleado_id = ventas.id_vendedor
    INNER JOIN cliente ON cliente.cliente_id = ventas.id_cliente
    WHERE ventas.estado = 1 and ventas.tipo_venta = 2
    ");
  echo json_encode($data["ventas"]);
}

public function BuscarProducto(){
  $data = $this->Mantenimiento_m->consulta3("SELECT categoria_producto_id as categoria_id, producto_id as id, producto_descripcion_ as descripcion,
    producto_estado as estado,producto_codigobarra as codigo,producto_descripcion_ as nombre,producto_precio as precio,producto_stock as stock FROM producto WHERE (producto_codigobarra LIKE  '%".$_POST["codigo_barra"]."%' OR producto_descripcion_ LIKE  '%".$_POST["codigo_barra"]."%') AND  producto_estado = 1 LIMIT 1 ");

  if ($data) {
    $dat["categoria_id"] = $data[0]["categoria_id"] ;
    $dat["codigo"] = $data[0]["codigo"] ;
    $dat["descripcion"] = $data[0]["descripcion"] ;
    $dat["estado"] = $data[0]["estado"] ;
    $dat["id"] = $data[0]["id"] ;
    $dat["nombre"] = $data[0]["nombre"] ;
    $dat["precio"] = $data[0]["precio"] ;
    $dat["stock"] = $data[0]["stock"] ;
    echo json_encode($dat);
  }else{
    echo json_encode("0");
  }



}


public function BuscarCategoriaMembresia(){

  if ($_POST["idcategoria"] != NULL) {

    $data = $this->Mantenimiento_m->consulta3("SELECT estado_asistencia as categoria_id, tipo_membresia_id as id, tipo_membresia_descripcion as nombre,tipo_membresia_precio_mes as precio,cantidad_personas,tipo_membresia_id as codigo,999 as stock, 1 as condicion
      FROM tipo_membresia WHERE tipo_membresia_estado = 1 AND estado_asistencia =   ". $_POST["idcategoria"]);

    if ($data) {

      echo json_encode($data);
    }else{
      echo json_encode("0");
    }
  }else{

   echo json_encode("0");

 }

}

public function calcularmesfin($fecha_inicio,$mes){
  $fecha=$fecha_inicio;
  $mes=$mes;

  $fecha6= date_create($fecha);
  date_add($fecha6, date_interval_create_from_date_string($mes.' month'));
  $dia=date_format($fecha6, 'Y-m-d');
  return $dia;

}

public function procesar_venta(){
  $post = file_get_contents("php://input");
  $res  = json_decode($post,true); 
  $venta_productos = array();
  $venta_pago = array();
  parse_str($res["compra"],$venta_productos);
  parse_str($res["pago"],$venta_pago);

      // print_r($_COOKIE);
  $fecha_inicio = $venta_productos["fecha_inicio"];
  $mes = $venta_productos["cantidades"][0];
  $fecha_fin =  $this->calcularmesfin($fecha_inicio,$mes);
  //$div = round($venta_productos["precios"][0] / (count($venta_productos["idCliente"])),2);
  //$total = round($div * $venta_productos["cantidades"][0],2);


  $data=array(
    "tipo_membresia_id"=>$venta_productos["productos"],
    "membresia_fecha_inicio"=>$fecha_inicio,
    "membresia_fecha_fin"=>$fecha_fin,
    //"membresia_precio_mes"=>$div,
    "membresia_meses"=>$venta_productos["cantidades"],
    //"membresia_precio_total"=>$total,
    "membresia_fecha_registro"=>date("Y-m-d")
  );
  $id_membresia = $this->Mantenimiento_m->insertar("membresia",$data);


  foreach ($venta_productos["idCliente"] as $key => $value) {
    $data=array(
      "membresia_id"=>$id_membresia,
      "cliente_id"=>$value,
    );
    $this->Mantenimiento_m->insertar("membresia_cliente",$data);
  }

  $idcomprobante = explode("*", $venta_productos["comprobantes"]);

  $comprobante = $this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento WHERE tipodoc_id = ".$idcomprobante[0]);
  $nrocorrelativo = $comprobante[0]["correlativo"];
  $serie          = $comprobante[0]["serie"]; 

  $sql="update tipo_documento set correlativo= ".($nrocorrelativo+1)." where tipodoc_id=".$idcomprobante[0];
  $this->Mantenimiento_m->coneliminar($sql);


  $total = $venta_productos["total"];
  $subtotal = $venta_productos["total"];
  $igv = 0;
  $monto_entregado= $venta_pago["monto"];
  $vuelto = $monto_entregado - $total;
  $fecha = date('Y/m/d');
  $descuento = 0;
  $idcomprobante = $idcomprobante;
  $nrocomprobante = $nrocorrelativo;
  $serie = $serie;


  $data = array(
    "fecha" => $fecha,
    "subtotal" => $subtotal,
    "igv" => $igv,
    "descuento" => $descuento,
    "total" => $total,
    "tipo_comprobante" => $idcomprobante[0],
    "serie" => $serie,
    "nro_comprobante" => $nrocomprobante,
    "monto_entregado" => $monto_entregado,
    "vuelto" => $vuelto,
    "id_moneda" => 1,
    "id_cliente" => $venta_productos["idCliente"][0],
    "id_vendedor" => $_COOKIE["usuario_id"],
    "tipo_venta" => 2
  );

   $idventa = $this->Mantenimiento_m->insertar("ventas",$data);
 

    $data = array(
      "membresia_id" => $id_membresia,
      "id" => $idventa,
      "precio" => $venta_productos["precios"],
      "cantidad" => $venta_productos["cantidades"] ,
      "importe" => $venta_productos["importes"] ,
    );
    $this->Mantenimiento_m->insertar("membresia_ventas",$data);


  echo $idventa;







}



public function mostrar_comprobante($id){
      // $empresa=$this->Mantenimiento_m->consulta3("select * from empresa");
  $venta=$this->Mantenimiento_m->consulta3("SELECT * from ventas where id=".$id);
  $detalle_venta=$this->Mantenimiento_m->consulta3("SELECT * FROM ventas 
    INNER JOIN membresia_ventas ON ventas.id = membresia_ventas.id
    LEFT JOIN membresia ON membresia.membresia_id = membresia_ventas.membresia_id
    LEFT JOIN tipo_membresia ON membresia.tipo_membresia_id = tipo_membresia.tipo_membresia_id
    where ventas.id=".$id);
  $total=0;
  foreach ($detalle_venta as $key => $val) {
   $total+=(float)$val["cantidad"]*$val["precio"];
 }

 $dat=intval($total); 
 $fl=$total-$dat;
 $flotante=(string)(round($fl*100));
 $tipo_venta=2;
 $vendedor=$this->Mantenimiento_m->consulta3("SELECT * FROM ventas INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id WHERE ventas.id=".$id);

 $cliente=$this->Mantenimiento_m->consulta3("SELECT * FROM ventas INNER JOIN cliente ON ventas.id_cliente = cliente.cliente_id where id=".$id);
      // $sede=$this->Mantenimiento_m->consulta3("select * from sede where id_sede=".$_COOKIE["id_sede"]);

 $letras= NumeroALetras::convertir($dat);
 $this->load->view("Comprobante/boleta",compact('venta','cliente','detalle_venta','flotante','vendedor','letras','tipo_venta'));  

}


public function eliminar(){
  $id=$_POST['id'];
  $this->Mantenimiento_m->coneliminar("update ventas set estado=0 where id=".$id);
}

}









