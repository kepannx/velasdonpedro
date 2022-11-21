
function editarServicioProducto(){
    swal({
                        title: "Seguro?",
                        text: "¿Estas seguro que quieres editar este Producto?",
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

                                if ((($('[id=serializacion]')[0].checked)=== true)){
                                        var serializacion = 'si';
                                        if (($('[id=serial]')[0].checked)===true) {var serial='si'}else{var serial='no'}
                                        if (($('[id=imei]')[0].checked)===true) {var imei='si'}else{var imei='no'}
                                        if (($('[id=otroTipoSerial]')[0].checked)===true) {var otroTipoSerial='si'}else{var otroTipoSerial='no'}
                                }else if(($('[id=serializacion]')[0].checked)===false){
                                    var serializacion= 'no';
                                    var serial='no';
                                    var imei='no';
                                    var otroTipoSerial='no';
                                }



                                if (tipoProductoServicio.value === 'servicio') {
                                    var subCategoria = 'null';
                                }else if (tipoProductoServicio.value === 'producto') {
                                   
                                    if ((typeof($('#subCategoria').val()) === 'undefined')) {
                                         var subCategoria='null';
                                    }
                                    else if ((typeof($('#subCategoria').val()) != 'undefined'))  {

                                       var subCategoria = $('#subCategoria').val();
                                    }
                                };


                               // if (($('[id=retiroTemporal]')[0].checked)===true){var mostrar="si";}else{ var mostrar = "no";}
                                //if (($('[id=web]')[0].checked)===true){var web="si";}else{ var web = "no";}
                               /* var ventaCruzada =[];
                                for (var i = $('#ventaCruzada :selected').length - 1; i >= 0; i--) {
                                                ventaCruzada.push($('#ventaCruzada :selected')[i].value);
                                }; */



                               var categoria =  $( "#categoria option:selected" ).val();
                               console.log(categoria);
                               console.log(subCategoria);

                            //inicio
                            $.ajax({
                                    //url: 'ajax/guardarUsuario.php',
                                    url: '../../data/ajax/edicionDatos/editarServicioProductos.php',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: { nombreProductosServicios: ""+limpiadorCaracteres(nombreProductosServicios.value)+"", 
                                    tipoProductoServicio: ""+limpiadorCaracteres(tipoProductoServicio.value)+"", 
                                    marca: ""+limpiadorCaracteres(marca.value)+"", 
                                    serializacion: ""+limpiadorCaracteres(serializacion)+"",
                                    serial: ""+limpiadorCaracteres(serial)+"",
                                    imei: ""+limpiadorCaracteres(imei)+"",
                                    otroTipoSerial: ""+limpiadorCaracteres(otroTipoSerial)+"",
                                    categoria: ""+(categoria)+"",
                                    subCategoria: ""+(subCategoria)+"",
                                    sku: ""+limpiadorCaracteres(sku.value)+"",
                                    valorVentaUnidad: ""+limpiadorCaracteres(valorVentaUnidad.value)+"",
                                    valorVentaPorMayor: ""+limpiadorCaracteres(valorVentaPorMayor.value)+"",
                                    cantidadMinimaGlobal: ""+limpiadorCaracteres(cantidadMinimaGlobal.value)+"",
                                    cantidadMinimaPuntos: ""+limpiadorCaracteres(cantidadMinimaPuntos.value)+""
                                },                                    
                                })
                                .done(function(data) { //Cuando  ingresa entonces  sacame la guia
                                    swal({
                                    title: "listo! ",
                                    text: "Ya Edité El Producto!",
                                    timer: 2000,  
                                    type: "success"
                                });})
                                .fail(function() {
                                    swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
                                })
                                .always(function() {
                                    //clear
                                });   
                        } 
                    });

}
//Fin de la edición


document.getElementById('editarDatosProductoServicio').addEventListener('click', function(){
	
		editarServicioProducto();
       
  });
