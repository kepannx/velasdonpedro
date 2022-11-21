 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaComprasProducto.php', {}, function(datosTabla) {
    $('#listaComprasProducto').html(datosTabla);
  });
  });