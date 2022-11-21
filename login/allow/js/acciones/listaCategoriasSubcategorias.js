 $(document).ready(function() {
  $.post('../../data/ajax/acciones/listaCategoriasSubCategorias.php', {id: ''+id.value+'' }, function(datosTabla) {
    $('#listaCategorias').html(datosTabla);
  });
  });