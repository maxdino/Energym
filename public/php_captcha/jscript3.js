jQuery(document).ready(function($) {
	

$(".btncapt").click(function(event) {
document.location.reload();
});

$("#IngresoLog").click(function(event) {
      //event.preventDefault();
      $.ajax({
      	url: 'VerifCaptha.php',
      	type: 'POST',
      	dataType: 'text',
      	data: {"valor": $("#valorCapt").val()},
      })
      .done(function(data) {
       alert(data);
      })
      .fail(function() {
      	//console.log("error");
      })
      .always(function() {
      	//console.log("complete");
      });
  });
});