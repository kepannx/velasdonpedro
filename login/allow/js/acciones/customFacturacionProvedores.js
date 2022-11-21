
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


//Opciones de la serialización
document.getElementById('estadoFactura').addEventListener('change', function(){
      if (($('[id=estadoFactura]')[0].value)=='credito') {
                  $("#facturaCredito").html('<div class="col-md-12"><div class="col-md-6 col-sm-12"><div class="form-group"><label>Cuándo Quedaste En Pagarle?</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="date" class="form-control fechas" id="fechaCompromisoPago" placeholder="Cuando lo compraste"  data-error="Cuándo quedaste en pagarle?"   required></div><div class="help-block with-errors"></div></div></div><div class="col-md-6 col-sm-12"><div class="form-group"><label>Cuánto Le Abonaste?</label><div class="input-group" id="nombreProvedor"><div class="input-group-addon"><i class="fa fa-credit-card-alt"></i></div><input type="text" class="form-control" id="valorAbonoFactura" placeholder="Cuánto Abonaste?"  onkeyup="format(this)" onchange="format(this)"></div><div class="help-block with-errors"></div></div></div></div>');
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
            url     : '../../data/ajax/acciones/checkSkuAdd.php',
            type    : 'POST',
            data: { sku: ""+$('#sku')[0].value+"", id: ""+id.value+"" },
            success :  function(data){
               if (data== 1) {

                $('#nombreProductosServicios').attr('readonly', true);
                  loadFeaturesFromSku($('#sku')[0].value);
               }
               else if(data== 0){ //El producto no esta registrado
                $("#nombreProductosServicios").addClass("typeahead form-control");
                $('#nombreProductosServicios').attr('readonly', false);
                $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>');
                $('#precios').html('<div class="col-md-6 col-sm-12"><label>Valor Público</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorVentaPublico" placeholder="Al Cliente" onkeyup="format(this)" onchange="format(this)"  ></div><div class="help-block with-errors"></div></div><div class="col-md-6 col-sm-12"><label>Valor Mayorista</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text"  class="form-control" id="valorVentaMayorista"  placeholder="Al por mayor" onkeyup="format(this)" onchange="format(this)"></div><div>');
                //categorias/SubCagegorias
                loadCategorias();

               
                loadCamposSeriales(0);
                $("#nombreProductosServicios").val("");
                $("#idproductosServicios").val(0);

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
             $("#idproductosServicios").val(datos.idproductosServicios);
             $('#volumenes').html('');
             $('#precios').html('');
             $('#categorias').html('');
             $('#subCategoria').html('');         
            if (datos.serializacion == 'si') {  //Tienen Serial
                loadCamposSeriales(0);
                $('#volumenes').html('<input type="hidden" id="cantidades" value="0" /><input type="hidden" id="tipo" value="serial" />');
                $('#precios').html('<div class="col-md-6 col-sm-12"><label>Valor Público</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorVentaPublico" placeholder="Al Cliente" onkeyup="format(this)" onchange="format(this)" value="'+datos.valorVentaUnidad+'"  ></div><div class="help-block with-errors"></div></div><div class="col-md-6 col-sm-12"><label>Valor Mayorista</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text"  class="form-control" id="valorVentaMayorista"  placeholder="Al por mayor" onkeyup="format(this)" onchange="format(this)" value="'+datos.valorVentaPorMayor+'" ></div><div><input type="hidden" id="categoria" value="'+datos.categoria+'"><input type="hidden" id="subCategorias" value="'+datos.subCategoria+'">');
                $('#categorias').html('');
                $('#subCategoria').html('');
            }
            else if(datos.serializacion == 'no'){ //No tienen serial
                  $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"><input type="hidden" id="tipo" value="unserial" /></div></div>');
                  $('#precios').html('<div class="col-md-6 col-sm-12"><label>Valor Público</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorVentaPublico" placeholder="Al Cliente" onkeyup="format(this)" onchange="format(this)" value="'+datos.valorVentaUnidad+'"  ></div><div class="help-block with-errors"></div></div><div class="col-md-6 col-sm-12"><label>Valor Mayorista</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text"  class="form-control" id="valorVentaMayorista"  placeholder="Al por mayor" onkeyup="format(this)" onchange="format(this)" value="'+datos.valorVentaPorMayor+'" ></div><div><input type="hidden" id="categoria" value="'+datos.categoria+'"><input type="hidden" id="subCategorias" value="'+datos.subCategoria+'">');
                  $('#volumenesSeriales').html('');
                  $('#categorias').html('');
                  $('#subCategoria').html('');

                }
            else{
                $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>');
                $('#precios').html('<div class="col-md-6 col-sm-12"><label>Valor Público</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text" class="form-control" id="valorVentaPublico" placeholder="Al Cliente" onkeyup="format(this)" onchange="format(this)"  ></div><div class="help-block with-errors"></div></div><div class="col-md-6 col-sm-12"><label>Valor Mayorista</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-dollar"></i></div><input type="text"  class="form-control" id="valorVentaMayorista"  placeholder="Al por mayor" onkeyup="format(this)" onchange="format(this)"></div><div><input type="hidden" id="categoria" value="'+datos.categoria+'"><input type="hidden" id="subCategorias" value="'+datos.subCategoria+'">');
                $("#nombreProductosServicios").val("");
                $("#idproductosServicios").val(0);
            }
          }
        });
    };
  }





