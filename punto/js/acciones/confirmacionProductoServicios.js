function confirmacionProductosServicios(){
    if (($('[id=serializacion]')[0].checked)===true){
            var serializacion= 'Si';
            if (($('[id=serial]')[0].checked)===true) {var serial='<i class="fa fa-check txt-success"></i>'}else{var serial='<i class="fa fa-times txt-danger"></i>'}
            if (($('[id=imei]')[0].checked)===true) {var imei='<i class="fa fa-check txt-success"></i>'}else{var imei='<i class="fa fa-times txt-danger"></i>'}
            if (($('[id=otroTipoSerial]')[0].checked)===true) {var otroTipoSerial='<i class="fa fa-check txt-success"></i>'}else{var otroTipoSerial='<i class="fa fa-time txt-dangers"></i>'}
    }else if(($('[id=serializacion]')[0].checked)===false){
        var serializacion= '<i class="fa fa-times"></i>';
        var serial='<i class="fa fa-times"></i>'
        var imei='<i class="fa fa-times"></i>'
        var otroTipoSerial='<i class="fa fa-times"></i>'
    }
    if (($('[id=retiroTemporal]')[0].checked)===true){var mostrar="Si";}else{ var mostrar = "No";}
    if (($('[id=web]')[0].checked)===true){var web="Si";}else{ var web = "No";}
            
	   
            if (tipoProductoServicio.value == 'producto') {

                if ((typeof($('#subCategoria').val()) === 'undefined')) {
                         var subCat=' No Aplica ';
                    }
                    else if ((typeof($('#subCategoria').val()) != 'undefined'))  {

                      var subCat = ($("#subCategoria option[value='"+subCategoria.value+"']").text());
                    }
                //
                var ventaCruzada =[];
                for (var i = $('#ventaCruzada :selected').length - 1; i >= 0; i--) {
                    ventaCruzada.push('<div class="col-md-3"> <i class="fa  fa-check-square-o"></i> '+$('#ventaCruzada :selected')[i].text+'</div>')
                };
                $('#datosBase').html('<div class="col-md-12"><div class="col-md-3"><div class="form-group"><label>Nombre del '+tipoProductoServicio.value+'</label><div class="input-group" >'+nombreProductosServicios.value+'</div></div></div><div class="col-md-2"><div class="form-group"><label>Tipo</label><div class="input-group" >'+tipoProductoServicio.value+'</div></div></div><div class="col-md-2"><div class="form-group"><label>Marca</label><div class="input-group" >'+marca.value+'</div></div></div><div class="col-md-2"><div class="form-group"><label>Serializado</label><div class="input-group" >'+serializacion+'</div></div></div><div class="col-md-3"> <b>Serial</b>: '+serial+'| <b>Imei</b>:' +imei+' |<b>Otro</b>:'+otroTipoSerial+' </div></div><div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Categoría</label><div class="input-group">'+($("#categoria option[value='"+categoria.value+"']").text())+'</div></div></div><div class="col-md-4"><div class="form-group"><label>SubCategoría</label><div class="input-group" >'+subCat+'</div></div></div><div class="col-md-4"><div class="form-group"><label>Código/SKU</label><div class="input-group" >'+sku.value+'</div></div></div></div><div class="col-md-12"><div class="col-md-3"><div class="form-group"><label>Valor Final</label><div class="input-group" >'+valorVentaUnidad.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label>Valor Por Mayor</label><div class="input-group" >'+valorVentaPorMayor.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label>Mínimos Globales</label><div class="input-group" >'+cantidadMinimaGlobal.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label>Mínimos En Puntos de Venta</label><div class="input-group" >'+cantidadMinimaPuntos.value+'</div></div></div><div class="col-md-12"><div class="col-md-6"><div class="form-group"><label>Mostrar En Inventario</label></div><div class="input-group" >'+mostrar+'</div></div><div class="col-md-6"><div class="form-group"><label>Mostrar En Pagina Web</label></div><div class="input-group" >'+web+'</div></div></div></div></div><hr>');
                $('#ventasCruzadas').html('<div class="col-md-12">'+ventaCruzada+'</div><hr>')
            }
            else if(tipoProductoServicio.value == 'servicio'){
                $('#datosBase').html('<div class="col-md-12"><div class="col-md-4"><div class="form-group"><label>Nombre del '+tipoProductoServicio.value+'</label><div class="input-group" >'+nombreProductosServicios.value+'</div></div></div><div class="col-md-4"><label>Tipo</label><div class="input-group">'+tipoProductoServicio.value+'</div></div><div class="col-md-4"><label>Valor </label><div class="input-group" >'+valorVentaUnidad.value+'</div></div></div>');
            }

    }
document.getElementById('confirmarGuardarItem').addEventListener('click', function(){
	event.preventDefault();
    
     if (validacionProductosServicios()==true) {
           confirmacionProductosServicios();

        }
    else
    {
       $('#confirmacionNuevoProductoServicio').modal('toggle');
    }
   });