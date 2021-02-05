<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body" id="cuerpo_pagina"> 
				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo base_url();?>RAsistencia/generar_reporte_pdf" target="_blank"><button class="btn  btn-danger" >Pdf</button></a>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="10%">#</th>
										<th width="50%">Nombre</th>
										<th width="20%">D.N.I</th>
										<th width="20%">Fecha Asistencia</th>
									</tr>
								</thead>
								<tbody id="cuerpo_tabla">

								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

 
<script type="text/javascript">
	$(".text-themecolor").text('Clientes');


	$(function(){
		$.post(base_url+"RAsistencia/mostrar_cliente",function(data){
			html="";
			if(data["cliente"].length>0){
				tabla = "'cliente'";
				for (var i = 0; i < data["cliente"].length; i++) {
					html+="<tr>";
					html+="<td>"+data["cliente"][i]["cliente_id"]+"</td>";
					html+="<td>"+data["cliente"][i]["cliente_nombre_completo"]+"</td>";
					html+="<td>"+data["cliente"][i]["cliente_documento_numero"]+"</td>";
					html+="<td>"+data["cliente"][i]["asistencia_fecha"]+" "+data["cliente"][i]["hora"]+"</td>";
					html+="</tr>";
				}
				$('#myTable').DataTable().destroy();
				$("#cuerpo_tabla").empty().append(html);
				$('#myTable').DataTable();
			}
		},"json");
	});

</script>