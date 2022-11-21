
document.getElementById('provedor').addEventListener('change', function(){
	$.ajax({
        url: '../../data/ajax/acciones/ckeckProvedoresId.php',
        type: 'POST',
        dataType: 'JSON',
        data: {provedor: ''+provedor.value+''},
    })
    .done(function(data) {
       $("#idProvedor").val(data.idProvedor);
    });
   });



