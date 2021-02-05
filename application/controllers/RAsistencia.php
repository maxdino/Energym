<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class RAsistencia extends BaseController {

 	public function __construct() {
        parent::__construct(); 
        $this->load->model("Mantenimiento_m"); 

    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Clientes"; 
	  	$this->vista("RAsistencia/index",$data);
	}

 

 function mostrar_cliente(){
		$data["cliente"]=$this->Mantenimiento_m->consulta("SELECT control_asistencia.asistencia_fecha,asistencia.hora,cliente.cliente_nombre_completo,cliente.cliente_documento_numero,cliente.cliente_id
FROM asistencia 
INNER JOIN control_asistencia ON asistencia.asistencia_id = control_asistencia.asistencia_id
INNER JOIN matricula ON matricula.matricula_id = asistencia.matricula_id
INNER JOIN cliente on cliente.cliente_id=matricula.cliente_id"); 

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
		$html.='<th width="50%">Nombre</th>';
		$html.='<th width="20%">D.N.I</th>';
		$html.='<th width="20%">Fecha Asistencia</th>';
		$html.='</tr>';
		$html.='</thead>';
		$html.='<tbody id="cuerpo_tabla">';
		$data["cliente"]=$this->Mantenimiento_m->consulta("SELECT asistencia_fecha_hora,asistencia_fecha,cliente.cliente_nombre_completo,cliente.cliente_documento_numero,cliente.cliente_id
		FROM cliente INNER JOIN asistencia ON asistencia.cliente_id = cliente.cliente_id"); 
		foreach ($data["cliente"] as $key => $value) {
			$html.="<tr>";
			$html.="<th width='10%'>".$value->cliente_id."</th>";
			$html.="<th width='50%'>".$value->cliente_nombre_completo."</th>";
			$html.="<th width='20%'>".$value->cliente_documento_numero."</th>";
			$html.="<th width='20%'>".$value->asistencia_fecha_hora."</th>";
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
    $pdf->cell(0, 0, 'LISTA DE ASISTENCIAS', 0, 0, "L", false);
    $pdf->Cell(11,11, $pdf->Image('public/assets/images/ener8.png',40,5,10,10),0);
    $pdf->SetFont('Arial','B',9);
    $pdf->setxy(5, 20);
    $pdf->cell(0, 0, 'Nro', 0, 0, "L", false);
    $pdf->setxy(15, 20);
    $pdf->cell(0, 0, 'NOMBRE CLIENTE', 0, 0, "L", false);
    $pdf->setxy(65, 20);
    $pdf->cell(0, 0, 'FECHA CONTROL', 0, 0, "L", false);
    $pdf->setxy(100, 20);
    $pdf->cell(0, 0, 'HORA', 0, 0, "L", false);  
    $pdf->setxy(130, 20);
    $pdf->cell(0, 0, 'ESTADO', 0, 0, "L", false);  
    $pdf->SetFont('Arial','',9);
    $saltos=25;$i=1;
      $datos=$this->Mantenimiento_m->consulta("SELECT control_asistencia.asistencia_fecha,asistencia.hora,cliente.cliente_nombre_completo,cliente.cliente_documento_numero,cliente.cliente_id
FROM asistencia 
INNER JOIN control_asistencia ON asistencia.asistencia_id = control_asistencia.asistencia_id
INNER JOIN matricula ON matricula.matricula_id = asistencia.matricula_id
INNER JOIN cliente on cliente.cliente_id=matricula.cliente_id
");
      foreach ($datos as $key => $value) {
       $pdf->setxy(5, $saltos); 
        $pdf->cell(0, 0, $i, 0, 0, "L", false); 
       $pdf->setxy(15, $saltos); 
        $pdf->cell(0, 0,utf8_decode( $value->cliente_nombre_completo), 0, 0, "L", false);
        $pdf->setxy(70, $saltos);
        $pdf->cell(0, 0,  $value->asistencia_fecha, 0, 0, "L", false); 
        $pdf->setxy(100, $saltos);
        $pdf->cell(0, 0, utf8_decode($value->hora), 0, 0, "L", false);
        $pdf->setxy(130, $saltos);
        if ($value->hora!='') {
        	$pdf->Cell(11,11, $pdf->Image('public/imagen/iconos/accept.png',135,$saltos-2,3,3),0);
        }else{
        	$pdf->Cell(11,11, $pdf->Image('public/imagen/iconos/error.png',135,$saltos-2,3,3),0);
        }
        
       
      $saltos=$saltos+5;$i++;
      }
      
     
 
    $pdf->Output('Reporte_Lista_asistencia.pdf' , 'I' );
  }
}
