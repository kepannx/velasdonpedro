 (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();


$(document).ready(function(){
      loadIndexacion(1);
      
    });


function loadIndexacion(pagina){
      var serial= $("#serial").val();
     
      $("#listadoSerialesDisponibles").fadeIn('slow');
      $.ajax({
        url:'../../data/ajax/acciones/listaImeisDisponibles.php?page='+pagina+'&serial='+serial+'&tipo=1',
         beforeSend: function(objeto){
         $('#listadoSerialesDisponibles').html('<div class="col-md-12" align="center"><img src="../../../../images/cargando.gif" width = "100px"> Cargando...</div>');
        },
        success:function(data){
          $('#listadoSerialesDisponibles').html(data);
        }
      })
    }
