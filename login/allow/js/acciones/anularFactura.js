function anularFacturacion()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres anularla?",
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
									url: 'ajax/anularFactura.php',
									type: 'POST',
									dataType: 'JSON',
									data: { justificarAnulacion: ""+justificarAnulacion.value+"",  idFactura : ""+idFactura.value+""},
									
									//abono

								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya lo suspendí",
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




//Validación de los datos


//Valido que los datos esten llenos
function validarDatos(){
	if (justificarAnulacion.value.length == 0) {
		
		swal({   
            title: "Ops!",   
            text: "Necesito que me digas porque lo vas a anular",
            type: "error",   
            timer: 2000,   
            showConfirmButton: true 
            
        });
        return false;

	}
	

	else //Todo esta muy bien (y) 
	{	
		return true;
	}
}
document.getElementById('anularFactura').addEventListener('click', function(){
       if (validarDatos()===true) {
       	anularFacturacion();
       };
  });
