 $(document).ready(function() { //Calculo lo ingresado a través de efectivo
 

if (typeof(fechas)==='undefined') {
$.post('../../data/ajax/acciones/calculoValorEfectivo.php', {}, function(datosTabla) {
 		var totalEfectivo=datosTabla;
    $('#totalEfectivo').html(formatDecilames(totalEfectivo));
  });

	//Calculo lo ingresado a través de transacciones
 $.post('../../data/ajax/acciones/calculoValorTransacciones.php', {}, function(datosTabla) {
 		var totalTransacciones=datosTabla;
    $('#totalTransacciones').html(formatDecilames(totalTransacciones));
  });



 $.post('../../data/ajax/acciones/calculoValorEgresos.php', { }, function(datosTabla) {
    var totalTransacciones=datosTabla;
    $('#totalEgresos').html(formatDecilames(totalTransacciones));
  });


  //Calculo lo ingresado a través de transacciones
 $.post('../../data/ajax/acciones/calculoValorTransacciones.php', {}, function(datosTabla) {
    var totalTransacciones=datosTabla;
    $('#totalTransacciones').html(formatDecilames(totalTransacciones));
  });



//Calculo las cuentas por cobrar
$.post('../../data/ajax/acciones/calculoCuentasPorCobrar.php', {}, function(datosTabla) {
 		$('#cxc').html(formatDecilames(datosTabla));
  });

//Calculo El Gran Total
$.post('../../data/ajax/acciones/calculoValorGranTotal.php', {}, function(datosTabla) {
 		$('#granTotalGlobal').html(formatDecilames(datosTabla));
  });


}
else{//Tiene fechas
$.post('../../data/ajax/acciones/calculoValorEfectivo.php', { fecha : ''+fechas.value+''}, function(datosTabla) {
 		var totalEfectivo=datosTabla;
    $('#totalEfectivo').html(formatDecilames(totalEfectivo));
  });

	//Calculo lo ingresado a través de transacciones
 $.post('../../data/ajax/acciones/calculoValorTransacciones.php', { fecha : ''+fechas.value+''}, function(datosTabla) {
 		var totalTransacciones=datosTabla;
    $('#totalTransacciones').html(formatDecilames(totalTransacciones));
  });

  $.post('../../data/ajax/acciones/calculoValorEgresos.php', { fecha : ''+fechas.value+''}, function(datosTabla) {
    var totalTransacciones=datosTabla;
    $('#totalEgresos').html(formatDecilames(totalTransacciones));
  });

//Calculo las cuentas por cobrar
$.post('../../data/ajax/acciones/calculoCuentasPorCobrar.php', { fecha : ''+fechas.value+''}, function(datosTabla) {
 		$('#cxc').html(formatDecilames(datosTabla));
  });

//Calculo El Gran Total
$.post('../../data/ajax/acciones/calculoValorGranTotal.php', { fecha : ''+fechas.value+''}, function(datosTabla) {
 		$('#granTotalGlobal').html(formatDecilames(datosTabla));
  });


}



 



$('#listaFacturasDia').slimScroll({
            height: '400px',
        });
        $('#listaGastosDia').slimScroll({
            height: '400px'
        });

//Formateo en decimales
function formatDecilames(input){
var num = input;
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}//fin del formato en decimales

});//End del ready

