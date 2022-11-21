
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

 jQuery('.complex-colorpicker, #inventarioConvenioFecha').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
          autoclose: true,
          todayHighlight: true
        });   
//Opciones de la serialización
document.getElementById('estadoFactura').addEventListener('change', function(){
      if (($('[id=estadoFactura]')[0].value)=='credito') {
                  $("#facturaCredito").html('<div class="col-md-12"><div class="col-md-6 col-sm-12"><div class="form-group"><label>Cuándo Quedaste En Pagarle?</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control fechas" id="fechaCompromisoPago" placeholder="Cuando lo compraste"  data-error="Cuándo quedaste en pagarle?"   required></div><div class="help-block with-errors"></div></div></div><div class="col-md-6 col-sm-12"><div class="form-group"><label>Cuánto Le Abonaste?</label><div class="input-group" id="nombreProvedor"><div class="input-group-addon"><i class="fa fa-credit-card-alt"></i></div><input type="text" class="form-control" id="valorAbonoFactura" placeholder="Cuánto Abonaste?"  onkeyup="formatDecilames(this)" onchange="formatDecilames(this)"></div><div class="help-block with-errors"></div></div></div></div>');
                }
            else{
                $("#facturaCredito").html('');
            }
   
   });




//Si invoco el SKU o Codigo de  producto
document.getElementById('skuCodigo').addEventListener('change', function(){
      //Comparo si existe
      //Checkeo sku repetido 
      if (($('#sku')[0].value).length > 0) {
          $.ajax({
            url     : '../../data/ajax/acciones/checkSkuRepetido.php',
            type    : 'POST',
            data: { sku: ""+$('#sku')[0].value+""},
            success :  function(data){
               if (data=='true') {

                $('#nombreProductosServicios').attr('readonly', true);
                  loadFeaturesFromSku($('#sku')[0].value);
               }
               else if(data=='false'){
                $("#nombreProductosServicios").addClass("typeahead form-control");
                $('#nombreProductosServicios').attr('readonly', false);
                $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>');
                $('#precios').html('<div class="col-md-6 col-sm-12"><label>Valor Público</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorVentaPublico" placeholder="Al Cliente" onkeyup="format(this)" onchange="format(this)"  ></div><div class="help-block with-errors"></div></div><div class="col-md-6 col-sm-12"><label>Valor Mayorista</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text"  class="form-control" id="valorVentaMayorista"  placeholder="Al por mayor" onkeyup="format(this)" onchange="format(this)"></div><div>');
                loadCamposSeriales(0);
                $("#nombreProductosServicios").val("");
                $("#idproductosServicios").val("");

               }
            }
          });
      };
});





