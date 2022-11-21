
$.post('../../data/ajax/acciones/datosTrasladoMercancia.php', {id: ''+id.value+'', datos : ''+parametro.value+''  }, function(datosTabla) {
    $('#listaProductosTrasladados').html(datosTabla);
  });

$.ajax({
          url: '../../data/ajax/acciones/loadDatosHojaTraslado.php',
          type: 'POST',
          data: { id: ''+id.value+'', datos : ''+parametro.value+''   },
          success: function (data) {
            datos = JSON.parse(data);
             $("#origenTraslado").html(datos.origenTraslado);
             $("#destinoTraslado").html(datos.destinoTraslado);
             $("#fechaTraslado").html(datos.fechaTraslado);
          }
        });
