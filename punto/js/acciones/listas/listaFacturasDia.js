 $(document).ready(function() {
 if (typeof(fechas)==='undefined') {
 	 $.post('../../data/ajax/acciones/listaFacturasDia.php', { /*fecha1 : ''+fecha1+'', fecha2 : ''+fecha2+''*/ }, function(datosTabla) {
    $('#listaFacturasDia').html(datosTabla);
  });
 }else{
 	 $.post('../../data/ajax/acciones/listaFacturasDia.php', {  fecha : ''+fechas.value+'' }, function(datosTabla) {
    	$('#listaFacturasDia').html(datosTabla);
  	});

 }


 });

