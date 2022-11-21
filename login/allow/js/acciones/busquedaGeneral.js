$("#resultadosBusqueda").on("onfocus",function(){e.preventDefault()}),$("#search").click(function(){$.post(url.value+"data/ajax/acciones/busquedaGeneral.php",{consultaBusqueda:""+consultaBusqueda.value},function(u){$("#resultadosBusqueda").html(u)})}),$(document).ready(function(){$("#consultaBusqueda").keypress(function(u){13==(u.keyCode?u.keyCode:u.which)&&($("#busquedaGeneral").modal("show"),$.post(url.value+"data/ajax/acciones/busquedaGeneral.php",{consultaBusqueda:""+consultaBusqueda.value},function(u){$("#resultadosBusqueda").html(u)}))})});


$('#resultadosBusqueda').on("click","#muestraMas", function(e){
                e.preventDefault();
    if (($(this).attr('name').length)>0) {
    	line = $(this).attr('name');
    	$('#'+line+'').css({
    		'display': 'block',
    	});
    };
 });

$("#lista").click(function(){
	$('.target').hide("swing");
});



$('#loader').on("click","#muestraMas", function(e){
                e.preventDefault();
                console.log($(this).attr('name').length);

    if (($(this).attr('name').length)>0) {
        line = $(this).attr('name');
        $('#'+line+'').css({
            'display': 'block',
        });
    };

 });
$("#lista").click(function(){
    $('.target').hide("swing");
});


$('#loader').on("dblclick",".hideme", function(e){
                e.preventDefault();
                console.log($(this).attr('name').length);

    if (($(this).attr('name').length)>0) {
        line = $(this).attr('name');
        $('#'+line+'').css({
            'display': 'none',
        });
    };

 });
$("#lista").click(function(){
    $('.target').hide("swing");
});





function load(pagina){
      var q= $("#q").val();
      var categoria = $("#categoria").val();
      if (typeof($("#subCategoria").val())==undefined) {
        var subCategoria=0;
      }else{
        subCategoria=$("#subCategoria").val();
      }
      $("#loader").fadeIn('slow');




      $.ajax({
        url:''+url.value+'data/ajax/acciones/listaProductos.php?page='+pagina+'&q='+q+'&categoria='+categoria+'&subCategoria='+subCategoria,
         beforeSend: function(objeto){
         $('#loader').html('<div class="col-md-12" align="center"><img src="../../images/cargando.gif" width = "100px"> Cargando...</div>');
        },
        success:function(data){
          $('#loader').html(data);
        }
      }) 
    }






$.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'categoria', padre : 0}, function(dataCategorias) {
                $('#categoria').html('<option> Selecciona una Categoria</option>'+dataCategorias);
              
        });




$('#categoria').change(function(){
  var padre = $( "#categoria option:selected" ).val();
  $.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'subCategoria', padre : padre }, function(dataCategorias) {
    $('#subCategoria').html('<option>Selecciona</option>'+dataCategorias+'');
  });
  load(1);
  });




$('#subCategoria').change(function() {
  load(1);
});





