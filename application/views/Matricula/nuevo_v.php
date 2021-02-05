<style type="text/css">
  .select2-container--default .select2-results__option[aria-disabled=true] {
    background-color: #d25454;
    color: black;
}
</style>
<div class="row">   
    <div class="col-12">
        <div class="card">
              <div class="card-body" id="cuerpo_pagina">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form id="formulario_venta" onsubmit="return generar_venta()" name="formulario_venta" >
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tipo de Comprobante:</label>
                                    <select name="comprobantes" id="comprobantes" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach($data["tipocomprobantes"] as $tipocomprobante):?> 
                                            <?php $datacomprobante = $tipocomprobante["tipodoc_id"]."*".$tipocomprobante["serie"].'-'.$tipocomprobante["correlativo"];?>
                                            <option value="<?php echo $datacomprobante;?>"><?php echo $tipocomprobante["tipodoc_descripcion"]?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cliente:</label>
 
                                    <select   id="select2_example" id="idCliente" name="idCliente" class="form-control" required> 
                                      <option value=""></option>
                                      <?php if(!empty($data["clientes"])): ?>
                                        <?php foreach($data["clientes"] as $cliente):?> 
                                            <option value="<?php echo $cliente["cliente_id"];?>" <?php echo $cliente["estado"];?>><?php echo $cliente["cliente_nombre_completo"] ?></option>
                                        <?php endforeach;?>
                                      <?php endif;?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <h4>Seleccione Instructores Disponible</h4>
                        <div class="form-group">
                            <select name="rutina" id="rutina" onchange="seleccionar_rutina()" class="form-control">
                                <option value=""></option> 
                               <?php foreach ($data['apertura_rutina'] as $key => $value) {  ?>
                                 <option  value="<?php echo $value['apertura_rutina_id'].'*'.$value['instructor_nombre'].'*'.'0.00'.'*'.'1'; ?>"><?php echo $value['instructor_nombre'].' |'.$value['fecha_inicio'].' a '.$value['fecha_fin'].'| '.$value['hora_inicio'].' a '.$value['hora_fin'] ?></option> 
                               <?php } ?>
                            </select>
                        </div>
                         
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">                    
                                <h4 class="text-center">Paquetes Agregados a la Venta</h4>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tborden">
                                    <thead>
                                        <tr>
                                            <th>Matricula</th> 
                                            <th>F. Inicio</th> 
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="message">
                                            <td colspan="5" class="text-center">Aun no se han agregado producto al detalle</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <td>
                                                <input type="hidden" name="total" id="total" value="0">
                                                <p class="total">0.00</p>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                                <div class="form-group">
                                    <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
                                    <a href="<?php echo base_url();?>Matricula_c" class="btn btn-danger">Volver</a>
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </form>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la orden</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button id="btn-cmodal" type="button" class="btn btn-danger pull-left btn-cerrar-imp" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
     <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-clientes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Listado de Clientes</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data["clientes"])):?>
                            <?php foreach($data["clientes"] as $cliente):?>
                                <tr>
                                    <td><?php echo $cliente["cliente_id"];?></td>
                                    <td><?php echo $cliente["cliente_nombre_completo"];?></td>
                                    <td><?php echo $cliente["cliente_documento_numero"];?></td>
                                    <?php $datacliente = $cliente["cliente_id"]."*".$cliente["cliente_nombre_completo"]."*1*".$cliente["tipo_documento_cliente_id"]."*".$cliente["cliente_documento_numero"]."*".$cliente["cliente_telefono"]."*".$cliente["cliente_direccion"];?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="btn-cmodal" type="button" class="btn btn-danger pull-left btn-cerrar-imp" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

   </div>
     </div>
