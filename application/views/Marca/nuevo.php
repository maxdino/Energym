
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
								<form method="POST" action="<?php echo base_url();?>marca_producto/guardar">
									<div class="form-group">
										<input type="hidden"  name="id" id="id">
										<label class="control-label mb-10 text-left">DESCRIPCION DE MARCA</label>
										<input type="text" class="form-control solo_letras" required="true" name="descripcion" id="descripcion" autofocus="true" value="">
									</div>	
									<br>
									<center><a href="<?php echo  base_url();?>Marca_producto"><button class="btn btn-primary">Guardar</button></a><a href="<?php echo  base_url();?>Marca_producto"><button class="btn btn-danger" type="button" >Cancelar</button></a></center>								
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
	<?php

	if(isset($data["id"])){ ?>
			$(function(){
				
				$.post(base_url+"marca_producto/traer_uno",{"id":"<?php echo $data['id']?>"},function(data){
					console.log(data);
					$("#id").val(data[0]["marca_id"]);
					$("#descripcion").val(data[0]["marca_descripcion"]);

				},"json");
			});
			<?php
			 }
			?>
			$('.solo_letras').on('input', function () { 
			this.value = this.value.replace(/[^a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]/g,'');
		});
		</script>