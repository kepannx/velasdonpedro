
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




//Valores del punto de venta
$(document).ready(function(){

    $.ajax({
      url: 'data/ajax/acciones/getInfoPuntoVenta.php',
      type: 'POST',
      dataType: 'JSON',
      data: {},
    })
    .done(function(datos) {
      //Verifico el iva
      if (datos.regimenTributario === 'regimen comun') {
          loadTaxes(); //Los impuestos segun el regimen
      }

    })
    
});


//Cargo los impuestos
function loadTaxes(){
  $.post('data/ajax/acciones/loadTaxes.php', {}, function(data) {
    $('#taxes').html(data);
  });
}

//Si invoco el SKU o imei/serial de  producto
document.getElementById('skuCodigo').addEventListener('change', function(){
      
    //Comparo si existe Checkeo sku repetido 
      if (($('#sku')[0].value).length > 0) {
          $.ajax({
            url     : 'data/ajax/acciones/checkSkuRepetido.php',
            type    : 'POST',
            data: { sku: ""+$('#sku')[0].value+"" },
            success :  function(data){

               if (data=='true') {//Si existe entonces cargo las caracteristicas del producto
                console.log($('#sku')[0].value);
                  loadFeaturesFromSku($('#sku')[0].value);

               }

               //

               else if(data=='false'){
                  $('#nombreProductosServicios').val('');
                  $('#valorUnidad').val('');
                  $('#cantidades').val(0);
                //Checkeo con SERIAL/IMEI
                console.log('no existe y checkeo serial imei');
                checkExistenciaSerialImei($('#sku')[0].value);
               }
            }
          });
      };
});





function checkExistenciaSerialImei(parametro){
    $.ajax({
      url: 'data/ajax/acciones/checkImeiSerial.php',
      type: 'POST',
      dataType: 'JSON',
      data: { imeiSerial: ''+parametro+''},
    })
    .done(function(datos) {
      if (datos.codigo === null) {
        $('#costo').html('');
        $('#sku').val('');
        $('#nombreProductosServicios').html('');
        swal({   
                        title: "Auch!",   
                        text: "Lo que quieres registrar no lo tengo en tu inventario O ya esta pre-facturado",
                        type: "error",   
                        timer: 4000,   
                        showConfirmButton: true 
                    });
      }else{

        $('#taxes').html(' <input type="hidden" id="impuesto" value="0"><input id="serializado" type="hidden" value="'+datos.tipo+'"><input type="hidden" id="idproductosServicio" value="'+datos.idProductoServicio+'"><input type="hidden" value="1" id="cantidades"><div class="col-md-12 col-m-12"><label>Costo Unidad?</label><div class="input-group"><div class="input-group-addon" ><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorUnidad" value="'+datos.valorVentaUnidad+'" placeholder="Costo Unidad" onkeyup="format(this)" onchange="format(this)" autofocus ></div><div class="help-block with-errors"></div></div>')
        valorUnidad.focus();
        $('#nombreProductosServicios').html('<h3>'+datos.nombreProductosServicios+'<h3>');

        
        //Poner el analisis del impuesto en esta linea



        
        //Checkear Impuestos
      }

    })

   
}

//Si invoco el SKU o Codigo de  producto
document.getElementById('identificacionCliente').addEventListener('change', function(){
      //Comparo si existe
      //Checkeo sku repetido 

      if (($('#identificacionCliente').val()).length > 0) {

          $.ajax({
            url     : 'data/ajax/acciones/checkClienteAnterior.php',
            type    : 'POST',
            data: { identificacionCliente: ""+$('#identificacionCliente').val()+"" },
            success :  function(datos){
          if (datos==1) {
                $('#nombreCliente').attr('disabled', true);
                $('#emailCliente').attr('disabled', true);
                $('#ciudadCliente').attr('disabled', true);
                $('#direccionCliente').attr('disabled', true);
                $('#telefonoCliente').attr('disabled', true);
                  loadDataCustomers($('#identificacionCliente').val());
               }
               else  {
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
                  //$('#tipoCliente').html('<select id="tipoDocumento" class="form-control "><option value="Cedula Ciudadania">C.C</option><option value="NIT">NIT</option><option value="NIT">Pasaporte</option><option value="Cedula de Extranjeria">C.E</option><option value="Tarjeta de Identidad">C.E</option><option value="Otro">Otro</option></select>')
               }
            }
          });
      };
});



