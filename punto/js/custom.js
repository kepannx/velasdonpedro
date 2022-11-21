$(document).ready(function() {

	//DESPLIEGO LA OPCIÓN DE  LA  DEUDA EN CASO QUE LA FACTURA  NO SE HAYA PAGADO A CONTADO
      $('#estadoDeuda').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId == 'credito') {
            document.getElementById('valorDeuda').style.display = 'block';

        } else {
            document.getElementById('valorDeuda').style.display = 'none';
        }
    });


      $('#tipoPago').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId == 'tarjeta credito' || grupoId == 'tarjeta debito') {
            document.getElementById('incremento').style.display = 'block';
            document.getElementById('nroCheque').style.display = 'none';
            document.getElementById('efectivoPagar').style.display = 'none';

            if (grupoId=='tarjeta credito') { 

                swal({   
                title: "No olvides verificar los datos de la tarjeta!",   
                text: "Recuerda verificar los datos de la tarjeta de crédito con los del tarjetahabiente, no queremos ser víctimas de un fraude ¿o si?",   
                timer: 7000,   
                showConfirmButton: true 
        });
            };
        }else if(grupoId == 'cheque'){
            document.getElementById('nroCheque').style.display = 'block';
            document.getElementById('incremento').style.display = 'none';
            document.getElementById('efectivoPagar').style.display = 'none';
            //efectivoPagar
        }
        else if(grupoId == 'efectivo'){
            document.getElementById('efectivoPagar').style.display = 'block';
            document.getElementById('incremento').style.display = 'none';
            document.getElementById('nroCheque').style.display = 'none';
        }

         else {
            document.getElementById('incremento').style.display = 'none';
            document.getElementById('nroCheque').style.display = 'none';
            document.getElementById('efectivoPagar').style.display = 'block';
        }
    });



      $('#tipoMovimiento').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId != 'traslado') {
            document.getElementById('noTraslado').style.display = 'block';
            document.getElementById('traslado').style.display = 'none';
        } else {
            document.getElementById('noTraslado').style.display = 'none';
            document.getElementById('traslado').style.display = 'block';
            
        }
    });




    $('#filtroBusquedaFactura').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId == 'nombreCliente') {
            document.getElementById('showNombreCliente').style.display = 'block';
            document.getElementById('showNroFactura').style.display = 'none';
            document.getElementById('showRangoFecha').style.display = 'none';
        }
        else if (grupoId == 'nroFactura') {
            document.getElementById('showNombreCliente').style.display = 'none';
            document.getElementById('showNroFactura').style.display = 'block';
            document.getElementById('showRangoFecha').style.display = 'none';
         }

        else if (grupoId == 'rangoFecha') {
            document.getElementById('showNombreCliente').style.display = 'none';
            document.getElementById('showNroFactura').style.display = 'none';
            document.getElementById('showRangoFecha').style.display = 'block';
         } 

    });




    $('#filtroBusquedaCuentaCobro').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId == 'nombreClienteCuentaDeCobro') {
            document.getElementById('showNombreClienteCuentaDeCobro').style.display = 'block';
            document.getElementById('showNroCuentaDeCobro').style.display = 'none';
            document.getElementById('showRangoFechaCuentaDeCobro').style.display = 'none';
        }
        else if (grupoId == 'nroCuentaDeCobro') {
            document.getElementById('showNombreClienteCuentaDeCobro').style.display = 'none';
            document.getElementById('showNroCuentaDeCobro').style.display = 'block';
            document.getElementById('showRangoFechaCuentaDeCobro').style.display = 'none';
         }

        else if (grupoId == 'rangoFechaCuentaDeCobro') {
            document.getElementById('showNombreClienteCuentaDeCobro').style.display = 'none';
            document.getElementById('showNroCuentaDeCobro').style.display = 'none';
            document.getElementById('showRangoFechaCuentaDeCobro').style.display = 'block';
         } 

    });



    $('#filtroBusquedaFacturaBloque').change(function() {
        var grupoId = $(this).find("option:selected").attr('value');

        if (grupoId == 'nombreClienteBloque') {
            document.getElementById('showNombreClienteBloque').style.display = 'block';
            document.getElementById('showRangoFechaBloque').style.display = 'none';
        }


        else if (grupoId == 'rangoFechaBloque') {
            document.getElementById('showNombreClienteBloque').style.display = 'none';
            document.getElementById('showRangoFechaBloque').style.display = 'block';
         } 

    });


  
  $('#downloadCliente').click(function(e) {
    e.preventDefault();  
    window.location.href = 'plantillas/clientes.xlsx';
    });

  $('#downloadProducoServicios').click(function(e) {
    e.preventDefault(); 
    window.location.href = 'plantillas/productosServicios.xlsx';
    });

  $('#downloadProvedores').click(function(e) {
    e.preventDefault(); 
    window.location.href = 'plantillas/proveedores.xlsx';
    });


});


