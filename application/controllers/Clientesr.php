<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Clientesr extends BaseController {

	public function __construct() {
		parent::__construct(); 
		$this->load->model("Mantenimiento_m"); 
		
	}

	public function index(){ 
		$data=array();
		$data["titulo_descripcion"]="Lista de Clientes"; 
		$this->vista("Clientesr/index",$data);
	}

	public function nuevo(){
		$data=array();
		$data["titulo_descripcion"]="Nuevo Almacen"; 
		$this->vista("Almacen/nuevo",$data);
	}

	function mostrar_cliente(){
		$data["cliente"]=$this->Mantenimiento_m->consulta("SELECT * FROM cliente where cliente_estado=1"); 
		foreach ($data["cliente"] as $key => $value) {   
			$datos=$this->Mantenimiento_m->consulta("SELECT max(fecha_fin) as fecha_final,cliente.cliente_nombre_completo from matricula inner join cliente on cliente.cliente_id=matricula.cliente_id  where matricula.cliente_id=".$value->cliente_id." and matricula.estado=1");    
			if(($datos[0]->fecha_final) != ''){
				$data["cliente"][$key]->fecha_ultima=$datos[0]->fecha_final;
				$data["cliente"][$key]->nombre=$datos[0]->cliente_nombre_completo;
			}else{
				$data["cliente"][$key]->fecha_ultima="No tienes fecha";
				$data["cliente"][$key]->tipo_membresia="No tiene";
			}
		}
		echo json_encode($data);exit();
	}

 	public function generar_reporte_pdf(){

	   //Se agrega la clase desde thirdparty para usar FPDF
		require_once APPPATH.'third_party/fpdf/fpdf.php';

		$pdf = new FPDF();
		$pdf->AddPage('P','A4',0);
		$pdf->SetFont('Arial','B',20);
		$pdf->setxy(60, 10);
		$pdf->cell(0, 0, 'LISTA DE CLIENTES', 0, 0, "L", false);
		$pdf->Cell(11,11, $pdf->Image('public/assets/images/ener8.png',50,5,10,10),0);
		$pdf->SetFont('Arial','B',10);
		$pdf->setxy(10, 20);
		$pdf->cell(0, 0, 'NOMBRE CLIENTE', 0, 0, "L", false);
		$pdf->setxy(90, 20);
		$pdf->cell(0, 0, 'DNI', 0, 0, "L", false);
		$pdf->setxy(120, 20);
		$pdf->cell(0, 0, 'FECHA FINAL MATRICULA', 0, 0, "L", false);	
		$pdf->SetFont('Arial','',10);
		$data["cliente"]=$this->Mantenimiento_m->consulta("SELECT * FROM cliente where cliente_estado=1 "); 
		$saltos=25;
		foreach ($data["cliente"] as $key => $value) {
			$datos=$this->Mantenimiento_m->consulta("SELECT max(fecha_fin) as fecha_final,cliente.* from matricula inner JOIN cliente on cliente.cliente_id=matricula.cliente_id where matricula.cliente_id=".$value->cliente_id);
			$pdf->setxy(10, $saltos);	
				$pdf->cell(0, 0, utf8_decode($value->cliente_nombre_completo), 0, 0, "L", false);
				$pdf->setxy(90, $saltos);
				$pdf->cell(0, 0, $value->cliente_documento_numero, 0, 0, "L", false); 
			if(($datos[0]->fecha_final) != ''){
				$pdf->setxy(120, $saltos);
				$pdf->cell(0, 0, $datos[0]->fecha_final, 0, 0, "L", false);

			}else{	
				$pdf->setxy(120, $saltos);
				$pdf->cell(0, 0, 'No tiene Matricula', 0, 0, "L", false);

			}
			$saltos=$saltos+5;
		}	
 
		$pdf->Output('Reporte_Lista_clientes.pdf' , 'I' );
	}
}