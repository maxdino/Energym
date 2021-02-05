                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body" id="cuerpo_pagina"> 
                        <div class="row">
                         <div class="col-md-12">
                          <a href="<?php echo base_url();?>VentaServicio/nuevo"><button class="btn  btn-success" >Agregar Venta</button></a>
                        </div>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                        <div class="table-responsive">   
                         <table class="table display product-overview mb-30" id="myTable">
                          <thead>
                            <tr>
                              <th width="10%">#</th>
                              <th width="30%">Empleado</th>
                              <th width="20%">Cliente</th>
                              <th width="20%">Nº de comprobante</th>
                              <th width="10%">Fecha</th>
                              <th width="20%">Total</th>

                              <th width="10%">Acciones</th>
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

  $(function(){

     $.post(base_url+"VentaServicio/mostrar_ventas",function(data){
       html="";
           
           if(data.length>0)
           {
           
             for (var i = 0; i < data.length; i++) {
               
               html+="<tr>";
               html+="<td>"+data[i]["id"]+"</td>";
               html+="<td>"+data[i]["empleado_nombres"]+"</td>";
               html+="<td>"+data[i]["cliente_nombre_completo"]+"</td>";
               html+="<td>"+data[i]["serie"]+'-'+data[i]["nro_comprobante"]+"</td>";
               html+="<td>"+data[i]["fecha"]+"</td>";
               html+="<td>"+data[i]["total"]+"</td>";
               html+='<td><a href="ventaservicio/mostrar_comprobante/'+data[i]["id"]+'" class="text-inverse" title="Imprimir" data-toggle="tooltip"><i class="mdi mdi-cloud-print txt-danger"></i></a><a href="#" onclick="eliminar('+data[i]["id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a></td>';

               html+="</tr>";
             }
  $('#myTable').DataTable().destroy();
             $("#cuerpo_tabla").empty().append(html);
                
        $('#myTable').DataTable();
           }
             
     },"json");
           

  })





function eliminar(id)
{


  Swal.fire({
  title: '¿Estas seguro de esto?',
  text: "Una vez realizada esta opcion ya no se puede revertir",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, deseo',
  showLoaderOnConfirm: true
}).then((result) => {
  if (result.value) {
    $.post(base_url+"VentaServicio/eliminar",{"id":id},function(data){
          location.reload();
    });
  }
});



}


</script>
