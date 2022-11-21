
function editarInformacionTributaria()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres editar la información tributaria?",
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
									url: 'ajax/editarDatosTributariosEmpresa.php',
									type: 'POST',
									dataType: 'JSON',
									data: { regimenEmpresa: ""+regimenEmpresa.value+"", representanteEmpresa: ""+representanteEmpresa.value+"", moneda: ""+moneda.value+"", terminosCondicionesFactura : ""+terminosCondicionesFactura.value+""},//
									//abono
								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya edité la información tributaria!",
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


document.getElementById('editarDatosTributarios').addEventListener('click', function(){
       editarInformacionTributaria();
  });
