
function editarUsuario()
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
									url: 'ajax/editarUsuario.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombre: ""+nombre.value+"",
									identificacion: ""+identificacion.value+"",
									direccion: ""+direccion.value+"", 
									telefonos: ""+telefonos.value+"",
									ciudad: ""+ciudad.value+"", 
									email: ""+email.value+"", 
									puntoAsignado: ""+puntoAsignado.value+"",
									tipoUsuario: ""+tipoUsuario.value+ "", 
									activada: ""+activada.value+ "", eps: ""+eps.value+ "", 
									ips: ""+ips.value+ "", arp: ""+arp.value+ "", 
									cajasCompensacion: ""+cajasCompensacion.value+ "", 
									cesantias: ""+cesantias.value+ "", 
									sueldoPromedio: ""+sueldoPromedio.value+ "", 
									idUsuario: ""+idUsuario.value+ ""},
									
									
								})

								.done(function() { //Cuando  ingresa entonces  sacame la guia
									 swal({
					                title: "listo! ",
					                text: "Ya Edité Al Usuario!",
					                timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
	

                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('actualizaDatos').addEventListener('click', function(){
       editarUsuario();
  });
