<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Rventa_servicio extends BaseController {

  public function __construct() {
        parent::__construct(); 
        $this->load->model("Mantenimiento_m"); 

    }

  public function index(){ 
      $data=array();
        $data["titulo_descripcion"]="Lista de ventas"; 
      $this->vista("Rventa_servicio/index",$data);
  }

 function mostrar_servicio(){
    $data["cliente"]=$this->Mantenimiento_m->consulta("SELECT
ventas.id,
ventas.total,
ventas.fecha,
tipo_membresia.tipo_membresia_descripcion,
cliente.cliente_nombre_completo,
empleados.empleado_nombre_completo
FROM
membresia_ventas
INNER JOIN ventas ON membresia_ventas.id = ventas.id
INNER JOIN membresia ON membresia.membresia_id = membresia_ventas.membresia_id
INNER JOIN tipo_membresia ON tipo_membresia.tipo_membresia_id = membresia.tipo_membresia_id
INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id
INNER JOIN cliente ON cliente.cliente_id = ventas.id_cliente
WHERE ventas.estado=1 ");

    echo json_encode($data);exit();
  }

  function pdf(){ 
    require_once(APPPATH.'libraries/vendor/autoload.php');


    $mpdf = new \Mpdf\Mpdf([
          'mode' => 'utf-8',      
          'setAutoTopMargin' => 'stretch'
        ]); 
        $html="";
    $datos="";
    $html.='<table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">';
    $html.='<thead>';
    $html.='<tr>';
    $html.='<th width="10%">#</th>';
    $html.='<th width="30%">Vendedor</th>';
    $html.='<th width="20%">Cliente</th>';
    $html.='<th width="20%">Fecha venta</th>';
    $html.='<th width="10%">Paquete Vendido</th>';
    $html.='<th width="20%">Total</th>';
    $html.='</tr>';
    $html.='</thead>';
    $html.='<tbody id="cuerpo_tabla">';
    $data["cliente"]=$this->Mantenimiento_m->consulta("SELECT
ventas.id,
ventas.total,
ventas.fecha,
tipo_membresia.tipo_membresia_descripcion,
cliente.cliente_nombre_completo,
empleados.empleado_nombre_completo
FROM
membresia_ventas
INNER JOIN ventas ON membresia_ventas.id = ventas.id
INNER JOIN membresia ON membresia.membresia_id = membresia_ventas.membresia_id
INNER JOIN tipo_membresia ON tipo_membresia.tipo_membresia_id = membresia.tipo_membresia_id
INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id
INNER JOIN cliente ON cliente.cliente_id = ventas.id_cliente
WHERE ventas.estado=1 "); 
    foreach ($data["cliente"] as $key => $value) {
      $html.="<tr>";
      $html.="<th width='10%'>".$value->id."</th>";
      $html.="<th width='20%'>".$value->empleado_nombre_completo."</th>";
      $html.="<th width='30%'>".$value->cliente_nombre_completo."</th>";
      $html.="<th width='20%'>".$value->fecha."</th>";
      $html.="<th width='20%'>".$value->tipo_membresia_descripcion."</th>";
      $html.="<th width='20%'>".$value->total."</th>";
      $html.="</tr>";
    }

    $html.='</tbody>';
    $html.='</table>';
    $mpdf->WriteHTML($html,2); 
    $mpdf->Output("Usuarios.pdf", 'I');
  }

  public function generar_reporte_pdf(){

     //Se agrega la clase desde thirdparty para usar FPDF
    require_once APPPATH.'third_party/fpdf/fpdf.php';

    $pdf = new FPDF();
    $pdf->AddPage('P','A4',0);
    $pdf->SetFont('Arial','B',20);
    $pdf->setxy(50, 10);
    $pdf->cell(0, 0, 'LISTA DE MEMBRESIA ADQUIRIDAS', 0, 0, "L", false);
    $pdf->Cell(11,11, $pdf->Image('public/assets/images/ener8.png',40,5,10,10),0);
    $pdf->SetFont('Arial','B',9);
    $pdf->setxy(5, 20);
    $pdf->cell(0, 0, 'Nro', 0, 0, "L", false);
    $pdf->setxy(15, 20);
    $pdf->cell(0, 0, 'NOMBRE EMPLEADO', 0, 0, "L", false);
    $pdf->setxy(55, 20);
    $pdf->cell(0, 0, 'FECHA', 0, 0, "L", false);
    $pdf->setxy(75, 20);
    $pdf->cell(0, 0, 'TIPO MEMBRESIA', 0, 0, "L", false);
    $pdf->setxy(110, 20);
    $pdf->cell(0, 0, 'GRUPO', 0, 0, "L", false);  
    $pdf->setxy(125, 20);
    $pdf->cell(0, 0, 'NOMBRE CLIENTE', 0, 0, "L", false);  
    $pdf->setxy(170, 20);
    $pdf->cell(0, 0, 'TOTAL (S/.)', 0, 0, "L", false);  
    $pdf->SetFont('Arial','',9);
    $saltos=25;$i=1;
      $datos=$this->Mantenimiento_m->consulta("SELECT  tipo_membresia.tipo_membresia_descripcion,membresia.membresia_fecha_registro as fecha,membresia_cliente.cliente_id,
cliente.cliente_nombre_completo,membresia.membresia_id,empleados.empleado_nombre_completo,ventas.total
from membresia
inner join tipo_membresia on tipo_membresia.tipo_membresia_id=membresia.tipo_membresia_id
inner join membresia_cliente on membresia_cliente.membresia_id=membresia.membresia_id
inner join cliente on cliente.cliente_id=membresia_cliente.cliente_id
inner join membresia_ventas on membresia.membresia_id=membresia_ventas.membresia_id
inner join ventas ON membresia_ventas.id = ventas.id
INNER JOIN empleados ON ventas.id_vendedor = empleados.empleado_id
where ventas.estado=1
");
      foreach ($datos as $key => $value) {
       $pdf->setxy(5, $saltos); 
        $pdf->cell(0, 0, $i, 0, 0, "L", false); 
       $pdf->setxy(15, $saltos); 
        $pdf->cell(0, 0,utf8_decode( $value->empleado_nombre_completo), 0, 0, "L", false);
        $pdf->setxy(55, $saltos);
        $pdf->cell(0, 0,  $value->fecha, 0, 0, "L", false); 
        $pdf->setxy(75, $saltos);
        $pdf->cell(0, 0, utf8_decode($value->tipo_membresia_descripcion), 0, 0, "L", false);
        $pdf->setxy(112, $saltos);
        $pdf->cell(0, 0, utf8_decode($value->membresia_id), 0, 0, "L", false);
         $pdf->setxy(125, $saltos);
        $pdf->cell(0, 0, utf8_decode($value->cliente_nombre_completo), 0, 0, "L", false);
        $pdf->setxy(170, $saltos);
        $pdf->cell(0, 0, 'S/ '.number_format($value->total, 2, '.', ''), 0, 0, "L", false);
      $saltos=$saltos+5;$i++;
      }
      
     
 
    $pdf->Output('Reporte_Lista_servicio.pdf' , 'I' );
  }

}
