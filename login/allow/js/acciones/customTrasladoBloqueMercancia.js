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




 (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();






//Si invoco el SKU o Codigo de  producto
document.getElementById('nombreProducto').addEventListener('change', function(){
      //Comparo si existe
      //Checkeo sku repetido 
      var skuserializado= $('#sku')[0].value;
      var idOrigen= $( "#origenId option:selected" ).val();


      if ((skuserializado).length > 0) {
          $.ajax({
            url     : '../../data/ajax/acciones/checkSkuRepetido.php',
            type    : 'POST',
            data: { sku: ""+skuserializado+"", idOrigen : ''+idOrigen+'' },
            success :  function(data){

              console.log(data);
               if (data == 1) { //Es sin seriales

                loadFeaturesFromSku(skuserializado, idOrigen); 

               }
               else if(data == 0){
                checkExistenciaSerialImei($('#sku')[0].value, idOrigen);
               }

            }
          });
      };
});





//Verificación  si el parámetro que  se envió existe como serial/imei
function checkExistenciaSerialImei(parametro, idOrigen){
    $.ajax({
      url: '../../data/ajax/acciones/checkImeiSerial.php',
      type: 'POST',
      dataType: 'JSON',
      data: { imeiSerial: ''+parametro+'', idOrigen : ''+idOrigen+''},
    })
    .done(function(datos) {
      if (datos.codigo === null) {
        $('#sku').val('');
        $('#nmProductoServicio').html(''); 
        swal({   
                        title: "Auch!",   
                        text: "Este serial no esta registrado en este punto de venta",
                        type: "error",   
                        timer: 4000,   
                        showConfirmButton: true 
                    });
      }else{

        $('#nmProductoServicio').html('<h3>'+datos.nombreProductosServicios+'<h3>');
        $("#idproductosServicios").val(datos.idProductoServicio);
        $('#volumenes').html('<input type="hidden" id="cantidades" value="1" ><input type="hidden" id="tipo" value="serial">');

        //Funcion ADD A Pre-traslado
        addPreTraslado();
        $('#sku').val('');

      }

    }) 
}




//Verifico si las cantidades que existen de un producto
function verificarCantidades(idProducto){
  $.ajax({
    url: '../../data/ajax/acciones/getNumeroExistencias.php',
    type: 'POST',
    dataType: 'JSON',
    data: {idProducto : ''+idProducto+''},
  })

  .done(function(data) {         
          var numero = parseInt(data.numero);
  });
}


//Cargo las caracteristicas que necesito  para ese  producto


//*
function loadFeaturesFromSku(sku, idOrigen){

    if (sku.length > 0) {
      //Cargo en JSON los parametros que necesito para ese articulo
      $.ajax({
          url: '../../data/ajax/acciones/checkJsonProductos.php',
          type: 'POST',
          data: { sku : ""+sku+""},
          success: function (data) {
            datos = JSON.parse(data);
            console.log(datos.idproductosServicios);
            var promesa = checkexistencia(idOrigen, datos.idproductosServicios);
                promesa.success(function (data) {
                  if ((data.numero)>0) {//El numero debe ser mayor a cero
                    $("#nmProductoServicio").html('<div align="center"><h4>'+datos.nombreProductosServicios+'</h4></div>');
                    $("#idproductosServicios").val(datos.idproductosServicios);
                    $('#volumenes').html('<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" onchange = "checking(this, '+data.numero+')" placeholder="Cantidades"></div></div><input type="hidden" id="tipo" value="unserial">');
                    $('#volumenesSeriales').html('');

                  }else{//No hay existencias
                    swal({   //Error en caso que no exista el producto
                        title: "Auch!",   
                        text: "Este producto no existe en el punto de venta",
                        type: "error",   
                        timer: 4000,   
                        showConfirmButton: true 
                    });
                  $('#volumenes').html('');
                  $('#volumenesSeriales').html('');
                  //$('#sku').val('');
                  }
                });//Fin de Promesa
          }
        });
    };
  }


function checkexistencia(idOrigen, idProducto){
    return $.ajax({
          url: '../../data/ajax/acciones/checkExistenciaOrigen.php',
          type    : 'POST',
          dataType: 'JSON',
          data: {idOrigen : ''+idOrigen+'' , idProducto : ''+idProducto+''  },
    })

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




//CARGAR HISTORIAS DE TRASLADOS


/*

      
*/







//FUN DE LOS LISTADO DE TRASLADOS





/*=================================
=            typerhead            =
=================================*/



$.post('../../data/ajax/acciones/typerhead/listaSkuNombreProductos.php', {  }, function(datos) {
    var nombreProducto = JSON.parse(datos);
    //var skuCodigo = datos;s

    $('#nombreProducto .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'nombreProducto',
      source: substringMatcher(nombreProducto)
    });
});


/*=====  End of typerhead  ======*/






/*============================================
=            ADD A PREFACTURACION            =
============================================*/

document.getElementById('addArticulo').addEventListener('click', function(){
  addPreTraslado();

});




//Agrego a la lista de los traslados
function addPreTraslado(){
  var idOrigen= $( "#origenId option:selected" ).val();
  var destinoId= $( "#destinoId option:selected" ).val();
  $.ajax({
    url: '../../data/ajax/insercionDatos/guardarPreTraslado.php',
    type: 'POST',
    dataType: 'JSON',
    data: { tipo: ''+tipo.value+'', 
            sku : ''+sku.value+'',
            idOrigen : ''+idOrigen+'',
            idDestino : 0,
            idProductoServicio: ''+idproductosServicios.value+'',
            unidades : ''+cantidades.value+'',
            token : ''+token.value+''
      },
  })
  .done(function(datos) {
    if (datos.Registrado>0) { 
      $.post('../../data/ajax/acciones/listaPreTraslado.php', { tokenPrefactura: ''+token.value+''}, function(data) {
        $('#listadoProductos').html(data);
        $('#sku').val('')
        $('#nmProductoServicio').html('');
        $('#volumenes').html('');

      
      }); 
    };
  })
}





//Eimino las filas de las pre-facturas cargadas
function deleteRow(parametro){
  $.ajax({
    url: '../../data/ajax/acciones/deleteRowPreTraslados.php',
    type: 'POST',
    dataType: 'JSON',
    data: {idRow : ''+parametro+''},
  })
   $.post('../../data/ajax/acciones/listaPreTraslado.php', { tokenPrefactura: ''+token.value+''}, function(fataProduc) {
        $('#listadoProductos').html(fataProduc);
      }); }



function trasladoMercancia(){

  $.ajax({
    url: '../../data/ajax/acciones/trasladar.php',
    type: 'POST',
    dataType: 'JSON',
    data: { token : ''+token.value+'',
    destinoId : ''+ $( "#destinoId option:selected" ).val() +'',
      },
  })
  .done(function(data) {

   $('#listadoProductos').html("");
   $("#sku").val("");
   $('#token').val(data.token);
   /*
    setTimeout(function(){
                window.open('../../../print/formatos/trasladoPuntoPunto.php?printData='+data.codigo,'_blank')
            }, 1000); */
    })
}






function clearCampos(){
                $("#sku").val("");
                $("#nombreProductosServicios").val("");
                $("#cantidades").val("");
                $("#idproductosServicios").val("");
                $("#volumenesSeriales").html('');
                           
}
/*=====  End of ADD A PREFACTURACION  ======*/




/*=====  End of MATH  ======*/



/*==================================
=            VALIDATION            =
==================================*/


/*=====  End of VALIDATION  ======*/