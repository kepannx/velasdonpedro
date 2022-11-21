function confirmacionDatosRegistroVenta(){

    console.log(fechaFactura.value);
   
  
  skucode ="";
  autocompletarItem="";
  valorBruto="";
  impuestos="";

  num = 0;
  $(".skucode").each(function() {
      skucode += $(this).val()+"|";

  });

  
  $(".autocompletarItem").each(function() {
      autocompletarItem += $(this).val()+"|";;
       num++;
  });

  
  $(".valorBruto").each(function() {
      valorBruto += $(this).val()+"|";;
  });


  
  $(".impuestos").each(function() {
      impuestos += $(this).val()+"|";;
  });

  cantidades='';
  $(".cantidades").each(function() {
      cantidades += $(this).val()+"|";;
  });


    autocompletar = autocompletarItem.split('|');
    listas="";
    sku = skucode.split('|');
    vb = valorBruto.split('|');
    tx = impuestos.split('|');
    cant = cantidades.split('|');

    valorTotal=0;
    sumaSubtotal=0;
    sumaImpuestos=0;
    sumaTotal=0;

    if ($('#regimenCliente').val()!= undefined) {
        //Preparo verificador de los datos de régimen comúm


        
        for (var i = 0; i < num; i++) {
            if (autocompletar[i]!="" || cant[i]!="") {
                subTotal=parseInt(cant[i]*vb[i]);
                valorTotal = parseInt(subTotal)+parseInt(tx[i]);
                sumaSubtotal=parseInt(subTotal)+parseInt(sumaSubtotal);
                sumaImpuestos=parseInt(tx[i])+parseInt(sumaImpuestos);
                sumaTotal=parseInt(valorTotal)+parseInt(sumaTotal);
                listas += '<tr><td>'+autocompletar[i]+'</td><td>'+cant[i]+'</td><td>'+vb[i]+'</td><td>'+tx[i]+'</td><td>'+(valorTotal)+'</td></tr>';
                
            };
        };  
        
        $('#datosRComun').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">Identificación</label><div class="input-group">'+identificacionCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">A Cuál Régimen Pertenece?</label><div class="input-group col-md-12">'+regimenCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label>Cómo Se Llama El Cliente?</label><div class="input-group">'+nombreCliente.value+'</div></div></div></div><div class="col-md-12"><div class="col-md-6"><div class="form-group"><label>Dame La Dirección Del Cliente</label><div class="input-group">'+direccion.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label>Departamento</label><div class="input-group">'+deptoCliente.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label>Ciudad</label><div class="input-group">'+ciudadCliente.value+'</div></div></div></div><div class="col-md-12"><div class="col-md-5"><div class="form-group"><label class="control-label col-md-12">Preguntale El Email</label><div class="input-group">'+emailCliente.value+'</div></div></div><div class="col-md-5"><div class="form-group"><label class="control-label col-md-12">Preguntale El Teléfono</label><div class="input-group">'+telefonosCliente.value+'</div></div></div></div>');
        $('#listadoItemsComun').html('<table class="table"><thead><tr><th>Item</th><th>Cantidad</th><th>Valor</th><th>Iva</th><th>Total</th></tr></thead><tbody>'+listas+'</tbody><tr ></tr><tr><td class="tg-yw4l" colspan="3"></td><td class="tg-yw4l"><b>Subtotal</b></td><td class="tg-yw4l">'+sumaSubtotal+'</td></tr><tr><td class="tg-yw4l" colspan="3"></td><td class="tg-yw4l"><b>Impuestos</b></td><td class="tg-yw4l">'+sumaImpuestos+'</td></tr><tr><td class="tg-yw4l" colspan="3"></td><td class="tg-yw4l"><b>Total</b></td><td class="tg-yw4l">'+sumaTotal+'</td></tr></table>')
        $('#datosFacturacion').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group col-md-12"><label>Fecha Facturacion</label><div class="input-group col-md-12">'+fechaFactura.value+'</div></div></div>  <div class="col-md-4"><div class="form-group col-md-12"><label>Quién Lo Vendió?</label><div class="input-group col-md-12"><div class="input-group col-md-12">'+codigoVendedor.value+'</div></div></div></div><div class="col-md-4"><div class="form-group col-md-12"><label>Cómo Pagará El Cliente?</label><div class="input-group col-md-12"><div class="input-group col-md-12">'+tipoPago.value+'</div></div></div></div> </div>');
        

    }
    else
    {
     ;
 //     console.log("Régimen Simplificado");
  
      for (var i = 0; i < num; i++) {
            if (autocompletar[i]!="" || cant[i]!="") {
              subTotal=parseInt(cant[i]*vb[i]);
              sumaTotal=parseInt(subTotal)+parseInt(sumaTotal);
                listas += '<tr><td>'+autocompletar[i]+'</td><td>'+vb[i]+'</td><td>'+cant[i]+'</td><td>'+(vb[i]*cant[i])+'</td></tr>';
            };
        };
        $('#datosRComun').html('');
        $('#listadoItemsComun').html('');
        $('#datosRSimplificada').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Cómo Se Llama El Cliente?</label><div class="input-group">'+nombreCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label>La Identificación Es</label><div class="input-group">'+identificacionCliente.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label>El Email</label><div class="input-group">'+emailCliente.value+'</div></div></div></div>')
       //Preparo verificador de los datos de régimen simplificado 

        $('#listadoItemsSimplificado').html('<table class="table"><thead><tr><th>Item</th><th>Valor Unidad</th><th>Cantidad</th><th>SubTotal</th></thead><tbody>'+listas+'</tbody><td class="tg-yw4l"></td></tr><tr><td class="tg-yw4l" colspan="2"></td><td class="tg-yw4l"><b>Total</b></td><td class="tg-yw4l">$ '+sumaTotal+'</td></tr></table>')
        $('#datosFacturacion').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group col-md-12"><label>Fecha Facturacion</label><div class="input-group col-md-12">'+fechaFactura.value+'</div></div></div>  <div class="col-md-4"><div class="form-group col-md-12"><label>Quién Lo Vendió?</label><div class="input-group col-md-12"><div class="input-group col-md-12">'+codigoVendedor.value+'</div></div></div></div><div class="col-md-4"><div class="form-group col-md-12"><label>Cómo Pagará El Cliente?</label><div class="input-group col-md-12"><div class="input-group col-md-12">'+tipoPago.value+'</div></div></div></div> </div>');
  
    }


}




document.getElementById('confirmaRegistro').addEventListener('click', function(){
    event.preventDefault();

    confirmacionDatosRegistroVenta();
});