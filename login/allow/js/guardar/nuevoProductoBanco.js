
function guardaProductoBancario()
{
								
	swal({
                        title: "Seguro?",
                        text: "Voy a crear "+tipo.value+", ¿estas seguro de ello?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! Crealo",
                        cancelButtonText: "No! Cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									url: 'ajax/guardarProductoBanco.php',
									type: 'POST',
									dataType: 'JSON',
									data: { tipo: ""+tipo.value+"", idBanco: ""+idenBancos.value+"", descripcion: ""+descripcion.value+"", saldo : ""+saldo.value+"", deuda : ""+deuda.value+"", fechaCorte : ""+fechaCorte.value+""},
									
									//abono

								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya guardé el producto !",
                          timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
									 formObj.descripcion.value = '';//Limpio  los valores de los input
                   formObj.saldo.value = '';
                   formObj.deuda.value = '';
                   formObj.fechaCorte.value = '';
								});


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarProductoBancario').addEventListener('click', function(){
       guardaProductoBancario();
      
  });
