
function guardarAbonoFacturaProvedor()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres abonar $ "+abono.value+" a esta factura?",
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
									url: 'ajax/guardarAbonoProvedor.php',
									type: 'POST',
									dataType: 'JSON',
									data: { abono: ""+abono.value+"", idfacturaProvedor: ""+idfacturaProvedor.value+"", deudaFacturaProvedor: ""+deudaFacturaProvedor.value+"", viaDePago : ""+viaDePago.value+""},
									
									//abono

								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya realicé el abono!",
                          timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
									 formObj.abono.value = '';//Limpio  los valores de los input
                  
									 
								});

								


                        	//Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('abonarDeudaProvedor').addEventListener('click', function(){
       guardarAbonoFacturaProvedor();
      
       /*console.log(cantidadMinima.value); */

  });
