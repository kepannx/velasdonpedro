
function aperturaCaja()
{
								
	swal({
                        title: "Apertura De Caja",
                        text: "Abriré la caja con un valor base de $ "+valorCajaBase.value+", ¿estas seguro de ese valor? ",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! Abre la caja",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									url: 'ajax/aperturaCaja.php',
									type: 'POST',
									dataType: 'JSON',
									data: { valorCajaBase: ""+valorCajaBase.value+""},
									
									
								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya Abrí la caja! buena suerte en las ventas de este turno <i class='fa fa-smile-o'></i> ",
                          timer: 4000,
                          html: true,
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
								//location.reload();
                window.setTimeout('location.reload()', 4500);
									 
								});

								


                        	//Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('abrirCaja').addEventListener('click', function(){
       aperturaCaja();
      /* console.log(nombreProductosServicios.value);
       console.log(tipoProductoServicio.value);
       console.log(valorVentaUnidad.value);
       console.log(valorVentaPorMayor.value);
       console.log(cantidadMinima.value); */

  });
