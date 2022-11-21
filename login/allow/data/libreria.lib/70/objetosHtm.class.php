<?php 
date_default_timezone_set('america/bogota');

//Saco los objetos necesarios para mostrar con html
class objetosHtml  {
	



/* SELECCIÓN DE LOS REGIMENES TRIBUTARIOS REGISTRADOS */

public function selectTiposRegimenTributario($parametro)
{

  echo '
          <option value="persona natural" '.$this->selected($parametro, 'persona natural').'>Persona Natural</option>
          <option value="empresa unipersonal" '.$this->selected($parametro, 'empresa unipersonal').'>Empresa Unipersonal</option>
          <option value="s.a.s" '.$this->selected($parametro, 's.a.s').'>S.A.S</option>
          <option value="sociedad colectiva" '.$this->selected($parametro, 'sociedad colectiva').'>Sociedad Colectiva</option>

          <option value="s.a" '.$this->selected($parametro, 's.a').'>S.A</option>

          <option value="ltda" '.$this->selected($parametro, 'ltda').'>Ltda</option>

          <option value="S.en C" '.$this->selected($parametro, 'S.en C').'>S.en C</option>

          <option value="S.C.A" '.$this->selected($parametro, 'S.C.A').'>S.C.A</option>


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




public function selectCancelacionFacturasProvedor($parametro){
    echo '<option value="cancelado" '.$this->selected($parametro, 'cancelado').'>Ya La Pagué</option>
      <option value="credito" '.$this->selected($parametro, 'credito').'>Esta En Crédito</option>
      <option value="consignacion" '.$this->selected($parametro, 'consignacion').'>Esta En Consignación</option>
    ';
  }


  

//Seleccion de tipo de impresión
public function selectFormatoImpresion(){
	echo '	<option value="tirilla" '.$this->selected($parametro, 'tirilla').'>Tirilla</option>
			<option value="media carta" '.$this->selected($parametro, 'media carta').'>Media Carta</option>
	';
}



//Seleccion de Metodos de Pago
public function selectMetodosPago(){
	echo '	<option value="tirilla" '.$this->selected($parametro, 'tirilla').'>Tirilla</option>
			<option value="media carta" '.$this->selected($parametro, 'media carta').'>Media Carta</option>
	';
}
/*******************[CHECK OPTIONS]**********************/




//Check activación de bodega para punto	
public function checkBodegas($parametro){
	return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="bodegas" class="js-switch"  data-color="#073c69" data-size="large"/>';
}


//Selección de los productos y servicios
	public function selectTipoProductoServicio($parametro){
		return '<option value="producto" '.$this->selected($parametro, 'producto').'>Producto</option>
	        	<option value="servicio"  '.$this->selected($parametro, 'servicio').'>Servicio</option>';
	}


	//Check activación Si el producto es serializado
	public function checkProductoSerializado($parametro){
		return '<input type="checkbox"  '.$this->selectedCheckbox($parametro).'  id="serializacion" class="js-switch"  data-color="#073c69" data-size="large"/>';
	}

//Selección de Categoria/subcategoria
	public function selectCategoriaSubcategoria($parametro){
		return '<option value="producto" '.$this->selected($parametro, 'producto').'>Producto</option>
	        	<option value="servicio"  '.$this->selected($parametro, 'servicio').'>Servicio</option>';
	}


//*********************[ICONOS]****************************//





	//Defino cual de los option select es el elegido como predeterminado según el parametro que le pase
	public function selected($parametro, $value)
	  {
	    if($parametro==$value)
	    {
	      return 'selected="select"';
	    }
	    else
	    {
	      return '';
	    }
	  }



	//Me checkea o   descheckea los parametros
	  public function selectedCheckbox($parametro)
	  {
	    if($parametro=='' ||$parametro=='no' )
	    {
	      return '';
	    }
	    else
	    {
	      return 'checked';
	    }
	  }




	//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
	public function formatoFecha($parametro)
	{
	  $fecha=explode("/", $parametro);
	  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
	}
  

	public function encrypt($string, $key) {
		$result = '';
		for ($i = 0; $i < strlen($string); $i++) {
			$char    = substr($string, $i, 1);
			$keychar = substr($key, ($i%strlen($key))-1, 1);
			$char    = chr(ord($char)+ord($keychar));
			$result .= $char;
		}
		return base64_encode($result);
	}

//desencripto el parametro
	public function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);
		for ($i = 0; $i < strlen($string); $i++) {
			$char    = substr($string, $i, 1);
			$keychar = substr($key, ($i%strlen($key))-1, 1);
			$char    = chr(ord($char)-ord($keychar));
			$result .= $char;
		}
		return $result;
	}

}


define(key, "SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen");
define(publickey, "5663284166397124291158310398993993");

?>