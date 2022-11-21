;
  $.post('../../data/ajax/acciones/listaPuntosVenta.php', {  }, function(datosTabla) {
    $('#listaPuntosVenta').html(datosTabla);
  });
