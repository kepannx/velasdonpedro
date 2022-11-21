
$(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/facturasCompletas.php',
      type    : 'POST',
      data: { id : ""+id.value+""},
      success :  function(resultado){
        $('#contenido').show();
        $('#listaFacturaBloques').hide();
        $('#contenido').html(resultado);
      }
    });
});



//En caso que busque facturas
$(function(){
  $('#buscarFacturas').click(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/facturasCompletasBusqueda.php',
      type    : 'POST',
      data: { filtroBusquedaFactura: ""+filtroBusquedaFactura.value+"",nombreClienteFacturas: ""+nombreClienteFacturas.value+"", nroFactura: ""+nroFactura.value+"", inicioFechaFactura: ""+inicioFechaFactura.value+"", finalFechaFactura: ""+finalFechaFactura.value+"", id : ""+id.value+""},
      success :  function(resultado){
        $('#contenido').show();
        
        $('#contenido').html(resultado);
        $('#listaFacturaBloques').hide();
      }
    });
  });
});


//Cargueme las facturas en bloque
$(function(){
  $('#buscarFacturasEnBloque').click(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/facturasCompletasBloque.php',
      type    : 'POST',
      data: { filtroBusquedaFacturaBloque: ""+filtroBusquedaFacturaBloque.value+"",nombreClienteFacturasBloque: ""+nombreClienteFacturasBloque.value+"", inicioFechaFacturaBloque: ""+inicioFechaFacturaBloque.value+"", finalFechaFacturaBloque: ""+finalFechaFacturaBloque.value+""},
      success :  function(resultado){
        $('#contenido').hide();
        $('#listaFacturaBloques').show();
        $('#listaFacturaBloques').html(resultado);

      }
    });
  });
});

$(function(){
  $('#pestanaFacturacion').click(function(){
    $(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/facturasCompletas.php',
      type    : 'POST',
      data: { id : ""+id.value+""},
      success :  function(resultado){
        $('#contenido').show();
        $('#listaFacturaBloques').hide();
        $('#contenido').html(resultado);
      }
    });
});
  });
});