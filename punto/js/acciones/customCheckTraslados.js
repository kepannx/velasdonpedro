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

$('.input-daterange-datepicker').daterangepicker({
          buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
        });





 (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();


$(document).ready(function() {
  //Cargo los traslados que esten pendientes
$.post('../../data/ajax/acciones/listaPreTrasladoPunto.php', {}, function(data) {
  $('#trasladosPendientes').html(data);
});

});


function trasladoMercancia(){
  $('input[id="idTraslado"]:checked').each(function() {
   $.ajax({
    url: '../../data/ajax/insercionDatos/guardarTraslado.php',
    type: 'GET',
    dataType: 'JSON',
    data: {idTraslado: ''+parseInt(this.value)+''},
  })
   $.post('../../data/ajax/acciones/listaPreTrasladoPunto.php', {}, function(data) {
  $('#trasladosPendientes').html(data);
});

});
}


$(document).ready(function() {

  fechas = fechaFiltro.value.split('-');
  $.post('../../data/ajax/acciones/historialTrasladosMercancia.php', {  fecha1 : ''+fechas[0]+'', fecha2 : null }, function(datosTabla) {
        $('#historicoTraslados').html(datosTabla);
      });

  });

document.getElementById('filtrar').addEventListener('click', function(){
      fechas = fechaFiltro.value.split('-');
     $.post('../../data/ajax/acciones/historialTrasladosMercancia.php', { fecha1 : ''+fechas[0]+'', fecha2 : ''+fechas[1]+'' }, function(datosTabla) {
        $('#historicoTraslados').html(datosTabla);
  });
   
})







