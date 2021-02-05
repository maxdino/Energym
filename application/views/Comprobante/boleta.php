
<html>
<head>
  <meta charset="utf8">
  <title>Estilos de impresión</title>
  <style type="text/css">
            /*body{
   margin: 5px 0px 0px 50px;
   font: 10pt 'Lucida Console';
   color: #000000;
   background-color: #ffffff;
   width: 320px;
   line-height: 3px;
}
#titulo {
    width: 280px;
    font-weight: bold;
    text-align: center;
}
#ruc-serie {
    font-weight: bold;
}
#cabecera {
    font-weight: bold;
    text-decoration: underline;
}
#totales{
    width: 280px;
    text-align: right;
}

@page{
   margin: 0;
   }*/

   *{
    margin:0px 0;
  }
  body{
    margin: 0px 0px 0px 0px;
    font: 9pt 'Lucida Console';
    color: #000000;
    background-color: #ffffff;
    width: 280px;

  }
  #titulo {
    font-weight: bold;
    text-align: center;
  }
  #ruc-serie {
    font-weight: bold;
  }
  #cabecera {
    font-weight: bold;
    text-decoration: underline;
    width: 100%;

  }
  #totales{

    text-align: right;
    margin-right: 16px;
  }
  #body{
    /*border-bottom:1px dashed black;*/
  }

  @page{
    margin: 0;
  }
  .title {
    /*font-weight: bold;*/
    text-align: center;
  }
