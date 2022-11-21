
function editarInformacionNegocio()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres editar la información básica?",
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
									url: 'ajax/editarDatosBasicosEmpresa.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombreEmpresa: ""+nombreEmpresa.value+"", direccionEmpresa: ""+direccionEmpresa.value+"", ciudadEmpresa: ""+ciudadEmpresa.value+"", estadoEmpresa : ""+estadoEmpresa.value+"", paisEmpresa : ""+paisEmpresa.value+"", telefonosEmpresa : ""+telefonosEmpresa.value+"", emailEmpresa : ""+emailEmpresa.value+"", sitioWeb : ""+sitioWeb.value+""},//
									//abono
								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya edité la información!",
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


document.getElementById('editarDatosBasicos').addEventListener('click', function(){
       editarInformacionNegocio();

  });
