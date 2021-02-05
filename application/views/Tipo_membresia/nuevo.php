<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body" id="cuerpo_pagina"> 

				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<center><h6 class="panel-title txt-dark">INGRESAR DATOS</h6></center>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								<form method="POST" id="formulario" onsubmit="return guardar()">
									<input type="hidden" id="id" name="id">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">

												<label class="control-label mb-10 text-left">DESCRIPCION</label>
												<input type="text" class="form-control" autocomplete="off" required="true" name="descripcion" id="descripcion" autofocus="true" value="">
											</div>
										</div>


										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">PRECIO MENSUAL</label>
											<input type="text" class="form-control" type="number" min="1" autocomplete="off"  name="precio_mensual" id="precio_mensual"  required="true" value="">
										</div></div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10 text-left">MESES</label>
												<input type="number" required="true" value="1" class="form-control" autocomplete="off"  name="meses" id="meses" min="1"  autofocus="true" value="">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">

												<label class="control-label mb-10 text-left">TIPO DE PERIODO</label>
												<select class="form-control" id="tipo_periodo" onchange="verificar()" name="tipo_periodo">
													<option value="0">Ilimitado</option>
													<option value="1">Temporal</option>

												</select>
											</div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10 text-left">FECHA</label>
												<input type="date"  class="form-control" autocomplete="off"  name="fecha" id="fecha" readonly="true" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" autofocus="true" value="">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10 text-left">CATEGORIA MEMBRESIA</label>
												<select class="form-control" id="estado_asistencia" onchange="estadocategoria()" name="estado_asistencia">
													<option value="0">Invidividual</option>
													<option value="1">Grupal</option>
												</select>
											</div>
										</div>

										<div class="col-md-4" id="cantidadpersonas" style="display: none;">
											<div class="form-group">
												<label class="control-label mb-10 text-left">CANTIDAD PERSONAS</label>
												<input type="text"  class="form-control"   name="cantidad_personas" id="cantidad_personas"  value="1">
											</div>
										</div>


									</div>	
									<div class="form-row">
										<div class="col-md-12 mb-6">
											<label for="validationDefault03">SERVICIOS</label>
											<select class="select2  " required="" multiple="" name="servicio[]" id="servicio" style="width: 100%; height:36px;">
												<?php  
												foreach ($data["servicio"] as $key => $value) {
													# code... 
													echo "<option value='".$value["servicio_id"]."'> ".$value["servicio_descripcion"]."</option>";
												} ?>
											</select>
										</div>
									</div>
									<br>
									<center><a href="<?php echo  base_url();?>Tipo_membresia"><button id="boton_guardar" class="btn btn-primary">Guardar</button></a><a href="<?php echo  base_url();?>Tipo_membresia"><button class="btn btn-danger" type="button" >Cancelar</button></a></center>								
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
	$(function() {
		$('#servicio').select2();

	});


	<?php if(isset($data["id"]))
	{?>


		$(function(){				
			$.post(base_url+"Tipo_membresia/traer_datos",{"id":"<?php echo $data['id']?>"},function(data){
				console.log(data);
				$("#id").val(data['tipo_membresia'][0].tipo_membresia_id);
				$("#descripcion").val(data['tipo_membresia'][0].tipo_membresia_descripcion);
				$("#precio_mensual").val(data['tipo_membresia'][0].tipo_membresia_precio_mes);
				$("#meses").val(data['tipo_membresia'][0].tipo_membresia_mes);
				$("#tipo_periodo").val(data['tipo_membresia'][0].tipo_duracion);
				$("#estado_asistencia").val(data['tipo_membresia'][0].estado_asistencia);
				$("#cantidad_personas").val(data['tipo_membresia'][0].cantidad_personas);
				if($("#tipo_periodo").val()==1){
					$("#fecha").val(data['tipo_membresia'][0].tiempo_duracion);
				}
				ar= [];
				for (var i = 0; i < data['servicio'].length; i++) {	ar.push(data['servicio'][i].servicio_id); }
				$("#servicio").val(ar).trigger('change');
				estadocategoria();
				verificar();
			},"json");
		});




	<?php }

	?>

	function guardar()
	{
		$("#boton_guardar").text("Procesando...");
		$("#boton_guardar").attr("disabled",true);


		$.post(base_url+"Tipo_membresia/guardar",$("#formulario").serialize(),function(data){
			if(parseFloat(data)==1)
			{
				alertasuccess('Se Registro correctamente','Exitoso');
				setTimeout(function(){ 
					location.href = base_url+"Tipo_membresia";
				}, 1000);
			}
			if(parseFloat(data)==2)
			{
				alertasuccess('Se Actualizo correctamente','Exitoso');
				setTimeout(function(){ 
					location.href = base_url+"Tipo_membresia";
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


		var valor=$("#tipo_periodo").val();
		if(parseFloat(valor)==0){
			$("#fecha").attr("readonly",true);
			$("#fecha").attr("required",true);

		}else{
			$("#fecha").attr("readonly",false);
			$("#fecha").attr("required",false);
		}

	}

	function estadocategoria(){
		if ( $("#estado_asistencia").val() == 1) {
			document.getElementById("cantidadpersonas").style.display = "block";
		}else{
			document.getElementById("cantidadpersonas").style.display = "none";
		}
	}


</script>