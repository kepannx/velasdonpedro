
function guardarEgresos()
{               
  swal({
                        title: "Seguro?",
                        text: "Â¿Estas seguro que quieres hacer un "+tipoEgresoGasto.value+" de $ "+valorEgresoGasto.value+" ?",
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
                  url: 'ajax/guardarEgresosGastos.php',
                  type: 'POST',
                  dataType: 'JSON',
                  data: { tipoEgresoGasto: ""+tipoEgresoGasto.value+"", descripcion: ""+descripcion.value+"", valorEgresoGasto: ""+valorEgresoGasto.value+""},
                  
                  //abono

                })

                .done(function() { //
                   swal({
                          title: "listo! ",
                          text: "Ya guardé el "+tipoEgresoGasto.value+"!",
                          timer: 2000,  
                          type: "success"
                      });})
                .fail(function() {
                  swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
                })
                .always(function() {
                  //Limpio  los valores de los input
                   egreso.valorEgresoGasto.value = '';
                   egreso.descripcion.value = ''; 
                   
                });

                


                          //Final


                        } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarDato').addEventListener('click', function(){
       guardarEgresos();

    
  });