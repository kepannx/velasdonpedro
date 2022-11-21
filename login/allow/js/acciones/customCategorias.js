//Opciones de la serialización
document.getElementById('aplicaTopeImpuesto').addEventListener('change', function(){
      if (($('[id=aplicaTopeImpuesto]')[0].checked)===true){
                  $("#tope").addClass("col-md-2");
                  $('#tiposCategoria').addClass("col-md-2");
                  $("#valorTope").html('<div class="form-group"><label>Valor Tope</label><div class="input-group" ><div class="input-group-addon"><i>$</i></div><input type="text" class="form-control" id="valTopTaxes" placeholder="Cómo piensas llamarlo" onkeyup="format(this)" onchange="format(this)" required></div></div>');
                }
            else{
                $("#tope").removeClass("col-md-2");
                $("#tope").addClass("col-md-3");
                $('#tiposCategoria').removeClass("col-md-2");
                $('#tiposCategoria').addClass("col-md-3");
                $("#valorTope").html('');
            }
   
   });


$.post('../../data/ajax/acciones/listaItemsFactura.php', {id: ''+datos.idFactura+'' }, function(datosTabla) {
         $('#listaProductosFacturados').html(datosTabla);
      });
