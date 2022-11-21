
/*TABLAS*/


$(document).ready(function(){
      load(1);
      
    });


function load(pagina){
      var q= $("#q").val();
      var categoria = $("#categoria").val();
      if (typeof($("#subCategoria").val())==undefined) {
        var subCategoria=0;
      }else{
        subCategoria=$("#subCategoria").val();
      }
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'../../data/ajax/acciones/listaClientes.php?page='+pagina+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<div class="col-md-12" align="center"><img src="../../../../images/cargando.gif" width = "100px"> Cargando...</div>');
        },
        success:function(data){
          $('#loader').html(data);
        }
      })
    }







 $(document).ready(function(){
      $('#tablaClientes').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "drawCallback": function ( settings ) {
            var api = this.api();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

              }
            } );
          }
        } );
  });




    });

