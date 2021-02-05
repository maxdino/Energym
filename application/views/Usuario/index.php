                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body" id="cuerpo_pagina"> 
                        <div class="row">
                         <div class="col-md-12">
                          <a href="<?php echo base_url();?>Usuario/nuevo"><button class="btn  btn-success" >Nuevo Usuario</button></a>
                        </div>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                        <div class="table-responsive">
                         <table class="table display product-overview mb-30" id="myTable">
                          <thead>
                            <tr>
                              <th width="10%">#</th>
                              <th width="30%">Nombres</th>
                              <th width="20%">Apellidos</th>
                              <th width="20%">Nº Documento</th>
                              <th width="10%">Perfil</th>
                              <th width="20%">Telefono</th>

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

     $.post(base_url+"Usuario/mostrar_usuario",function(data){
       html="";
           
           if(data["usuario"].length>0)
           {
           
             for (var i = 0; i < data["usuario"].length; i++) {
               
               html+="<tr>";
               html+="<td>"+data["usuario"][i]["empleado_id"]+"</td>";
               html+="<td>"+data["usuario"][i]["empleado_nombres"]+"</td>";
               html+="<td>"+data["usuario"][i]["empleado_apellidos"]+"</td>";
               html+="<td>"+data["usuario"][i]["empleado_dni"]+"</td>";
               html+="<td>"+data["usuario"][i]["perfil_descripcion"]+"</td>";
               html+="<td>"+data["usuario"][i]["empleado_telefono"]+"</td>";
               html+='<td><a href="usuario/editar/'+data["usuario"][i]["empleado_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a><a href="#" onclick="eliminar('+data["usuario"][i]["empleado_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a></td>';

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
    $.post(base_url+"Usuario/eliminar",{"id":id},function(data){
          location.reload();
    });
  }
});



}


</script>
