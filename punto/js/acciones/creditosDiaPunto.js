 $(document).ready(function() {
  $.post('../../data/ajax/acciones/creditosDiaPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#creditosDiaPunto').html(datosTabla);
  });
  });