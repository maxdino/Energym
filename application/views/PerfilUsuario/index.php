
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
 <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>Editarusuario/actualizar">
<div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <input type="hidden" name="id" value="<?php echo $_COOKIE["usuario_id"]?>" id="id" >
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> 
                    <div  class="avatar-upload">
                    <div class="avatar-edit">
                      <input type="file" name="fileToUpload" id="imageUpload" accept=".png, .jpg, .jpeg">
                      <input type='hidden' id="urlfoto"/>
                      <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                      <img  id="imagePreview" style="background-image: url(<?php echo base_url()."public/assets/images/foto_perfil/".$data["tabla"]->empleado_foto ?>);"/>
                    </div> 
                  </div> 
                    <h4 class="card-title m-t-10"><?php echo $data["tabla"]->empleado_nombres ?></h4>
                    <h6 class="card-subtitle"><?php echo $data["tabla"]->perfil_descripcion ?></h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                     </div>
                </center>
            </div>
            <div>
                <hr> </div>
                <div class="card-body"> <small class="text-muted">Correo Electronico </small>
                    <h6><?php echo $data["tabla"]->empleado_email ?></h6> <small class="text-muted p-t-30 db">Telefono</small>
                    <h6><?php echo $data["tabla"]->empleado_telefono ?></h6> <small class="text-muted p-t-30 db">Dirección</small>
                    <h6><?php echo $data["tabla"]->empleado_direccion ?></h6>
                    <small class="text-muted p-t-30 db">Redes Sociales</small>
                    <br/>
                    <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist"> 
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Perfil</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Configuración</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--second tab-->
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"> <strong><?php echo $data["tabla"]->empleado_nombres.' '.$data["tabla"]->empleado_apellidos ?></strong>
                                    <br>
                                    <p class="text-muted"><?php echo $data["tabla"]->empleado_nombres ?></p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Telefono</strong>
                                    <br>
                                    <p class="text-muted">(+51) <?php echo $data["tabla"]->empleado_telefono ?></p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $data["tabla"]->empleado_email?></p>
                                </div>
                                <div class="col-md-3 col-xs-6"> <strong>Ubicación</strong>
                                    <br>
                                    <p class="text-muted">Tarapoto</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel">
 
                        <div class="card-body">

                                <div class="row form-material">
                                    <div class="col-md-6"> 
                                        <label class="m-t-20">Nombre</label>
                                        <input type="text" placeholder="Johnathan Doe" value="<?php echo $data["tabla"]->empleado_nombres ?>" name="nombreempleado" id="nombreempleado" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6">
                                       <label for="example-email" class="col-md-12">Apellido</label>
                                        <div class="m-t-20">
                                            <input type="text" placeholder="Johnathan Doe" value="<?php echo $data["tabla"]->empleado_apellidos ?>" name="apellidoempleado" id="apellidoempleado" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-material">
                                    <div class="col-md-6"> 
                                        <label class="m-t-20">D.N.I</label>
                                        <input type="text" class="form-control" id="dni" name="dni"  placeholder="2017-06-04" value="<?php echo $data["tabla"]->empleado_dni ?>" > 
                                    </div>
                                    <div class="col-md-6"> 
                                        <label class="m-t-20">Sexo</label>
                                        <div class="m-t-20">
                                            <select class="form-control form-control-line" name="sexoempleado" id="sexoempleado">
                                              <?php if ($data["tabla"]->empleado_sexo == 'M'){ ?>
                                                <option value="M" selected="selected">Masculino</option>
                                                <option value="F">Femenino</option> 
                                              <?php }else{  ?>
                                                 <option value="M">Masculino</option>
                                                  <option value="F" selected="selected">Femenino</option> 
                                             <?php } ?>
                                            
                                        </select>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row form-material">
                                    <div class="col-md-6"> 
                                        <label class="m-t-20">Fecha de Nacimiento</label>
                                        <input type="text" class="form-control"   name="mdate" placeholder="2017-06-04" value="<?php echo $data["tabla"]->empleado_fecha_nacimiento ?>" id="mdate"> 
                                    </div>
                                    <div class="col-md-6">
                                       <label for="example-email" class="col-md-12">Email</label>
                                        <div class="m-t-20">
                                            <input type="email" placeholder="johnathan@admin.com" value="<?php echo $data["tabla"]->empleado_email ?>" class="form-control form-control-line" name="correo" id="correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-material">
                                    <div class="col-md-6"> 
                                        <label class="m-t-20">Contraseña</label>
                                        <input type="password"    value="<?php echo $data["tabla"]->empleado_clave ?>" name="contrasenia" id="contrasenia" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-6">
                                       <label for="example-email" class="col-md-12">Telefono</label>
                                        <div class="m-t-20">
                                            <input type="text" placeholder="123 456 7890"  value="<?php echo $data["tabla"]->empleado_telefono ?>" name="telefonoempleado" id="telefonoempleado" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-material">
                                    <div class="col-md-6">
                                       <label for="example-email" class="col-md-12">Direccion</label>
                                        <div class="m-t-20">
                                            <input type="text" placeholder="123 456 7890"  value="<?php echo $data["tabla"]->empleado_direccion ?>" name="direccionempleado" id="direccionempleado" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <label class="m-t-20">Descripción</label>
                                        <textarea rows="5" class="form-control form-control-line" name="descripcionempleado" id="descripcionempleado"></textarea>
                                    </div>
                                    
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success" >Actualizar Perfil</button>
                                    </div>
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
 
    </script>