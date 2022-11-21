
function guardarUsuario()
{
								
	swal({
                        title: "Seguro?",
                        text: "Estas seguro de los datos que ingresaste",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! hazlo",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									url: 'ajax/guardarUsuario.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombre: ""+nombre.value+"", 
										email: ""+email.value+"", 
										tipoUsuario: ""+tipoUsuario.value+"", 
										puntoAsignado : ""+puntoAsignado.value+"",
										usuario: ""+usuario.value+"",
										contrasena: ""+contrasena.value+""},
									
									
								})

								.done(function() { //Cuando  ingresa entonces  sacame la guia
									 swal({
					                title: "listo! ",
					                text: "Ya Guardé Al Usuario!",
					                timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
									formObj.nombre.value = ''; 
					                formObj.email.value = ''; 
					                formObj.usuario.value = '';  
					                formObj.contrasena.value = '';  

								});

								


                        	//Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarUsuario').addEventListener('click', function(){
       guardarUsuario();
  });
