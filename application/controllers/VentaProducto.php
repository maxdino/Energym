<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";


class VentaProducto  extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }
    public function index() {
    	$data=array();
      //$data["titulo_descripcion"]="Venta de Productos";
      $data["ventas"] = $this->Mantenimiento_m->consulta3("SELECT * FROM ventas  WHERE estado = 1");
	   $this->vista("VentaProducto/index",$data);
    }

    public function nuevo(){          
    	$data=array();
      $data["titulo_descripcion"]="Nueva Venta";
      $data["categorias"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto where categoria_producto.categoria_producto_estado = 1 ");
      $data["tipocomprobantes"] = $this->Mantenimiento_m->consulta3("SELECT * FROM tipo_documento WHERE tipodoc_estado = 1");
      $data["clientes"]=$this->Mantenimiento_m->consulta3("SELECT * FROM cliente where cliente.cliente_estado = 1 ");

	  	$this->vista("VentaProducto/nuevo",$data);


    }

    public function mostrar_ventas(){
$data["ventas"] = $this->Mantenimiento_m->consulta3("SELECT *
FROM
ventas
INNER JOIN empleados ON empleados.empleado_id = ventas.id_vendedor
INNER JOIN cliente ON cliente.cliente_id = ventas.id_cliente
WHERE ventas.estado = 1 AND ventas.tipo_venta = 1
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


    public function BuscarProductosCategoria(){

      if ($_POST["idcategoria"] != NULL) {
       
        $data = $this->Mantenimiento_m->consulta3("SELECT categoria_producto_id as categoria_id, producto_id as id, producto_descripcion as descripcion,
          producto_estado as estado, producto_codigobarra as codigo, producto_descripcion as nombre,producto_precio as precio,producto_stock as stock, producto_imagen as imagen FROM producto WHERE (categoria_producto_id = ".$_POST["idcategoria"].") AND  producto_estado = 1  ");

        if ($data) {

          echo json_encode($data);
        }else{
          echo json_encode("0");
        }
      }else{

         echo json_encode("0");

      }

    }


    public function procesar_venta(){
      $post = file_get_contents("php://input");
      $res  = json_decode($post,true); 
      $venta_productos = array();
      $venta_pago = array();
      parse_str($res["compra"],$venta_productos);
      parse_str($res["pago"],$venta_pago);

      // print_r($_COOKIE);
      // print_r($venta_pago);exit();

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
        "id_cliente" => $venta_productos["idCliente"],
        "id_vendedor" => $_COOKIE["usuario_id"],
        "id_moneda" => 1
      );


        $this->Mantenimiento_m->insertar("ventas",$data);
        $idventa = $this->db->insert_id();



    foreach ($venta_productos["productos"] as $key => $value) {
        $data = array(
            "producto_id" => $value,
            "venta_id" => $idventa,
            "precio" => $venta_productos["precios"][$key],
            "cantidad" => $venta_productos["cantidades"][$key] ,
            "importe" => $venta_productos["importes"][$key] ,
        );
        $this->Mantenimiento_m->insertar("detalle_venta",$data);


    }


      echo $idventa;




       

      
    }
 


  public function mostrar_comprobante($id){
      // $empresa=$this->Mantenimiento_m->consulta3("select * from empresa");
      $venta=$this->Mantenimiento_m->consulta3("SELECT * from ventas where id=".$id);
      $detalle_venta=$this->Mantenimiento_m->consulta3("SELECT * FROM ventas 
        INNER JOIN detalle_venta ON ventas.id = detalle_venta.venta_id
        LEFT JOIN producto ON producto.producto_id = detalle_venta.producto_id
         where ventas.id=".$id);
          //LEFT JOIN tipo_membresia ON detalle_venta.tipo_membresia = tipo_membresia.tipo_membresia_id
       $total=0;
       foreach ($detalle_venta as $key => $val) {
         $total+=(float)$val["cantidad"]*$val["producto_precio"];
       }

       $dat=intval($total); 
       $fl=$total-$dat;
       $flotante=(string)(round($fl*100));

      $vendedor=$this->Mantenimiento_m->consulta3("SELECT * FROM ventas INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id WHERE ventas.id=".$id);
        $tipo_venta=1;
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









    