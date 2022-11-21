
$('#idPunto').change(function(event) {
	/* Act on the event */
	$.post('../../data/ajax/acciones/datosBaseFacturacion.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosTabla) {
    $('#datosBaseFacturacion').html(datosTabla);
});

	$.post('../../data/ajax/acciones/tipoFactura.php', {id: ''+id.value+'', idPunto : ''+idPunto.value+''}, function(datosFactura) {
    $('#tipoFactura').html(datosFactura);
});


});