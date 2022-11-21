 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaDocumentosPuntosVenta.php', {}, function(datosTabla) {
    $('#listaDocumentosPuntoVenta').html(datosTabla);
  });
  });


