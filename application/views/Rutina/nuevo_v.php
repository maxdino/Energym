
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body" id="cuerpo_pagina"> 

				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">INGRESAR DATOS</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								<form method="POST" action="<?php echo base_url();?>Rutina_c/guardar">
									<div class="form-group">
										<input type="hidden"  name="id" id="id">
										<label class="control-label mb-10 text-left">DESCRIPCION DE RUTINA</label>
										<input type="text" class="form-control solo_letras" onchange="borrar_espacios('descripcion')" required="true" name="descripcion" id="descripcion" autofocus="true" value="">
									</div>	
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="validationDefault03">TIPO PAQUETE</label>
											<select class="select2  " name="tipo_paquete" id="tipo_paquete" style="width: 100%; height:36px;">
												<option value=""></option>
												<?php foreach ($data["tipo_paquete"] as $key => $value) {
													echo "<option value='".$value["tipo_paquete_id"]."'>".$value["tipo_paquete_descripcion"]."</option>";
												} ?>
											</select>
										</div>
									</div>
									<br>
									<center><a href="<?php echo  base_url();?>Rutina_c"><button class="btn btn-primary">Guardar</button></a><a href="<?php echo  base_url();?>Rutina_c"><button class="btn btn-danger" type="button" >Cancelar</button></a></center>								
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
	 $('#tipo_paquete').select2();
	 
	});

	<?php

	if(isset($data["id"]))
		{?>
			

			$(function(){
				
				$.post(base_url+"Rutina_c/traer_uno",{"id":"<?php echo $data['id']?>"},function(data){
					$("#id").val(data[0]["rutina_paquete_id"]);
					$("#descripcion").val(data[0]["rutina_paquete_descripcion"]);
					$("#tipo_paquete").val(data[0]["tipo_paquete_id"]).trigger('change');
				},"json");
			});




		<?php }

		?>
		$('.solo_letras').on('input', function () { 
			this.value = this.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]/g,'');
		});

		function borrar_espacios(name){
			cadena = $('#'+name).val();
			$('#'+name).val($.trim(cadena));
		}
	</script>