</style>
<script src="<?php echo base_url();?>public/assets/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    var imprimir=$("#imprimir").val();
    if(imprimir=='S')
    {

     setTimeout(function()
     {
       window.print();
       window.close();
     }, 1000);
   }else
   {
    window.close();
  }
               // window.print();
             });
           </script>
         </head>

         <body>

          <input type="hidden" id="imprimir" name="imprimir" value="S"/>
          <div id="contenedor">
            <div id="titulo">
              <center><img width="160px" height="130px" src="<?php echo base_url() ?>public/assets/images/ener2.jpg   "></center>
              <br><br>
              <p><?php   echo strtoupper('ENERGYM '); ?></p>
              <p></p>
              <p><?php echo 'Jr. Orellana 796'; ?></p>
              <p>RUC: <?php echo '10710879642'; ?></p>
              <p>SEDE: <?php echo "Tarapoto";?></p>
              <p><?php echo 'Jr. Orellana 796'; ?></p>


            </div>

            <br/>
            <div id="datos">

              <?php
              $tipo=$venta[0]["tipo_comprobante"];
              $estado_pago =1;
              $mostra="0";
              if ($estado_pago == 2) {
                $mostra="NOTA DE CREDITO: ".$venta[0]["venta_serie_eliminado"]."-".$venta[0]["venta_correlativo_eliminado"];
              }else{
                if($tipo==0){
                  $mostra="SIN COMPROBANTE";
                }else{
                  if ($tipo==2) {
                    $mostra="FACTURA ELECTRONICA: F".$venta[0]["serie"]."-".$venta[0]["nro_comprobante"];
                  }
                  if($tipo==1){
                    $mostra="BOLETA ELECTRONICA: B".$venta[0]["serie"]."-".$venta[0]["nro_comprobante"];
                  }
                  if($tipo==3 || $tipo == 4){
                    $mostra="TICKET: T".$venta[0]["serie"]."-".$venta[0]["nro_comprobante"];
                  }
                }
              }



              ?>
              <p>&nbsp;&nbsp;<?php echo $mostra; ?></p>
              <p>&nbsp;&nbsp;SERIE: FFCF287063</p>
              <p>&nbsp;&nbsp;AUTORIZACION: 0183845134239</p>
              <p style="border-top:1px solid #000;"></p><br>
              <p>&nbsp;&nbsp;CLIENTE: <?php echo $cliente[0]["cliente_nombre_completo"]; ?></p>


              <?php if(strlen($cliente[0]["cliente_documento_numero"])==8){ ?>
                <p>&nbsp;&nbsp;DNI: <?php echo $cliente[0]["cliente_documento_numero"]; ?></p>
              <?php } ?>

              <?php if(strlen($cliente[0]["cliente_documento_numero"])==11){ ?>
                <p>&nbsp;&nbsp;RUC: <?php echo $cliente[0]["cliente_documento_numero"]; ?></p>
              <?php } ?> 


              <p>&nbsp;&nbsp;DIRECCION:<?php echo $cliente[0]["cliente_direccion"]; ?></p>
              <p>&nbsp;&nbsp;TELEFONO: <?php echo $cliente[0]["cliente_telefono"]; ?></p>


            </div>
            <br/>
            <div id="ruc-serie">
              <p>&nbsp;&nbsp;DESCRIPCION</p>
            </div>
            <div id="cabecera" style="border-bottom:1px solid #000;text-decoration: none;">
              <p>&nbsp;&nbsp;CANT &nbsp;&nbsp;&nbsp;&nbsp;U.M. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UNIT.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</p>
            </div>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <div id="datos">
              <?php  
              $c=1;
              $total_venta=0;
              $arti=0;

              if($venta[0]["venta_estado_consumo"]==0)
              {

                foreach($detalle_venta as $value){
                  
                 $total=$value["cantidad"]*$value["precio"];
                 $total_venta+=$total;
                 $arti++;
                 ?>   
                 <?php  if ($tipo_venta==1) {  ?>
                  <p>&nbsp;&nbsp;<?php echo $c."-".$value["producto_descripcion"] ?></p>
                  <p>&nbsp;&nbsp;<?php echo $value["cantidad"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UND &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($value["precio"], 2, ',', ' '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($total, 2, ',', ' '); ?>&nbsp;</p>
                  <?php $c=$c+1;  ?>  
                <?php } ?>

                <?php  if ( $tipo_venta==2) {  ?>
                  <p>&nbsp;&nbsp;<?php echo $c."-".$value["tipo_membresia_descripcion"] ?></p>
                  <p>&nbsp;&nbsp;<?php echo $value["cantidad"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UND &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($value["precio"], 2, ',', ' '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($total, 2, ',', ' '); ?>&nbsp;</p>
                  <?php $c=$c+1;  ?>  
                <?php } ?>
                <?php  if ( $tipo_venta==3) {  ?>
                  <p>&nbsp;&nbsp;<?php echo $c."- MATRICULA " ?></p>
                  <p>&nbsp;&nbsp;<?php echo $value["cantidad"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UND &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($value["precio"], 2, ',', ' '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($total, 2, ',', ' '); ?>&nbsp;</p>
                  <?php $c=$c+1;  ?>  
                <?php } ?>

              <?php } ?>


            <?php }else  { ?>

              <p>POR CONSUMO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($venta[0]["total"], 2, ',', ' ');?></p>

            <?php }

            ?>           





          </div>
          <div id="cabecera" style="border-bottom:1px solid #000;text-decoration: none;">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </div>
          <br/>
          <div id="totales" style="margin-right: 3px;">
            <p style="float:left;width: 65%;">SUB TOTAL</p>
            <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
            <p style="float:left;width: 20%;"><?php echo number_format($venta[0]["total"], 2, ',', ' '); ?></p>
            <p style="clear: both"></p>
            <p style="float:left;width: 65%;">DESCUENTO</p>
            <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
            <p style="float:left;width: 20%;">0.00</p>
            <p style="clear: both"></p>
            <p style="float:left;width: 65%;">IGV </p>
            <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
            <p style="float:left;width: 20%;"><?php echo number_format(0, 2, ',', ' '); ?></p>
            <p style="clear: both"></p>
            <p style="float:left;width: 65%;">**** TOTAL</p>
            <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
            <p style="float:left;width: 20%;"><?php echo number_format($venta[0]["total"], 2, ',', ' '); ?></p>
            <p style="clear: both"></p>
          </div>
          <br>
          <?php 
          $tan="";
          $tam=strlen($flotante);
          if($tam==1){
           $tan="0".$flotante."/100  SOLES"; 
         }else{
          $tan=$flotante."/100  SOLES"; 

        }




        ?>

        <p style="width: 100%;border-top: 1px solid #000;padding: .6em 0 .6em 0;text-align: left">
          &nbsp;SON: <?php echo $letras." con ".$tan ?>    
        </p>
        <p style="width: 100%;border-top: 1px solid #000;"></p>
        <div id="totales" style="margin-right: 3px;">
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          <p style="float:left;width: 65%;">**** EFECTIVO</p>
          <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
          <p style="float:left;width: 20%;"><?php echo number_format($venta[0]["monto_entregado"], 2, '.', ''); 
          $vuelto=0;
          $vuelto=abs($total_venta-$venta[0]["monto_entregado"]);

          ?> </p>
          <p style="clear: both"></p>
          <p style="float:left;width: 65%;">**** VUELTO</p>
          <p style="float:left;width: 11%;">&nbsp;&nbsp;S/&nbsp;</p>
          <p style="float:left;width: 20%;"><?php  echo number_format( $vuelto, 2, '.', '');   ?></p>
          <p style="clear: both"></p>
        </div>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <div  id="datos">
          <?php
          $fecha_pedido = explode(" ", $venta[0]["fecha"]);
          $fecha_venta = explode(" ", $venta[0]["fecha"]);

          $fecha2 = date_create($fecha_venta[0]);

          $tiemponuevo1=date_format($fecha2, 'd/m/Y');
          

          ?>
          <p>&nbsp;&nbsp;NUM. TOTAL ART. VENDIDOS = <?php echo $arti; ?></p>
          <!--  <p>IGV (0.0%):&nbsp;&nbsp;S/ 0.00</p>-->
          <p>&nbsp;&nbsp;FECHA: <?php echo $tiemponuevo1;?>&nbsp;&nbsp; HORA: <?php echo $fecha_venta[0];  ?></p>
          <p>&nbsp;&nbsp;HORA DE PEDIDO: <?php echo $fecha_pedido[0]?></p>
          <p>&nbsp;&nbsp;VENDEDOR:<?php echo $vendedor[0]["empleado_nombres"]; ?></p>
          <?php
          $nombre="";





          ?> 
        </div>
      </div>
      <center id="">
        <!-- <img  style="display:none;margin-left: 45px;width: 150px;height: 150px;" src="<?php echo base_url(); ?>public/qr/qr_<?php echo $id?>.png" > -->
      </center>
    </body>
    </html>
