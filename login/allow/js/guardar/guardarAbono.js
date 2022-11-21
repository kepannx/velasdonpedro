function guardarAbono()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres abonar $ "+abono.value+" a la deuda global?",
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
									url: 'ajax/guardarAbono.php',
									type: 'POST',
									dataType: 'JSON',
									data: { abono: ""+abono.value+"", idCliente: ""+idCliente.value+"", valorDeuda: ""+valorDeuda.value+"", idFactura : ""+idFactura.value+""},
									
									//abono

								})
								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya guardé el item!",
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


document.getElementById('guardarDato').addEventListener('click', function(){
       guardarAbono();

       console.log(valorDeuda.value);
      
  });