</div>
</div>



 <div id="modal_pagar_venta" class="modal fade bs-example-modal-lg "  role="dialog" aria-labelledby="myLargeModalLabel"  aria-modal="true">
                                    <div class="modal-dialog modal-lg"    >
                                        <form id="formulario_pago" onsubmit="return pagar_venta()">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #67757c!important;">
                                                <h4 class="modal-title" id="myLargeModalLabel" style="color: #fff!important;">Pagar Venta</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                              
                                            <div class="modal-body " style="background-color: #67757c!important;">
                                               <div class="col-md-12">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
                                                            <tbody>
                                                              <tr>
                                                                <td width="25%" style=" border: 1px solid #00a65a;background: #FFF !important;color: black ;font-weight: bold;">Articulos totales</td>
                                                                <td width="25%" style=" border: 1px solid #00a65a;background: #FFF !important;color: black;" class="text-right">


                                                                  <span id="item_count" style="color: black;">1(1)</span>


                                                                </td>
                                                                <td width="25%" style=" border: 1px solid #00a65a;background: #FFF !important;color: black;font-weight: bold;">Total a Pagar</td>
                                                                <td width="25%" class="text-right" style=" border: 1px solid #00a65a;background: #FFF !important;color: black;">

                                                                  <span id="total_pagar_modal" style="color: black;">12.00</span>


                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td style=" border: 1px solid #00a65a;background: #FFF !important;color: black;font-weight: bold;">Dinero Entrego</td>
                                                                <td class="text-right" style=" border: 1px solid #00a65a;background: #FFF !important;color: black;">
                                                                
                                                                  <span id="total_paying" style="color: black;">12.00</span>
                                                                <input type="hidden" name="totalpagar" id="totalpagar">

                                                                </td>
                                                                <td style=" border: 1px solid #00a65a;background: #FFF !important;color: black;font-weight: bold;">Vuelto</td>
                                                                <td class="text-right" style=" border: 1px solid #00a65a;background: #FFF !important;color: black;">

                                                                  <span id="balance" style="color: black;font-weight: bold;">0.00</span>

                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-md-4">
                                                     <div class="form-group">
                                                       <label style="color:#fff;">Monto de dinero</label>
                                                       <input type="number" required="true" step="0.01" autocomplete="off" onchange="validarvuelto();" id="monto_dato" class="form-control" name="monto">
                                                     </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <div class="form-group">
                                                          <label style="color:#fff;">Tipo de pago</label>
                                                          <select  class="form-control" id="tipo_pago" name="tipo_pago">
                                                            <option value="1">Contado</option>
                                                           <!--  <option value="2">Credito</option> -->
                                                          </select>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                     <div class="form-group">
                                                       <label style="color:#fff;">Forma de Pago</label>
                                                       <select id="forma_pago" name="forma_pago" class="form-control">
                                                        <option value="1">Efectivo</option>
                                                        </select>
                                                     </div>
                                                   </div>
                                                </div>
                                                 
                                                 <div id="cuerpo_credito" style="display: none">
                                                  <div  class="row">
                                                     <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label style="color:white;">Cuotas</label>
                                                        <input type="number" id="cuotas" onkeyup="crear_cronograma()" value="1" name="cuotas" class="form-control">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label style="color:white;">Tiempo</label>
                                                        <select class="form-control" onchange="crear_cronograma()" id="intervalo" name="intervalo">
                                                          <option value="">Seleccionar</option>
                                                          <option value="1">Diario</option>
                                                          <option value="2">Semanal</option>
                                                          <option value="3">Quincenal</option>
                                                          <option value="4" >Mensual</option>

                                                        </select>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <div id="cronograma">
                                                        
                                                      </div>
                                                    </div>
                                                  </div>

                                                </div>

                                               </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #67757c!important;">
                                                  <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button> 
                                                  <button type="submit" id="submit-sale" class="btn btn-primary">Pagar</button>
                                           </div>
                                  
                                    </div>
                             </form>
                       </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  var minimum = 1;
    $(document).ready(function () {
     // $("#modal_pagar_venta").modal();
    var year = (new Date).getFullYear();
    $("#rutina").select2();
    //datagrafico(base_url,year);





    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#infoCliente").val(infocliente[4] + ' - ' +infocliente[1]);
        $("#idCliente").val(infocliente[0]);
        $("#modal-clientes").modal("hide");
    });

    $("#membresia").on("change", function(){
        id = $(this).val(); 
        $.ajax({
            url: base_url + "Matricula_c/BuscarCategoriaMembresia",
            type: "POST", 
            data:{idcategoria:id},
            dataType:"json",
            success:function(resp){

                html = "";
                if ( resp == 0) {
                    html = "";
                }else{
                    $.each(resp,function(key, value){

                      if (value.condicion == "1") {
                          stock = value.stock;
                      }
                      else{
                          stock = "N/A";
                      }
                      data = value.id + "*"+ value.codigo+ "*"+ value.nombre+ "*"+ value.precio+ "*"+ stock+"*"+value.cantidad_personas;
                      html += "<tr>";
                      html += "<td>"+value.nombre+"</td>";
                      html += "<td><button type='button' class='btn btn-success btn-flat btn-selected' value='"+data+"'><span class='fa fa-check'></span></button></td>";
                      html += "</tr>";
                  });
                }

                $("#tbproductos tbody").html(html);
            }

        });
    });
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });
    $(".btn-view-producto").on("click", function(){
        var producto = $(this).val(); 
        //alert(cliente);
        var infoproducto = producto.split("*");
        html = "<p><strong>Codigo:</strong>"+infoproducto[1]+"</p>"
        html += "<p><strong>Nombre:</strong>"+infoproducto[2]+"</p>"
        html += "<p><strong>Descripcion:</strong>"+infoproducto[3]+"</p>"
        html += "<p><strong>Precio:</strong>"+infoproducto[4]+"</p>"
        html += "<p><strong>Stock:</strong>"+infoproducto[5]+"</p>"
        html += "<p><strong>Categoria:</strong>"+infoproducto[6]+"</p>";
        $("#modal-default .modal-body").html(html);
    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
    $(".btn-view").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/categorias/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5 ]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
 
    $('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('.example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    //$('.sidebar-menu').tree();

    $("#comprobantes").on("change",function(){
        option = $(this).val();

        if (option != "") {
            infocomprobante = option.split("*");

            $("#idcomprobante").val(infocomprobante[0]);
            $("#igv").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
        }
        else{
            $("#idcomprobante").val(null);
            $("#igv").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumar();
    })

    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });
/*    $("#producto").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            data = ui.item.id + "*"+ ui.item.codigo+ "*"+ ui.item.label+ "*"+ ui.item.precio+ "*"+ ui.item.stock;
            $("#btn-agregar").val(data);
        },
    }); */
    $("#btn-agregar").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='hidden' name='precios' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
            html += "<td>"+infoproducto[4]+"</td>";
            html += "<td><input type='text' name='cantidades' value='1' class='cantidades'></td>";
            html += "<td><input type='hidden' name='importes' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='mdi mdi-delete-empty txt-danger'></span></button></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#producto").val(null);
        }else{
            alert("seleccione un producto...");
        }
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    $(document).on("keyup mouseup","#tborden input.input-cantidad ", function(){
        cantidad = $(this).val(); 
        precio = $("#precios").val();//$(this).closest("tr").find("td:eq(2)").text(); 
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
        sumar();

    });
    $(document).on("keyup mouseup","#precios", function(){
        cantidad = $("#cantidades").val();
        precio = $("#precios").val();//$(this).closest("tr").find("td:eq(2)").text(); 
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
        sumar();

    });
    $(document).on("click",".btn-view-venta",function(){
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });

    $(document).on("click",".btn-print",function(){
        $("#modal-default .modal-body").print({
            title:"Comprobante de Venta"
        });
    });
})

