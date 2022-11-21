function loadTraslados(){
$.ajax({
  url: url.value+'data/ajax/acciones/checkTraslados.php',
  type: 'GET',
  dataType: 'JSON',
  data: {},
})
.done(function(data) {
  if (data>0) {
      $(function() {
        $.toast({
                  heading: 'TIENES TRASLADOS!',
                  text: 'Tienes traslados pendientes por aceptar <a href="'+url.value+'/modulos/inventario/checkTraslados.php">Revisalos Aqui<a/>',
                  position: 'bottom-left',
                  loaderBg:'#ff6849',
                  icon: 'info',
                  hideAfter: 10000, 
                  stack: 6
                });
      }); 
  }
}) 
}

setInterval('loadTraslados()',30000);