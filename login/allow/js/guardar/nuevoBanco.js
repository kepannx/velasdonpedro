
function guardarEntidadFinanciera()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres guardar este banco?",
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
									url: 'ajax/guardarBanco.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombreBanco: ""+nombreBanco.value+"", nroCuenta: ""+nroCuenta.value+"", tipoCuenta: ""+tipoCuenta.value+"", saldo : ""+saldo.value+""},
									
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
								.always(function() {
									 formObj.nombreBanco.value = '';//Limpio  los valores de los input
                   formObj.nroCuenta.value = '';
                   formObj.saldo.value = '';
								});


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarBanco').addEventListener('click', function(){
       guardarEntidadFinanciera();
       /*console.log(cantidadMinima.value); */

  });
