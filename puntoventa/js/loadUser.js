function checkUsers(){	
	$.ajax({
		url: 'ajax/checkUser.php',
		type: 'POST',
		dataType: 'JSON',
		data: {usuario: ''+limpiadorCaracteres(usuario.value)+'',
				password: ''+limpiadorCaracteres(contrasena.value)+''
		 },
	})
	.done(function(data) {
		if (data===true) {
			setTimeout(' window.location.href = "home.php"; ',1000);
		}
		else{
			swal("Auch", "Algo salió mal, intentalo de nuevo", "error");
		}
		
	})
	.fail(function() {
		swal("Auch", "Algo salió mal, intentalo de nuevo", "error");
	})
	
}

document.getElementById('login').addEventListener('click', function(evt){
	 evt.preventDefault();
	 checkUsers();/*
	if (usuario.value.length > 2) {
		
	}
	else
	{
		swal("Auch", "Oye! eso no es un  usuario valido", "error");
	}*/
  });

function limpiadorCaracteres(parametro){
        return  res= parametro.replace(/[^a-zA-Z 0-9]`+/g,' ');
}




