 $(document).ready(function() {
  $.post('../../data/ajax/acciones/inventarioEnMinimosPunto.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#inventarioEnMinimos').html(datosTabla);
  });
  });