//Cargo las categorias que existen

function loadCategorias(){
  $.post('../../data/ajax/acciones/loadSelectCategorias.php', {tipo: 'categoria', padre : null }, function(data) {
    /*optional stuff to do after success */
       $('#categorias').html('<div class="col-md-12"><select id="categoria" class="form-control"><option>Categoria</option> '+data+'</select><div>');
      
       $('#categoria').change(function(){
        var padre = $( "#categoria option:selected" ).val();
         loadSubCategorias(padre);
        });
  });
}



//Cargo las subcagegorias
function loadSubCategorias(padre){
  $.post('../../data/ajax/acciones/loadSelectCategorias.php', {tipo: 'subCategoria', padre :  ''+padre+'' }, function(dataSubCategoria) {
    $('#subCategoria').html('<div class="col-md-12"><select id="subCategorias" class="form-control"><option>SubCategoria</option>'+dataSubCategoria+'</select></div><div class="col-md-12"> <a href="#" >Crear Nueva Categoria/SubCategoria </a></div><div class="col-md-12"><select id="tipo" onchange="loadBtn(this.value)" class="form-control"><option value="serial">Con Serial</option><option value="unserial">Sin Serial</option></select></div>');
  });




}



function loadBtn(parametro){
  console.log(parametro);
  if (parametro=='unserial') {
      $('#volumenesSeriales').html('');
    }else{
        $('#volumenesSeriales').html('<div class="col-md-12" align="center"><div  class="btn btn-success col-md-12 addTodosSeriales" data-toggle="modal" data-target=".pre-serializacion" onclick="loadNames()" class="model_img img-responsive"><i class="fa fa-plus"></i> Agregar Mas Seriales</div></div>');
    }
}



function loadCamposSeriales(parametro){
  $('#volumenesSeriales').html('<div class="col-md-12" align="center"><div  class="btn btn-success col-md-12 addTodosSeriales" data-toggle="modal" data-target=".pre-serializacion" onclick="loadNames()" class="model_img img-responsive"><i class="fa fa-plus"></i> Agregar Mas Seriales</div></div>')

  
    $('#addSeriales').click(function(e){
      delete window.seriales;
      var seriales=[];
      var cantidades=0;

        console.log('Load');
       $.post('../../data/ajax/acciones/listaPreSeriales.php', { token : ''+$('#token').val()+'', sku : ''+$('#sku').val()+'' }, function(datosTabla) {
              $('#volumenesSeriales').html(datosTabla);
              }); 

      /*
      if (($('[id=preCodigos]').length)>0) {
            for (var i = $('[id=preCodigos]').length - 1; i >= 0; i--) {
                seriales.push('<div id="codigo_serial" class="btn btn-info col-md-12" >'+ $('[id=preCodigos]')[i].name +'</div>');
                cantidades=cantidades+1;
            };
          };//Existen seriales 

          */

      //$('#volumenesSeriales').append('<div id="serials" class="col-md-12" style="text-align:center margin-bottom: 10px;">'+seriales+'</div>');
      $('#cantidades').val(($('[id=code]').length));
      $('#cantidades').attr('readonly', true);
  });
  $('#volumenesSeriales').on("click","#removerSeriales", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').remove();
    })

}



