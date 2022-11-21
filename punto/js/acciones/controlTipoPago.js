$('#tipoPago').change(function(event) {
	/* Act on the event */
	$.post('../../data/ajax/acciones/controlTipoPago.php', {id: ''+id.value+'', tipoPago : ''+tipoPago.value+''}, function(datosTabla) {
    $('#controlTipoPago').html(datosTabla);
});
});