document.getElementById('username').addEventListener('change', function(){
	$.ajax({
        url: '../../data/ajax/acciones/compararUsernames.php',
        type: 'POST',
        dataType: 'JSON',
        data: {id: ''+id.value+'', username: ''+username.value+''},
    })
    .done(function(data) {
        if (data.aviso===true) {
       swal("Ops!", "Este usuario ya lo tengo registrado, necesito que me des otro", "warning");
       $("#username").val('');
    }
    });
   });