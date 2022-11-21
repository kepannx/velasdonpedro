function confirmacionFacturaVenta(){
	 
  $('#datosCliente').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Cómo Se Llama El Cliente?</label><div class="input-group"><i class="fa fa-user"></i>'+nombreCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">Cuál es Su Email</label><div class="input-group"><i class="ti-email"></i>'+emailCliente.value+'</div></div></div> <div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">En Qué Ciudad Vive?</label><div class="input-group"><i class="fa  fa-home"></i>'+ciudadCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">Pidele La Dirección</label><div class="input-group"><i class="fa   fa-map-marker"></i>'+direccionCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">A Qué Teléfono Podemos Llamarlo?</label><div class="input-group"><i class="fa   fa-phone"></i>'+telefonoCliente.value+'</div></div></div></div>');
  
  var articulos = [];
  for (var i = $('[id=sku_]').length - 1; i >= 0; i--) {
                articulos.push('<div class="col-md-12" style="border-bottom: 1px solid #e5e5e5; margin-top:5px; margin-bottom:5px;"><div class="col-md-3">'+($('[id=sku_]')[i].value)+'</div><div class="col-md-4" align="center">'+($('[id=nombreProductoServicio_]')[i].value)+'</div><div class="col-md-1" align="center">'+($('[id=unidades]')[i].value)+'</div><div class="col-md-2" align="center">'+($('[id=valorUnidad_]')[i].value)+'</div><div class="col-md-2" align="center">$'+(($('[id=valorUnidad_]')[i].value)*($('[id=unidades]')[i].value))+'</div></div>');
            };
  $('#datosArticulos').html('<div class="col-md-12  panel panel-inverse panel-heading"><div class="col-md-2 text-center">Código</div><div class="col-md-5 text-center" >Producto</div><div class="col-md-1 text-center">Unidades</div><div class="col-md-2 text-center">Valor Unidad</div><div class="col-md-2 text-center">Valor Bruto</div></div>'+articulos+'');
  
  

  $('#datosTributarios').html('<div class="col-md-offset-8"><div class="col-md-5"><strong class="text text-danger">SubTotal:</strong> </div><div class="col-md-7">'+($('#subTotal').text())+'</div></div><div class="col-md-offset-8"><div class="col-md-5"><strong class="text text-danger">Impuestos:</strong> </div><div class="col-md-7">'+($('#totalImpuestos').text())+'</div></div><div class="col-md-offset-8"><div class="col-md-5"><strong class="text text-success">Total a Pagar:</strong> </div><div class="col-md-7">'+($('#totalFinal').text())+'</div></div><div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Vendedor:</label><div class="input-group">'+($('#codigoVendedor option:selected').text())+'</div></div></div><div class="col-md-8"><label class="col-md-12">Método de Pago</label>'+metodosPagoRegistrado()+'</div></div>')
  


  var relacionSerialImeis = [];
  var control =0;


  for (var i = imeisandserials.length - 1; i >= 0; i--) {
    if ((imeisandserials[i].value.length)>0) {
        relacionSerialImeis.push('  <div class="col-md-12" style="border-bottom:1px, dotted, #e5e5e5  ;"><div class="col-md-6" style="word-wrap:break-word;"">'+(imeisandserials[i].value)+'</div><div class="col-md-6">'+($('[id=nombreProductoServicio_]')[i].value)+'</div></div>');
        control++;
    }
  }
  if (control>0) {
        $('#footerBill').html('<div class="col-md-12"><!--INICIO RELCION SERIALES E IMEIS --><div class="col-md-6"><div class="col-md-12 text-center"><b> <i class="fa fa-list"></i> Relación de Imeis o Seriales Dispositivos</b></div><div class="col-md-12"><div class="col-md-6"><b>Imei-Serial</b></div><div class="col-md-6"><b>Producto</b></div></div>'+relacionSerialImeis+'</div><!-- fin de listado de imeis y seriales--><!-- inicio terminos y condiciones--><div class="col-md-6"><div class="col-md-12 text-center"><b>Términos, Condiciones e Información Legal</b></div><div class="col-md-12"><h6> <small> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small></h6></div></div></div>');

  }else{
        $('#footerBill').html('<div class="col-md-12"><div class="col-md-12 text-center"><b>Términos, Condiciones e Información Legal</b></div><div class="col-md-12"><h6> <small> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small></h6></div></div>');
  }

}



function metodosPagoRegistrado(){
   var metodosPagoRegistrado = '<div class="col-md-2 col-md-offset-2"><i class="fa fa-check-circle"></i> Efectivo</div>';

   var metodos = [];
   if(($('[id=efectivo]')[0].checked)===true){ metodos.push('<div class="col-md-2 col-md-offset-2"><i class="fa fa-check-circle"></i> Efectivo</div>')}
   if(($('[id=debito]')[0].checked)===true){ metodos.push('<div class="col-md-2 col-md-offset-2"><i class="fa fa-check-circle"></i>T Débito</div>'); }
   if(($('[id=credito]')[0].checked)===true){metodos.push('<div class="col-md-2 col-md-offset-2"><i class="fa fa-check-circle"></i>T Credito</div>')  }
   if(($('[id=cheque]')[0].checked)===true){ metodos.push('<div class="col-md-2 col-md-offset-2"><i class="fa fa-check-circle"></i>Cheque</div>') }

    return metodos;
} 




document.getElementById('saveFactura').addEventListener('click', function(){
	event.preventDefault();
  //console.log(identificacionCliente.values);
     if (validarFacturaVenta()==true) {
           confirmacionFacturaVenta();
        }
    else
    {
       $('#confirmacionFacturVenta').modal('toggle');
    }
   });