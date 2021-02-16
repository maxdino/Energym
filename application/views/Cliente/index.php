                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body" id="cuerpo_pagina"> 
                        <div class="row">
                         <div class="col-md-9">
                          <a href="<?php echo base_url();?>Cliente/nuevo"><button class="btn  btn-success" >Nuevo Cliente</button></a>
                        </div>
                        <div class="col-md-3">
                            <input type="text" placeholder="Buscar Clientes ..." name="buscar_cliente" id="buscar_cliente" onkeyup="buscar_cliente()">
                        </div>
                      </div>
                      
                      <div class="row">
                       <div class="col-md-12">
                        <div class="table-responsive">
                         <table class="table display product-overview mb-30" id="tabla_clientes">
                          <thead>
                            <tr>
                              <th width="10%">#</th>
                              <th width="30%">Nombre</th>
                              <th width="20%">Nº Documento</th>
                              <th width="20%">Fecha Inicio</th>
                              <th width="20%">Fecha Final</th>
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


<input type="hidden" id="fecha_actual" name="fecha_actual" value="<?php echo date("Y-m-d") ?>">


<div id="modal_mostrar_membresia" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  aria-modal="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Mostrar lista de Membresia</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <div class="row">
                                                   <div class="col-md-12">
                                                       <a id="link" href=""><button  class="btn btn-primary">Agregar</button></a>
                                                   </div>
                                                </div> -->
                                                <div class="row">
                                                  <div class="col-md-12">
                                                     <div id="mostrar_tabla">
                                                     
                                                     </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick='cerrar()' class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">

    function eliminar_membresia(id)
    {
        var r = confirm("¿Estas seguro que desea eliminar?");
          if (r == true) {
          $("#cuerpo_membresia_"+id).remove();
            $.post(base_url+"Cliente/eliminar_membresia",{"id":id},function(data){

               alertasuccess('Se Elimino correctamente','Exitoso');
                  });
          }
    }
  function cerrar()
  {
   
    $("#modal_mostrar_membresia").modal("hide");
  }
 /* 
  $(function(){

     $.post(base_url+"Cliente/mostrar_cliente",function(data){
       html="";
           
           if(data["cliente"].length>0)
           {
           
             for (var i = 0; i < data["cliente"].length; i++) {
               
               html+="<tr>";
               html+="<td>"+data["cliente"][i]["cliente_id"]+"</td>";
               html+="<td>"+data["cliente"][i]["cliente_nombre_completo"]+"</td>";
               html+="<td>"+data["cliente"][i]["cliente_documento_numero"]+"</td>";
               html+="<td>"+data["cliente"][i]["fecha_ini"]+"</td>";
               html+="<td>"+data["cliente"][i]["fecha_fin"]+"</td>";
               // html+='<td><a href="'+base_url+'Cliente/agregar_membresia/'+data["cliente"][i]["cliente_id"]+'"  class="text-inverse" title="agregar membresia" data-toggle="tooltip"><i class="mdi mdi-launch txt-danger"></i></a><a href="#" onclick="eliminar('+data["cliente"][i]["cliente_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a><a href="cliente/editar/'+data["cliente"][i]["cliente_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td>';
               // html+='<td><a href="#" onclick="membresia('+data["cliente"][i]["cliente_id"]+')" class="text-inverse" title="Mostrar Membresia" data-toggle="tooltip"><i class="mdi mdi-eye txt-danger"></i></a><a href="#" onclick="eliminar('+data["cliente"][i]["cliente_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a><a href="cliente/editar/'+data["cliente"][i]["cliente_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td>';
                html+='<td><a href="#" onclick="eliminar('+data["cliente"][i]["cliente_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a><a href="cliente/editar/'+data["cliente"][i]["cliente_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td>';

               html+="</tr>";
             }
  $('#myTable').DataTable().destroy();
             $("#cuerpo_tabla").empty().append(html);
                
        
           }
             
     },"json");
           

  });
*/

  function membresia(id)
  {
    $("#modal_mostrar_membresia").modal();
    $("#link").attr("href",base_url+"Cliente/agregar_membresia/"+id);
 $("#mostrar_tabla").empty().html('<center style="margin-top: 150px;"> <h1><i class="fa fa-spin fa-spinner"></i></h1> </center>');
    $.post(base_url+"Cliente/enviar_tabla",{"id":id},function(data){
    
       var html='';
       var fecha=$("#fecha_actual").val();
        html+='<div class="table-responsive">'+
                                    '<table class="table table-striped">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th>#</th>'+
                                                '<th>Tipo Membresia</th>'+
                                                '<th>Fecha Inicio</th>'+
                                                '<th>Fecha Fin</th>'+
                                                '<th>Estado</th>'+


                                               '<th class="text-nowrap">Acciones</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody>';
                                        if(data.length!=0){ 
                                          for (var i = 0; i < data.length; i++) {
                                             html+="<tr id='cuerpo_membresia_"+data[i]["membresia_id"]+"'>";
                                           html+='<td>'+(i+1)+'</td>';
                                           html+='<td>'+data[i]["tipo_membresia_descripcion"]+'</td>';
                                           html+='<td><input type="date" value="'+data[i]["membresia_fecha_inicio"]+'" readonly="true" class="form-control"></td>';
                                           html+='<td><input type="date" id="fecha_final_'+data[i]["membresia_id"]+'" min="'+data[i]["membresia_fecha_fin"]+'" value="'+data[i]["membresia_fecha_fin"]+'" readonly="true" class="form-control"></td>';
                                           if(parseFloat(data[i]["membresia_estado"])==1){
                                           html+='<td>Activo</td>';
                                            html+='<td><a onclick="actualizar_membresia()" id="guardar'+data[i]["membresia_id"]+
                                                  '" href="#" style="display:none" class="text-inverse" title="Guardar" data-toggle="tooltip"><i class="mdi mdi-content-save txt-danger"></i></a>'+
                                            '<a onclick="cancelar_membresia()" id="cancelar'+data[i]["membresia_id"]+'" style="display:none" href="#" class="text-inverse" title="Cancelar" data-toggle="tooltip"><i class="mdi mdi-close txt-danger"></i></a><a id="editar'+data[i]["membresia_id"]+'" onclick="editar_membresia('+data[i]["membresia_id"]+')"  href="#" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-launch txt-danger"></i></a>';
                                            if(fecha==data[i]["membresia_fecha_registro"]){
                                            html+='<a onclick="eliminar_membresia('+data[i]["membresia_id"]+')" id="eliminar'+data[i]["membresia_id"]+'" href="#" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a>';
                                             }


                                            html+='</td>';
                                            }else{
                                           html+='<td>Vencio</td>';

                                               html+='<td></td>';
                                            }
                                          

                                             html+='</tr>';
                                          }
                                        }else{
                                               html+='<tr>';
                                                html+='<td colspan="6"><center>No tienes resultados</center></td>';
                                              html+='</tr>';
                                        }
                                            
                                       html+= '</tbody>'+
                                   '</table>'+
                                '</div>';


                                $("#mostrar_tabla").empty().append(html);
    },"json");
  }

 






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
    $.post(base_url+"Cliente/eliminar",{"id":id},function(data){
          location.reload();
    });
  }
});

}

