<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body" id="cuerpo_pagina"> 

				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<center><h4 class="panel-title txt-dark">INGRESAR DATOS DE LA MEMBRESIA</h4></center>
							<br>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								<form method="POST" id="formulario" onsubmit="return enviar_membresia()">
							<input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo $data['id'] ?>">
							<input type="hidden" id="membresia_id" value="" name="membresia_id">
									<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10 text-left">FECHA DE INICIO</label>
											<input type="date" class="form-control" autocomplete="off" value="<?php echo $data['fecha'] ?>" required="true" onchange="fecha()" name="fecha_inicio" id="fecha_inicio" autofocus="true" value="">
										</div>
									</div>
									<div></div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="">Tipo Membresia</label>
											<select required="true" onchange="verificar()" class="form-control" id="tipo_membresia" name="tipo_membresia">
												<option value="">Seleccionar</option>
												<?php
                                                      foreach ($data["tipo_membresia"] as $key => $value)
                                                       {
                                                      	echo "<option value='".$value["tipo_membresia_id"]."/".$value["tipo_membresia_precio_mes"]."/".$value["tipo_membresia_mes"]."'>".$value["tipo_membresia_descripcion"]."</option>";
                                                      }


												 ?>
												
											</select>
										</div>
									</div>
									<div class="col-md-2">
											<div class="form-group">
											<label class="control-label mb-10 text-left">PRECIO MENSUAL</label>
											<input type="number" class="form-control" autocomplete="off" min="1" required="true" name="precio_mensual" id="precio_mensual" value="0.00" onkeyup="total()" onchange="total()"  autofocus="true" value="">
										</div>
									</div>
									<div class="col-md-1">
											<div class="form-group">
											<label class="control-label mb-10 text-left">MESES</label>
											<input type="number" class="form-control" min="1" value="1" onkeyup="total()" onchange="total()" autocomplete="off" required="true" name="meses" id="meses" value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10 text-left">FECHA DE FINAL</label>
											<input type="date" class="form-control" autocomplete="off" readonly="true" required="true" name="fecha_final" id="fecha_final" 
										 autofocus="true" value="">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label mb-10 text-left">PRECIO TOTAL</label>
											<input type="number" value="0.00" class="form-control" autocomplete="off" readonly="true" required="true" name="precio_total" id="precio_total" 
										 autofocus="true" value="">
										</div>
									</div>
								   </div>
									<center><a href="<?php echo  base_url();?>Cliente"><button class="btn btn-danger" type="button" >Cancelar</button></a> <button id="boton_guardar" class="btn btn-primary">Guardar</button></center>								
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">


		function enviar_membresia()
	{


		$("#boton_guardar").attr("disablad",true);
		$("#boton_guardar").text("Procesando...");



         $.post(base_url+"Cliente/guardar",$("#formulario").serialize(),function(data){
                    if(parseFloat(data)==1)
                    {
                        	alertasuccess('Se Registro correctamente','Exitoso');
                        	setTimeout(function(){ 
							 location.href = base_url+"Cliente";
						}, 1000);
                    }
                    if(parseFloat(data)==2)
                     {
							alertasuccess('Se Actualizo correctamente','Exitoso');
							setTimeout(function(){ 
							 location.href = base_url+"Cliente";
						}, 1000);
                     }
                     if(parseFloat(data)==0)
                      {
							alertainfo('No se pudo completar!','Error');

                      }

         });
		return false;
	}
	function verificar()
	{

		var valor=$("#tipo_membresia").val();
		var array=valor.split("/");
		
		if(valor!="")
		{

            $("#precio_mensual").val(array[1]);
            $("#meses").val(array[2]);

		}else{

			$("#precio_mensual").val("0.00");
            $("#meses").val("1");

		}

total();

	}
	function total()
	{
     var precio=$("#precio_mensual").val();
     var mes=$("#meses").val();
     var total=parseFloat(precio)*parseFloat(mes);
         
     $("#precio_total").val(total);
     fecha();
	}
	function fecha()
	{


		$.post(base_url+"Cliente/calcular_meses",$("#formulario").serialize(),function(data){
           $("#fecha_final").val(data);
		});
	}
</script>