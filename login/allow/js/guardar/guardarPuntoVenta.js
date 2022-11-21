
function guardarPuntosVenta()
{
if (($('[id=bodegas]')[0].checked)===true){
                    bodegas=true;
                }
            else{
                bodegas=false;
            }
$.ajax({
            //url: 'ajax/guardarUsuario.php',
            url: '../../data/ajax/insercionDatos/guardarPuntoVenta.php',
            type: 'POST',
            dataType: 'JSON',
            data: { nombrePunto: ""+limpiadorCaracteres(nombrePunto.value)+"", 
            direccion: ""+limpiadorCaracteres(direccion.value)+"", 
            departamentos: ""+limpiadorCaracteres(departamentos.value)+"", 
            ciudadPunto: ""+limpiadorCaracteres(ciudadPunto.value)+"", 
            idAdministrador: ""+limpiadorCaracteres(idAdministrador.value)+"",
            sitioWebPunto : ""+sitioWebPunto.value+"",
            bodegas: ""+bodegas+"", 
            username: ""+username.value+"", 
            password: ""+password.value+"",  
            nitPunto: ""+limpiadorCaracteres(nitPunto.value)+"", 
            regimenTributario: ""+regimenTributario.value+"", 
            representanteLegal:""+representanteLegal.value+"" ,
            telefonoPunto:""+telefonoPunto.value+"" ,
            terminosCondicionesFactura : ""+terminosCondicionesFactura.value+"",
            formatoImpresion : ""+formatoImpresion.value+"",
            nroInicioFactura : ""+nroInicioFactura.value+"",
            id:""+id.value+""},                                    
        })
        .done(function() { //Cuando  ingresa entonces  sacame la guia
                swal({
            title: "listo! ",
            text: "Ya Guardé El Punto De Venta!",
            timer: 2000,  
            type: "success"
        });})
        .fail(function() {
            swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
        })
        .always(function() {
            //clear

    
            formObj.nombrePunto.value = ''; 
            formObj.direccion.value = ''; 
            formObj.sitioWebPunto.value = '';  
            formObj.username.value = ''; 
            formObj.password.value = '';
            formObj.passwordMatch.value='';
            formObj.nitPunto.value = '';
            formObj.representanteLegal.value = '';
            formObj.telefonoPunto.value = '';
            formObj.terminosCondicionesFactura.value = '';
             $('#confirmaDatosPuntoVenta').modal('toggle');
            
        });
}






document.getElementById('guardaDatosPuntoVenta').addEventListener('click', function(){
		if(validarNuevoPuntoVenta()==true){
		guardarPuntosVenta();
		};       
  });
