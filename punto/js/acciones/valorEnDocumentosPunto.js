 $(document).ready(function() {
  $.post('../../data/ajax/acciones/valorEnTransaccionesNoEfectivoPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#valorDocumentosPunto').html(datosTabla);
  });
  });