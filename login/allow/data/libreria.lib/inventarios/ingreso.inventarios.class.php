<?php
class ingresoInventarios extends conectar  {

public function datosProvedores($parametro, $vector)
{
  

  $idprovedor=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM provedores WHERE idprovedor='".$idprovedor."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'nombreProvedor':
      # code...
      return $rs["nombreProvedor"];
      break;


    case 'ideProvedor':
      # code...
      return $rs["ideProvedor"];
      break;

    case 'direccionProvedor':
      # code...
      return $rs["direccionProvedor"];
      break;

    case 'ciudadProvedor':
      # code...
      return $rs["ciudadProvedor"];
      break;

    case 'emailProvedor':
      # code...
      return $rs["emailProvedor"];
      break;

    case 'telefonoProvedor':
      # code...
      return $rs["telefonoProvedor"];
      break;


    case "contactoProvedor":
      # clienteCupoCredito...
      echo $rs["contactoProvedor"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}





public function ingresoInventario($parametros)
{
	conectar::conexiones();
	extract($parametros);
	
	//Verifico Existencia de Producto y provedores
	$idProducto=$this->existenciaProducto($productoId, $id);
	//$provedorId=$this->existenciaProvedor($idProvedor, $id);
	
	//desencripto el id 
	$idConvenio=$this->decrypt($id, key);
	if($idProducto==0)
	{
		//Ingresar El Producto
		 $sqlProducto="INSERT INTO productosConvenio SET productosConvenioNombre='".$this->filtroStrings($productoId,2)."',
														productoConvenioMedida='".$this->filtroNumerico($productoConvenioMedida)."',
														productosConvenioValor='".$this->normalizacionDeCaracteres($productosConvenioValor)."',
														productosConvenioProductoReceta='".$this->filtroNumerico($productosConvenioProductoReceta)."',
														productosConvenioMinimo='".$this->filtroNumerico($productosConvenioMinimo)."',
														convenioId='".$this->decrypt($id, key)."'";
		if (mysql_query($sqlProducto)) {
			# code...
			return 1;//is ok
		}
		else{
			return 0; //Error;
		}
	
	}
	else
	{
		$this->errorLog("02-02-02-00-03");
		return $this->avisos("error", "No puedes guardar un producto con el mismo nombre :/");
		
	}

	conectar::desconectar();
}







//Ingreso los productos por lotes
public function ingresoLotes($parametros)
{
	extract($parametros);	
	//saco los provedores
	$provedorId=$this->existenciaProvedor($idProvedor);
	//CONVERTIR FECHA  EN FORMATO ADECUADO
	$fechaFacturaProvedor=$this->formatoFecha($fechaFacturaProvedor);
	
	//Filtro de datos
	$nroFacturaProvedor=$this->filtroStrings($nroFacturaProvedor, 0);
	$estadoFactura=$this->filtroStrings($estadoFactura, 0);
	$valorFacturaProvedor=$this->filtroNumerico($valorFactura);
	if($estadoFactura=='cancelado'){
		$deudaFacturaProvedor=0;
	}
	else{

		$deudaFacturaProvedor=$this->filtroNumerico($deudaFacturaProvedor);
	}
	
	//Ingreso  los datos básicos de la factura
 	$sql="INSERT INTO facturasProvedores SET idProvedor='".$this->filtroNumerico($provedorId)."', fechaFacturaProvedor='".$fechaFacturaProvedor."',
	 											nroFacturaProvedor='".$nroFacturaProvedor."',
	 											estadoFactura='".$estadoFactura."', 
	 											fechaPagar=NULL,
	 											valorFacturaProvedor='".$valorFacturaProvedor."',
	 											deudaFacturaProvedor='".$deudaFacturaProvedor."'";
	 											
	if (mysql_query($sql)) {//Si ingresó la factura correctamente entonces  ejecuteme la siguiente orden
		# Capturo el id de la factura que acabé de ingresar...
		$IdFacturaProvedor=mysql_insert_id();
		$t=sizeof($itemName);
		$n=0;
		$a=0;

		while ($t>$n)
		{
			# code...
			$idProducto=$this->existenciaProducto($itemName[$n]);
			if ($idProducto==0) 
			{
				# Si no tengo el producto registrado, lo ingreso a la base de datos...
				$sqlProducto="INSERT INTO PRODUCTOSERVICIOS SET nombreProductosServicios='".$this->filtroStrings($itemName[$n],2)."', sku='".$sku[$n]."', tipoProductoServicio='producto'";


				mysql_query($sqlProducto);
				$idProducto=mysql_insert_id();

					//Como ingrese un producto entonces necesito avisar que hay productos nuevos para que les den un precio
					if(!isset($_SESSION["nuevoProducto"]))
					{	
						//Ingreso el producto en esta sesion para pasarla  al frontend 
						$_SESSION['nuevoProducto'][$a]=$productosNuevos[$n]=$idProducto."-".$this->filtroStrings($itemName[$n],2);
					}
					else
					{	//hay mas de un producto que es nuevo, entonces hago lo mismo de arriba  solo que  los pongo en arrays
						$_SESSION['nuevoProducto'][$a]=$productosNuevos[$n]=$idProducto."-".$this->filtroStrings($itemName[$n],2);
					 //Registro los productos que deben ser intervenidos por que son nuevos.
					}
				$a++;
			}

			$precio=$this->filtroNumerico($price[$n]);
			$unidadesCompradas=$this->filtroNumerico($quantity[$n]);
			$sqlInventario="INSERT INTO inventario SET  idProvedor='".$provedorId."', 
														IdFacturaProvedor='".$IdFacturaProvedor."', 
														idProductoServicio='".$idProducto."', 
														fechaIngreso='".$fechaFacturaProvedor."',
														valorUnidad='".$precio."',
														tipoNegocio='compra',
														unidadesCompradas='".$unidadesCompradas."',
														unidadesExistentes='".$unidadesCompradas."'

			";
			if (mysql_query($sqlInventario))
					{
						# code...
						$n++;
					}
					else
					{	
						$n=0; //Error al ingresar un inventario
						$this->errorLog("00-02-02-00-04-00");
						return 2;
						exit(); 
					}
		}//Fin del while
			

		//Verifico si existe un abono y lo hago en caso de existir
		$abonoDeuda=$this->filtroNumerico($this->filtroNumerico($abonoDeuda));
		if($abonoDeuda>0 AND $estadoFactura=="credito")
			{
				$sql="INSERT INTO abonosFacturaProvedor SET idFacturaProvedor='".$IdFacturaProvedor."',
															fechaAbonoFactura='".$fechaFacturaProvedor."',
															valorAbonoFactura='".$abonoDeuda."'
				";
				mysql_query($sql);

				//Ingreso el egreso(no es chiste)
				$sql="INSERT INTO  egresosGastos SET tipoEgresoGasto='egreso', fechaEgresoGasto='".$fechaFacturaProvedor."', descripcion='Abono a factura nro ".$nroFacturaProvedor." del provedor ".$this->datosProvedores($provedorId, 'nombreProvedor')."',valorEgresoGasto='".$abonoDeuda."' ";
				mysql_query($sql);
			}
			
				
			
	 		
	
		}

		if ($n==$t) {
				# code...
				return 1;//Listo
			}
			else
			{
				return 2; //no se logro ingresar todos los items
			}

	
}





//Si las unidades en un paquete superan el 1  debo multiplicarlos por las cantidades que compre
//ejemplo:  si compre dos canastas de  huevos  y la canasta de huevos  trae 24 entonces debo multiplicar  24 x 2
private  function calculoUnidadesCompradas($unidadescompradas, $cantidadesCompradas)
{
	$unidadescompradas=$this->filtroNumerico($unidadescompradas);
	$cantidadesCompradas=$this->filtroNumerico($cantidadesCompradas);
	if ($cantidadesCompradas<=1) {
		# code...
		return $unidadescompradas;
	}
	elseif ($cantidadesCompradas>1) {
		# code...
		return  ($cantidadesCompradas*$unidadescompradas);
	}
}


//VERIFICACIÓN DE EXISTENCIA DE PRODUCTO
public  function existenciaProducto($parametro)
{
	//Normalizo los caracteres e igualo el string
	$parametro=$this->normalizacionDeCaracteres($this->filtroStrings($parametro, 0));
	
	$sql="SELECT idproductosServicios, nombreProductosServicios FROM PRODUCTOSERVICIOS";	
	$query=mysql_query($sql);

	while (($rs=mysql_fetch_array($query))) {
				$nombreProducto=$this->normalizacionDeCaracteres($this->filtroStrings($rs["nombreProductosServicios"],0));;
				
				if($nombreProducto==$parametro){
					 $idProducto=$rs["idproductosServicios"];
				}
				else
				{	//Si el id producto tiene algun id entonces siga siendo el mismo valor de ese id
					if($idProducto>0)
					{
						$idProducto=$idProducto;
					}
					else//Si no tiene un ID siga siendo 0;
					{
						$idProducto=0;
					}
				}

		}

		return  $idProducto;

}




//Verifico la existencia de un provedor
public  function existenciaProvedor($parametro)
{
	conectar::conexiones();
	//Normalizo los caracteres e igualo el string
	$parametro=explode("|", $parametro);
	$nombreProvedor=mysql_real_escape_string($parametro[0]);
	$ideProvedor=mysql_real_escape_string($parametro[1]);

	$sql="SELECT idproductosServicios, nombreProductosServicios FROM PRODUCTOSERVICIOS";	
	$query=mysql_query($sql, conectar::conexiones());

	$sql="SELECT idprovedor, ideProvedor, nombreProvedor FROM provedores WHERE ideProvedor='".$ideProvedor."' AND nombreProvedor='".$nombreProvedor."'";	
	$query=mysql_query($sql);

	if (mysql_num_rows($query)==1) {
		# Si existe un provedor entonces saco el ID de ese provedor...
		$rs=mysql_fetch_array($query);
		$idProvedor=$rs['idprovedor'];
	}
	elseif(mysql_num_rows($query)==0){//
		//No existe provedor, debe ingresarse 
		$sql="INSERT INTO provedores SET nombreProvedor='".$nombreProvedor."'";
		mysql_query($sql);
		$idProvedor=mysql_insert_id(); //Ingreso el nuevo provedor y saco el ID asignado
	}
			return  $idProvedor; //Retorno el ID del provedor
}








//Formato de Fecha
//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
	$fecha=explode("/", $parametro);
	return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
}




//Filtro Strings
private function filtroStrings($parametro, $tipo)
{
	//tipo[0]=minuscula  [1]=MAYUSCULA [2]=Tipo Oracion

	if($tipo==0)
	{
		//Minúscula
		return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_LOWER , "UTF-8");
	}
	elseif ($tipo==1) {
		# MAYÚSCULA...
		return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_UPPER , "UTF-8");
	}
	elseif ($tipo==2) {
		# Tipo Oración...
		return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
	}
	else
	{
		//Tipo Oración
		return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
	}
}

