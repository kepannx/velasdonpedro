$('.input-daterange-datepicker').daterangepicker({
          buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
        });
 $(document).ready(function() {
  fechas = fechaFiltro.value.split('-');
  $.post('../../data/ajax/acciones/listaMovimiendosDiarios.php', {  fecha1 : ''+fechas[0]+'', fecha2 : null }, function(datosTabla) {
        $('#listaFacturasDia').html(datosTabla);
      });

  });

document.getElementById('filtrar').addEventListener('click', function(){
fechas = fechaFiltro.value.split('-');
  
     $.post('../../data/ajax/acciones/listaMovimiendosDiarios.php', { fecha1 : ''+fechas[0]+'', fecha2 : ''+fechas[1]+'' }, function(datosTabla) {
        $('#listaFacturasDia').html(datosTabla);
    	$('#fechaFactura').html(fechas[0]+' Al '+fechas[1]);
  });
   
})
      

