 $(document).ready(function() {
  $.post('../../data/ajax/acciones/valorEnEfectivoPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#efectivoEnPunto').html(datosTabla);
  });
  });