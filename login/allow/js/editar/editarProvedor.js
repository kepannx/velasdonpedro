
function editarProvedor()
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
									url: 'ajax/editarProvedor.php',
									type: 'POST',
									dataType: 'JSON',
									data: { nombreProvedor: ""+nombreProvedor.value+"", ideProvedor: ""+ideProvedor.value+"", direccionProvedor: ""+direccionProvedor.value+"", ciudadProvedor: ""+ciudadProvedor.value+"", telefonoProvedor: ""+telefonoProvedor.value+"", emailProvedor: ""+emailProvedor.value+"", contactoProvedor: ""+contactoProvedor.value+ "", idprovedor: ""+idprovedor.value+ ""},
									
									
								})

								.done(function() { //Cuando  ingresa entonces  sacame la guia
									 swal({
					                title: "listo! ",
					                text: "Ya Edité Al Provedor!",
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


document.getElementById('guardarDato').addEventListener('click', function(){
       editarProvedor();


  });
