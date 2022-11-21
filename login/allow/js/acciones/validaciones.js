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





//Validación de las facturas de venta 
function validarFacturaVenta(){
    if (identificacionCliente.value.length <= 2) {
        swal({   
            title: "Auch!",   
            text: "Necesito que me des la identificación del cliente",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
        return 1;
    }

    else if (nombreCliente.value.length <= 2) {
        swal({   
            title: "Auch!",   
            text: "Sin el nombre no puedo dejarte registrar la venta",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });

        return 2;
    }

    else if (ciudadCliente.value.length <= 3) {
        swal({   
            title: "Auch!",   
            text: "Debo saber donde vive el cliente",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });

        return 3;
    }


    else if (direccionCliente.value.length ==0) {
        swal({   
            title: "Auch!",   
            text: "Si no me dices la dirección de facturación del cliente no te puedo dejar registrar la compra",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });

        return 4;
    }

    

    else if (($( "#codigoVendedor option:selected" ).val().length) == 0) {
         swal({   
            title: "Auch!",   
            text: "Necesito que me digas quien es el vendedor",
            type: "error",   
            timer: 4000,   
            showConfirmButton: true 
        });
         return 5;
    }

    else if (tipoDocumento.value === 'NIT') {
        if (identificacionCliente.value.indexOf('-') === -1) {
            swal({   
            title: "Auch!",   
            text: "Necesito el digito de verificación del nit. Asegurate de ponerle un guión,  Ejemplo: xxxxxxx-x",
            type: "error",   
            timer: 5000,   
            showConfirmButton: true 
        });
        }else{
            return true;
        }

    }

    else{
        return true;
    }
}





//Validación del ingreso de las categorías
function validacionCategorias(){
    if (nombreCategoria.value.length <= 2) {
            swal({   
                title: "Auch!",   
                text: "Necesito que me digas como llamarás a esta categoría",
                type: "error",   
                timer: 4000,   
                showConfirmButton: true 
            });
            }
        if (($('[id=aplicaTopeImpuesto]')[0].checked)===true){
            if (valTopTaxes.value.length <= 1) {
            swal({   
                title: "Auch!",   
                text: "Necesito que le des un valor al tope",
                type: "error",   
                timer: 4000,   
                showConfirmButton: true 
            });
            }

        }
        else
        {
            return true;
        }
}








//Validación de actualización de provedores
function validacionProvedores(){
    if (nombreProvedor.value.length <= 1) {
            swal({   
                title: "Auch!",   
                text: "Necesito que me digas como se llama el provedor",
                type: "error",   
                timer: 4000,   
                showConfirmButton: true 
            });
            }

    if (ideProvedor.value.length <= 3) {
            swal({   
                title: "Auch!",   
                text: "Necesito que me des el número de identificación del cliente",
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