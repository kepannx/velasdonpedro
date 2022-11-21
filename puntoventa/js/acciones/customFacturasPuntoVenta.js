
jQuery('.fechas').datepicker({
        autoclose: true,
        todayHighlight: true
      });

var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');

        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });
        cb(matches);
      };
    };


jQuery('#fechaFactura').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
          autoclose: true,
          todayHighlight: true
        });   

//Si invoco el SKU o Codigo de  producto
document.getElementById('skuCodigo').addEventListener('change', function(){
      //Comparo si existe
      //Checkeo sku repetido 

      if (($('#sku')[0].value).length > 0) {
          $.ajax({
            url     : '../../data/ajax/acciones/checkSkuRepetido.php',
            type    : 'POST',
            data: { sku: ""+$('#sku')[0].value+"", id: ""+id.value+"" },
            success :  function(data){

               if (data=='true') {

                $('#nombreProductosServicios').attr('readonly', true);
                $('#valorUnidad').attr('disabled', false);
                  loadFeaturesFromSku($('#sku')[0].value);
               }
               else if(data=='false'){
                 swal({   
                        title: "Auch!",   
                        text: "Lo que quieres registrar no lo tengo en inventario, Necesito que lo ingreses primero para dejartelo facturar",
                        type: "error",   
                        timer: 4000,   
                        showConfirmButton: true 
                    });
                  $('#sku').val('');
               }
            }
          });
      };
});



//Si invoco el SKU o Codigo de  producto
document.getElementById('identificacionCliente').addEventListener('change', function(){
      //Comparo si existe
      //Checkeo sku repetido 
      if (($('#identificacionCliente').val()).length > 0) {
          $.ajax({
            url     : '../../data/ajax/acciones/checkClienteAnterior.php',
            type    : 'POST',
            data: { identificacionCliente: ""+$('#identificacionCliente').val()+"", id: ""+id.value+"" },
            success :  function(data){

               if (data=='true') {

                $('#nombreCliente').attr('disabled', true);
                $('#emailCliente').attr('disabled', true);
                $('#ciudadCliente').attr('disabled', true);
                $('#direccionCliente').attr('disabled', true);
                $('#telefonoCliente').attr('disabled', true);
                  loadDataCustomers($('#identificacionCliente').val());
               }
               else if(data=='false'){
                  $('#nombreCliente').attr('disabled', false);
                  $('#nombreCliente').val('');
                  $('#emailCliente').attr('disabled', false);
                  $('#emailCliente').val('');
                  $('#ciudadCliente').attr('disabled', false);
                  $('#ciudadCliente').val('');
                  $('#direccionCliente').attr('disabled', false);
                  $('#direccionCliente').val('');
                  $('#telefonoCliente').attr('disabled', false);
                  $('#telefonoCliente').val('');
                  $('#idCliente').val('0');
               }
            }
          });
      };
});

//Cargo las caracteristicas que necesito  para ese  producto


//*
function loadFeaturesFromSku(sku){
    if (sku.length > 0) {
      //Cargo en JSON los parametros que necesito para ese articulo
      $.ajax({
          url: '../../data/ajax/acciones/checkJsonProductos.php',
          type: 'POST',
          data: { sku : ""+sku+"", nombreProductosServicios : null, id: ""+id.value+"" },
          success: function (data) {
            datos = JSON.parse(data);
            //Lleno los datos que tenga que llenar
             $("#nombreProductosServicios").val(datos.nombreProductosServicios);
             $("#valorUnidad").val(datos.valorVentaUnidad);
             $("#impuesto").val(datos.impuesto);
             $("#idproductosServicios").val(datos.idproductosServicios);
             $('#volumenes').html('');
             $('#precios').html('');
             if (datos.serializacion == 'si') {
              loadProductosSerialImei(datos.idproductosServicios)
             }
            else if(datos.serializacion == 'no')
                  $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>');
            else{
                $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>');
                $("#precios").html('');
                $("#nombreProductosServicios").val("");
                $("#idproductosServicios").val("");
            }
          }
        });
    };
  }


//LOAD DATA CUSTOMERS
function loadDataCustomers(identificacionCliente){
    if (identificacionCliente.length > 0) {
      //Cargo en JSON los parametros que necesito para ese cliente
      $.ajax({
          url: '../../data/ajax/acciones/checkJsonCliente.php',
          type: 'POST',
          data: { identificacionCliente : ""+identificacionCliente+"", id: ""+id.value+"" },
          success: function (data) {
            datos = JSON.parse(data);
            //Lleno los datos que tenga que llenar
             $("#nombreCliente").val(datos.nombreCliente);
             $("#emailCliente").val(datos.emailCliente);
             $("#ciudadCliente").val(datos.ciudadCliente);
             $("#direccionCliente").val(datos.direccionCliente);
             $("#telefonoCliente").val(datos.telefonosCliente);
             $("#idCliente").val(datos.idcliente);

          }
        });
    };
  }





