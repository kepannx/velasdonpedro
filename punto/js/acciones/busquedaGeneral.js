$('#resultadosBusqueda').on('onfocus', function(){e.preventDefault(); $("#resultadosBusqueda").empty();});

$("#consultaBusqueda").keypress(function(e){
  var keycode = (e.keyCode ? e.keyCode : e.which);
  //Enter
  if (keycode==13) {
      $("#busquedaGeneral").modal("show");
      $('#q').val('');
      $.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'categoria', padre : 0}, function(dataCategorias) {
                $('#categoria').html('<option  value="0"> Selecciona una Categoria</option>'+dataCategorias);
              
        });
      $('#categoria').change(function(){
        var padre = $( "#categoria option:selected" ).val();
          $.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'subCategoria', padre : padre }, function(dataCategorias) {
          $('#subCategoria').html('<option value="0">Selecciona</option>'+dataCategorias+'');
           $('#q').val('');
        });
        busqueda($("#q").val(), 1, padre, 0);
      });

      $('#subCategoria').change(function() {
        $('#q').val('');

        busqueda($("#q").val(), 1, $('#categoria').val(), $('#subCategoria').val());
      });

      busqueda($("#consultaBusqueda").val(), 1, 0,0);
  };
  



});




//función de búsqueda
 function busqueda(parametroBusqueda, pagina, categoria,subCategoria) {
  $("#resultadosBusqueda").empty();
  var categoria=parseInt(categoria);
  var subCategoria=parseInt(subCategoria);
  var pagina=parseInt(pagina);

  $.ajax({
        url:''+url.value+'data/ajax/acciones/busquedaGeneral.php?page='+parseInt(pagina)+'&q='+parametroBusqueda+'&categoria='+parseInt(categoria)+'&subCategoria='+parseInt(subCategoria),
         beforeSend: function(objeto){

         $('#resultadosBusqueda').html('<div class="col-md-12" align="center"><img src="../../images/cargando.gif" width = "100px"> Cargando...</div>');
        },
        success:function(data){

          $('#resultadosBusqueda').html(data);
          $('#tablaBusqueda').footable();

        }
      }) 
 }



function loadSearch(page){
  $("#resultadosBusqueda").empty();
  var categoria = $('#categoria').val();
  var subCategoria = $('#subCategoria').val();
  busqueda($("#q").val(), 1, categoria,  subCategoria);
}


  // Row Toggler
  // -----------------------------------------------------------------

  




function loadStores(parametro){
  $.post(url.value+'data/ajax/acciones/getExistenciaPuntos.php', {idProducto: ''+parseInt(parametro)+''}, function(datosPunto) {
      $('#loadStore'+parametro+'').html(datosPunto);
  });
}




