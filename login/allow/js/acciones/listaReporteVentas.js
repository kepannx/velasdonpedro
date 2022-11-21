 $('#checkReporte').click(function(event) {
 	/* Act on the event */

 	$.post('../../data/ajax/acciones/listaReporteVentas.php', { id: ''+id.value+'', 
 				fecha1 : ''+fecha1.value+'',
 				fecha2 : ''+fecha2.value+''}, function(datosTabla) {
    $('#listaPuntosVenta').html(datosTabla);
  });
 });