//Cargo las caracteristicas que necesito  para ese  producto
function loadFeaturesFromSku(sku){
    if (sku.length > 0) {
      //Cargo en JSON los parametros que necesito para ese articulo
      $.ajax({
          url: 'data/ajax/acciones/checkJsonProductos.php',
          type: 'POST',
          data: { sku : ""+sku+"", nombreProductosServicios : null },
          success: function (data) {
            datos = JSON.parse(data);
            //Lleno los datos que tenga que llenar
             $("#nombreProductosServicios").val(datos.nombreProductosServicios);

             var promesa = checkexistencia(datos.idproductosServicios);


                  promesa.success(function (data) {
                    //verifico si el producto tiene serial  o no
                      if ((datos.serializacion)=='no') { //no tiene serial
                          $('#costo').html('<div class="col-md-6"><label>Costo Unidad?</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorUnidad" value="'+datos.valorVentaUnidad+'" placeholder="Costo Unidad" onkeyup="format(this)" onchange="format(this)" autofocus ></div><div class="help-block with-errors"></div></div> <div class="col-md-6"><label>Unidades</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" value="1" min="1" max="'+data.numero+'" placeholder="Unidades" onchange="checking(this, '+data.numero+')"  ></div><div class="help-block with-errors"></div></div>');
                          //adiciono los impuestos correspondientes al producto cargado
                          $('#taxes').html('<input type="hidden" id="serializado" value="null"><input type="hidden" id="impuesto" value="'+datos.impuesto+'"><input type="hidden" id="idproductosServicio" value="'+datos.idproductosServicios+'"> ');

                          valorUnidad.focus();

                      }else{//si tiene serial
                        console.log('aqui tiene serial, y debe cargarse');
                         $('#costo').html(' <input type="text" value="1" id="cantidades" ><div class="col-md-12"><label>Costo Unidad?</label><div class="input-group"><div class="input-group-addon" id="alertacosto"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorUnidad" value="'+datos.valorVentaUnidad+'" placeholder="Costo Unidad" onkeyup="format(this)" onchange="format(this)" autofocus ></div><div class="help-block with-errors"></div></div>');
                          //adiciono los impuestos correspondientes al producto cargado
                          $('#taxes').html('<input type="hidden" id="impuesto" value="'+datos.impuesto+'"><input type="hidden" id="idproductosServicio" value="'+datos.idproductosServicios+'">  ');

                      }
                  })
        $('#nombreProductosServicios').html('<h3>'+datos.nombreProductosServicios+'<h3>');
             delete window.sku;
          }
        });
    };
  }


//LOAD DATA CUSTOMERS
function loadDataCustomers(identificacionCliente){
    if (identificacionCliente.length > 0) {
      //Cargo en JSON los parametros que necesito para ese cliente
      $.ajax({
          url: 'data/ajax/acciones/checkJsonCliente.php',
          type: 'POST',
          data: { identificacionCliente : ""+identificacionCliente+"" },
          success: function (data) {
            datos = JSON.parse(data);
            //Lleno los datos que tenga que llenar
             $("#nombreCliente").val(datos.nombreCliente);
             $("#emailCliente").val(datos.emailCliente);
             $("#ciudadCliente").val(datos.ciudadCliente);
             $("#direccionCliente").val(datos.direccionCliente);
             $("#telefonoCliente").val(datos.telefonosCliente);
             $("#idCliente").val(datos.idcliente);
             $('#tipoCliente').html('<input type="text" class="form-control" id="tipoDocumento"  value="'+datos.tipoDocumento+'" data-error="Debes decirme la identificación del cliente " disabled required>')

          }
        });
    };
  }




//Evita que traslade mas cantidades de las que existen en un punto de venta
 function checking(parametro, maximo){
        var trasladar= parseInt(parametro.value);
        if ((trasladar)>maximo) {
           $('#cantidades').val('');
           $('#cantidades').focus().val('');
              swal({   //Error en caso que no exista el producto
                        title: "Ops!",   
                        text: "No puedo dejarte trasladar "+trasladar+" productos porque el punto de venta tiene en el inventario un máximo de "+maximo+" ",
                        type: "warning",   
                        timer: 5000,   
                        showConfirmButton: true 
                    });

        };
             
          }




