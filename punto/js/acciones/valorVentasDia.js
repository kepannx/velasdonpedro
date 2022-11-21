 $(document).ready(function() {
  $.post('../../data/ajax/acciones/valorVentasDiaPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#valorVentasDiaPunto').html(datosTabla);
  });
  });