//*
function loadFeaturesFromSku(sku){
    if (sku.length > 0) {
      //Cargo en JSON los parametros que necesito para ese articulo
      $.ajax({
          url: '../../data/ajax/acciones/checkJsonProductos.php',
          type: 'POST',
          data: { sku : ""+sku+"", nombreProductosServicios : null },
          success: function (data) {
            datos = JSON.parse(data);
            //Lleno los datos que tenga que llenar
             $("#nombreProductosServicios").val(datos.nombreProductosServicios);
             $("#idproductosServicios").val(datos.idproductosServicios);
             $('#volumenes').html('');
             $('#precios').html('');
            if (datos.serializacion == 'si') {
                //Checkeo el tipo de seriales que tiene
               
                if (datos.serial == 'si' && datos.imei == 'si' && datos.otroTipoSerial == 'si') {
                    loadCamposSeriales(0);
                }
                else if (datos.serial == 'si' && datos.imei == 'no' && datos.otroTipoSerial == 'no') {
                      loadCamposSeriales(1);
                }
                else if (datos.serial == 'no' && datos.imei == 'si' && datos.otroTipoSerial == 'si') {
                    loadCamposSeriales(2);
                }
                else if (datos.serial == 'si' && datos.imei == 'no' && datos.otroTipoSerial == 'si') {
                    loadCamposSeriales(3);
                }
                
                else if (datos.serial == 'si' && datos.imei == 'si' && datos.otroTipoSerial == 'no') {
                    loadCamposSeriales(4);
                }
                else if (datos.serial == 'no' && datos.imei == 'si' && datos.otroTipoSerial == 'no') {
                    loadCamposSeriales(5);
                }
                else if (datos.serial == 'no' && datos.imei == 'no' && datos.otroTipoSerial == 'si') {
                    loadCamposSeriales(6);
                }
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



function loadCamposSeriales(parametro){
  $('#volumenesSeriales').html('<div class="col-md-12" align="center"><div  class="btn btn-success col-md-12 addTodosSeriales"><i class="fa fa-plus"></i> Agregar Mas Seriales</div></div>')
  //We love u permutation <3 
  if (parametro === 0 ) { //Todos los seriales
    seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Serial</div><input type="text"  class="form-control col-md-12" id="codigo_serial"  placeholder="Serial"></div><div class="input-group"><div class="input-group-addon">Imei</div><input type="text"  class="form-control col-md-12" id="codigo_imei"  placeholder="separa con - si hay mas imeis"></div><div class="input-group"><div class="input-group-addon">Otro Serial</div><input type="text"  class="form-control col-md-12" id="codigo_otroTipoSerial"  placeholder="Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 45px; padding-bottom: 45px; padding-right: 14px;"><i class="fa fa-trash"></i></div></div>';
  }
  else if(parametro ===1){//Solo seriales
    seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Serial</div><input type="text"  class="form-control col-md-12" id="codigo_serial"  placeholder="Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 10px; padding-bottom: 10px; padding-right: 10px; padding-left: 5px;"><i class="fa fa-trash"></i></div></div>';
  }
  else if(parametro === 2){ //Todos excepto serial 
        seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Imei</div><input type="text"  class="form-control col-md-12" id="codigo_imei"  placeholder="separa con - si hay mas imeis"></div><div class="input-group"><div class="input-group-addon">Otro Serial</div><input type="text"  class="form-control col-md-12" id="codigo_otroTipoSerial"  placeholder="Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 25px; padding-bottom: 25px; padding-right: 14px;"><i class="fa fa-trash"></i></div></div>';

  }
  else if(parametro === 3){ //Todos Excepto imei
      seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Serial</div><input type="text"  class="form-control col-md-12" id="codigo_serial"  placeholder="Serial"></div><div class="input-group"><div class="input-group-addon">Otro Serial</div><input type="text"  class="form-control col-md-12" id="codigo_otroTipoSerial"  placeholder="Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 25px; padding-bottom: 25px; padding-right: 14px;"><i class="fa fa-trash"></i></div></div>';
  }
  else if(parametro === 4){ //Todos excepto serial especial

      seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Serial</div><input type="text"  class="form-control col-md-12" id="codigo_serial"  placeholder="Serial"></div><div class="input-group"><div class="input-group-addon">Imei</div><input type="text"  class="form-control col-md-12" id="codigo_imei"  placeholder="Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 25px; padding-bottom: 25px; padding-right: 14px;"><i class="fa fa-trash"></i></div></div>';
  }
  else if(parametro === 5){//Solo Imeis
        seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Imei</div><input type="text"  class="form-control col-md-12" id="codigo_imei"  placeholder="separa con - si hay mas imeis"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 10px; padding-bottom: 10px; padding-right: 10px; padding-left: 5px;"><i class="fa fa-trash"></i></div></div>';
  }
  else if(parametro === 6){ //Solo serial especial  
      seriales = '<div class="col-md-12" style="margin-top:20px;"><div class="col-md-11"><div class="input-group"><div class="input-group-addon">Otro Serial</div><input type="text"  class="form-control col-md-12" id="codigo_otroTipoSerial"  placeholder="Otro Serial"></div></div><div class="col-md-1 btn-danger" id="removerSeriales" style="padding-top: 10px; padding-bottom: 10px; padding-right: 10px; padding-left: 5px;"><i class="fa fa-trash"></i></div></div>';
  }
    $('.addTodosSeriales').click(function(e){
      $('#volumenesSeriales').append('<div id="serials" >'+seriales+'</div><br>');
  });
  $('#volumenesSeriales').on("click","#removerSeriales", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').remove();
    })

}





/*=================================
=            typerhead            =
=================================*/
//Checkeo lista de los provedores
$.post('../../data/ajax/acciones/typerhead/listaProvedores.php', {}, function(datos) {
    var nombreProvedor = JSON.parse(datos);
    
    $('#nombreProvedor .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'nombreProvedor',
      source: substringMatcher(nombreProvedor)
    });
});

//Checkeo nombre de producto existente
$.post('../../data/ajax/acciones/typerhead/listaProductos.php', {}, function(datos) {
    var productos = JSON.parse(datos);
    
    $('#productosServicios .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'productos',
      source: substringMatcher(productos)
    });
});


//Checkeo SKU existentes
$.post('../../data/ajax/acciones/typerhead/listaSkuCodigos.php', {}, function(datos) {
    var skuCodigo = JSON.parse(datos);
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


/*=====  End of typerhead  ======*/


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
                seriales.push(limpiadorCaracteres($('[id=codigo_serial]')[i].value));
            };
          };//Existen seriales
          if (($('[id=codigo_imei]').length)>0) {
            for (var i = $('[id=codigo_imei]').length - 1; i >= 0; i--) {
                imeis.push(limpiadorCaracteres($('[id=codigo_imei]')[i].value));
            };
          };//Existen imeis
          if (($('[id=codigo_otroTipoSerial]').length)>0) {
            for (var i = $('[id=codigo_otroTipoSerial]').length - 1; i >= 0; i--) {
                serialesEspeciales.push(limpiadorCaracteres($('[id=codigo_otroTipoSerial]')[i].value));
            };
          };//Existen Otros Tipo de serial
          //Consulta de tipo de seriales
          
          //Repartir TABLAS según las serializaciones 
          //[SI ][ SI ][ SI]
          if (seriales.length > 0 && imeis.length > 0 && serialesEspeciales.length > 0) {
                  unidadesCompradas = seriales.length;
                  //console.log('TODOS');
                  tablas = '<tr id="lts"><td align="center"><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /><input type="hidden" id="sku_" value="'+sku.value+'"> '+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+imeis+'|'+serialesEspeciales+'" onclick="showDetails(this)" ></i><input type="hidden" id="imeisandserials" value = "{'+seriales+'|'+imeis+'|'+serialesEspeciales+'" /><i class="fa fa-minus-circle text-danger" id="closeSerial" style="display: none"></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[SI][NO][NO]
          else if (seriales.length > 0 && imeis.length == 0 && serialesEspeciales.length == 0) {
              unidadesCompradas = seriales.length;
               //console.log('SOLO SERIALES');

              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /><td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green" id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'" onclick="showDetails(this)"  ></i><input type="hidden" id="imeisandserials" value = "{'+seriales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }

          //[NO][SI][SI] 
          else if (seriales.length == 0 && imeis.length > 0 && serialesEspeciales.length > 0) {
              unidadesCompradas = imeis.length;
             //console.log('TODOS MENOS SERIAL');
             //console.log(unidadesCompradas);
            tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+imeis+'|'+serialesEspeciales+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "{'+imeis+'|'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }

          //[SI][NO][SI]
          else if (seriales.length > 0 && imeis.length == 0 && serialesEspeciales.length > 0) {
            unidadesCompradas = seriales.length;
             //console.log('TODOS EXCEPTO IMEIS');
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+serialesEspeciales+'" onclick="showDetails(this)"></i> <input type="hidden" id="imeisandserials" value = "{'+seriales+'|'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[SI][SI][NO]
          else if (seriales.length > 0 && imeis.length > 0 && serialesEspeciales.length == 0) {
            unidadesCompradas = seriales.length;
            //console.log('todos menos serial especial');
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+imeis+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "{'+seriales+'|'+imeis+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[NO][SI][NO]
          else if (seriales.length == 0 && imeis.length > 0 && serialesEspeciales.length == 0) {
            unidadesCompradas = parseInt(imeis.length);
           // console.log("Unidades: "+unidadesCompradas)
            
             tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+imeis+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "{'+imeis+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
              //tablas = '<tr id="lts"><tr><td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+valorUnidad.value+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+mathValorNeto(unidadesCompradas, valorUnidad)+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green" id="openSerials"></i><i class="fa fa-minus-circle text-danger" id="closeSerial" style="display: none"></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr><tr id="ts"><!-- SERIALS--><td  colspan="8" id="listSerials"><div class="col-md-12"><label>Imei:</label>'+listasSeriales(imeis)+'</div></td</tr></tr>';
          }
          //[NO][NO][SI]
          else if (seriales.length == 0 && imeis.length == 0 && serialesEspeciales.length > 0) {
            unidadesCompradas = serialesEspeciales.length;
             //console.log('SOLO SERIAL ESPECIAL');
            tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+serialesEspeciales+'" onclick="showDetails(this)"></i><input type="hidden" id="imeisandserials" value = "{'+serialesEspeciales+'" /></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
          }
          //[NO][NO][NO]
          else 
          {   
              unidadesCompradas = parseInt(cantidades.value);
              tablas = '<tr id="lts"><input type="hidden" id="new" value="0"/><input type="hidden" id="valorVentaMayorista_" value="0" /><input type="hidden" id="valorVentaPublico_" value="0" /> <td align="center"><input type="hidden" id="sku_" value="'+sku.value+'">'+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'">'+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td><td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"></i><i class="fa fa-minus-circle text-danger" id="closeSerial" ></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';
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
            text: "No puedo dejarte agregar este producto hasta que no llenes los campos del sku, nombre del producto y cuanto costó",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
        }
        


    }else {
       // es un producto nuevo 
       if (nombreProductosServicios.value.length > 2  && sku.value.length >0) {
          var seriales=[];
          var imeis=[];
          var serialesEspeciales=[];
         if (($('[id=codigo_serial]').length)>0) {
            for (var i = $('[id=codigo_serial]').length - 1; i >= 0; i--) {
                seriales.push(limpiadorCaracteres($('[id=codigo_serial]')[i].value));
            };
          };//Existen seriales
          if (($('[id=codigo_imei]').length)>0) {
            for (var i = $('[id=codigo_imei]').length - 1; i >= 0; i--) {
                imeis.push(limpiadorCaracteres($('[id=codigo_imei]')[i].value));
            };
          };//Existen imeis
          if (($('[id=codigo_otroTipoSerial]').length)>0) {
            for (var i = $('[id=codigo_otroTipoSerial]').length - 1; i >= 0; i--) {
                serialesEspeciales.push(limpiadorCaracteres($('[id=codigo_otroTipoSerial]')[i].value));
            };
          };//Existen Otros Tipo de serial

        
          if (cantidades.value == 0 ) {

                if (imeis.length > 0) {
                  unidadesCompradas = imeis.length;
                }else if (seriales.length >0 ) {
                  unidadesCompradas = seriales.length;
                }else if (serialesEspeciales.length > 0) {
                  unidadesCompradas = seriales.length;
                };
          }else {
            unidadesCompradas = cantidades.value;
          }
          tablas = '<tr id="lts"><input type="hidden" id="new" value="1"/> <input type="hidden" id="valorVentaPublico_" value="'+valorVentaPublico.value+'" /><input type="hidden" id="valorVentaMayorista_" value="'+valorVentaMayorista.value+'" /><td align="center"><input type="hidden" id="sku_" value="'+sku.value+'"> '+sku.value+'</td><td><input type="hidden" id="idproductosServicios_" value="'+idproductosServicios.value+'"> '+nombreProductosServicios.value+'</td><td align="center"><input type="hidden" id="valorUnidad_" value="'+valorUnidad.value+'">'+formatDecilames(valorUnidad.value)+'</td><td align="center"><input type="hidden" id="unidades" value="'+unidadesCompradas+'">'+unidadesCompradas+'</td><td align="center"><input type="hidden" id="valorNeto" value="'+mathValorNeto(unidadesCompradas, valorUnidad)+'">'+formatDecilames(mathValorNeto(unidadesCompradas, valorUnidad))+'</td> <td align="center"><input type="hidden" id="valorTotal" value="'+mathValorTotal(unidadesCompradas, valorUnidad, impuesto)+'">'+formatDecilames(mathValorTotal(unidadesCompradas, valorUnidad, impuesto))+'</td><input type="hidden" id="impuesto_" value="'+impuesto.value+'"><td align="center"><i class="fa fa-plus-circle text-green"  id="openSerials" data-toggle="modal" data-target="#serialsImeis" data-seriales="'+seriales+'|'+imeis+'|'+serialesEspeciales+'" onclick="showDetails(this)" ></i><input type="hidden" id="imeisandserials" value = "{'+seriales+'|'+imeis+'|'+serialesEspeciales+'" /><i class="fa fa-minus-circle text-danger" id="closeSerial" style="display: none"></i></td><td><i class="fa fa-trash" id="deleteRow"></i></td></tr>';

          $('#listadoProductos').append(tablas);
          
          //Remover 
          $('.white-box').on("click","#deleteRow", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parent("tr").remove();
                $(this).closest("tr").remove();
                calcular()
              })
          calcular();
          clearCampos();
       }  
        else{
          swal({   
            title: "Ops!",   
            text: "No puedo dejarte agregar este producto hasta que no llenes los campos del sku, nombre del producto y cuanto costó",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
        }
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


function validarDatosInventatio(){
  if (provedor.value.length <= 2) {
    swal({   
            title: "Auch!",   
            text: "Necesito que me des el nombre del provedor, sin eso no lo puedo guardar",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
  }

  else if (nroFacturaProvedor.value.length <= 3) {
    swal({   
            title: "Auch!",   
            text: "El número de la factura es importante que lo pongas para luego identificar la compra",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
  }


  else if (fechaFacturaProvedor.value.length ==0) {
    swal({   
            title: "Auch!",   
            text: "Necesito que señales la fecha de compra",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
  }


  else if ($('[id=sku_]').length == null || $('[id=sku_]').length  == 0) {
    swal({   
            title: "Auch!",   
            text: "Necesito que registres al menos un producto",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
  }



  else{
    return true;
  }
}

/*=====  End of VALIDATION  ======*/


