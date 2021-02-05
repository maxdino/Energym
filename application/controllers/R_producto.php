<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "BaseController.php";

class R_producto extends BaseController {

 	public function __construct() {
        parent::__construct();      	
    }

	public function index(){
     	$data=array();
      $data["titulo_descripcion"]="Lista de Producto";
      $data["tabla"]=$this->Mantenimiento_m->consulta3("SELECT * FROM producto WHERE producto_estado = 1  ");
	  	$this->vista("CrearProducto/index",$data);
	}

  public function nuevo(){
    $data=array();
    $data["titulo_descripcion"]="Lista de Producto";
      $data["categoria"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto where categoria_producto.categoria_producto_estado = 1 ");
      $data["marca"]=$this->Mantenimiento_m->consulta3("SELECT * FROM marca where marca.marca_estado = 1 ");
      $data["unidad_medida"]=$this->Mantenimiento_m->consulta3("select * from unidad_medida  ");
        $data["titulo_descripcion"]="Nuevo Producto"; 
      $this->vista("CrearProducto/nuevo_v",$data);
  }

	public function guardar_imagen(){     
		$data = array("empleado_foto" => $_POST["image"]);
		$this->db->where('empleado_id',$_COOKIE["usuario_id"]);
	    $estado=$this->db->update('empleados', $data);
	    echo json_encode(1);
	}

	public function guardar(){ 
     
    $post = $_POST;
    $file = $_FILES; 
    $nombre_imagen = 'defaut.png';
    if ($_FILES['fileToUpload']['name']==null) {
        $imagen = $_POST['imagen_valida'];
      }else{
        $cadena = str_replace(' ','', $_FILES['fileToUpload']['name']);
        $imagen = "producto/".$cadena;  
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'public/imagen/'.$imagen);
       }
		$data=array(
          "producto_descripcion"=>$this->input->post("producto_nombre"),
          "producto_precio"=>$this->input->post("precioproducto"),
          "producto_stock"=>9999999,
          "producto_minimo"=>$this->input->post("stockminimo"),
          "producto_imagen"=>$imagen,
          "categoria_producto_id"=>$this->input->post("categoria_producto"),
          "producto_codigobarra"=>$this->input->post("codigobarra"),
          "unidad_medida_id"=>$this->input->post("unidadmedida"),
          "marca_id"=>$this->input->post("marca")

		);  
    if($this->input->post("id")==""){
    $estado=$this->db->insert('producto', $data);
   }else{
    $this->db->where('producto_id',$this->input->post("id"));
    $estado=$this->db->update('producto', $data);
   }
    header('Location: '.base_url()."R_producto");
  }

  public function editar($id){
    $data=array();
        $data["titulo_descripcion"]="Actualizar Producto";
        //$data["tabla"]=$this->Mantenimiento_m->consulta3("select * from categoria where categoria_estado=1");
        $data["id"]=$id;
         $data["categoria"]=$this->Mantenimiento_m->consulta3("SELECT * FROM categoria_producto where categoria_producto.categoria_producto_estado = 1 ");
      $data["marca"]=$this->Mantenimiento_m->consulta3("SELECT * FROM marca where marca.marca_estado = 1 ");
      $data["unidad_medida"]=$this->Mantenimiento_m->consulta3("select * from unidad_medida  ");
      $this->vista("CrearProducto/nuevo_v",$data);
  }

  public function traer_uno(){
    $dat=$this->Mantenimiento_m->consulta3("select * from producto where producto_id=".$this->input->post("id"));
    echo json_encode($dat);
  }

  public function eliminar(){
    $id=$_POST['id'];
      $this->Mantenimiento_m->coneliminar("update producto set producto_estado=0 where producto_id=".$id);
  } 
}
