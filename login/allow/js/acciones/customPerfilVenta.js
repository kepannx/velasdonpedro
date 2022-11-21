
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

		$.ajax({
			url: '../../data/ajax/acciones/checkDatosPuntoVenta.php',
			type: 'POST',
			dataType: 'JSON',
			data: {},
		})
		.done(function(data) {
			$('#nombrePuntoVenta').html(data.nombrePunto);
			
		})

      jQuery('.fechaFiltro, #datepicker').datepicker();



/*LISTA DE LAS FACTURAS DEL DIA*/


if (typeof(typeof($('fechas').value==undefined))) {
$.post('../../data/ajax/acciones/listaFacturasDia.php', {   }, function(datosTabla) {
    $('#listaFacturasDia').html(datosTabla);
  });

};
/*FIN DE LA LISTA DE LAS FACTURAS DEL DIA*/
$('#fechas').on('change', function() {
	$.post('../../data/ajax/acciones/listaFacturasDia.php', {  fecha : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
    $('#listaFacturasDia').html(datosTabla);
  });
});


/*LISTA DE LOS EGRESOS */

if (typeof(typeof($('fechas').value==undefined))) {

$.post('../../data/ajax/acciones/listaEgresosGastos.php', {   }, function(datosTabla) {
    $('#listaGastosDia').html(datosTabla);
  });

};

$('#fechas').on('change', function() {
	$.post('../../data/ajax/acciones/listaEgresosGastos.php', {  fechaGastos : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
        $('#listaGastosDia').html(datosTabla);
  });
});





/*FIN EGRESOS */


	//*movimientos diarios
		if (typeof(typeof($('fechas').value==undefined))) {
			$.post('../../data/ajax/acciones/calculoValorEfectivo.php', { }, function(datosTabla) {
			 		var totalEfectivo=datosTabla;
			    $('#totalEfectivo').html(totalEfectivo);
			  });

			$.post('../../data/ajax/acciones/calculoValorTransacciones.php', { }, function(datosTabla) {
			 		var totalTransacciones=datosTabla;
			    $('#totalTransacciones').html(totalTransacciones);
			  });


			$.post('../../data/ajax/acciones/calculoValorEgresos.php', { }, function(datosTabla) {
			 		var totalTransacciones=datosTabla;
			    $('#totalEgresos').html(totalTransacciones);
			  });



			$.post('../../data/ajax/acciones/calculoCuentasPorCobrar.php', { }, function(datosTabla) {
			 		$('#cxc').html(datosTabla);
			  });

			//Calculo El Gran Total
			$.post('../../data/ajax/acciones/calculoValorGranTotal.php', { }, function(datosTabla) {
			 		$('#granTotal').html(datosTabla);
			  });

/*
			$.post('../../data/ajax/acciones/movimientosTransaccion.php', { }, function(datosTabla) {
			 		var totalEfectivo=datosTabla;
			    $('#listaTransacciones').html(totalEfectivo);
			  });*/
		}


			$('#fechas').on('change', function() {
			
			$.post('../../data/ajax/acciones/calculoValorEfectivo.php', {  fechaGastos : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
        	$('#totalEfectivo').html(datosTabla);
  			});


  			$.post('../../data/ajax/acciones/calculoValorTransacciones.php', {  fechaTransaccion : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
        	$('#totalTransacciones').html(datosTabla);
  			});

  			$.post('../../data/ajax/acciones/calculoValorEgresos.php', {fechaEgreso : ''+$('#fechas')[0].value+''  }, function(datosTabla) {
			 		var totalEgresos=datosTabla;
			    $('#totalEgresos').html(totalEgresos);
			  });

  			$.post('../../data/ajax/acciones/calculoCuentasPorCobrar.php', {  fechaCuentasXcobrar : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
        	$('#cxc').html(datosTabla);
  			});


  			$.post('../../data/ajax/acciones/calculoValorGranTotal.php', {  fecha : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
        	$('#granTotal').html(datosTabla);
  			});


  			


		});
		
});



$('#movimientosDeTransacciones').on('click', function() {
	$.post('../../data/ajax/acciones/movimientosTransaccion.php', { fechaTransacciones : ''+$('#fechas')[0].value+''  }, function(datosTabla) {
			 		var totalEfectivo=datosTabla;
			    $('#listaTransacciones').html(totalEfectivo);
			  });
});



//SACO TODAS LAS FACTURAS QUE SE HAN HECHO DEL PUNTO DE VENTA EN EL RÁNGO DE FECHA QUE LE INDIQUE EL USUARIO

$.post('../../data/ajax/acciones/listaFacturasRango.php', {  fecha : ''+$('#fechas')[0].value+'' }, function(datosTabla) {
    $('#listaHistoricoFacturas').html(datosTabla);
  });
$('#rangoFacturas').change(function(event) {
	$.post('../../data/ajax/acciones/listaFacturasRango.php', {  fecha : ''+ $('#rangoFacturas')[0].value+ '' }, function(datosTabla) {
			    $('#listaHistoricoFacturas').html((datosTabla));
			  });
});



$('#tbLista').on('click', function() {

	$.post('../../data/ajax/acciones/listaProductosPuntoVenta.php', { }, function(datosTabla) {
    		$('#listaHistoricoFacturas').html(datosTabla);
  		});

})






/*==========================================================
=            HISTORIAL DE TRASLADOS DE UN PUNTO            =
==========================================================*/

$.post('../../data/ajax/acciones/listaTrasladoRango.php', {  fechaTraslado : ''+$('#fechas')[0].value+'' }, function(datosTablaTraslados) {
    $('#listaHistoricoTraslados').html(datosTablaTraslados);
  });
$('#rangoFechaTraslados').change(function(event) {

	console.log($('#rangoFechaTraslados')[0].value);
	$.post('../../data/ajax/acciones/listaTrasladoRango.php', {  fechaTraslado : ''+ $('#rangoFechaTraslados')[0].value+ '' }, function(datosTablaTraslados) {
			    $('#listaHistoricoTraslados').html((datosTablaTraslados));
			  });
});



/*=====  End of HISTORIAL DE TRASLADOS DE UN PUNTO  ======*/





$('#listaFacturasDia').slimScroll({
            height: '400px',
        });
        $('#listaGastosDia').slimScroll({
            height: '400px'
        });




//Formateo en decimales
function formatDecilames(input){
	var num = input;
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
	num = num.split('').reverse().join('').replace(/^[\.]/,'');
	return num;
}//fin del formato en decimales