function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}

function verificar(producto_id){
    var existe = 0;
    $('input[name^="productos"]').each(function() {
        if ($(this).val() == producto_id) {
            existe = 1;
        }
    });

    return existe;
}

function contarproductos(){
    var contador = 0;
    $('input[name^="productos"]').each(function() {
        contador ++;
    });

    return contador;
}



function sumar(){
    /*subtotal = 0;
    $("#tbventas tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(5)").text());
    });
    $("input[name=subtotal]").val(subtotal.toFixed(2));
    porcentaje = $("#igv").val();
    igv = subtotal * (porcentaje/100);
    $("input[name=igv]").val(igv.toFixed(2));
    descuento = $("input[name=descuento]").val();
    total = subtotal + igv - descuento;
    $("input[name=total]").val(subtotal.toFixed(2));*/
    total = 0;
    $("#tborden tbody tr").each(function(){ 
        total = total + Number($(this).find("td:eq(4)").text());
    });
    $("input[name=total]").val(total.toFixed(2));
    $(".total").text(total.toFixed(2));

}
/*function datagrafico(base_url,year){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "dashboard/getData",
        type:"POST",
        data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(meses,montos,year);
        }
    });
}*/

function generar_venta(){
   
  var monto_total=$("#total").val();
  totalitem = 0;
  totalcantidad = 0;
  importetotal = 0;
    $('input[name="cantidades"]').map(function () {
         totalcantidad = parseFloat($(this).val()) + parseFloat(totalcantidad);         
         totalitem++;
    }).get();

    $('input[name="importes"]').map(function () {
        importetotal =  parseFloat($(this).val()) + parseFloat(importetotal);
    }).get();
  var item_count=totalitem+"("+totalcantidad+")";
  total_pagar_modal=importetotal
  total_paying=importetotal;
  balance="0,00";

 // alert(monto_total);
  /*var datos=parseFloat(monto_total);
  */
  $("#monto_dato").val(monto_total);
  $("#item_count").text(item_count);
  $("#total_pagar_modal").text(total_pagar_modal);
  $("#total_paying").text(total_paying);
  $("#balance").text(balance);
  $("#totalpagar").val(importetotal);
  $("#monto_dato").val(importetotal);
  $("#modal_pagar_venta").modal();

  return false;
}

