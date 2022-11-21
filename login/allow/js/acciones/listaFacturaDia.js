 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaFacturaVentasDia.php', {id: ''+id.value+'', 
 				fecha : ''+fecha.value+'' }, function(datosTabla) {
    $('#listaFacturas').html(datosTabla);
  });
  });






 $('#checkReporte').click(function(event) {
 	/* Act on the event */
 	console.log(fecha1.value+" "+fecha2.value);

 	$.post('../../data/ajax/acciones/listaReporteVentas.php', { id: ''+id.value+'', 
 				fecha1 : ''+fecha1.value+'',
 				fecha2 : ''+fecha2.value+''}, function(datosTabla) {
    $('#listaPuntosVenta').html(datosTabla);
  });
 });