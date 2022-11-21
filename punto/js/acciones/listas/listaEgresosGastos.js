$(document).ready(function() {
 	if (typeof(fechas)==='undefined') {
 	$.post('../../data/ajax/acciones/listaEgresosGastos.php', {  /*PARAMETROS DE FECHA */ }, function(datosTabla) {
    $('#listaGastosDia').html(datosTabla);
  });
 	}else{
  	$.post('../../data/ajax/acciones/listaEgresosGastos.php', {   fecha : ''+fechas.value+''  }, function(datosTabla) {
    $('#listaGastosDia').html(datosTabla);
  });
 	}
  });