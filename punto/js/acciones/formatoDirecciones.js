function configuracionDireccion(){

 	nm1= nomenclatura1.value.replace(/[^a-zA-Z 0-9]+/g,' ');
 	nm2= nomenclatura2.value.replace(/[^a-zA-Z 0-9]+/g,' ');

	 direccionFiltrada=tipo1.value+" "+nm1+" "+tipo2.value+" "+nm2+" "+segundoGrupo.value;
	 $( "#direccionBase" ).html( '<input type="text" class="form-control" id="direccion" placeholder="Debo tener la dirección para ubicarlo" value="'+direccionFiltrada+'"  data-toggle="modal" data-target="#formatoDireccion" required readonly>' );
}


document.getElementById('pasarDireccion').addEventListener('click', function(){
      	if (validoDirecciones()===true) {

      		configuracionDireccion();
      	};	
       
   });