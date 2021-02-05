<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Rventa_producto extends BaseController {

  public function __construct() {
        parent::__construct(); 
        $this->load->model("Mantenimiento_m"); 

    }

  public function index(){ 
      $data=array();
        $data["titulo_descripcion"]="Lista de Productos"; 
      $this->vista("Rventa_producto/index",$data);
  }

   function mostrar_producto(){
    $data["cliente"]=$this->Mantenimiento_m->consulta("SELECT
ventas.id,
empleados.empleado_nombre_completo,
ventas.fecha,
cliente.cliente_nombre_completo,
producto.producto_descripcion,
ventas.total
FROM
ventas
inner join detalle_venta on ventas.id=detalle_venta.venta_id
inner join producto on producto.producto_id=detalle_venta.producto_id
INNER JOIN cliente ON ventas.id_cliente = cliente.cliente_id
INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id
GROUP BY ventas.id"); 
    
    echo json_encode($data);exit();
  }

  public function generar_reporte_pdf(){

     //Se agrega la clase desde thirdparty para usar FPDF
    require_once APPPATH.'third_party/fpdf/fpdf.php';

    $pdf = new FPDF();
    $pdf->AddPage('P','A4',0);
    $pdf->SetFont('Arial','B',20);
    $pdf->setxy(60, 10);
    $pdf->cell(0, 0, 'LISTA DE VENTAS', 0, 0, "L", false);
    $pdf->Cell(11,11, $pdf->Image('public/assets/images/ener8.png',50,5,10,10),0);
    $pdf->SetFont('Arial','B',9);
    $pdf->setxy(5, 20);
    $pdf->cell(0, 0, 'Nro', 0, 0, "L", false);
    $pdf->setxy(15, 20);
    $pdf->cell(0, 0, 'NOMBRE EMPLEADO', 0, 0, "L", false);
    $pdf->setxy(55, 20);
    $pdf->cell(0, 0, 'FECHA', 0, 0, "L", false);
    $pdf->setxy(75, 20);
    $pdf->cell(0, 0, 'NOMBRE CLIENTE', 0, 0, "L", false);  
    $pdf->setxy(130, 20);
    $pdf->cell(0, 0, 'TOTAL (S/.)', 0, 0, "L", false);  
    $pdf->SetFont('Arial','',9);
    $saltos=25;$i=1;
      $datos=$this->Mantenimiento_m->consulta("SELECT
ventas.id,
empleados.empleado_nombre_completo,
ventas.fecha,
cliente.cliente_nombre_completo,
producto.producto_descripcion,
ventas.total
FROM
ventas
inner join detalle_venta on ventas.id=detalle_venta.venta_id
inner join producto on producto.producto_id=detalle_venta.producto_id
INNER JOIN cliente ON ventas.id_cliente = cliente.cliente_id
INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id
GROUP BY ventas.id ");
      foreach ($datos as $key => $value) {
       $pdf->setxy(5, $saltos); 
        $pdf->cell(0, 0, $i, 0, 0, "L", false); 
       $pdf->setxy(15, $saltos); 
        $pdf->cell(0, 0,utf8_decode( $value->empleado_nombre_completo), 0, 0, "L", false);
        $pdf->setxy(55, $saltos);
        $pdf->cell(0, 0,  $value->fecha, 0, 0, "L", false); 
        $pdf->setxy(75, $saltos);
        $pdf->cell(0, 0, utf8_decode($value->cliente_nombre_completo), 0, 0, "L", false);
        $pdf->setxy(130, $saltos);
        $pdf->cell(0, 0, 'S/ '.number_format($value->total, 2, '.', ''), 0, 0, "L", false);
      $saltos=$saltos+5;$i++;
      }
      
     
 
    $pdf->Output('Reporte_Lista_venta.pdf' , 'I' );
  }


}
