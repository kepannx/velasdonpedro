
var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');

        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });
        cb(matches);
      };
    };


//Opciones de la serialización
document.getElementById('serializacion').addEventListener('change', function(){
      if (($('[id=serializacion]')[0].checked)===true){
                  $("#capaSerializada").addClass("col-md-3");
                  $("#serializado").html('<div class="form-group col-md-12"><label class="col-md-12" align="center">Tipo de Seriales</label><div class="checkbox checkbox-info checkbox-circle"><div class="col-md-7"><input id="serial" type="checkbox" checked ><label for="serial"> Serial </label></div><div class="col-md-7"><input id="imei" type="checkbox" ><label for="imei"> Imei </label></div><div class="col-md-7"><input id="otroTipoSerial" type="checkbox"><label for="otroTipoSerial"> Otro </label></div></div></div>');
                }
            else{
                $("#capaSerializada").removeClass("col-md-3");
                $("#capaSerializada").addClass("col-md-4");
                $("#serializado").html('');
            }
   
   });

//Ocultamiento y show de las opciones según  si es servicio o producto
document.getElementById('tipoProductoServicio').addEventListener('change', function(){
    if (($('[id=tipoProductoServicio]')[0].value)=='servicio') {
        $('#capaServicios').hide();
        $('#segundoRenglonCapaServicios').hide();
        $('#tercerRenglonCapaServicios').hide();
        $("#capaSerializada").removeClass();
        $("#capaSerializada").addClass("col-md-8");
        $('#valorFinalServicio').removeClass();
        $('#valorFinalServicio').addClass("col-md-12");
    }
    else
    {
      $('#capaServicios').show();
      $('#segundoRenglonCapaServicios').show();
      $("#capaSerializada").addClass("col-md-4");
      $('#valorFinalServicio').addClass("col-md-3");
      $('#tercerRenglonCapaServicios').show();
        
    }
});




//Checkeo nombre de producto repetido
$(function(){
  $('#nombreProductosServicios').change(function(){
   $.ajax({
      url     : '../../data/ajax/acciones/checkProductosRepetidos.php',
      type    : 'POST',
      data: { producto: ""+$(this).val()+""},
      success :  function(data){
         if (data=='true') {
           swal("Ops!", "No puedo dejarte registrar un producto con el mismo nombre", "warning");
           $("#nombreProductosServicios").val('');
         }
      }
    });
  });
});

//Checkeo sku repetido
$(function(){
  $('#sku').change(function(){
   $.ajax({
      url     : '../../data/ajax/acciones/checkSkuRepetido.php',
      type    : 'POST',
      data: { sku: ""+$(this).val()+""},
      success :  function(data){
         if (data=='true') {
           swal("Ops!", "El Código/sku no puede estar repetido, Necesitas asignarle otro", "warning");
           $("#sku").val('');
         }
      }
    });
  });
});

//Activa la subcategoria
$(function(){
  $('#categoria').change(function(){
   $.ajax({
      url     : '../../data/ajax/acciones/selectSubCategorias.php',
      type    : 'POST',
      data: { categoria: ""+$(this).val()+""},
      success :  function(resultado){
        $('#subCat').html(resultado);
      }
    });
  });

});




$.post('../../data/ajax/acciones/typerhead/listaProductos.php', {}, function(datos) {
    var productos = JSON.parse(datos);
    
    $('#productosServicios .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'productos',
      source: substringMatcher(productos)
    });
});



$.post('../../data/ajax/acciones/typerhead/listaMarcas.php', {}, function(datos) {
    var marcas = JSON.parse(datos);
    
    $('#marcas .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'marcas',
      source: substringMatcher(marcas)
    });
});
// ---------- Bloodhound ----------



     
// -------- Scrollable --------

