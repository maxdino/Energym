<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body" id="cuerpo_pagina"> 
				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo base_url();?>Rventa_producto/generar_reporte_pdf" target="_blank"><button class="btn  btn-danger" >Pdf</button></a>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="10%">#</th>
										<th width="30%">Vendedor</th>
										<th width="30%">Cliente</th>
										<th width="20%">Fecha Venta</th>
										<th width="20%">Total</th>
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
	$(".text-themecolor").text('Reporte Ventas Productos');


	$(function(){
		$.post(base_url+"Rventa_producto/mostrar_producto",function(data){
			html="";
			if(data["cliente"].length>0){
				tabla = "'cliente'";
				for (var i = 0; i < data["cliente"].length; i++) {
					html+="<tr>";
					html+="<td>"+data["cliente"][i]["id"]+"</td>";
					html+="<td>"+data["cliente"][i]["empleado_nombre_completo"]+"</td>";
					html+="<td>"+data["cliente"][i]["cliente_nombre_completo"]+"</td>";
					html+="<td>"+data["cliente"][i]["fecha"]+"</td>";
					html+="<td>"+data["cliente"][i]["total"]+"</td>";
					html+="</tr>";
				}
				$('#myTable').DataTable().destroy();
				$("#cuerpo_tabla").empty().append(html);
				$('#myTable').DataTable();
			}
		},"json");
	});

</script>