//Listo los seriales e imeis de un producto en especifico
function loadProductosSerialImei(parametro){
  $.post('../../data/ajax/acciones/serialesImeisDisponibles.php', {id: ''+id.value+'', 
        idProducto : ''+parametro+'' }, function(datosTabla) {
    $('#volumenesSeriales').html(datosTabla);
  });


}



/*=================================
=            typerhead            =
=================================*/
$.post('../../data/ajax/acciones/typerhead/listaSkuCodigos.php', { id : ""+id.value+"" }, function(datos) {
    var skuCodigo = JSON.parse(datos);
    //var skuCodigo = datos;

    $('#skuCodigo .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'skuCodigo',
      source: substringMatcher(skuCodigo)
    });
});



//Identificacion del Cliente
$.post('../../data/ajax/acciones/typerhead/listaIdentificacionClientes.php', { id : ""+id.value+"" }, function(datos) {
    var identificacionCliente = JSON.parse(datos);

    $('#ideCliente .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'identificacionCliente',
      source: substringMatcher(identificacionCliente)
    });
});


/*=====  End of typerhead  ======*/


/*=============================================
=            OPCIONES DE METODOS DE PAGO          =
=============================================*/

//Si Es efectivo
document.getElementById('efectivo').addEventListener('click', function(){
if (($('[id=efectivo]')[0].checked)===true){
    loadBtnSave();
    $('#opcionEfectivo').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon">En Efectivo Pagará:</span> <input type="text" class="form-control" id="valorEfectivo" onkeyup="format(this)" onchange="format(this)" placeholder="Cuánto Pagará en Débito "   ></div><div class="help-block with-errors"></div></div>');
    calcular();
    }else{
       $('#opcionEfectivo').html('');
      loadBtnSave();
    }
});


//Si es Débito
document.getElementById('debito').addEventListener('click', function(){
if (($('[id=debito]')[0].checked)===true){
    $('#opcionDebito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon">En Debito Pagará:</span> <input type="text" class="form-control" id="valorDebito" onkeyup="format(this)" onchange="format(this)" placeholder="Cuánto Pagará en Débito "   ></div><div class="help-block with-errors"></div></div>');
    loadBtnSave();
    }else{
      $('#opcionDebito').html('');
      loadBtnSave();
    }

});


//Es credito
document.getElementById('credito').addEventListener('click', function(){
if (($('[id=credito]')[0].checked)===true){
    $('#opcionCredito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon"><i class=""></i>En Crédito Pagará:</span> <input type="text" class="form-control" id="valorCredito" onkeyup="format(this); calcular();" onchange="format(this)"  placeholder="Cuánto Pagará en Credito "   ></div><div class="help-block with-errors"></div></div>');
      loadBtnSave()
    }else{
      $('#opcionCredito').html('');
      calcular();
      loadBtnSave();
    }

});


//Es cheque
document.getElementById('cheque').addEventListener('click', function(){
if (($('[id=cheque]')[0].checked)===true){
     $('#opcionCheque').html('<div class="col-md-12"><div class="form-group col-md-6"><div class="input-group"><span class="input-group-addon"><i class=""></i>Valor Cheque</span> <input type="text" class="form-control" id="valorCheque" onkeyup="format(this)" onchange="format(this)" placeholder="Cuánto Pagará en Credito "   ></div><div class="help-block with-errors"></div></div><div class="form-group col-md-6"><div class="input-group"><span class="input-group-addon"><i class="icon-calender"></i> Cobralo El </span><input type="date" class="form-control" id="fechaCobroCheque"  > </div></div></div></div>');
      loadBtnSave();
    }else{
      $('#opcionCheque').html('');
      loadBtnSave();
    }

});

//Es servicredito
document.getElementById('servicredito').addEventListener('click', function(){
if (($('[id=servicredito]')[0].checked)===true){
    $('#opcionServicredito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon"><i class=""></i>Servicredito Pagará:</span> <input type="text" class="form-control" id="valorServicredito" onkeyup="format(this)" onchange="format(this)" placeholder="Cuánto Pagará Servicredito "   ></div></div>');
      loadBtnSave();
    }else{
      $('#opcionServicredito').html('');
      loadBtnSave();
    }

});




