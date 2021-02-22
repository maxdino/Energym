<style type="text/css">
  .select2-container--default .select2-results__option[aria-disabled=true] {
    background-color: #d25454;
    color: black;
  }
  canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
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
            <form id="formulario_venta" method="post" action="<?php echo base_url();?>Triage_c/guardar" name="formulario_venta" >
              <div class="box box-solid">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Matricula Cliente:</label>
                            <select name="matricula" id="matricula" class="form-control" required>
                              <option value="">Seleccione...</option>
                              <?php foreach($data["matricula"] as $matricula): ?> 
                                <option value="<?php echo $matricula["matricula_id"]; ?>"><?php echo $matricula["cliente_nombre_completo"]; ?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4>Peso:</h4>
                      <div class="form-group">
                        <input type="text" name="peso" id="peso" class="solo_medida" onchange="formato_numero('peso')">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4>Biceps:</h4>
                      <div class="form-group">
                        <input type="text" name="biceps" id="biceps" class="solo_medida" onchange="formato_numero('biceps')">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4>IMC:</h4>
                      <div class="form-group">
                        <input type="text" name="imc" id="imc"  class="solo_medida" onchange="formato_numero('imc')">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4>Triceps:</h4>
                      <div class="form-group">
                        <input type="text" name="triceps" id="triceps"  class="solo_medida" onchange="formato_numero('triceps')">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4>Cintura:</h4>
                      <div class="form-group">
                        <input type="text" name="cintura" id="cintura"  class="solo_medida" onchange="formato_numero('cintura')">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">                    

                        <div class="form-group">
                          <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar"  >Guardar</button>
                          <a href="<?php echo base_url();?>Triage_c" class="btn btn-danger">Volver</a>
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

        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
          </section>
          <!-- Main content -->
          <section class="content">
            <!-- Default box -->
            <div id="caja_canvas" style="width:90%; display: none;" >
              <canvas id="canvas"></canvas>
            </div>
            <!--<div id="caja_canvas" style="width:90%;" >
              <canvas id="chart-2" style="height: 350px;"></canvas>
            </div>-->
           
            <!-- /.box -->
          </section>

          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>public/graficos/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>public/graficos/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>public/graficos/utils.js"></script>
<script src="<?php echo base_url(); ?>public/graficos/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
  $( "#matricula" ).change(function() {
   id = $("#matricula").val();
   chartData.datasets.forEach(function(dataset) {
    dataset.data.length=0;
  });
   chartData.labels.length=0;
   window.myMixedChart.update();
   $.post(base_url+"Triage_c/traer_uno",{"id":id},function(data){
    obj = JSON.parse(data);
    if (obj['valida']==1) {
      for (var i = 0;i<obj['peso'].length; i++) {
        chartData.datasets[0].data.push(obj['peso'][i]);
        chartData.datasets[1].data.push(obj['imc'][i]);
        chartData.datasets[2].data.push(obj['cintura'][i]);
        chartData.datasets[3].data.push(obj['biceps'][i]);
        chartData.datasets[4].data.push(obj['triceps'][i]);
      }
 
      for ( var i = 0; i < obj['fecha'].length; i++) {
       chartData.labels.push(obj['fecha'][i]);
     }
     window.myMixedChart.update();
     $('#caja_canvas').css('display','block');
   }else{
    $('#caja_canvas').css('display','none');
  }

} );
 });
 
  var color = Chart.helpers.color;
  var chartData = {
    labels: [],
    datasets: [ {
      type: 'bar',
      label: 'PESO',
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),

      data: [ ],
      borderColor: window.chartColors.red,
      borderWidth: 1
    },{
      type: 'line',
      label: 'IMC',
      borderColor: window.chartColors.blue,
      borderWidth: 2,
      fill: false,
      data: [ ]
    },
    {
      type: 'line',
      label: 'CINTURA',
      borderColor: window.chartColors.green,
      borderWidth: 2,
      fill: false,
      data: [ ]
    }
    ,
    {
      type: 'line',
      label: 'BICEPS',
      borderColor: window.chartColors.purple,
      borderWidth: 2,
      fill: false,
      data: [ ]
    },
    {
      type: 'line',
      label: 'TRICEPS',
      borderColor: window.chartColors.yellow,
      borderWidth: 2,
      fill: false,
      data: [ ]
    }]
  }

  window.onload = function() {
    var ctx1 = document.getElementById('canvas').getContext('2d');
    window.myMixedChart = new Chart(ctx1, {
      type: 'bar',
      data: chartData,
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'TRIAGE'
        },
        tooltips: {
          mode: 'index',
          intersect: true
        }
      }
    })
  }
  
 

   /* window.chartColors = {
      red: 'rgb(51, 54, 58)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(104, 115, 132)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(231,233,237)'
    };*/
    $('.solo_medida').on('input', function () { 
      this.value = this.value.replace(/[^0-9.]/g,'');
    });

    function formato_numero(name){
      formato = $('#'+name).val();
      $('#'+name).val(parseFloat(formato).toFixed(2));
    }

  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#matricula").select2();
    });
  </script>
