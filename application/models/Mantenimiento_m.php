<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mantenimiento_m extends CI_Model
	{
		public function __construct()
		 {
		 	parent::__construct();


		 }
          

        public function insertar($tabla,$datos=array()){
          $r=$this->db->insert($tabla,$datos);
          return $this->db->insert_id();
        }

        public function actualizar($tabla,$datos=array(),$id,$id1){
        	$this->db->where($id1,$id);
	        $r=$this->db->update($tabla,$datos);
        }
        public function eliminar($tabla,$id,$id1){
        	$datos = array(
		        "estado" => "0"
		    );

	             $this->db->where($id1,$id);
	             $r = $this->db->update($tabla,$datos);

	          if ($r)
	            {
		            return 1;
	             }
	          else
	             {
		            return 0;
	             }

        }

        public function insertar_cliente($data=array(),$data1=array()){  
           $r=$this->db->insert("persona",$data);
           $r=$this->db->insert("cliente",$data1);
        }

 

         public function consulta($sql){
            $datasesores=$this->db->query($sql);
            return $datasesores->result();
        }


        public function consulta2($sql){
            $datasesores=$this->db->query($sql);
            return $datasesores->row();       
        }

        public function consulta3($sql){
            $datasesores=$this->db->query($sql);
            return $datasesores->result_array();       
         }


         public function coneliminar($sql){
            $datasesores=$this->db->query($sql);
            return $datasesores;
         }
        


	}

?>