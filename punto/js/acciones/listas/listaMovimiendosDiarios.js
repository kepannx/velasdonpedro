 $(document).ready(function() {
 	fechas = fechaFiltro.value.split('-');
  $.post('../../data/ajax/acciones/listaMovimiendosDiarios.php', { fecha1 :  fechas[0], fecha2 :  fechas[1] /*PARAMETROS DE FECHA */ }, function(datosTabla) {
    $('#listaFacturasDia').html(datosTabla);
  });

  });