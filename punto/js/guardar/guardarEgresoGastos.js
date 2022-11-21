
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
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {

                          //inicio
                          $.ajax({
                  url: '../../data/ajax/insercionDatos/guardarEgresoGastos.php',
                  type: 'POST',
                  dataType: 'JSON',
                  data: { tipoEgresoGasto: ""+tipoEgresoGasto.value+"", 
                          descripcion: ""+descripcion.value+"", 
                          provedor : ""+provedor.value+"",
                          nroRecibo : ""+nroRecibo.value+"",
                          valorEgresoGasto: ""+valorEgresoGasto.value+""},
                  
                  //abono

                })

                .done(function(data) { //
                  
                setTimeout(function() {
                var win = window.open('../../print/formatos/formatoEgresos.php?printData='+data.Registrado+'', '_blank');
                win.focus();}, 1000);

                 })
                .fail(function() {
                  swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
                })
                .always(function() {
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