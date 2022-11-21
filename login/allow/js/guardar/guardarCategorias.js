
function guardarCategiria()
{
  if ($('#padre').val() == undefined) {
    var padre= null;
  }else if($('#padre').val() != undefined){
    var padre= $('#padre').val();
  }







	if (($('[id=aplicaTopeImpuesto]')[0].checked)===true){
        var aplicaTopeImpuesto="si";
        var valTopTaxes =  $('#valTopTaxes').val();
      }else{ 
        var aplicaTopeImpuesto = "no";
        var valTopTaxes =0;
      }			
	swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres guardar Esta Categoria?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7eb149",
                        cancelButtonColor: "#ba0505",
                        confirmButtonText: "Si! hazlo",
                        cancelButtonText: "No! cancelalo!",
                        closeOnConfirm: false,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {

                        	//inicio
                        	$.ajax({
									//url: 'ajax/guardarBanco.php',
                        url: '../../data/ajax/insercionDatos/guardarCategoriasSubCategorias.php',
      									type: 'POST',
      									dataType: 'JSON',
      									data: { tipo: ''+tipo.value+'',
                                padre : ''+padre+'',
                                nombreCategoria : ''+limpiadorCaracteres(nombreCategoria.value)+'',
                                aplicaTopeImpuesto : ''+aplicaTopeImpuesto+'',
                                valorTopeImpuesto : ''+valTopTaxes+'',
                                id : ''+id.value+''
                         },
								
								})

								.done(function() { //
									 swal({
					                title: "listo! ",
					                text: "Ya Guardé La Categoría!",
                          timer: 2000,  
					                type: "success"
					            });
                  })
								.fail(function() {
									swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
								})
								.always(function() {
                  $('#nombreCategoria').val('');
									$('#modalCategoria').modal('toggle');
								});
                  } else {
                            swal("Cancelaste", "No pasa nada!", "error");
                        }
                    });


}


document.getElementById('guardarCategoria').addEventListener('click', function(){
       guardarCategiria();
      


  });
