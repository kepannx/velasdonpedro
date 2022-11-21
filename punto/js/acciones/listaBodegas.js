 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listadoBodegas.php', {}, function(datosTabla) {
    $('#listadoBodegas').html(datosTabla);
  });
  });


