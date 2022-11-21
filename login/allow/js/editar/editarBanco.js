
function editarBanco()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres editar este banco?",
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
									url: 'ajax/editarBanco.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombreBanco: ""+nombreBanco.value+"", nroCuenta: ""+nroCuenta.value+"", tipoCuenta: ""+tipoCuenta.value+"", idBanco : ""+idBanco.value+"", activada : ""+activada.value+""},
									//abono
								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya guardé el banco!",
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


document.getElementById('editarBanco').addEventListener('click', function(){
       editarBanco();
       /*console.log(cantidadMinima.value); */

  });
