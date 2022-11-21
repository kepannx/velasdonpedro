
/*TABLAS*/
 (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();


/*LOAD DATOS DE PUNTO DE VENTA */

$.ajax({
      url: '../../data/ajax/acciones/checkDatosProvedor.php',
      type: 'POST',
      dataType: 'JSON',
      data: {},
    })
    .done(function(data) {
      $('#nombreProvedor').val(data.nombreProvedor);
      $('#direccionProvedor').val(data.direccionProvedor);
      $('#ideProvedor').val(data.ideProvedor);
      $('#telefonoProvedor').val(data.telefonoProvedor);
      $('#contactoProvedor').val(data.contactoProvedor);
      $('#emailProvedor').val(data.emailProvedor);
      $('#sitioWebProvedor').val(data.sitioWebProvedor);
      $('#nombreProvedorTitulo').html(data.nombreProvedor);
    })



//ACTUALIZACION DE PROVEDORES



//Actualización de datos del provedor

$('#actualizarPerfilProvedor').on('click', function(){
  if (validacionProvedores()==true) {
          actualizacionDatos();
  }
})



//HISTORICO DE LAS COMPRAS HECHAS A ESTE PROVEDOR
$.post('../../data/ajax/acciones/listaCompraAProvedor.php', {}, function(datosTabla) {
    /*optional stuff to do after success */
    $('#historialCompras').html(datosTabla);
});


$('#downloadCliente').click(function(e) {
    e.preventDefault();  
    window.location.href = 'plantillas/clientes.xlsx';
    });

//links
function link(parametro){
   window.location.href = 'link.php?data=historico&idFactura='+parametro;
}