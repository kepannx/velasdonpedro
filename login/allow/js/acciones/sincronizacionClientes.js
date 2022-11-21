
function syncClientes()
{
								
	swal({
                        title: "Voy a Sincronizar",
                        text: "Seguro que deseas sincronizar los clientes desde excel ",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! Sincronizalos!",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
        									url: 'ajax/sincronizacionClientes.php',
        									type: 'POST',
        									dataType: 'JSON',
        									data: { excel: ""+excel.value+"", upload: ""+action.value+""},
									
									
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


document.getElementById('sincronizoCliente').addEventListener('click', function(){
       syncClientes();
       console.log(action.value);
      /* console.log(nombreProductosServicios.value);
       console.log(tipoProductoServicio.value);
       console.log(valorVentaUnidad.value);
       console.log(valorVentaPorMayor.value);
       console.log(cantidadMinima.value); */

  });
