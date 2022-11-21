
function anularGastoEgreso()
{								
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres anular este Egreso?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#ba0505",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! ANULALO",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									url: 'ajax/guardarEgresosGastos.php',
									type: 'POST',
									dataType: 'JSON',
									data: { tipoEgresoGasto: ""+tipoEgresoGasto.value+"", descripcion: ""+descripcion.value+"", valorEgresoGasto: ""+valorEgresoGasto.value+""},
									
									//abono

								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya Anulé el gasto/egreso!",
                          timer: 2000,  
					                type: "success"
					            });})
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
                  //Actualizo la pagina
									location.reload(true);
									 
								});

                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('anular').addEventListener('click', function(){
       anularGastoEgreso();

       console.log(numRows.value);
       /*
       //console.log(idEgresosGasto.value);
        idEgreso = $(":radio[name=idEgresosGasto]:checked").val();
console.log(idEgreso); */

  });


document.getElementById('restaurar').addEventListener('click', function(){
       anularGastoEgreso();
      // console.log(idEgreso);
  });
