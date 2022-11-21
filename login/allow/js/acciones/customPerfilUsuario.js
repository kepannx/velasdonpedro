
$(document).ready(function() {
 	 $('.input-daterange-datepicker').daterangepicker({
          buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
        });
 	  (function() {
                [].slice.call( document.querySelectorAll('.sttabs') ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
		});


$.post('../../data/ajax/acciones/listaComisionesRango.php', {   }, function(datosTabla) {
    $('#listaHistoricoFacturas').html(datosTabla);
  });


$('#rangoFacturas').change(function(event) {
	$.post('../../data/ajax/acciones/listaComisionesRango.php', {  fecha : ''+ $('#rangoFacturas')[0].value+ '' }, function(datosTabla) {
			    $('#listaHistoricoFacturas').html((datosTabla));
			  });
});