//Filtro de numeros

private function filtroNumerico($parametro)
{
  if(intval(filter_var($parametro, FILTER_VALIDATE_INT)==TRUE))
  {
    return intval($parametro);
  }
  elseif(intval(filter_var($parametro, FILTER_VALIDATE_INT)==FALSE))
  {
    return 0;
  }
}





//Filtro con decimal en punto (.) 
private function filtroNumericoDecimal($parametro)
{
  
  if(intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==TRUE))
  {
    return intval($parametro);
  }
  elseif(intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==FALSE))
  {
    return 0;
  }

}




//Filtro  todos los emails
private function filtrarEmail($original_email)
{
	$original_email=$this->filtroStrings($original_email, 0);
	$clean_email = filter_var($original_email,FILTER_SANITIZE_EMAIL);
	if ($original_email == $clean_email && filter_var($original_email,FILTER_VALIDATE_EMAIL))
	{
	return $original_email;
	}

}

private function filtrocaracteres($parametro){
      $encontrar    = array( ".", ",", " ", "=", "_"," ", "#","`:","+", "-", "(", ")");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}

private function remplazartildesyotros($parametro) {
		$encontrar = array("á", "é", "í", "ó", "ú", " ", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ä", "Ë", "Ï", "Ö", "Ü", "ä", "ë", "ï", "ö", "ü");
		$remplazar = array("a", "e", "i", "o", "u", "_", "n", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u");
		return str_ireplace($encontrar, $remplazar, $parametro);
	}

public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER , "UTF-8")));

}



}