function validarvuelto(){
    monto = $("#monto_dato").val();
    montototal = $("#totalpagar").val();
    resta =  parseFloat(monto) - parseFloat(montototal);
    if (resta < 0) {
        $("#monto_dato").val(montototal);
        $("#balance").text("0,00");
    }else{
        
        $("#balance").text((Math.round(resta * 100) / 100));
    }
}

    function seleccionar_rutina(){
        valorBtn = $("#rutina").val();
        infoBtn = valorBtn.split("*"); 
        $("#tborden tbody").empty();
        if (valorBtn!='') { 
        if (verificar(infoBtn[0])) {
            alert("El paquete ya fue agregado");
        }else{
              if (contarproductos()) {
               alert("Solo puede agregar un tipo de membresía");
               return 0;
             } 
             today = new Date();
             $mes =(today.getMonth()+1).toString();;
             if ($mes.length==1) {
              $mes = '0'+$mes;
             }
             var date = today.getFullYear()+'-'+$mes+'-'+today.getDate();

            html = "<tr>";
            html += "<td><input type='hidden' name='productos' value='"+infoBtn[0]+"'>"+infoBtn[1]+"</td>";
            html += '<td><input type="date" class="form-control" min="'+date+'" autocomplete="off" value="'+date+'" required="true"  name="fecha_inicio" id="fecha_inicio"></td>';
            html += '<td><input type="text" name="precios" id="precios" class="form-control" value="'+infoBtn[2]+'"></td>';
            html += "<td>";
            html +='<input type="number" name="cantidades" id="cantidades" min="1" class="form-control input-cantidad" value="1">';
            html += "</td>";
            html += "<td>";
            html +='<input type="hidden" name="importes" class="form-control"  value="'+infoBtn[3]+'">';
            html += '<p>'+infoBtn[3]+'</p>';
            html += "</td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='mdi mdi-delete-empty txt-danger'></span></button></td>";
            html += "</tr>";

            $("#tborden tbody").append(html);
            $(".btn-guardar").removeAttr("disabled");
            sumar();

            if (Number($("input[name=total]").val()) != 0) {
                $("#tborden tbody tr.message").remove();
            }

        }

        }
    }

 
function pagar_venta() {


   datos_matriz={};
   datos_matriz["compra"]=$("#formulario_venta").serialize();
   datos_matriz["pago"] = $("#formulario_pago").serialize();
//alert(datos_matriz["pago"]);
$("#submit-sale").text("Procesando...");
$("#submit-sale").attr("disabled",true);
$.post(base_url+"Matricula_c/procesar_venta",JSON.stringify(datos_matriz),function(data){ 

         $("#submit-sale").text("Pagar");
         $("#submit-sale").attr("disabled",false); 
         $("#modal_pagar_venta").modal("hide"); 
          Swal.fire({
            title: '¿Desea Imprimir comprobante?',
            text: "Venta Exitosa!!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo',
            cancelButtonText: 'Más Tarde',
            showLoaderOnConfirm: true
          }).then((result) => {
            if (result.value) {
              var url=base_url+"Matricula_c/mostrar_comprobante/"+data;
               var a = document.createElement("a");
               a.target = "_blank";
               a.href = url;
               a.click();
               
            }
            location.href = base_url+"Matricula_c";
          });
 

}).fail(function() {
   $("#submit-sale").text("Pagar");
   $("#submit-sale").attr("disabled",false);
   alert("ERROR SE GENERO UN ERROR EN LA TRANSACCION");
});

return false;
}


 $('#select2_example').select2();
</script>
