 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaVentasPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#ventadDiaPunto').html(datosTabla);
  });
  });