
function guardarMovimientoBancario()
{
								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que hacer este movimiento?",
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
									url: 'ajax/registrarMovimientoBancario.php',
									type: 'POST',
									dataType: 'JSON',
									data: { idBanco: ""+idBanco.value+"", tipoMovimiento: ""+tipoMovimiento.value+"", justificacionMovimiento: ""+justificacionMovimiento.value+"", justificacionTraslado: ""+justificacionTraslado.value+"", valorMovimiento : ""+valorMovimiento.value+"", identificacionBanco : ""+idenBancos.value+"", saldoActual : ""+saldoActual.value+""},
									//abono
								})


								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya realicé el movimiento",
                          timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
                .always(function() {
                  egreso.descripcionMovimientoBancario.value = '';//Limpio  los valores de los input
                  egreso.descripcionMovimientoBancarios.value = '';
                  egreso.valorMovimiento.value = '';
                   
                });


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}




function validacion(){
  if (tipoMovimiento.value === 'traslado' || tipoMovimiento.value === 'egreso') {
      //VERIFICAR QUE EL SALDO ACTUAL SEA MAYOR O IGUAL A LA CANDITAD QUE MOVERÉ

        return true
    }

 else if (valorMovimiento.value.length == 0) {

    swal({   
            title: "Ops!",   
            text: "Necesito que me digas cuanto vas a mover",
            type: "error",   
            timer: 3000,   
            showConfirmButton: false 
            
        });
        return false;
  }

  else{
    return true
  }

  }
//Fin de la validación



document.getElementById('guardarMovimientoBancario').addEventListener('click', function(){
        if (validacion()==true) {
         
           guardarMovimientoBancario();
         }


       /*console.log(cantidadMinima.value); */

  });
