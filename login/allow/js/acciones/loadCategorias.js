 //Activa la subcategoria
$(function(){
  $('#tipo').change(function(){

    console.log($(this).val());
  	//console.log(x: number);
  	$.ajax({
  		url: '../../data/ajax/acciones/loadSelectCategorias.php',
  		type: 'POST',
  		dataType: 'HTML',
  		data: {tipo: ''+$(this).val()+'',  id : ''+id.value+''},
  	})
  	.done(function(dato) {
  		$('#cargarSubCategorias').html(dato)
  	})

    $('#name').html($('#tipo').val());

  });

});