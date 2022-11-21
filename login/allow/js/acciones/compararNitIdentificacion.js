
document.getElementById('nitPunto').addEventListener('change', function(){
	$.ajax({
        url: '../../data/ajax/acciones/compararIdsPuntos.php',
        type: 'POST',
        dataType: 'JSON',
        data: {id: ''+id.value+'', nitPunto: ''+nitPunto.value+''},
    })
    .done(function(data) {
        if (data.aviso===true) {
       swal("Ops!", "Ya tengo este NIT Ingresado, necesito que me des otro", "warning");
       $("#nitPunto").val('');
    }
    });
   });



