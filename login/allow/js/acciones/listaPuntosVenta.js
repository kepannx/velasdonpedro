 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaPuntosVenta.php', {id: ''+id.value+''  }, function(datosTabla) {
    $('#listaPuntosVenta').html(datosTabla);
  });
  });