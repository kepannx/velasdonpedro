
$(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/cuentaCobroCompletas.php',
      type    : 'POST',
      data: { id : ""+id.value+""},
      success :  function(resultado){
        $('#listadoCuentaCobro').html(resultado);
      }
    });
});



//En caso que busque Cuentas de Cobro
$(function(){
  $('#buscarCuentasCobro').click(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/cuentaCobroCocuentaCobroCompletasBusqueda.php',
      type    : 'POST',
      data: { filtroBusquedaCuentaCobro: ""+filtroBusquedaCuentaCobro.value+"",nombreClienteCuentaDeCobro: ""+nombreClienteCuentaDeCobro.value+"", nroCuentaCobro: ""+nroCuentaCobro.value+"", inicioFechaFacturaCuentaCobro: ""+inicioFechaFacturaCuentaCobro.value+"", finalFechaFacturaCuentaCobro: ""+finalFechaFacturaCuentaCobro.value+"", id : ""+id.value+""},
      success :  function(resultado){
        $('#listadoCuentaCobro').html(resultado);
      }
    });
  });
});

$(function(){
  $('#cuentaCobro').click(function(){
    $(function(){
    $.ajax({
      url     : '../../data/comunes/listas/contabilidad/cuentaCobroCompletas.php',
      type    : 'POST',
      data: { id : ""+id.value+""},
      success :  function(resultado){
        $('#listadoCuentaCobro').html(resultado);
      }
    });
});
  });
});