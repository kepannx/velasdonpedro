
// Notificacion de acceso

$(document).ready(function() {
      $(".NotificacionAcceso").click(function(){
           $.toast({
            heading: 'Notificacion de Acceso', // Cabecera notificacion
            text: 'El cliente ... acabo de ingresar al Gym ', // body Notificacion
            position: 'top-right', // posicion
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3000,
            stack: 6
          });
     });
});
