<?php 
date_default_timezone_set('america/bogota');

//Saco los objetos necesarios para mostrar con html
class objetosHtml  extends conect {

	/* SELECCIÓN DE LOS REGIMENES TRIBUTARIOS REGISTRADOS */
	public function selectTiposRegimenTributario($parametro)
	{

	  echo '	
	  		<option value="persona natural" '.$this->selected($parametro, 'persona natural').'>Persona Natural</option>


	  		  <option value="regimen simplificado" '.$this->selected($parametro, 'regimen simplificado').'>Régimen Simplificado</option>
	  		  


			  <option value="regimen comun" '.$this->selected($parametro, 'regimen comun').'>Régimen Común</option>
	  		  
	          
	          <option value="empresa unipersonal" '.$this->selected($parametro, 'empresa unipersonal').'>Empresa Unipersonal</option>
	          <option value="s.a.s" '.$this->selected($parametro, 's.a.s').'>S.A.S</option>
	          <option value="sociedad colectiva" '.$this->selected($parametro, 'sociedad colectiva').'>Sociedad Colectiva</option>

	          <option value="s.a" '.$this->selected($parametro, 's.a').'>S.A</option>

	          <option value="ltda" '.$this->selected($parametro, 'ltda').'>Ltda</option>

	          <option value="S.en C" '.$this->selected($parametro, 'S.en C').'>S.en C</option>

	          <option value="S.C.A" '.$this->selected($parametro, 'S.C.A').'>S.C.A</option>


	       ';
	}

	public function selectCancelacionFacturasProvedor($parametro){
		echo '<option value="cancelado" '.$this->selected($parametro, 'cancelado').'>Ya La Pagué</option>
			<option value="credito" '.$this->selected($parametro, 'credito').'>Esta En Crédito</option>
			<option value="consignacion" '.$this->selected($parametro, 'consignacion').'>Esta En Consignación</option>
		';
	}



	public function optionValuesSeriales($serial, $imei, $otroTipoSerial){
		echo '
				<label class="col-md-12" align="center">Tipo de Seriales</label>
					<div class="checkbox checkbox-info checkbox-circle">
						<div class="col-md-7">
							<input id="serial" type="checkbox" '.$this->selectedCheckbox($serial).' >
							<label for="serial"> Serial </label>
						</div>
						<div class="col-md-7">
							<input id="imei" type="checkbox" '.$this->selectedCheckbox($imei).' >
								<label for="imei"> Imei </label>
							</div>
							<div class="col-md-7">
								<input id="otroTipoSerial" type="checkbox" '.$this->selectedCheckbox($otroTipoSerial).'>
									<label for="otroTipoSerial"> Otro </label>
								</div>
							</div>
						';
	}




	//Selección de los productos y servicios
	public function selectTipoProductoServicio($parametro){
		return '<option value="producto" '.$this->selected($parametro, 'producto').'>Producto</option>
	        	<option value="servicio"  '.$this->selected($parametro, 'servicio').'>Servicio</option>';
	}

	//Seleccion de tipo de impresión
	public function selectFormatoImpresion($parametro){
		echo '	<option value="tirilla" '.$this->selected($parametro, 'tirilla').'>Tirilla</option>
				<option value="media carta" '.$this->selected($parametro, 'media carta').'>Media Carta</option>
		';
	}

	//Check activación de bodega para punto	
	public function checkBodegas($parametro){
		return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="bodegas" class="js-switch"  data-color="#073c69" data-size="large"/>';
	}




	//Check activación Si el producto es serializado
	public function checkProductoSerializado($parametro){
		return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="serializacion" class="js-switch"  data-color="#073c69" data-size="large"/>';
	}

	//Check Existencia
	public function checkExistencia($parametro){
		return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="retiroTemporal" class="js-switch"  data-color="#073c69" data-size="large"/>';
	}

	//Check Existencia
	public function checkMostrarWeb($parametro){
		return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="web" class="js-switch"  data-color="#073c69" data-size="large"/>';
	}


}