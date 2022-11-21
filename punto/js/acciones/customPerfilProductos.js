$.post('../../data/ajax/acciones/getExistenciaGlobal.php', {}, function(datos) {
    $('#existenciaGlobal').html(datos);
});