//Verifico la cantidad de unidades existentes
function checkexistencia(idProducto){
    return $.ajax({
          url: 'data/ajax/acciones/checkExistenciaOrigen.php',
          type    : 'POST',
          dataType: 'JSON',
          data: {idProducto : ''+idProducto+''},
    })

}




/*
//Listo los seriales e imeis de un producto en especifico
function loadProductosSerialImei(parametro){
  $.post('data/ajax/acciones/serialesImeisDisponibles.php', {
        idProducto : ''+parametro+'' }, function(datosTabla) {
    $('#volumenesSeriales').html(datosTabla);
  });


}


*/
/*=================================
=            typerhead            =
=================================*/
$.post('data/ajax/acciones/typerhead/listaSkuCodigos.php', { }, function(datos) {
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
$.post('data/ajax/acciones/typerhead/listaIdentificacionClientes.php', { }, function(datos) {
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
  console.log('aqui esta');
    loadBtnSave();
    $('#opcionEfectivo').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon">En Efectivo Pagará:</span> <input type="text" class="form-control" id="valorEfectivo" onkeyup="format(this); recalcularValoresPerfilPago(this);" onchange="format(this); recalcularValoresPerfilPago(this);" placeholder="Cuánto Pagará en Débito "   ></div><div class="help-block with-errors"></div></div>');
    calcular();
    }else{
       $('#opcionEfectivo').html('');
      loadBtnSave();
    }
});


//Si es Débito
document.getElementById('debito').addEventListener('click', function(){
if (($('[id=debito]')[0].checked)===true){
    $('#opcionDebito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon">En Debito Pagará:</span> <input type="text" class="form-control" id="valorDebito" onkeyup="format(this); recalcularValoresPerfilPago(this);" onchange="format(this); recalcularValoresPerfilPago(this);"  placeholder="Cuánto Pagará en Débito " value=""  ></div><div class="help-block with-errors"></div></div>');
    loadBtnSave();
    }else{
      $('#opcionDebito').html('');
      loadBtnSave();
    }

});


//Es credito
document.getElementById('credito').addEventListener('click', function(){
if (($('[id=credito]')[0].checked)===true){
    $('#opcionCredito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon"><i class=""></i>En Crédito Pagará:</span> <input type="text" class="form-control" id="valorCredito" onkeyup="format(this); recalcularValoresPerfilPago(this);" onchange="format(this); recalcularValoresPerfilPago(this);"  placeholder="Cuánto Pagará en Credito " value="" ></div><div class="help-block with-errors"></div></div>');
      loadBtnSave()
    }else{
      $('#opcionCredito').html('');
      loadBtnSave();
    }

});


//Es cheque
document.getElementById('cheque').addEventListener('click', function(){
if (($('[id=cheque]')[0].checked)===true){
     $('#opcionCheque').html('<div class="col-md-12"><div class="form-group col-md-6"><div class="input-group"><span class="input-group-addon"><i class=""></i>Valor Cheque</span> <input type="text" class="form-control" id="valorCheque" onkeyup="format(this);" onchange="format(this); recalcularValoresPerfilPago(this);" placeholder="Cuánto Pagará en Credito "   ></div><div class="help-block with-errors"></div></div><div class="form-group col-md-6"><div class="input-group"><span class="input-group-addon"><i class="icon-calender"></i> Cobralo El </span><input type="date" class="form-control" id="fechaCobroCheque"  > </div></div></div></div>');
      loadBtnSave();
    }else{
      $('#opcionCheque').html('');
      loadBtnSave();
    }

});

//Es servicredito
document.getElementById('servicredito').addEventListener('click', function(){
if (($('[id=servicredito]')[0].checked)===true){
    $('#opcionServicredito').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon"><i class=""></i>Servicredito Pagará:</span> <input type="text" class="form-control" id="valorServicredito" onkeyup="format(this);" onchange="format(this); recalcularValoresPerfilPago(this);" placeholder="Cuánto Pagará Servicredito "   ></div></div>');
      loadBtnSave();
    }else{
      $('#opcionServicredito').html('');
      loadBtnSave();
    }

});


/*
document.getElementById('epm').addEventListener('click', function(){
if (($('[id=epm]')[0].checked)===true){
    $('#opcionEpm').html('<div class="form-group col-md-12"><div class="input-group"><span class="input-group-addon"><i class=""></i>En EPM Pagará:</span> <input type="text" class="form-control" id="valorEpm" onkeyup="format(this);" onchange="format(this); recalcularValoresPerfilPago(this);" placeholder="Cuánto Pagará Servicredito "   ></div></div>');
      loadBtnSave();
    }else{
      $('#opcionEpm').html('');
      loadBtnSave();
    }

});*/

document.addEventListener('keyup', function(e){
if (e.keyCode == 121) {
    $('#foraneo').html('<input type="checkbox" class="js-switch"  id="fc" data-color="#13dafe"/>');
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
    setTimeout(function(){ $('#foraneo').html('') }, 10000);
};
});





//Cargo las caracteristicas que necesito  para ese  producto
/*
if (($('[id=tipoDocumento]')[0].selected)==='NIT'){
}else{
}
*/





//Me suma y convierte  automáticamente los valores que voy metiendo en los metodos de pago
function recalcularValoresPerfilPago(parametro){
/*
  var valorBase=parseInt($('[id=totalhide]')[0].value);
  //pago en efectivo y debito
  if ((($('[id=efectivo]')[0].checked)==true) && (($('[id=debito]')[0].checked)==true)) {
      var vd=parseInt($('[id=valorDebito]')[0].value.replace(/\./g,''));
      var ve=parseInt($('[id=valorEfectivo]')[0].value.replace(/\./g,''));
      if ((parametro.id)=='valorEfectivo'){//Estoy cambiando valor de efectivo
        if (vd>ve) {
          var resultado= valorBase-vd;
        }else if(vd<=ve){ var resultado= valorBase-ve; };
        if (resultado<0) { resultado=0};
        $('#valorDebito').val(formatDecilames(resultado));

      }else if ((parametro.id)=='valorDebito'){//Estoy cambiando valor de debto
          if (vd>ve) {var resultado= valorBase-vd;}else if(vd<=ve){ var resultado= valorBase-vd;};
          if (resultado<0) { resultado=0};
          $('#valorEfectivo').val(formatDecilames(resultado));
      }
  };



  //pago en  efectivo y tarjeta
  if ((($('[id=efectivo]')[0].checked)==true) && (($('[id=credito]')[0].checked)==true)) {

      var vc=parseInt($('[id=valorCredito]')[0].value.replace(/\./g,''));
      var ve=parseInt($('[id=valorEfectivo]')[0].value.replace(/\./g,''));
      if ((parametro.id)=='valorEfectivo'){//Estoy cambiando valor de efectivo
       
        if (vc>ve) {
          var resultado= valorBase-vc; 
        }else if(vc<=ve){ var resultado= valorBase-ve;};
        
        if (resultado<0) { resultado=0};
        $('#valorCredito').val(formatDecilames(resultado));
      }

      else if ((parametro.id)=='valorCredito'){//Estoy cambiando valor de debto
          if (vc>ve) {var resultado= valorBase-vc;}else if(vc<=ve){ var resultado= valorBase-vc;};
          if (resultado<0) { resultado=0};
          $('#valorEfectivo').val(formatDecilames(resultado));
      }
  };

*/
}




function loadBtnSave(){

  if ((($('[id=efectivo]')[0].checked)===true) || (($('[id=cheque]')[0].checked)===true) || (($('[id=credito]')[0].checked)===true) || (($('[id=debito]')[0].checked)===true) || ($('[id=servicredito]')[0].checked)===true) {
  $('#saveFactura').css("display", "block");
}else{
  $('#saveFactura').css("display", "none");
}
}
/*=====  End of OPCIONES DE METODOS DE PAGO ======*/








/*===========================================
=            NUEVO SAVE PRODUCTO            =
===========================================*/



/*=====  End of NUEVO SAVE PRODUCTO  ======*/
document.getElementById('addArticulo').addEventListener('click', function(){
  if ((valorUnidad.value.length)==0) {
      swal({   //Error en caso que no exista el producto
                        title: "Ops!",   
                        text: "Necesito que le des un valor de venta a este producto",
                        type: "warning",   
                        timer: 3000,   
                        showConfirmButton: true 
                    });
  }else{


 
    console.log('dato:'+idproductosServicio.value);
    $.ajax({
      url: 'data/ajax/insercionDatos/guardarPreFactura.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
          codigo: ''+sku.value+'',
          idProductoServicio: ''+idproductosServicio.value+'',
          nombreProductosServicios : ''+nombreProductosServicios.value+'',
          valorUnidad: ''+valorUnidad.value+'',
          cantidades : ''+cantidades.value+'',
          tipoDocumento : ''+tipoDocumento.value+'',
          tokenPrefactura : ''+tokenPrefactura.value+'',
          impuesto : ''+impuesto.value+'',
          serializado : ''+serializado.value+''
    },
    })
    .done(function(data) {
      console.log(data.Registrado);

      if ((data.Registrado)==0) {
          $.post('data/ajax/acciones/listaPreFactura.php', { tokenPrefactura : ''+tokenPrefactura.value+'' }, function(datosTabla) {
              $('#sku').val('');
              console.log();
              $('#preFacturacion').html(datosTabla);
              calcular();
              });  
        }else if ((data.Registrado)==1) {
              swal({   //Error en caso que no exista el producto
                        title: "Ops!",   
                        text: "Para facturar este producto debes hacerlo con el serial o imei",
                        type: "warning",   
                        timer: 3000,   
                        showConfirmButton: true 
                    });
          //Exste pero hay que registrarlo con serial o imei
        }else if ((data.Registrado)==2) {

        }else if ((data.Registrado)==3) {
           swal({   //Error en caso que no exista el producto
                        title: "Ops!",   
                        text: "El producto no existe o ya esta pre-facturado",
                        type: "warning",   
                        timer: 3000,   
                        showConfirmButton: true 
                    });
          //El producto no esta en inventario O ESTA PRE-FACTURADO
        }
          $('#sku').val('');
          $('#nombreProductosServicios').html('');
          $('#costo').html('');
    })
    
    

  };
/*
*/
});


