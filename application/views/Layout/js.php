    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>public/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url();?>public/js/perfect-scrollbar.jquery.min.js"></script>
    
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>public/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>public/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url();?>public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url();?>public/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>public/js/custom.min.js"></script>
     <script src="<?php echo base_url();?>public/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>public/assets/plugins/icheck/icheck.min.js"></script>


    <script src="<?php echo base_url();?>public/assets/plugins/icheck/icheck.init.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.validate.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url();?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url();?>public/assets/plugins/datatables/datatables.min.js"></script> 
    <script src="<?php echo base_url();?>public/assets/plugins/toast-master/js/jquery.toast.js"></script>
    <script src="<?php echo base_url();?>public/js/toastr.js"></script>
    <script src="<?php echo base_url();?>public/assets/plugins/moment/moment.js"></script>
    <script src="<?php echo base_url();?>public/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

 
 <script type="text/javascript">
    
     $(function() {
        $('#myTable').DataTable();
        $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
        $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
        $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
    function sololetras(e){
      key= e.keyCode || e.which;
      teclado=String.fromCharCode(key).toLowerCase();
      letras=" abcdefghijklmnñopqrstuvwxyz";
      especiales="8-37-38-46-164";
      teclado_especial=false;
      for(var i in especiales){
        if(key==especiales[i]){
          teclado_especial= true;
          break;
        }
      }
      if (letras.indexOf(teclado)==-1 && !teclado_especial){

        return false;

      }
    }


    function solonumeros(e){
      key=e.keyCode || e.which;
      teclado=String.fromCharCode(key);
      numeros=" 0123456789";
      especiales="8-37-38-46";
      teclado_especial=false;

      for(var i in especiales){
        if(key==especiales[i]){
          teclado_especial=true;
        }
      }
      if(numeros.indexOf(teclado)==-1 && !teclado_especial){
        return false;
      }
    }
      function alertasuccess(mensaje,titulo){ 
           $.toast({
            heading: mensaje,
            text: titulo,
            position: 'bottom-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
           return false;
     }

      function alertainfo(mensaje,titulo){
           $.toast({
            heading: mensaje,
            text: titulo,
            position: 'bottom-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500
            
          });

     }
 </script>