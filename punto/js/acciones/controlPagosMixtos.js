<script>
$(document).ready(function() {
//Si selecciona tarjeta de crédito
$( "#pagoTarjetaCredito" ).on( "click", function() {
  if ($( "input:checked" ).val()=='on') {
  	$('#mixtodebitoCredito').html('pago con tarjetas');
  }
  else{
  	$('#mixtodebitoCredito').html('');
  }
});

//Si selecciona tarjeta debito
$( "#pagoTarjetaDebito" ).on( "click", function() {
  if ($( "input:checked" ).val()=='on') {
  	$('#mixtodebitoCredito').html('pago con tarjetas');
  }
  else{
  	$('#mixtodebitoCredito').html('');
  }
});


//Si selecciona tarjeta debito
$( "#pagoCheque" ).on( "click", function() {
  if ($( "input:checked" ).val()=='on') {
  	$('#mixtoCheque').html('pago con cheque');
  }
  else{
  	$('#mixtoCheque').html('');
  }
});


//Si selecciona tarjeta debito
$( "#pagoEfectivo" ).on( "click", function() {
  if ($( "input:checked" ).val()=='on') {
  	$('#mixtoCheque').html('');
  }
  
  
});




});
</script>