function deleteRow(parametro){

  $.ajax({
    url: 'data/ajax/acciones/deleteRow.php',
    type: 'POST',
    dataType: 'JSON',
    data: {idRow : ''+parametro+''},
  })
  .done(function(datosDelete) {

        console.log(datosDelete);

  });


  $.post('data/ajax/acciones/listaPreFactura.php', { tokenPrefactura : ''+tokenPrefactura.value+''  }, function(datosTabla) {
              $('#sku').val('');
              $('#preFacturacion').html(datosTabla);
              });  
  
  
}


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
                //$("#impuesto").val("");
                $("#cantidades").val("");
                $("#idproductosServicios").val("");
                $("#precios").html("");
                $("#volumenesSeriales").html('');
                           
}
/*=====  End of ADD A PREFACTURACION  ======*/





/*============================
=            MATH            =
============================*/


//Calculo el valor base sin el impuesto
function mathValorNeto(valorUnidad,impuesto){
  unidadesCompradas = parseInt(unidadesCompradas);
  valorUnidad = parseInt(valorUnidad.value.replace(/\./g,''));
  impuesto = parseFloat(impuesto.value);
  convercionImpuesto = (impuesto/100)+1;//Para que quede en (1.x)

  return Math.floor(valorUnidad/convercionImpuesto);

}



function   mathValorTotal(unidadesCompradas, valorUnidad){
    valorUnidad = valorUnidad.value.replace(/\./g,'');
    unidadesCompradas = parseInt(unidadesCompradas);
    valorUnidad = parseInt(valorUnidad);
    return (unidadesCompradas*valorUnidad);

}





function redondear(value) {
   return value - (value % 5);
}




//Sumatorias
 var variableAcumuladora =0;
//Calculo todos los valores que hay en el final de la factura o remisión
function calcular(){
  var valor=0;
  for (var i = $('[id=valorTotal]').length - 1; i >= 0; i--) {
                valor=valor+(parseInt($('[id=valorTotal]')[i].value));
            };
    $('#valorEfectivo').val(formatDecilames(valor));
}



function formatDecilames(input){
var num = input;
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}
/*=====  End of MATH  ======*/




