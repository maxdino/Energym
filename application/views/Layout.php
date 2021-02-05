        <?php 
        $ver="";
        if($data["datos_usuario"][0]["empleado_foto_perfil"]==""){
            $ver="icono_perfil.png";
        }else{
            $ver=$data["datos_usuario"][0]["empleado_foto_perfil"];
        }?>
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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>public/assets/images/favicon.png">
    <title>Energym</title>
    <!-- Bootstrap Core CSS -->
    <?php include("Layout/css.php"); ?>

</head>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<body class="fix-header card-no-border fix-sidebar">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Energym</p>
        </div>
    </div>

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url();?>public/assets/images/ener8.png" style="    width: 50px;" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url();?>public/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url();?>public/assets/images/ener9.jpg" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url();?>public/assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down"></li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="foto_perfilupdate" src="<?php echo base_url().'public/assets/images/foto_perfil/'.$data["datos_usuario"][0]["empleado_foto"] ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img class="foto_perfilupdate" src="<?php echo base_url().'public/assets/images/foto_perfil/'.$data["datos_usuario"][0]["empleado_foto"] ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $data["datos_usuario"][0]["empleado_nombres"]?></h4>
                                                <p class="text-muted"><?php echo $data["datos_usuario"][0]["empleado_email"]?></p><a href="<?php echo base_url()?>Editarusuario" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url()?>Login/cerrar_session"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img class="foto_perfilupdate" src="<?php echo base_url().'public/assets/images/foto_perfil/'.$data["datos_usuario"][0]["empleado_foto"] ?>" alt="user" /><span class="hide-menu"><?php echo $data["datos_usuario"][0]["empleado_nombres"]?> </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url()?>Editarusuario">Mi perfil </a></li>
                                <li><a href="<?php echo base_url()?>Login/cerrar_session">Cerrar Sesión</a></li>
                            </ul>
                        </li>

                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">PERSONAL</li>
                        <?php foreach ($modulos as $value) {  
                            if(count($value["lista"])>0){ ?>
                        
                        <li> <a id="padre_id_<?php echo $value['modulo_id']?>" data-target="#cuerpo_<?php echo ($value["modulo_id"])?>" class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="<?php echo strtolower($value["modulo_icono"])?>"></i><span class="hide-menu"><?php echo ($value["modulo_nombre"])?> </span></a>
                            <ul id="cuerpo_<?php echo ($value["modulo_id"])?>" aria-expanded="false" class="collapse">
                                <?php foreach ($value["lista"] as $val) { ?>
                                <li><a onclick="mostrar_clase(<?php echo $value['modulo_id']; ?>,<?php echo $val['modulo_id']; ?>)" id="hijo_id_<?php echo $val['modulo_id']?>" href="<?php echo base_url().$val["modulo_url"]?>"><?php echo $val["modulo_nombre"]?></a></li></a></li> 
                                <?php }     ?>  
                            </ul>
                        </li>
                        <?php }else{
                         echo '<li> <a  href="'.base_url().$value["modulo_url"].'" aria-expanded="false"><i class="'.$value["modulo_icono"].'"></i><span class="hide-menu">'.$value["modulo_nombre"].'</span></a></li>';   
                        }}?>
                       
                       
                    </ul>
                </nav>

            </div>

        </aside>
        <div class="page-wrapper">

            <div class="container-fluid"  id="cuerpo_pagina_vista">
        
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?php if(isset($data["titulo_descripcion"])){echo $data["titulo_descripcion"];}else{echo "Panel de Control";} ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Principal</a></li>
                        <li class="breadcrumb-item">Pagina</li>
                        <li class="breadcrumb-item active"><?php if(isset($data["titulo_descripcion"])){echo $data["titulo_descripcion"];}else{echo "Panel de Control";} ?></li>
                    </ol>
                </div>
            </div>
 