//Cargo el nombre que haya en el nombre de producto del formulario de ingreso de producto y lo envío como parametro en caso que haya seriales o imeis
function loadNames(){
  $('#perfilProducto').html('<h3 align="center">' + $('#nombreProductosServicios').val()+'</h3>');
}

/*=================================
=            typerhead            =
=================================*/
//Checkeo lista de los provedores

$.post('../../data/ajax/acciones/typerhead/listaProvedores.php', {id : ""+id.value+""}, function(datos) {
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




/*=====  End of typerhead  ======*/









function nuevoFocus(valor){
    var number = Math.floor((Math.random() * 1000000000) + 1);;
      if (valor.value.length > 0) {
        setTimeout(function(){//time
          addSerialImei(valor);
         }, 10);//FIN DEL TIME
      }
  }





function addSerialImei(valor){

  if ($('#serial:checked').val()=='on') { serial = 'si';}else{ serial = 'no';}
  if ($('#imei:checked').val()=='on') { imei = 'si';}else{ imei = 'no';}
  if ($('#otro:checked').val()=='on') { otro = 'si';}else{ otro = 'no';}

  $.ajax({
            //url: 'ajax/guardarUsuario.php',
            url : '../../data/ajax/insercionDatos/guardarPreCodigo.php',
            type: 'GET',
            dataType: 'JSON',
            data: { 
                    codigo: ""+valor.value+"",
                    sku : ""+ $('#sku').val() +"",
                    serial : ""+serial+"", 
                    imei : ""+imei+"",
                    otro : ""+otro+"",
                    token : ""+ $('#token').val()+""
            },                                    
        })
        .done(function(data) { 

          if ((data.Registrado)==0) {

           $.post('../../data/ajax/acciones/listaPreSeriales.php', { token : ''+$('#token').val()+'', sku : ''+$('#sku').val()+'' }, function(datosTabla) {
              $('#listaSerialesImeis').html(datosTabla);
              }); 

        }else if (data.Registrado == 1) {
              
              swal("Ops!", "EL SERIAL YA ESTA REGISTRADO EN EL SISTEMA, ES POSIBLE QUE SEA UNA RETOMA", "warning");

            //Error imei
        }else if (data.Registrado == 2) {
          //Ese imei no existe
              swal("Auch!", "ESTE SERIAL YA ESTA PRE-REGISTRADO", "warning");

        }
    });

      $('#codeAdd').val('').focus();
}



//Elimino el codigo seleccionado 
function deleteCodigo(parametro){
  $.ajax({
    url: '../../data/ajax/acciones/deletePreserial.php',
    type: 'GET',
    dataType: 'JSON',
    data: {idSerializacion: ''+parametro.value+''},
  })
  

    $.post('../../data/ajax/acciones/listaPreSeriales.php', { token : ''+$('#token').val()+'', sku : ''+$('#sku').val()+'' }, function(datosTablas) {
              $('#listaSerialesImeis').html(datosTablas);
              }); 
 
}



//Elimino el codigo seleccionado 
function deleteRow(parametro){
  $.ajax({
    url: '../../data/ajax/acciones/deleteRowPreCompra.php',
    type: 'GET',
    dataType: 'JSON',
    data: {idRow: ''+parseInt(parametro)+'', token : ''+parseInt($('#token').val())+'' },
  })
   

    loadPreCompras($('#token').val());
 
}


/*============================================
=            ADD A PREFACTURACION            =
============================================*/
document.getElementById('addArticulo').addEventListener('click', function(){

  var categoria = $('[id=categoria]').val();
  var subCategoria = $('[id=subCategorias]').val();
  $.ajax({
    url: '../../data/ajax/insercionDatos/guardarPreCompra.php',
    type: 'GET',
    dataType: 'JSON',
    data: { sku: ''+sku.value+'',
            nombreProductosServicios : ''+nombreProductosServicios.value+'',
            valorUnidad : ''+valorUnidad.value+'',
            impuesto:''+impuesto.value+'',
            valorVentaPublico : ''+valorVentaPublico.value+'',
            valorVentaMayorista : ''+valorVentaMayorista.value+'',
            categoria : ''+parseInt(categoria)+'',
            subCategoria : ''+parseInt(subCategoria)+'',
            cantidades: ''+parseInt(cantidades.value)+'',
            tipo : ''+tipo.value+'',
            token : ''+token.value+''
     },
  })


      loadPreCompras($('#token').val())


      $("#sku").val("");
      $("#nombreProductosServicios").val("");
      $("#valorUnidad").val("");
      $("#impuesto").val("");
      $("#cantidades").val("");
      $("#idproductosServicios").val("");
      $('#volumenesSeriales').html('');
      $('#listaSerialesImeis').html('');
      $('#precios').html('');
     


});
 

function loadPreCompras(token){
        //Enlisto los productos guardados
    $.post('../../data/ajax/acciones/listaPreCompras.php', { token : ''+token+'' }, function(datosTablas) {
        $('#listadoProductos').html(datosTablas);
      }); 
}
//GUARDAR

function saveFactura(){

if (typeof(valorAbonoFactura) == 'undefined') {
  valorAbonoFactura=0;
};

$.ajax({
            //url: 'ajax/guardarUsuario.php',
            url: '../../data/ajax/insercionDatos/guardarFacturaProvedorLotes.php',
            type: 'POST',
            dataType: 'JSON',
            data: { 
                    idProvedor: ""+parseInt(idProvedor.value)+"",
                    provedor: ""+limpiadorCaracteres(provedor.value)+"", 
                    nroFacturaProvedor: ""+limpiadorCaracteres(nroFacturaProvedor.value)+"", 
                    fechaIngreso: ""+limpiadorCaracteres(fechaFacturaProvedor.value)+"",
                    estadoFactura: ""+limpiadorCaracteres($('[id=origenTraslado]').val())+"",
                    id : ""+id.value+"",

                    totalFactura : ''+parseInt(totalFactura.value)+'',
                    impuestos : ''+parseInt(impuestos.value)+'',
                    subTotal : ''+parseInt(subTotal.value)+'',
                    destino : ""+limpiadorCaracteres($('[id=origenTraslado]').val())+"",
                    token : ''+$('#token').val()+''
            },                                    
        })
        .done(function(data) { 
                swal({
            title: "listo! ",
            text: "Ya Guarde Estos Productos En El Inventario",
            timer: 2000,  
            type: "success"
        });

      $('#token').val(data);
      $("#sku").val("");
      $("#nombreProductosServicios").val("");
      $("#valorUnidad").val("");
      $("#impuesto").val("");
      $("#cantidades").val("");
      $("#idproductosServicios").val("");
      $('#volumenesSeriales').html('');
      $('#listaSerialesImeis').html('');
      $('#listadoProductos').html('');
      $('#provedor').html('');
      $('#nroFacturaProvedor').html('');
});

  
}


function loadPrefactura(){
        loadPreCompras($('#token').val())
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
                $("#categorias").html('');
                $("#subCategoria").html('');
                delete window.seriales;
                delete window.imeis;
                delete window.serialesEspeciales;
}
/*=====  End of ADD A PREFACTURACION  ======*/




/*============================
=            MATH            =


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


