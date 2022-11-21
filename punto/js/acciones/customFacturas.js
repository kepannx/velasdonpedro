 $(document).ready(function() {
 	$.ajax({
 		url: '../../data/ajax/acciones/getInfoFactura.php',
 		type: 'POST',
 		dataType: 'JSON',
 		data: {idFactura: ''+idFactura.value+''},
 	})
 	.done(function(datos) {//Reparto los datos
 		//Get Datos Factura
 		$('#nroFactura').html(datos.nroFactura);
 		$('#fechaFactura').html(datos.fechaFactura);
 		$('#estadoFactura').html(datos.estadoFactura);
 		$('#tipoPago').html(datos.tipoPago);
 		$('#total').html('$ '+formatDecilames(datos.valorTotalFactura));
 		$('#deuda').html('$ '+formatDecilames(datos.deudaFactura));
    $('#vendedor').html(datos.codigoVendedor);

	if (datos.nroFactura!=null){
	 	$.ajax({
	 		url: '../../data/ajax/acciones/getInfoCliente.php',
	 		type: 'POST',
	 		dataType: 'JSON',
	 		data: {idCliente: ''+datos.idCliente+''},
	 	})
	 	.done(function(datosCliente) {
	 		$('#nombreCliente').html(datosCliente.nombreCliente);
	 		$('#identificacionCliente').html(datosCliente.identificacionCliente);
	 		$('#direccionCliente').html(datosCliente.direccionCliente);
	 		$('#ciudadCliente').html(datosCliente.ciudadCliente);
	 		$('#telefonosCliente').html(datosCliente.telefonosCliente);
	 		$('#emailCliente').html(datosCliente.emailCliente);
	 	});



	 	//Listado de los tipos de pago que se hizo en esa factura
	 	$.post('../../data/ajax/acciones/listaItemsFactura.php', {idFactura: ''+datos.idFactura+'' }, function(datosTabla) {
   			 $('#listaProductosFacturados').html(datosTabla);
  		});

	 	$.post('../../data/ajax/acciones/getInfoMetodosPagoFactura.php', {idFactura: ''+datos.idFactura+'' }, function(datosTabla) {
   			 $('#tipoPago').html(datosTabla);
  		});
  		//

	 }else{//No reconosco factura
	 	 window.history.back();
	 }
 		//Fin Datos Cliente
 	


 	})//Fin del reparto de datos

 });

  $('#imprimir').click(function(e) {
    e.preventDefault();  
    window.open('../../print/formatos/billRoll.php?printData='+idFactura.value,'_blank');
    });




//anulación de la factura
$("#anularFactura").click(function(){



	 swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres anular esta factura?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! ANULALA ",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {

                          //inicio
                          $.ajax({
                 url: '../../data/ajax/insercionDatos/anulacionFactura.php',
                  type: 'POST',
                  dataType: 'JSON',
                  data: { idFactura : ''+idFactura.value+'', justificarAnulacion : ''+justificarAnulacion.value+''},
                  
                  //abono

                })

                .done(function(data) { //
                  
                setTimeout(function() {
                var win = window.open('../../print/formatos/formatoEgresos.php?printData='+data.Registrado+'', '_blank');
                win.focus();}, 1000);

                 })
                .fail(function() {
                  swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
                })
                .always(function() {
                   egreso.valorEgresoGasto.value = '';
                   egreso.descripcion.value = ''; 
                   
                });

                


                          //Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });

});

// fin de la anulacion de la factura



document.getElementById('guardarDato').addEventListener('click', function(){
       guardarEgresos();

    
  });





function formatDecilames(input){
var num = input;
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}
