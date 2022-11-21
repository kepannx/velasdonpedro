
 //Listo los seriales e imeis de un producto en especifico
 $.post('data/ajax/acciones/disponibleEfectivoAllPuntos.php', { }, function(datosTabla) {
     $('#disponibilidadEfectivo').html(datosTabla);
   });


//Listo los seriales e imeis de un producto en especifico
 $.post('data/ajax/acciones/listaFacturasTodosLosPuntos.php', { }, function(datosTabla) {
     $('#listaFacturasTodosLosPuntos').html(datosTabla);
   });

  $('#creditosDia').on('click',  function(event) {
  	 /* Act on the event */
  	  $.post('data/ajax/acciones/listaFacturasPorPagarDia.php', { }, function(datos) {
     		$('#listaFacturasTodosLosPuntos').html(datos);
   		});


  });