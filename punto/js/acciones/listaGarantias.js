 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaGarantias.php', {}, function(datosTabla) {
    $('#listaGarantias').html(datosTabla);
  });
  });