<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class Almacen extends BaseController {

 	public function __construct() {
        parent::__construct();    	
    }

	public function index(){ 
     	$data=array();
      	$data["titulo_descripcion"]="Lista de Almacenes";
      	$data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM almacenes where almacen_estado=1");
	  	$this->vista("Almacen/index",$data);
	}

	public function nuevo(){
		$data=array();
      	$data["titulo_descripcion"]="Nuevo Almacen"; 
	  	$this->vista("Almacen/nuevo",$data);
	}
	public function guardar(){
		$data=array(
          "almacen_descripcion"=>$this->input->post("descripcion"),
          "almacen_direccion"=>$this->input->post("direccion"),
          "id_sede" => $_COOKIE["id_sede"]
		); 
		if($this->input->post("id")==""){
         	$estado=$this->db->insert('almacenes', $data);
		}else{
            $this->db->where('almacen_id',$this->input->post("id"));
	        $estado=$this->db->update('almacenes', $data);
		}
    	header('Location: '.base_url()."Almacen");
	}
	public function editar($id){
		$data=array();
      	$data["titulo_descripcion"]="Actualizar Almacen";
      	//$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from almacenes where almacen_estado=1");
      	$data["id"]=$id;
	  	$this->vista("Almacen/nuevo",$data);
	}

	public function traer_uno(){
		$dat=$this->Mantenimiento_m->consulta3("select * from almacenes where almacen_id=".$this->input->post("id"));
		echo json_encode($dat);
	}

	public function eliminar(){
		$id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update almacenes set almacen_estado=0 where almacen_id=".$id);
	} 


	public function venta(){
		$j=0;
		for ($i=0; $i < 1000000; $i=$i+10000) { 
			$array_inicio[$j] = $i; 
			$array_fin[$j] = $i + 10000; 
			$j++;
			
		} 
		for ($i=0; $i < count($array_inicio); $i++) { 

			$html ='';		
			$nombre = "script".$i;
			$archivo = fopen("ventas/".$nombre.".sql", "w+b");
			$traer_ventas= $this->Mantenimiento_m->consulta3("SELECT * FROM ventas LIMIT 10000 OFFSET ".$array_inicio[$i].""); 
			foreach ($traer_ventas as $key => $value) {
				$html.="INSERT INTO ventas VALUES ('".$value["TransVenta"]."', '".$value["CodEmpleado"]."', '".$value["CodCaja"]."', '".$value["CodAlmacen"]."', '".$value["CodCliente"]."', '".$value["CodSerieDocumento"]."', '".$value["CodMoneda"]."', '".$value["Serie"]."', '".$value["NumDocumento"]."', ".$value["Importe"].", ".$value["IGV"].", ".$value["Total"].", ".$value["PorcentajeIGV"].", ".$value["CondicionVenta"].", ".$value["FormaPago"].", '".$value["FechaVenta"]."', '".$value["FechaVencimiento"]."', ".$value["FlagAnulado"].",".$value["SaldoCredito"].", ".$value["TipoCambioContable"].",  NULL, '".$value["ClienteRef"]."', '".$value["NumeroGuia"]."', '".$value["HoraVenta"]."', ".$value["CalculaIGV"].", ".$value["TipoIGV"].");"."\r\n";

			}
			fwrite($archivo, $html);
			fflush($archivo);
			$html;
		}
		 fclose($archivo);
	}

	public function detalle_venta(){
		$j=0;
		for ($i=0; $i < 2900000; $i=$i+20000) { 
			$array_inicio[$j] = $i; 
			$array_fin[$j] = $i + 20000; 
			$j++;
			
		}  
		for ($i=0; $i < count($array_inicio); $i++) { 

			$html ='';		
			$nombre = "script".$i;
			$archivo = fopen("detalle_venta/".$nombre.".sql", "w+b");
			$traer_ventas= $this->Mantenimiento_m->consulta3("SELECT * FROM detalleventas LIMIT 20000 OFFSET ".$array_inicio[$i].""); 
			foreach ($traer_ventas as $key => $value) {
				$html.="INSERT INTO detalleventas VALUES ('".$value["TransVenta"]."', '".$value["CodProducto"]."', '".$value["CodUnidadMedida"]."', ".$value["Item"].", ".$value["Cantidad"].", ".$value["Precio"].", ".$value["ListaPrecio"].", ".$value["SubTotal"].", ".$value["CantidadAfectaStock"].", ".$value["CostoVenta"].", ".$value["Descuento"].",".$value["Descuento"].");"."\r\n";

			}
			fwrite($archivo, $html);
			fflush($archivo);
			$html;
		}
		 fclose($archivo);
	}
}
