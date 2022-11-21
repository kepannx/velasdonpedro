
/*LOAD DATOS DE PUNTO DE VENTA */

$.ajax({
      url: '../../data/ajax/acciones/checkDatosProvedor.php',
      type: 'POST',
      dataType: 'JSON',
      data: {},
    })
    .done(function(data) {
      $('#nombreProvedor').html(data.nombreProvedor);
      
    })

$.ajax({
      url: '../../data/ajax/acciones/checkDatosFacturaProvedor.php',
      type: 'POST',
      dataType: 'JSON',
      data: {},
    })
    .done(function(datosProvedor) {
      $('#nroFacturaProvedor').html('<b class="text text-danger">'+datosProvedor.nroFacturaProvedor+'</b>');
      $('#fechaFacturaProvedor').html(datosProvedor.fechaFacturaProvedor);
      //Estados de la factura
      if ((datosProvedor.estadoFactura)=='cancelado') {
          $('#estadoFactura').html('<div class="text text-success"> <i class="fa fa-check"></i> Pagado</div>');
      }else if((datosProvedor.estadoFactura)=='credito'){
        $('#estadoFactura').html('<div class="text text-danger"> <i class="fa fa-warning"></i> Por Pagar</div>');
        $('#fechaPagoMaximo').html('<h3> <i class="fa fa-warning"></i> DEBES PAGAR ANTES DEL '+datosProvedor.fechaPagar+'</h3>')
        $('#deudaFacturaProvedor').html('<div class="btn btn-danger"><i class="fa fa-wallet"></i> Aun se debe <h1>'+datosProvedor.deudaFacturaProvedor+'</h1></div>')
      }else if((datosProvedor.estadoFactura)=='consignacion'){
        $('#estadoFactura').html('<div class="text text-warning"> <i class="fa fa-warning"></i> En Consignación</div>');
      }
      $('#valorTotalFactura').html(datosProvedor.valorFacturaProvedor);
      //fin de los estados de la factur
    })

$.post('../../data/ajax/acciones/listaProductosFacturaProvedor.php', {}, function(data) {
  /*optional stuff to do after success */
  $('#listaProductosFacturaProvedores').html(data)
});


//Enlisto los seriales
$.post('../../data/ajax/acciones/serializacionProductosEnFactura.php', {}, function(data) {
  $('#serializacion').html(data)
});





function eliminarSub(parametro){
  console.log(parametro);
}








//Edición del valor de la unidad
function editarItemValorUnidad(parametro){
  var separacion = parametro.split('|');
  $('#changeValorUnidad_'+separacion[0]+'').html('<input type="text" class="form-control" value="'+separacion[1]+'" id="valorUnidad_'+separacion[0]+'" onkeyup="format(this)" onchange="format(this)"  >')
  $('#valorUnidad_'+separacion[0]+'').on('change', function() {
    saveValue(this, separacion[2], 'valorUnidad', separacion[0]);
    /* Act on the event */
  });
}


//Edito el valor de los impuestos
function editarItemImpuesto(parametro){
  var separacion = parametro.split('|');
  $('#changeValorimpuesto_'+separacion[0]+'').html('<input type="text" class="form-control" value="'+separacion[1]+'" id="impuesto_'+separacion[0]+'" onkeyup="format(this)" onchange="format(this)"  >')
  $('#impuesto_'+separacion[0]+'').on('change', function() {
    saveValue(this, separacion[2], 'impuestos', separacion[0]);
  });
}






//Edición de las unidades compradas
function editarUnidadesCompradas(parametro){
  var separacion = parametro.split('|');
  $('#changeUnidadesCompradas_'+separacion[0]+'').html('<input type="number" min="1" max="10000" class="form-control" value="'+separacion[1]+'" id="unidadesCompradas_'+separacion[0]+'" onkeyup="format(this)" onchange="format(this)"  >')
  $('#unidadesCompradas_'+separacion[0]+'').on('change', function() {
    saveValue(this, separacion[2], 'unidadesCompradas', separacion[0]);
    /* Act on the event */
  });
}




function saveValue(valor, id, parametro, vector){
    if (parametro == 'valorUnidad') {
      swal({   
            title: "Estas seguro de esto? ",   
            text: "Estas por cambiar el valor por  "+valor.value+" ",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Si, cambialo!",   
            closeOnConfirm: false 
        }, function(){
            $.ajax({
                 url: '../../data/ajax/edicionDatos/editarDatosPrefactura.php',
                 type: 'POST',
                 dataType: 'JSON',
                 data: {  id: ''+id+'',
                          valor : ''+valor.value+'',
                          tipo : ''+parametro+''
                  },
               })
               .done(function(datos) {
               }) 
                               console.log(vector);
                  $('#changeValorUnidad_'+vector+'').html('<button  class="btn btn-danger"  id="valorUnidad_'+vector+'" value="'+vector+'|'+valor.value+'|'+id+'" onkeyup="format(this)" onchange="format(this)" ondblclick="editarItemValorUnidad(this.value)" >'+valor.value+'</button>');
                  swal("Listo!", "El valor quedó actualizado", "success"); 
        });









        //Guardo el valor por impuestos
    }else if(parametro == 'impuestos'){
            swal({   
            title: "Estas seguro de cambiar el valor de los impuestos? ",   
            text: "Estas por cambiar el valor por  "+valor.value+" ",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Si, cambialo!",   
            closeOnConfirm: false 
        }, function(){
            $.ajax({
                 url: '../../data/ajax/edicionDatos/editarDatosPrefactura.php',
                 type: 'POST',
                 dataType: 'JSON',
                 data: {  id: ''+id+'',
                          valor : ''+valor.value+'',
                          tipo : ''+parametro+''
                  },
               })
               .done(function(datos) {
               }) 
                  $('#changeValorimpuesto_'+vector+'').html('<button  class="btn btn-danger"  id="valorUnidad_'+vector+'" value="'+vector+'|'+valor.value+'|'+id+'" onkeyup="format(this)" onchange="format(this)" ondblclick="editarItemImpuesto(this.value)" >'+valor.value+'</button>');
                  swal("Listo!", "El valor quedó actualizado", "success"); 
        });
      //Guardo el valor de los impuestos
    }else if (parametro == 'unidadesCompradas') {
            console.log('Unidades Compradas:'+valor.value)
      //Guardo el valor de las unidades compradas
    };
}

 $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Used events
        var drEvent = $('#input-file-events').dropify();
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });