function confirmacionDatosPuntoVenta(){
	if (($('[id=bodegas]')[0].checked)===true){//conversión del checkSeguros
                    activacionBodega="Crearé Una Bodega Para Este Punto";
                }
            else{
                activacionBodega="No Crearé Bodega";
            }//fin de la conversión de seguros
	$('#datosBase').html('<div class="col-md-12"><div class="col-md-3"><div class="form-group"><label>Nombre Del Punto</label><div class="input-group">'+nombrePunto.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">Dirección Asignada</label><div class="input-group">'+direccion.value+'</div></div></div><div class="col-md-3"><div class="form-group"><label >Departamento</label><div class="input-group">'+departamentos.value+'</div></div></div><div class="col-md-2"><div class="form-group"><label class="control-label col-md-12">Ciudad</label><div class="input-group">'+ciudadPunto.value+'</div></div></div></div><div class="col-md-12"><div class="col-md-4"><div class="form-group"><label >Tiene Un Sitio Web?</label>'+sitioWebPunto.value+'</div></div><div class="col-md-4"><div class="form-group"><label >Teféfonos</label><div class="input-group">'+telefonoPunto.value+'</div></div></div><div class="col-md-4"><div class="form-group"><label class="control-label col-md-12">Administrador?</label><div class="input-group col-md-12">'+idAdministrador.value+'</div></div></div></div><div class="col-md-12"><div class="col-md-6"><div class="form-group"><div class="input-group"><label class="col-md-3" >Bodega</label><div class="col-md-10">'+activacionBodega+'</div></div></div></div><div class="col-md-4"><div class="form-group"><label >Usuario</label><div class="input-group">'+username.value+'</div></div></div></div>');
	$('#datosTributarios').html('<!-- columna 1 --><div class="col-md-5"><div class="col-md-12"><div class="form-group"><label >Cuál Es El NIT Del Punto</label><div class="input-group">'+nitPunto.value+'</div></div></div><div class="col-12"><div class="form-group"><label >A Cuál Régimen Pertenece?</label><div class="input-group col-md-12">'+regimenTributario.value+'</div></div></div><div class="col-md-12"><div class="form-group"><label >Quién Será El Representante Legal?</label><div class="input-group">'+representanteLegal.value+'</div></div></div><div class="col-md-12"><div class="form-group"><label >Formato De Impresión Predeterminada </label><div class="input-group col-md-12">'+formatoImpresion.value+'</div></div></div></div><!-- fin columna 1 --><!-- columna 2 --><div class="col-md-7"><div class="form-group"><label class="col-md-12" align="center">Términos Y Condiciones De La Factura</label><div class=input-group col-md-12">'+terminosCondicionesFactura.value+'</div></div></div><!-- fin columna2 -->');
}



document.getElementById('confirmaDatos').addEventListener('click', function(){
	event.preventDefault();
  
     if (validarNuevoPuntoVenta()==true) {
           confirmacionDatosPuntoVenta();
        }
    else
    {
        $('#confirmaDatosPuntoVenta').modal('toggle');
    }
   });