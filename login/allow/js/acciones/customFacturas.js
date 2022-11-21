 $(document).ready(function() {
 	$.ajax({
 		url: '../../data/ajax/acciones/getInfoFactura.php',
 		type: 'POST',
 		dataType: 'JSON',
 		data: {},
 	})
 	.done(function(datos) {//Reparto los datos
 		//Get Datos Factura
 		$('#nroFactura').html(datos.nroFactura);
 		$('#fechaFactura').html(datos.fechaFactura);
 		$('#estadoFactura').html(datos.estadoFactura);
 		$('#tipoPago').html(datos.tipoPago);
 		$('#total').html('$ '+formatDecilames(datos.valorTotalFactura));
 		$('#deuda').html('$ '+formatDecilames(datos.deudaFactura));
    getDatosPuntoVenta(datos.idPuntoVenta, datos.pertenencia, 'nombrePunto')
    if ((datos.estadoFactura)!='anulada') {
      $('#an').html('<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#justificacionAnulacion"> <i class="fa fa-warning"></i>ANULAR</button>');
    
    }else{
        $('#an').html('<div class="alert alert-danger"> <h4>JUSTIFICACIÓN DE ANULACIÓN</h4>'+datos.justificacionAnulacion+'<div>');
    }

    if ((datos.backup)=='si') { $('#bk').css('display', 'none') }

 		//Get Datos Cliente

	if (datos.nroFactura!=null) {
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
      $('#nombreClienteDeuda').html(datosCliente.nombreCliente);

	 	});
	 	//Listado de los productos que tiene esta factura
	 	$.post('../../data/ajax/acciones/listaItemsFactura.php', { }, function(datosTabla) {
   			 $('#listaProductosFacturados').html(datosTabla);
   		});
    $.post('../../data/ajax/acciones/getInfoMetodosPagoFactura.php', { }, function(datosTabla) {
         $('#tipoPago').html(datosTabla);
      });

   		if (datos.estadoFactura === 'en credito') {//En caso que este en crédito
   				$.post('../../data/ajax/acciones/listaAbonos.php', { }, function(datosTabla) {
   			 	$('#abonos').html(loadBtnAbonos()+' '+datosTabla);

   			 	$('#guardarDato').click(function(e) {
   			 		$.ajax({
   			 			url: '../../data/ajax/insercionDatos/guardarAbonosFacturaCliente.php',
   			 			type: 'POST',
   			 			dataType: 'JSON',
   			 			data: {	
   			 					deuda: ''+datos.deudaFactura+'',
   			 					abono: ''+abono.value+'',
                  metodoPago : ''+metodoPago.value+''
   			 					 },
   			 		})
   			 		.done(function(dataAbonos) {
   			 			$.post('../../data/ajax/acciones/listaAbonos.php', { }, function(datosTabla) {
   			 			$('#abonos').html(loadBtnAbonos()+' '+datosTabla);
              $('#abonoDeCreditos').modal('toggle');
   			 			});
              
              $.post('../../data/ajax/acciones/getInfoFactura.php', { }, function(nuevoDato) {
                          $('#deuda').html('');
                          $('#nuevaDeuda').html(''+(nuevoDato.deudaFactura)+'');
              });
   			 			 window.open('../../print/formatos/formatoAbonoFacturasCliente.php?printData='+dataAbonos.Registrado,'_blank');
   			 		});
   			 		
   			 	});


   		});
   		};
  		//

	 }else{//No reconosco factura
	 	 window.history.back();
	 }
 		//Fin Datos Cliente
 	


 	})//Fin del reparto de datos

 });


function getDatosPuntoVenta(idPunto, idPertenencia, tipo){

  $.ajax({
      url: '../../data/ajax/acciones/getInfoPuntoVenta.php',
      type: 'POST',
      dataType: 'JSON',
      data: {idPuntoVenta: ''+idPunto+''},
    })
    .done(function(datosPunto) {
      if (idPunto != idPertenencia) {
         $('#pertenece').html('<h4>Esta Factura Esta Registrada A '+datosPunto.nombrePunto+' Pero la Venta Pertenece a '+idPertenencia+'</h4>')
      }else if(idPunto == idPertenencia){
         $('#pertenece').html('<h4>Esta Factura Esta Registrada A '+datosPunto.nombrePunto+'</h4>')
      }else{
        $('#pertenece').html('<h4>Esta Factura Esta Registrada A '+datosPunto.nombrePunto+'</h4>')
      }
    });
}



//ANULACIÓN DE LA FACTURA
$('#anularFactura').click(function(e) {
   if (($("#justificarAnulacion").val().length)<=5) {
       swal("Error", "Ops! Necesito que seas mas explicito en el por qué vas a anularla", "error");
   }else{
        $.ajax({
          url: '../../data/ajax/edicionDatos/anulacionFacturas.php',
          type: 'POST',
          dataType: 'JSON',
          data: { justificarAnulacion : ''+ $('#justificarAnulacion').val()+''},
      })
      .done(function() {
          swal({
            title: "listo! ",
            text: "La Factura Ha Sido Anulada!",
            timer: 2000,  
            type: "success"
        });
            $('#an').html('');
            $('#estadoFactura').html('Anulada');
             $('#justificacionAnulacion').modal('toggle');



      });
   }
});




$('#backup').on('change',  function(){


    if (($('[id=backup]')[0].checked)===true) {
      swal({   
            title: "Estas seguro?",   
            text: "Estas seguro de hacerle backup a esta factura?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#d04424",   
            confirmButtonText: "Si, quiero que la respaldes",   
            cancelButtonText: "NO HAGAS NADA!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
            if (isConfirm) {
                $.ajax({
                    url: '../../data/ajax/edicionDatos/backupFacturas.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {},
                })

                swal("Listo!", "Ya quedó respaldada en la base de datos de backup", "success");   
            } else {     
                swal("CANCELADO", "No hice respaldo de esta factura", "error");   
            } 
        });
    };


});




//FIN DE LA ANULACION DE LA FACTURA
$('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });

$('#imprimir').click(function(e) {
    e.preventDefault();  
    window.open('../../print/formatos/formatoAbonoFacturasCliente.php?printData='+idFactura.value,'_blank');
    });
function loadBtnAbonos(){
	return '<button type="button" id="btnAbonarCredito" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#abonoDeCreditos" ><i class="fa fa-warning"></i>Abonar a esta factura</h1></button>';
}

function formatDecilames(input){
var num = input;
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}
