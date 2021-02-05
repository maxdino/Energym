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
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label mb-10 text-left">APERTURA RUTINA</label>
                        <select class="form-control" id="rutina"  name="rutina">
                         <option value=""></option>
                          <?php foreach ($data['apertura_rutina'] as $key => $value) {  ?>
                          <option  value="<?php echo $value['apertura_rutina_id']; ?>"><?php echo $value['instructor_nombre'].' |'.$value['fecha_inicio'].' a '.$value['fecha_fin'].'| '.$value['hora_inicio'].' a '.$value['hora_fin'] ?></option>    
                          <?php }  ?>  
                        </select>
                      </div>
                    </div>
                   </div>  
                  <br>
                  <center><a href="<?php echo  base_url();?>Control_asistencia_c"><button id="boton_guardar" class="btn btn-primary">Guardar</button></a><a href="<?php echo  base_url();?>Control_asistencia_c"><button class="btn btn-danger" type="button" >Cancelar</button></a></center>               
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
    $('#instructor').select2();
    $('#rutina').select2();
  });

function validarfecha(){
$("#fecha_fin").val('');
$("#fecha_fin").attr('min',$("#fecha_inicio").val())
}

function validarhora(){
$("#hora_fin").val('');
$("#hora_fin").attr('min',$("#hora_inicio").val())
}

  <?php if(isset($data["id"]))
  { ?>


    $(function(){       
      $.post(base_url+"Control_asistencia_c/traer_uno",{"id":"<?php echo $data['id']?>"},function(data){
        $("#id").val(data[0].apertura_rutina_id);
        $("#fecha_inicio").val(data[0].fecha_inicio);
        $("#fecha_fin").val(data[0].fecha_fin);
        $("#frecuencia").val(data[0].frecuencia);
        $("#hora_inicio").val(data[0].hora_inicio);
        $("#hora_fin").val(data[0].hora_fin);
        $("#rutina").val(data[0].rutina_paquete_id).trigger('change');
        $("#instructor").val(data[0].instructor_id).trigger('change');

      },"json");
    });

  <?php }

  ?>

  function guardar()
  {
    $("#boton_guardar").text("Procesando...");
    $("#boton_guardar").attr("disabled",true);


    $.post(base_url+"Control_asistencia_c/guardar",$("#formulario").serialize(),function(data){  
      if(parseFloat(data)==1)
      {
        alertasuccess('Se Registro correctamente','Exitoso');
        setTimeout(function(){ 
          location.href = base_url+"Control_asistencia_c";
        }, 1000);
      }
      if(parseFloat(data)==2)
      {
        alertasuccess('Se Actualizo correctamente','Exitoso');
        setTimeout(function(){ 
          location.href = base_url+"Control_asistencia_c";
        }, 1000);
      }
      if(parseFloat(data)==0)
      {
        alertainfo('No se pudo completar!','Error');

      }
      if(parseFloat(data)==3)
      {
        alertainfo('Ya existe el Control de Asistencia!','Error');
        setTimeout(function(){ 
          location.href = base_url+"Control_asistencia_c";
        }, 1000);
      }

    });


    return false;
  }
 
  

</script>