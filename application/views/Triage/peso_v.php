
<div id="caja_canvas_imc" style="width:90%;display: block;" >
              <canvas id="chart-2" style="height: 350px;"></canvas>
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
        chartData.datasets.forEach(function(dataset) {
          dataset.data.push(obj['peso'][i]);
        });
      }
       
      for ( var i = 0; i < obj['fecha'].length; i++) {
       chartData.labels.push(obj['fecha'][i]);
       
     }
     window.myMixedChart.update(); 
     $('#caja_canvas').css('display','block');
     $('#caja_canvas_imc').css('display','block');
   }else{
    $('#caja_canvas').css('display','none');
    $('#caja_canvas_imc').css('display','none');
  }

} );
 });

  var color = Chart.helpers.color;
  var chartData = {
    labels: [],
    datasets: [{
      type: 'line',
      label: '',
      borderColor: window.chartColors.blue,
      borderWidth: 2,
      fill: false,
      data: [ ]
    }, {
      type: 'bar',
      label: '',
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),

      data: [ ],
      borderColor: window.chartColors.red,
      borderWidth: 1
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
          text: 'Peso'
        },
        tooltips: {
          mode: 'index',
          intersect: true
        }
      }
    })
  }
  




  </script>