function buscar_cliente(){
  id = $('#buscar_cliente').val();
  if (id!='') {
   $('#tabla_clientes tbody').empty();
   $.post(base_url+"Cliente/buscar_cliente",{"id":id},function(data){
    for (var i = 0; i< data.length; i++) {
      if (data[i]["fecha_final"]!=null) {
     $('#tabla_clientes').append('<tr><td>'+(i+1)+'</td><td>'+data[i]["cliente_nombre_completo"]+'</td><td>'+data[i]["cliente_documento_numero"]+'</td><td>'+data[i]["fecha_inicio"]+'</td><td>'+data[i]["fecha_final"]+'</td><td><a href="#" onclick="eliminar('+data[i]["cliente_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a><a href="cliente/editar/'+data[i]["cliente_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td></tr>');
    }else{
      $('#tabla_clientes').append('<tr><td>'+(i+1)+'</td><td>'+data[i]["cliente_nombre_completo"]+'</td><td>'+data[i]["cliente_documento_numero"]+'</td><td> - </td><td> - </td><td><a  onclick="eliminar('+data[i]["cliente_id"]+')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a><a href="cliente/editar/'+data[i]["cliente_id"]+'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td></tr>');
    } }
    },'json');
 }else{
  $('#tabla_clientes tbody').empty();
 }
}


</script>
