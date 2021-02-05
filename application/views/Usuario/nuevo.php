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
                <form method="POST" id="enviar_usuario" onsubmit="return enviar_usuario_guardar()">
                  <input type="hidden" id="empleado_id" name="empleado_id">
                  <div class="row">
                  <div class="col-md-4"><div class="form-group">
                  
                    <label class="control-label mb-10 text-left">N° DOCUMENTO</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="n_documento" id="n_documento" maxlength="8" minlength="8" autofocus="true" value="">
                  </div></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Perfil</label>
                      <select id="perfil"  name="perfil" class="form-control">
                        <?php 
                                                   foreach ($data["perfil"] as $key => $value) {
                                                    echo "<option value='".$value["perfil_id"]."'>".$value["perfil_descripcion"]."</option>";
                                                   }
                                 
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4"><div class="form-group">
                  
                    <label class="control-label mb-10 text-left">Nombres</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="nombre" id="nombre"  autofocus="true" value="">
                  </div></div>

                  <div class="col-md-4"><div class="form-group">
                  <label class="control-label mb-10 text-left">Apellidos</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="apellidos" id="apellidos"  autofocus="true" value="">
                  </div></div>

                    <div class="col-md-4"><div class="form-group">
                    <label class="control-label mb-10 text-left">Direccion</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="direccion" id="direccion"  autofocus="true" value="">
                  </div></div>
                  <div class="col-md-4"><div class="form-group">
                  
                    <label class="control-label mb-10 text-left">Celular</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="celular" id="celular"  autofocus="true" value="">
                  </div></div>
                    <div class="col-md-4"><div class="form-group">
                  
                    <label class="control-label mb-10 text-left">Correo Electronico</label>
                    <input type="text" class="form-control" autocomplete="off" required="true" name="correo" id="correo"  autofocus="true" value="">
                  </div></div>
                    <div class="col-md-4"><div class="form-group">
              
                    <label class="control-label mb-10 text-left">Usuario</label>
                    <input type="text" class="form-control" autocomplete="off"  name="usuario" id="usuario"  autofocus="true" value="">
                  </div></div>
                  <div class="col-md-4"><div class="form-group">
              
                    <label class="control-label mb-10 text-left">Contraseña</label>
                    <input type="text" class="form-control" autocomplete="off"  name="contrasena" id="contrasena"  autofocus="true" value="">
                  </div></div>

                  <div class="col-md-4"><div class="form-group">
                  
                    <label class="control-label mb-10 text-left">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo">
                      <option value="M">Masculino</option>
                      <option value="F">Femenino</option>

                    </select>
                  </div></div>

                  </div>  
                  <br>
                  <center><a href="<?php echo  base_url();?>Usuario"><button id="boton_guardar" class="btn btn-primary">Guardar</button></a><a href="<?php echo  base_url();?>Usuario"><button class="btn btn-danger" type="button" >Cancelar</button></a></center>               
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

  function enviar_usuario_guardar()
  {

    //alert();
    $("#boton_guardar").attr("disablad",true);
    $("#boton_guardar").text("Procesando...");



         $.post(base_url+"Usuario/guardar_usuario",$("#enviar_usuario").serialize(),function(data){
                    if(parseFloat(data)==1)
                    {
                          alertasuccess('Se Registro correctamente','Exitoso');
                          setTimeout(function(){ 
               location.href = base_url+"Usuario";
            }, 1000);
                    }
                    if(parseFloat(data)==2)
                     {
              alertasuccess('Se Actualizo correctamente','Exitoso');
              setTimeout(function(){ 
               location.href = base_url+"Usuario";
            }, 1000);
                     }
                     if(parseFloat(data)==0)
                      {
              alertainfo('No se pudo completar!','Error');

                      }

         });
    return false;
  }
  <?php

  if(isset($data["id"]))
    {?>
      

      $(function(){
        
        $.post(base_url+"Usuario/traer_datos",{"id":"<?php echo $data['id']?>"},function(data){
          console.log(data);
          $("#empleado_id").val(data[0]["empleado_id"]);
          $("#nombre").val(data[0]["empleado_nombres"]);
          $("#apellidos").val(data[0]["empleado_apellidos"]);
          $("#n_documento").val(data[0]["empleado_dni"]);
          $("#direccion").val(data[0]["empleado_direccion"]);
          $("#celular").val(data[0]["empleado_telefono"]);
          $("#correo").val(data[0]["empleado_email"]);
          $("#perfil").val(data[0]["perfil_id"]);
          $("#sexo").val(data[0]["empleado_sexo"]);
          $("#usuario").val(data[0]["empleado_usuario"]);
          $("#contrasena").val(data[0]["empleado_clave"]);




        },"json");
      });




      <?php }

      ?>
</script>