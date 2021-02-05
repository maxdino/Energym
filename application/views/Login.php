<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>public/assets/images/favicon.png">
    <title>Energym</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- page css -->
    <link href="<?php echo base_url()?>public/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>public/css/style.css" rel="stylesheet">
    

    <link href="<?php echo base_url()?>public/css/colors/default-dark.css" id="theme" rel="stylesheet">
 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/php_captcha/estilo.css">
<![endif]-->
</head>

<body>

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Energym</p>
        </div>
    </div>

    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(<?php echo base_url()?>public/assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material"  id="form" >
                    <a href="javascript:void(0)" class="text-center db"><img style="width: 300px;" src="<?php echo base_url()?>public/assets/images/ener2.jpg" alt="Home" /><br/>
                        <!-- <img src="<?php echo base_url()?>public/assets/images/logo-text.png" alt="Home" /></a> -->
                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" id="usuario" autocomplete="off" name="usuario" required="" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" id="clave" autocomplete="off" name="clave" required=""  placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                               <button  type="button" class="btn btn-default btncapt "><i class="icon icon-refresh"></i></button>  
                               <canvas id="capatcha" height="45" style="margin-bottom: -10px;"  width="150" ></canvas>
                           </div>
                       </div>
                       <input type="hidden" name="validar_captchar" id="validar_captchar" value="0">
                       <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <button class="btn    " title="validar captchar" id="IngresoLog" style="background: #fff;" type="button"><i class="icon-check" style="color: black;"></i></button>
                            <input type="text"  placeholder="Captchar" autocomplete="off" name="contra" id="valorCapt" />
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" id="submit" type="button" name="submit" value="submit">Iniciar</button>
                        </div>
                    </div>
                    <div class="row" id="mensaje">

                    </div>

                </form>

            </div>
        </section>
        <script src="<?php echo base_url()?>public/assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?php echo base_url()?>public/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!--Custom JavaScript -->
        <script type="text/javascript">
            $( document ).ready(function() {
                $("#IngresoLog").click(function(event) {
      //event.preventDefault();
      //Se envia peticion Ajax
      //al servidor para verificar
      //si la clave introducida es la
      //correcta, y nos nuestra en un alert
      $.ajax({
        url: '<?php echo base_url(); ?>public/php_captcha/VerifCaptha.php',
        type: 'POST',
        dataType: 'text',
        data: {"valor": $("#valorCapt").val()},
    })
      .done(function(data) {
        if (data!='') {
            $('#validar_captchar').val(data);
        }

    })
      .fail(function() {
        //console.log("error");
    })
      .always(function() {
        //console.log("complete");
    });
      
  });
//Reccarga al hacer clik en el 
//boton par generar nuevo clave
$(".btncapt").click(function(event) {
    CargarCaptcha();
});

CargarCaptcha();
});

/**
 * Realiza la peticion AJAX
 * al servidor para generar clave
 */
 function CargarCaptcha() {
     $.ajax({
        url: '<?php echo base_url(); ?>public/php_captcha/captcha2.php',
        type: 'post',
        dataType: 'text',
        data:{"capt":"visto"}
    })
     .done(function(data) {
   // alert(data);
   var visto=$.parseJSON(data);
    //Dibujamos en el CANVA las claves 
    //devueltas por el servidor
    var canva=document.getElementById("capatcha");
    var dibujar=canva.getContext("2d");
    canva.width = canva.width;
    dibujar.fillStyle="black";
    dibujar.font='20pt "NeoPrint M319"';
    dibujar.fillText(visto.retornar,6,39);
    //console.log(data);
})
     .fail(function() {
    //console.log("error");
})
     .always(function() {
    //console.log("complete");
});
 }  
</script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#form").slideUp();
            $("#recoverform").fadeIn();
        });

        $(document).ready(function(){
        // click on button submit
        $("#submit").on('click', function(){    
            if ($("#usuario").val() == "") {
                $("#usuario").focus();
                return 0;
            }
            if ($("#clave").val() == "") {
                $("#clave").focus();
                return 0;
            }
            // send ajax
            llamarfuncion();
        });
    });
        document.querySelector('#clave').addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
    if (key === 13) { // 13 is enter}
       if ($("#usuario").val() == "") {
        $("#usuario").focus();
        return 0;
    }
    if ($("#clave").val() == "") {
        $("#clave").focus();
        return 0;
    }
    llamarfuncion();
}
});
        document.querySelector('#usuario').addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
    if (key === 13) { // 13 is enter}
       if ($("#usuario").val() == "") {
        $("#usuario").focus();
        return 0;
    }
    if ($("#clave").val() == "") {
        $("#clave").focus();
        return 0;
    }
    llamarfuncion();
}
});
        function llamarfuncion(){ 
            $.ajax({
                url: base_url+'Login/Iniciar', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#form").serialize(), // post data || get data
                success : function(result) {
                 if (result == 0) {
                    $("#mensaje").empty().html('<div class="alert alert-danger"> <i class="ti-user"></i>Lo sentimos el usuario o clave que ingreso es incorrecta<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>');
                    return 0;
                }
                if(result == 2){
                    $("#mensaje").empty().html('<div class="alert alert-warning"> <i class="ti-user"></i>Lo sentimos el usuario está dado de baja<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>');
                    return 0;

                }

                if(result == 3){
                    $("#mensaje").empty().html('<div class="alert alert-danger"> <i class="ti-user"></i>Lo sentimos el captchar es incorrecto<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>');
                    return 0;

                }
                if (result == 1) {
                   location.href = base_url+"Login";
               }
           },
           error: function(xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    })
        }

    </script>
    
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/admin-pro/main/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jan 2019 22:31:11 GMT -->
</html>