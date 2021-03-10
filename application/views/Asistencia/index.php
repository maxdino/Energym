
    <link href="<?php echo base_url()?>public/css/pages/card-page.css" rel="stylesheet">

 <div class="row">
    <div class="col-12">
    	 <div class="card">
           <div class="card-body" id="cuerpo_pagina"> 
           	  	<form id="formulario" onsubmit="return guardar()">
           	<div class="row">
         
           	<div class="col-md-4">
           		
           	</div>
                 <div class="col-md-4">
                 	<div class="form-group">
                 		<label>Buscar Con Dni</label>
                 		<input type="text" class="form-control solo_numero" maxlength="8" id="dni" autocomplete="off" autofocus="true" name="dni">
                 	</div>
                 </div>
                 <div class="col-md-2"><br>
                 	<button id="boton" class="btn btn-primary">Buscar</button>
                 </div>
           
             </div>
               </form>
             <div class="row">
             	<div class="col-md-3">
             		
             	</div>
             	<div  class="col-md-6">
                        <div id="cuerpo_total" class="card card-outline-info">
                            <div class="card-header">
                                <h4 id="mensaje" class="m-b-0 text-white">No tiene datos</h4>
                                <h4 id="mensaje1" class="m-b-0 text-white"></h4>
                            </div>
                            <div class="card-body">
                                <h3 id="nombre" class="card-title"></h3>
                                <h4 id="DNI" ></h4>
                                <p class="card-text" >FECHA REGISTRO: <label id="fecha"></label></p>                           
                                

                               
                            </div>
                        </div>
                    </div>
             </div>
           
             </div>
          </div>

     </div>


 </div>
<script type="text/javascript">
	function  guardar() {
$("#boton").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Cargando...');
$("#boton").attr("disablad",true);
		$.post(base_url+"Asistencia/buscar_cliente",$("#formulario").serialize(),function(data){
             console.log(data);
             $("#mensaje").text(data["mensaje"]);
             $("#mensaje1").text(data["dias"]);
             $("#DNI").text(data["dni"]);
             $("#fecha").text(data["fecha"]);
             $("#nombre").html(data["nombre"]);
             if(data["estado"]==1 && data["alerta"] == 2){
                $("#cuerpo_total").addClass("card-outline-info");
                $("#cuerpo_total").removeClass("card-outline-danger");
             }else{
				 $("#cuerpo_total").removeClass("card-outline-info");
                $("#cuerpo_total").addClass("card-outline-danger");
              

             }
$("#boton").attr("disablad",false);
$("#dni").val("");

               $("#boton").html("Buscar");


		},"json");
		return false;
		// body...
	}
    $('.solo_numero').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
    });
</script>