function loadBtnSave(){

  if ((($('[id=servicredito]')[0].checked)===true) || (($('[id=cheque]')[0].checked)===true) || (($('[id=credito]')[0].checked)===true) || (($('[id=debito]')[0].checked)===true) || ($('[id=efectivo]')[0].checked)===true) {
  $('#saveFactura').css("display", "block");
}else{
  $('#saveFactura').css("display", "none");
}
}

/*=====  End of OPCIONES DE METODOS DE PAGO ======*/



/*============================================
=            ADD A PREFACTURACION            =
============================================*/
document.getElementById('addArticulo').addEventListener('click', function(){
  //Capturo los datos

    if ((idproductosServicios.value.length)>0) {
        //Es un producto registrado en la base de datos
        if (nombreProductosServicios.value.length > 2  && valorUnidad.value.length >0 && sku.value.length >0 ) {
          var seriales=[];
          var imeis=[];
          var serialesEspeciales=[];
          calcular();

          if (($('[id=codigo_serial]').length)>0) {
            for (var i = $('[id=codigo_serial]').length - 1; i >= 0; i--) {
                if (($('[id=codigo_serial]')[i].checked)===true){
                  seriales.push(limpiadorCaracteres($('[id=codigo_serial]')[i].value));
                }
            };
          };//Existen seriales
          if (($('[id=codigo_imei]').length)>0) {
            for (var i = $('[id=codigo_imei]').length - 1; i >= 0; i--) {
              if (($('[id=codigo_imei]')[i].checked)===true){
                imeis.push(limpiadorCaracteres($('[id=codigo_imei]')[i].value));
                }
            };//fin del for
          };//Existen imeis
          if (($('[id=codigo_otroTipoSerial]').length)>0) {
            for (var i = $('[id=codigo_otroTipoSerial]').length - 1; i >= 0; i--) {
              if (($('[id=codigo_otroTipoSerial]')[i].checked)===true){
                serialesEspeciales.push(limpiadorCaracteres($('[id=codigo_otroTipoSerial]')[i].value));
              }//Fin del IF CHECK
            };//Fin del for
          };//Existen Otros Tipo de serial
          //Consulta de tipo de seriales
          
          //Repartir TABLAS según las serializaciones 
          //[SI ][ SI ][ SI]
          if (seriales.length > 0 && imeis.length > 0 && serialesEspeciales.length > 0) {
                  unidadesCompradas = seriales.length;
                  //console.log('TODOS');
                  tablas = '<tr id="lts"><td align="center"><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /><input type="hidden" id="sku_" value="'+sku.value+'"> '+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'">  '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+imeis+'|'+serialesEspeciales+'" onclick="showDetails(this)" ></i><input type="hidden" id="imeisandserials" value = "'+seriales+'|'+imeis+'|'+serialesEspeciales+'" /><i class="fa fa-minus-circle text-danger" id="closeSerial" style="display: none"></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[SI][NO][NO]
          else if (seriales.length > 0 && imeis.length == 0 && serialesEspeciales.length == 0) {
              unidadesCompradas = seriales.length;
               //console.log('SOLO SERIALES');

              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /><td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green" id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'" onclick="showDetails(this)"  ></i><input type="hidden" id="imeisandserials" value = "'+seriales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }

          //[NO][SI][SI] 
          else if (seriales.length == 0 && imeis.length > 0 && serialesEspeciales.length > 0) {
              unidadesCompradas = imeis.length;
            tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+imeis+'|'+serialesEspeciales+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "'+imeis+'|'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }

          //[SI][NO][SI]
          else if (seriales.length > 0 && imeis.length == 0 && serialesEspeciales.length > 0) {
            unidadesCompradas = seriales.length;
             //console.log('TODOS EXCEPTO IMEIS');
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+serialesEspeciales+'" onclick="showDetails(this)"></i> <input type="hidden" id="imeisandserials" value = "'+seriales+'|'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[SI][SI][NO]
          else if (seriales.length > 0 && imeis.length > 0 && serialesEspeciales.length == 0) {
            unidadesCompradas = seriales.length;
            //console.log('todos menos serial especial');
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+imeis+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "'+seriales+'|'+imeis+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[NO][SI][NO]
          else if (seriales.length == 0 && imeis.length > 0 && serialesEspeciales.length == 0) {
            unidadesCompradas = parseInt(imeis.length);
           // console.log("Unidades: "+unidadesCompradas)
            
             tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+imeis+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "'+imeis+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[NO][NO][SI]
          else if (seriales.length == 0 && imeis.length == 0 && serialesEspeciales.length > 0) {
            unidadesCompradas = serialesEspeciales.length;
             //console.log('SOLO SERIAL ESPECIAL');
            tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+serialesEspeciales+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[NO][NO][NO]
          else 
          {   
              
            if (typeof(cantidades)=='undefined') {
              swal({   
                      title: "Ops!",   
                      text: "No puedo dejarte agregar este producto porque no lo tienes en punto de venta, Necesito que lo agregues al inventario o te hagan un traslado",
                      type: "error",   
                      timer: 5000,   
                      showConfirmButton: true 
                  });
            }else{
              unidadesCompradas = parseInt(cantidades.value);
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"><input type="hidden" id="nombreProductoServicio_" value="'+nombreProductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><input type="hidden" id="imeisandserials" value = "" /><td align="center"></i><i class="fa fa-minus-circle text-danger" id="closeSerial" ></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';

            }

          }


          $('#listadoProductos').append(tablas);


          //Borrar  rows de productos agregados
          $('#listadoProductos').on("click","#deleteRow", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parent("tr").remove();
                $(this).parent('#ts').remove();
                $(this).closest("tr").remove();
                calcular()
              })
          calcular();
          clearCampos(); 
        } 
        else {
          //
          swal({   
            title: "Ops!",   
            text: "No puedo dejarte agregar este producto hasta que no llenes los campos del sku, nombre del producto y cuanto se vendió",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
        }
        


    }else {
      
          swal({   
            title: "Ops!",   
            text: "Lo que quieres agregar a esta factura no esta en inventario, necesito que lo ingreses primero para dejartelo facturar",
            type: "error",   
            timer: 5000,   
            showConfirmButton: true 
        });
    }

});


function listasSeriales(seriales){
  var separacion = seriales.split('|')+ '';
  var lotes = separacion.length;
  var string = separacion + '';
  desfragmento = string.split(",")
  series = [];
  dividir= desfragmento.length;
  ciclos = ( dividir / lotes);
  

     for (var i = desfragmento.length - 1; i >= 0; i--) {
     series.push('<div class="col-md-4"><i class="fa fa-check-circle"></i>'+desfragmento[i]+" </div> ");
    };

 
  return series; 
}


function clearCampos(){
                $("#sku").val("");
                $("#nombreProductosServicios").val("");
                $("#valorUnidad").val("");
                $("#impuesto").val("");
                $("#cantidades").val("");
                $("#idproductosServicios").val("");
                $("#precios").html("");
                $("#volumenesSeriales").html('');
                           
}
/*=====  End of ADD A PREFACTURACION  ======*/




/*============================
=            MATH            =
============================*/
function mathValorNeto(unidadesCompradas, valorUnidad){
    valorUnidad = valorUnidad.value.replace(/\./g,'');
    unidadesCompradas = parseInt(unidadesCompradas);
    valorUnidad = parseInt(valorUnidad);
    return (unidadesCompradas*valorUnidad);

}


function mathValorTotal (unidadesCompradas, valorUnidad, impuesto) {
  // body...
    unidadesCompradas = parseInt(unidadesCompradas);
    valorUnidad = parseInt(valorUnidad.value.replace(/\./g,''));
    impuesto = parseFloat(impuesto.value);
    valorNeto= unidadesCompradas*valorUnidad;
    return ((valorNeto * impuesto)/100)+valorNeto;
}



//Sumatorias
 var variableAcumuladora =0;
//Calculo todos los valores que hay en el final de la factura o remisión
function calcular(){
        //Calculo Valor Neto

        subTotal = 0;
        valorTotal = 0;
        for (var i = $('[id=valorNeto]').length - 1; i >= 0; i--) {
            subTotal = parseInt(subTotal) + parseInt((($('[id=valorNeto]')[i].value)));
        };
        for (var i = $('[id=valorTotal]').length - 1; i >= 0; i--) {
            valorTotal = parseInt(valorTotal) + parseInt((($('[id=valorTotal]')[i].value)));
        };
        
        valorImpuestos = (valorTotal-subTotal);

        $("#subTotal").html('$ '+formatDecilames(subTotal));
        $("#totalImpuestos").html('$ '+formatDecilames(valorImpuestos));
        $("#totalFinal").html('$ '+formatDecilames(valorTotal));
        $("#valorEfectivo").val(formatDecilames(valorTotal));
}



function formatDecilames(input){
var num = input;
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}
/*=====  End of MATH  ======*/



/*==================================
=            VALIDATION            =
==================================*/


/*=====  End of VALIDATION  ======*/


