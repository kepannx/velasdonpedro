function validarNuevoPuntoVenta(){
	if (nombrePunto.value.length <= 2) {
		swal({   
            title: "Auch!",   
            text: "Si no me das el nombre del punto de venta no te lo guardaré",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}

	else if (direccion.value.length <= 3) {
		swal({   
            title: "Auch!",   
            text: "Si no me das una dirección real no te lo guardaré",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (departamentos.value.length ==0) {
		swal({   
            title: "Auch!",   
            text: "Si no me das una el departamento no te lo guardaré",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (ciudadPunto.value.length ==0) {
		swal({   
            title: "Auch!",   
            text: "Si no me das una ciudad no te lo guardaré",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (idAdministrador.value.length ==0) {
		swal({   
            title: "Auch!",   
            text: "Se supone que quién va a administrar el punto? dame un administrador por favor",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (username.value.length <= 2) {
		swal({   
            title: "Auch!",   
            text: "No puedo crear un punto si no me das un usuario de acceso.",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (password.value.length <= 2) {
		swal({   
            title: "Auch!",   
            text: "Y la contraseña con que van a entrar? debes darme una",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}



	else if (nitPunto.value.length <= 2) {
		swal({   
            title: "Auch!",   
            text: "Necesito que me des un NIT o número de identificación para el punto de venta",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}


	else if (representanteLegal.value.length <= 2) {
		swal({   
            title: "Auch!",   
            text: "Debo registrar un representante legal, ¿quién es?",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
	}

	else{
		return true;
	}
}

//Valido que la dirección este corectamente ingresada
function validoDirecciones(){
  if (nomenclatura1.value.length == 0 || nomenclatura2.value.length == 0 || tipo1.value.length == 0 || tipo2.value.length == 0) {
  swal({   
            title: "Ops!",   
            text: "Necesito que me des la dirección completa",
            type: "error",   
            timer: 3000,   
            showConfirmButton: false 
        });
        return false;
  }
  else
  {
    return true;
  }
}
//Fin de la validación de direcciones

(function(){
    
})

//Validacion de productos servicios
function validacionProductosServicios(){
    

    if (tipoProductoServicio.value =='producto') {
        if (sku.value.length <= 2) {
            swal({   
                title: "Auch!",   
                text: "Necesito que me digas con que Código o SKU lo vamos a guardar para identificarlo",
                type: "error",   
                timer: 4000,   
                showConfirmButton: true 
            });
            }
            else if (nombreProductosServicios.value.length <= 2){
                swal({   
                    title: "Auch!",   
                    text: "Necesito que el item tenga mas de dos caracteres",
                    type: "error",   
                    timer: 4000,   
                    showConfirmButton: true 
                });
            }
        else
        {
            return true;
        }

    }
    else if (tipoProductoServicio.value =='servicio'){
        if (nombreProductosServicios.value.length <= 2){
            swal({   
                title: "Auch!",   
                text: "Necesito que el item tenga mas de dos caracteres",
                type: "error",   
                timer: 4000,   
                showConfirmButton: true 
            });}
            else
            {
                return true;
            }
    }

}


//Limpio caracteres
function limpiadorCaracteres(parametro){
        return  res= parametro.replace(/[^a-zA-Z 0-9]`+/g,' ');
}



function limpiadorCaracteresConPunto(parametro){
        return  res= parametro.replace(/[.A-Z a-z Á-Ú á-ú]/gi, "");
}