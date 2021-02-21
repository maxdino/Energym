
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
								<form method="POST" id="enviar_cliente" onsubmit="return enviar_cliente_guardar()">
									<input type="hidden" id="cliente_id" name="cliente_id">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">

												<label class="control-label mb-10 text-left">N° DOCUMENTO</label>
												<input type="text" class="form-control solo_numero" autocomplete="off" onchange="validardni();" required="true" name="n_documento" id="n_documento" maxlength="8" minlength="8" autofocus="true" value="">
											</div>
										</div>

										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Nombre Completo</label>
											<input type="text" onchange="borrar_espacios('nombre')" class="form-control solo_letras" autocomplete="off" required="true" name="nombre" id="nombre"  autofocus="true" value="">
										</div></div>

										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Direccion</label>
											<input type="text" onchange="borrar_espacios('direccion')" class="form-control solo_direccion" autocomplete="off" required="true" name="direccion" id="direccion"  autofocus="true" value="">
										</div></div>
										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Celular</label>
											<input type="text" class="form-control solo_numero" autocomplete="off" required="true" name="celular" id="celular" maxlength="9" autofocus="true" value="">
										</div></div>
										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Correo Electronico</label>
											<input type="text"  class="form-control" autocomplete="off" required="true" name="correo" id="correo" onchange="validar_correo()"  autofocus="true" value="">
										</div></div>
										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Celular referencia</label>
											<input type="text" class="form-control solo_numero" autocomplete="off"  name="celular_referencia" id="celular_referencia" maxlength="9"  autofocus="true" value="">
										</div></div>

										<div class="col-md-4"><div class="form-group">

											<label class="control-label mb-10 text-left">Sexo</label>
											<select class="form-control" id="sexo" name="sexo">
												<option value="Masculino">Masculino</option>
												<option value="Femenino">Femenino</option>

											</select>
										</div></div>

									</div>	
									<br>
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

	function enviar_cliente_guardar()
	{

		//alert();
		var value = document.getElementById('n_documento').value;
		$("#boton_guardar").attr("disablad",true);
		$("#boton_guardar").text("Procesando...");



		$.post(base_url+"Cliente/guardar_cliente",$("#enviar_cliente").serialize(),function(data){
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
	function tipo_documento_data() {
		var valor=$("#tipo_documento").val();
		var valores = valor.split("/");
		$("#n_documento").attr("maxlength",valores[1]);
		$("#n_documento").attr("minlength",valores[1]);

	}


	<?php

	if(isset($data["id"]))
		{?>
			

			$(function(){
				
				$.post(base_url+"Cliente/traer_datos",{"id":"<?php echo $data['id']?>"},function(data){
					console.log(data);
					$("#cliente_id").val(data[0]["cliente_id"]);
					$("#nombre").val(data[0]["cliente_nombre_completo"]);
					$("#n_documento").val(data[0]["cliente_documento_numero"]);
					$("#direccion").val(data[0]["cliente_direccion"]);
					$("#celular").val(data[0]["cliente_telefono"]);
					$("#celular_referencia").val(data[0]["cliente_telefono_referencia"]);
					$("#correo").val(data[0]["cliente_correo"]);
					$("#tipo_documento").val(data[0]["tipo_documento_cliente_id"]+"/"+data[0]["tipo_documento_cliente_tam"]);
					$("#n_documento").attr('readonly','readonly');
					$("#sexo").val(data[0]["cliente_sexo"]);




				},"json");
			});
		<?php }

		?>

		function validardni(){
			cantidad = ($("#n_documento").val()).length;
			dni = $("#n_documento").val();
			if (cantidad == 8) {
				$.post(base_url+"Cliente/validardni",{"n_documento":dni},function(data){
					console.log(data);
					if (data == 1) {
						alert('Usuario ya registrado')
					//$("#boton_guardar").attr("disablad",true);
					$('#boton_guardar').attr('disabled','disabled');
				}else{
					$('#boton_guardar').removeAttr('disabled');
				}
			},"json");

			}else{
				alert('Ingrese los 8 digitos del DNI');
				$("#n_documento").val('');
			}
		}


		$('.solo_numero').on('input', function () { 
			this.value = this.value.replace(/[^0-9]/g,'');
		});
		$('.solo_letras').on('input', function () { 
			this.value = this.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]/g,'');
		});
		$('.solo_direccion').on('input', function () { 
			this.value = this.value.replace(/[^0-9a-zA-ZáéíóúüñÁÉÍÓÚÜÑ. #]/g,'');
		});
		function validar_correo(){
 		correo = $('#correo').val();
		emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (!emailRegex.test(correo)) {
    	$('#correo').val('');		
     } 
	}
		function borrar_espacios(name){
			cadena = $('#'+name).val();
			$('#'+name).val($.trim(cadena));
		}
	</script>		 
