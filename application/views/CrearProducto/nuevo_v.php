
<style type="text/css">
  .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
  }
  .avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
  }
  .avatar-upload .avatar-edit input {
    display: none;
  }
  .avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
    }mdi-lead-pencil
    .avatar-upload .avatar-edit input + label:hover {
      background: #f1f1f1;
      border-color: #d6d6d6;
    }
    .avatar-upload .avatar-edit input + label:after {
      content: "\F64F";
      font-family: 'Material Design Icons';
      color: #757575;
      position: absolute;
      top: 10px;
      left: 0;
      right: 0;
      text-align: center;
      margin: auto;
    }
    .avatar-upload .avatar-preview {
      width: 192px;
      height: 192px;
      position: relative;
      border-radius: 100%;
      border: 6px solid #F8F8F8;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-upload .avatar-preview > img {
      width: 100%;
      height: 100%;
      border-radius: 100%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>
  <div class="row">
    <form method="post" id="subirimagen" enctype="multipart/form-data" action="<?php echo base_url();?>R_producto/guardar">
      <div class="row">
       <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
          <div class="card-body">
            <center class="m-t-30"> 
              <div  class="avatar-upload">
                <div class="avatar-edit">
                  <input type="file" name="fileToUpload" id="imageUpload" accept=".png, .jpg, .jpeg">
                  <input type="hidden"  name="imagen_valida" id="imagen_valida"  class="span11"   />
                  <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                  <img  id="imagePreview" style="background-image: url(<?php echo base_url()."public/assets/images/foto_perfil/defecto_imagen.png" ?>);"/>
                </div> 


                <br><input type="hidden"  name="id" id="id">
                <div class="row form-group has-success">
                  <label class="form-control-label" for="success">Nom. Producto</label>
                  <input type="text" class="form-control form-control-success" id="producto_nombre" name="producto_nombre">
                </div> 

              </div>  
            </center>
          </div>

        </div>
      </div>
      <!-- Column -->
      <!-- Column -->
      <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs profile-tab" role="tablist"> 
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Registro</a> </li> 
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!--second tab-->
            <div class="tab-pane active" id="profile" role="tabpanel">
              <div class="card-body">
               <form action="#">
                <div class="form-body">
                  <h3 class="card-title">Producto</h3>
                  <hr>
                  <div class="row p-t-0">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">CODIGO DE BARRAS</label>
                        <input type="text" id="codigobarra" name="codigobarra" class="form-control"   placeholder="">
                        <!--<small class="form-control-feedback"> This is inline help </small> -->
                      </div>
                    </div>
                    <!--/span has-danger form-control-danger-->
                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">PRECIO PRODUCTO</label>
                        <input type="number" step="0.01" id="precioproducto"  min="0" name="precioproducto" onkeypress="return solonumeros(event)" class="form-control" placeholder=" ">
                        <!--<small class="form-control-feedback"> Select your gender </small> -->
                      </div>
                    </div>
                    <!--/span-->
                  </div>
                  <div class="row p-t-0">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">STOCK MINIMO</label> 
                        <input type="number" step="0.01" id="stockminimo"  min="0" name="stockminimo" onkeypress="return solonumeros(event)" class="form-control" placeholder=" ">
                        <!--<small class="form-control-feedback"> This is inline help </small> -->
                      </div>
                    </div>
                    <!--/span has-danger form-control-danger-->
                    <div class="col-md-6 ">
                      <div class="form-group ">
                        <label class="control-label">CATEGORIA DE TIPO PRODUCTO</label>
                        <select class="form-control custom-select" id="categoria_producto" name="categoria_producto">
                          <option value=" "> </option>
                          <?php foreach ($data["categoria"] as $key => $value) { ?>
                           <option value="<?php echo $value["categoria_producto_id"] ?>"><?php echo $value["categoria_producto_descripcion"] ?></option>
                         <?php   } ?>
                       </select>
                     </div>
                   </div>
                   <!--/span-->
                 </div>
                 <!--/row-->
                 <div class="row">
                   <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">MARCA</label>
                      <select class="form-control custom-select" name="marca" id="marca">
                        <option value=" "> </option>
                        <?php foreach ($data["marca"] as $key => $value) { ?>
                         <option value="<?php echo $value["marca_id"] ?>"><?php echo $value["marca_descripcion"] ?></option>
                       <?php   } ?>
                     </select>
                     <!--<small class="form-control-feedback"> Select your gender </small> -->
                   </div>
                 </div>
                 <!--/span-->
                 <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">UNIDAD DE MEDIDA</label>
                    <select class="form-control custom-select" name="unidadmedida" id="unidadmedida"><option value=" "> </option>
                      <?php foreach ($data["unidad_medida"] as $key => $value) { ?>
                       <option value="<?php echo $value["id_unidad_medida"] ?>"><?php echo $value["unidad_medida_descripcion"] ?></option>
                     <?php   } ?>
                   </select>
                   <!--<small class="form-control-feedback"> Select your gender </small> -->
                 </div>
               </div>
             </div>

             <!--/span-->
           </div>
           <!--/row-->


         </div>
         <div class="form-actions">
          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
          <a   href="<?php echo  base_url();?>R_producto" class="btn btn-inverse">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</form>
</div>






<script type="text/javascript"> 
  function readURL(input) {
    var  variable;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) { 
        $('#imagePreview').css('background-image', 'url('+e.target.result +')'); 
        $('#imagePreview').attr('src', e.target.result);
        $(".foto_perfilupdate").attr('src', e.target.result);
        $("#foto_perfilupdate").attr('src', e.target.result);
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650); 

      }                         
      reader.readAsDataURL(input.files[0]); 
    }
  }
  $("#imageUpload").change(function() {
   readURL(this);  
 });
  function llamarfuncion(){ 
    $.ajax({
                url: base_url+'Editarusuario/guardar', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#form_update").serialize(), // post data || get data
                success : function(result) {

                },
                error: function(xhr, resp, text) {
                  console.log(xhr, resp, text);
                }
              })
  }

  <?php

  if(isset($data["id"]))
    {?>
      $(function(){
        $.post(base_url+"R_producto/traer_uno",{"id":"<?php echo $data['id']?>"},function(data){
          $("#id").val(data[0]["producto_id"]);
          $("#producto_nombre").val(data[0]["producto_descripcion"]);
          $("#precioproducto").val(data[0]["producto_precio"]);
          $("#stockminimo").val(data[0]["producto_minimo"]);
          $("#marca option[value='"+data[0]["marca_id"]+"']").attr("selected", true);
          $("#categoria_producto option[value='"+data[0]["categoria_producto_id"]+"']").attr("selected", true);
          $("#unidadmedida option[value='"+data[0]["unidad_medida_id"]+"']").attr("selected", true);
          $("#imagen_valida").val(data[0]["producto_imagen"]);
           if (data[0]["producto_imagen"]!='') { 
          $('#imagePreview').css('background-image', 'url('+<?php echo base_url(); ?>+'public/imagen/'+data[0]["producto_imagen"]+')');
         }
        },"json");
      });
    <?php }

    ?>

  </script>