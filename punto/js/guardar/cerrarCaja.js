
function cerrarCaja()
{
								
	swal({
                        title: "Seguro?",
                        text: "Estas seguro de los datos que ingresaste<h4 class='text-danger'>Efectivo: "+valorEnEfectivo.value+" <h4><h4>Recibos:  "+valorEnDocumentos.value+"<h4> ",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! Cierra la caja!",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        html : true,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									url: 'ajax/cerrarCaja.php',
									type: 'POST',
									dataType: 'JSON',
									data: { valorEnEfectivo: ""+valorEnEfectivo.value+"", valorEnDocumentos: ""+valorEnDocumentos.value+"", totalEnSistema: ""+totalEnSistema.value+"", idCierreCaja: ""+idCierreCaja.value+"", valorGastosEgresos: ""+valorGastosEgresos.value+""},
									
									
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
									
									 
								});

								


                        	//Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarDato').addEventListener('click', function(){
       cerrarCaja();
       console.log(valorEnEfectivo.value);
       console.log(valorEnDocumentos.value);
       console.log(totalEnSistema.value);
       console.log(idCierreCaja.value);
      /* console.log(nombreProductosServicios.value);
       console.log(tipoProductoServicio.value);
       console.log(valorVentaUnidad.value);
       console.log(valorVentaPorMayor.value);
       console.log(cantidadMinima.value); */

  });
