function guardarFacturaVenta()
{
     skus=[];
     idProductoServicios=[];
     valorUnidad = [];
     unidades = [];
     valorNeto = [];
     valorTotal = [];
     taxes = [];
     bucketSerials = [];
     nuevos = [];
     valorMayoristas = [];
     valorPublico = [];



     
     if (($('[id=sku_]').length)>0) {
            for (var i = $('[id=sku_]').length - 1; i >= 0; i--) {
                skus.push(limpiadorCaracteres($('[id=sku_]')[i].value));
            };

          };
    if (($('[id=idproductosServicios_]').length)>0) {
            for (var i = $('[id=idproductosServicios_]').length - 1; i >= 0; i--) {
                idProductoServicios.push(limpiadorCaracteres($('[id=idproductosServicios_]')[i].value));
            };
          };

    if (($('[id=valorUnidad_]').length)>0) {
            for (var i = $('[id=valorUnidad_]').length - 1; i >= 0; i--) {

                valorUnidad.push((parseInt($('[id=valorUnidad_]')[i].value.replace(/\./g,'')))) ;
            };
          };

    if (($('[id=unidades_]').length)>0) {
            for (var i = $('[id=unidades_]').length - 1; i >= 0; i--) {
                unidades.push(limpiadorCaracteres($('[id=unidades_]')[i].value));
            };
          };


    if (($('[id=valorNeto]').length)>0) {
            for (var i = $('[id=valorNeto]').length - 1; i >= 0; i--) {
                valorNeto.push(limpiadorCaracteres($('[id=valorNeto]')[i].value));
            };
          };

    if (($('[id=valorTotal]').length)>0) {
            for (var i = $('[id=valorTotal]').length - 1; i >= 0; i--) {
                valorTotal.push(limpiadorCaracteres($('[id=valorTotal]')[i].value));
            };
          };

    if (($('[id=impuesto_]').length)>0) {
            for (var i = $('[id=impuesto_]').length - 1; i >= 0; i--) {
                taxes.push(limpiadorCaracteres($('[id=impuesto_]')[i].value));
            };
          };

    if (($('[id=imeisandserials]').length)>0) {
            for (var i = $('[id=imeisandserials]').length -  1; i >= 0; i--) {
                bucketSerials.push('%'+($('[id=imeisandserials]')[i].value)+"|"+limpiadorCaracteres($('[id=idproductosServicios_]')[i].value));
                
            };
          };



    var tipoPago = [];  
    if (($('[id=efectivo]')[0].checked)===true) { tipoPago.push('efectivo');}
    if (($('[id=debito]')[0].checked)===true) {tipoPago.push('tarjeta debito');}
    if (($('[id=credito]')[0].checked)===true) {tipoPago.push('tarjeta credito');}
    if (($('[id=cheque]')[0].checked)===true) {tipoPago.push('cheque');}
    if (($('[id=servicredito]')[0].checked)===true) {tipoPago.push('entidad crediticia');}
        if (typeof(idCliente.value)==='undefined' || typeof(idCliente.value)===undefined) {
            idCliente='NaN';
        };

        //console.log(($('[id=fc]')[0].checked))

         if ((typeof($('[id=fc]')[0]) == 'undefined') || (typeof($('[id=fc]')[0]) == undefined)) { fc = false; }else{ fc= ($('[id=fc]')[0].checked) };

        if ((typeof(valorEfectivo) == 'undefined') || (typeof(valorEfectivo) == undefined)) { valorEfectivo = 0; }else{ valorEfectivo= (valorEfectivo.value); };
        if ((typeof(valorDebito) == 'undefined') || (typeof(valorDebito) == undefined)) { valorDebito = 0; }else{ valorDebito= (valorDebito.value); };
        if ((typeof(valorCheque) == 'undefined') || (typeof(valorCheque) == undefined)) { valorCheque = 0; }else{ valorCheque= (valorCheque.value); };
        if ((typeof(valorServicredito) == 'undefined') || (typeof(valorServicredito) == undefined)) { valorServicredito = 0; }else{ valorServicredito= (valorServicredito.value); };
        
        if ((typeof(digitoVerificacion) == 'undefined') || (typeof(digitoVerificacion) == undefined)) { digitoVerificacion = ''; }else{ digitoVerificacion= (digitoVerificacion.value); };
        if ((typeof(valorCredito) == 'undefined') || (typeof(valorCredito) == undefined)) { valorCredito = 0; }else{ valorCredito= (valorCredito.value); };

      


$.ajax({
            url: 'data/ajax/insercionDatos/guardarFactura.php',
            type: 'POST',
            dataType: 'JSON',
            data: { 
                    idCliente: ""+idCliente.value+"",
                    tipoDocumento : ""+tipoDocumento.value+"",
                    digitoVerificacion : ""+digitoVerificacion+"",
                    identificacionCliente: ""+limpiadorCaracteres(identificacionCliente.value)+"", 
                    nombreCliente: ""+limpiadorCaracteres(nombreCliente.value)+"", 
                    emailCliente: ""+limpiadorCaracteres(emailCliente.value)+"",
                    ciudadCliente: ""+limpiadorCaracteres(ciudadCliente.value)+"",
                    direccionCliente: ""+limpiadorCaracteres(direccionCliente.value)+"",
                    telefonoCliente: ""+limpiadorCaracteres(telefonoCliente.value)+"",
                    fechaFactura: ""+limpiadorCaracteres(fechaFactura.value)+"",
                    fc : fc,
                    codigoVendedor: ""+limpiadorCaracteres(codigoVendedor.value)+"",
                    skus : ""+skus+"",
                    idProductoServicios : ""+idProductoServicios+"",
                    valorUnidad:  ""+valorUnidad+"",
                    unidades : ""+unidades+"",
                    valorNeto : ""+valorNeto+"",
                    valorTotal:  ""+valorTotal+"",
                    taxes : ""+taxes+"",
                    bucketSerials:  ""+bucketSerials+"",
                    tipoPago: ""+tipoPago+"",
                    valorEfectivo : ""+valorEfectivo+"",
                    valorDebito : ""+valorDebito+"",
                    valorCredito : ""+valorCredito+"",
                    valorCheque : ""+valorCheque+"",
                    valorServicredito : ""+valorServicredito+"",
                    tokenPrefactura : ""+tokenPrefactura.value+""
            },                                    
        })
        .done(function(data) { 

            console.log(data);
            setTimeout(function(){
                window.open('print/formatos/billRoll.php?printData='+data,'_blank')
            }, 1000)

           } )
        .fail(function() {
            swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
        })
        .always(function() {
            //clear
        
            $('#listadoProductos').html("");
            $('#identificacionCliente').val('');
            $('#nombreCliente').val('');
            $('#emailCliente').val('');
            $('#ciudadCliente').val('');
            $('#direccionCliente').val('');
            $('#telefonoCliente').val('');
            $('#skuCodigo').val('');
            $('#nombreProductosServicios').val('');
            $('#valorUnidad').val('');
            $('#cantidades').val('');
            $('#subTotal').text('');
            $("#provedor").val("");
            $("#idProvedor").val("");
            $('#nroFacturaProvedor').val('');
            $('#fechaFacturaProvedor').text('');
            $('#estadoFactura');
            $("#totalImpuestos").html('');
            $('#opcionEfectivo').html('');
            $('#opcionDebito').html('');
            $('#opcionCredito').html('');
            $('#opcionCheque').html('');
            $('#opcionServicredito').html('');
            $('#efectivo').prop('checked', false);
            $('#debito').prop('checked', false);
            $('#credito').prop('checked', false);
            $('#cheque').prop('checked', false);
            $('#idCliente').val('');
            $('#opcionServicreditoicredito').prop('checked', false);
            $('#codigoVendedor option:eq(0)').attr('selected', 'selected');
            $("#totalFinal").html('');
            $('#facturaCredito').html('');
            $('#valorDebito').html('');
            $('#valorEfectivo').html('');
            $('#valorCredito').html('');
            $('#valorCheque').html('');
            $('#valorServicredito').html('');
            delete window.valorEfectivo;
            delete window.valorDebito;
            delete window.valorCredito;
            delete window.valorServicredito;
            delete window.valorCheque;
            
            delete (valorUnidad);
            delete(impuesto);       
             $('#confirmacionFacturVenta').modal('toggle');
             $('#saveFactura').css('display' , 'none');
 
        }); 
}
document.getElementById('guardarDatosFacturacion').addEventListener('click', function(){
        guardarFacturaVenta();
  });
