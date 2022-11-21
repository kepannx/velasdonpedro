$(document).ready(function() {
swal({
  title: "Acceso Restringido",
  text: "Necesito que me escribas la contraseña del administrador del punto",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  inputPlaceholder: "escribe tu contraseña"
}, function (inputValue) {
  if (inputValue === false)  window.location.href = '../../';
  if (inputValue === "") {
    swal("ERROR!", "No puedes entrar acá", "error");
    window.location.href = '../../';
  }
  checkPass(inputValue);
});

  });




function checkPass(inputValue){
  $.ajax({
  url: '../../data/ajax/acciones/checkPass.php',
  type: 'POST',
  dataType: 'JSON',
  data: {pass: ''+inputValue+''},
})

.done(function(data) {
  if ((data)>0) {
      swal("Ok!", "Bienvenido Admin", "success");
      $('#loadHeaders').css('display', 'block');
  listaProductos(1, null, null);
  }else{
    swal("ERROR!", "No puedes entrar acá", "error");
    window.location.href = '../../';
  }
})
}



$.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'categoria', padre : 0}, function(dataCategorias) {
                $('#categories').html('<option  value="0"> Selecciona una Categoria</option>'+dataCategorias);
              
        });


$('#categories').change(function(){
        var padre = $( "#categories option:selected" ).val();
          $.post(url.value+"data/ajax/acciones/checkSubCategorias.php", { tipo : 'subCategoria', padre : padre }, function(dataCategorias) {
          $('#subCategories').html('<option value="0">Selecciona</option>'+dataCategorias+'');
           $('#queryBusqueda').val('');
        });
        listaProductos(1, padre, null);
      });
$('#subCategories').change(function() {
  $('#queryBusqueda').val('');
  listaProductos(1, $('#categories').val(),$('#subCategories').val());
});






 function listaProductos(pagina,categoria,subCategoria ) {
  $("#listaProductosServicios").empty();
  if (typeof(categoria)=='undefined') {
    var categoria= $('#categories').val();
  };
  if (typeof(subCategoria)=='undefined') {
    var subCategoria= $('#subCategories').val();
  };

  var categoria=parseInt(categoria);
  var subCategoria=parseInt(subCategoria);

  var pagina=parseInt(pagina);
  var queryBusqueda= $('#queryBusqueda').val();
  $.ajax({
        url:''+url.value+'data/ajax/acciones/listaProductos.php?page='+parseInt(pagina)+'&q='+queryBusqueda+'&categoria='+parseInt(categoria)+'&subCategoria='+parseInt(subCategoria),
         beforeSend: function(objeto){

         $('#listaProductosServicios').html('<div class="col-md-12" align="center"><img src="../../images/cargando.gif" width = "100px"> Cargando...</div>');
        },
        success:function(data){

          $('#listaProductosServicios').html(data);
          $('#tablaInventario').footable();

        }
      }) 
 }
