<?php
class editoProductos extends conectar {









//Ingreso los valores cuando un producto se ingreso desde lote,  lo actualizo y queda listo para la venta
public function editarProductoDesdeLote($parametros)
{
	conectar::conexiones();
	extract($parametros);
	$t=sizeof($idProducto);
	$n=0;



	while ($t>$n) 
	{

		if (isset($idProducto[$n])) {
			# code...
			$sql="UPDATE PRODUCTOSERVICIOS SET valorVentaUnidad='".$this->normalizacionDeCaracteres($valorVentaUnidad[$n])."', valorVentaPorMayor='".$this->normalizacionDeCaracteres($valorVentaPorMayor[$n])."', cantidadMinima='".$productosConvenioMinimo."'	 WHERE idproductosServicios='".$this->filtroNumerico($idProducto[$n])."'";
			mysql_query($sql);
		}	

		$n++;

	}

	//Fin del while
		if ($n==$t) {
			# code...
			return 1; //ok
		}
		else
		{	
			$this->errorLog("02-02-02-01-00");
			return 0; //ocurrio un error al actualizar los precios

		}
	
	conectar::desconectar();
}








//EDITO EL PRODUCTO SEGÚN EL PARÁMETRO QUE LE PASE
public  function editarDatosBasicosProducto($parametros)
{
	conectar::conexiones();
	extract($parametros);
	$sql="UPDATE productosConvenio SET	productosConvenioNombre='".$this->filtroStrings($productosConvenioNombre, 2)."',
										productosConvenioValor='".$this->filtroNumerico($this->normalizacionDeCaracteres($inventarioConvenioValorCompra))."',
										productoConvenioMedida='".$this->filtroNumerico($inventarioConvenioMedida)."', productosConvenioMinimo='".$this->filtroNumerico($productosConvenioMinimo)."' WHERE productosConvenioId ='".$this->decrypt($productoId, publickey)."'
										";
	if (mysql_query($sql)) {
		# code...
		return 1;
	}
	else
	{
		$this->errorLog("02-02-01-03-01-00");//Error al editar los datos básicos de un parámetro
		return 0;
	}
	conectar::desconectar();
}








/*******************************[TRASLADO DE MERCANCIAS]*******************************************/




//TRASLADO DE UNA BODEGA AL PUNTO DE VENTA LA CANTIDAD DE PRODUCTO QUE ME DAN
public function trasladarProductoBodegaAPuntoVenta($cantidadTrasladada, $productoId)
{
	conectar::conexiones();
	//Limpio los parámetros que  traigo
	$cantidadTrasladada=$this->filtroNumerico($cantidadTrasladada);
	$productoId=$this->filtroNumerico($this->decrypt($productoId, publickey));
	$cantidadCumplida=$cantidadTrasladada;
	//Filtro si hay suficientes cantidad 
	if($this->cantidadEnExistenciaEnBodega($productoId)>=$cantidadTrasladada)
		{
			$bucket=array();//array que me guardara las cantidades que existem por cada linea
			$n=0;
			$break=0;
			//Hay suficientes existencias entonces filtro la tabla con lo que ncesito
			  $sql="SELECT inventarioConvenioId, inventarioConvenioExistencia,  convenioId, productoId FROM 


			 inventarioConvenio WHERE productoId='".$productoId."' and inventarioConvenioExistencia>0";

			$query=mysql_query($sql);
			while ($rs=mysql_fetch_array($query) AND  ($break==0)) {
				# code...

				//$bucket[$n]=$rs["inventarioConvenioId"]."-".$rs["inventarioConvenioExistencia"];
				if ($cantidadCumplida>=$rs["inventarioConvenioExistencia"]) {
					# code...
					 $cantidadCumplida=($cantidadCumplida)-($rs["inventarioConvenioExistencia"]);

					 $sql="UPDATE inventarioConvenio SET inventarioConvenioExistencia= 0 WHERE inventarioConvenioId='".$rs["inventarioConvenioId"]."'";

					mysql_query($sql);

				
				}
				elseif ($cantidadCumplida<=$rs["inventarioConvenioExistencia"]) {
					# code...
					$break=1;
					 $cantidadNueva=($rs["inventarioConvenioExistencia"])-($cantidadCumplida);
					 $sql="UPDATE inventarioConvenio SET inventarioConvenioExistencia= ".$cantidadNueva." WHERE inventarioConvenioId='".$rs["inventarioConvenioId"]."'";

					mysql_query($sql);
				}

			}

			//Registro la mercancia que trasladé

			$sqlTraslado="INSERT INTO  productosTraslados SET 	productoId='".$productoId."',
																convenioId='".$this->decrypt($_REQUEST["id"], key)."',
																productosTrasladosFechaTraslado='".fechaActual."',
																productosTrasladosUnidadesTrasladadas='".$cantidadTrasladada."', productosTrasladosExistenciaActual='".$cantidadTrasladada."'
																 ";
			if (mysql_query($sqlTraslado)) {
				# code...
					return 1;//Listo
			}
			else{
				//Error  al hacer un traslado de un producto
				$this->errorLog("02-02-01-03-01-01");
				return 0;
			}
		}
	conectar::desconectar();
}





//TRASLADO DE UNA PUNTO DE VENTA A LA BODEGA LA  CANTIDAD DE PRODUCTO QUE ME DAN
public function trasladarProductoPuntoVentaABodega($cantidadTrasladada, $productoId)
{
	conectar::conexiones();
	//Limpio los parámetros que  traigo
	$cantidadTrasladada=$this->filtroNumerico($cantidadTrasladada);
	$productoId=$this->filtroNumerico($this->decrypt($productoId, publickey));
	$cantidadCumplida=$cantidadTrasladada;
	//Filtro si hay suficientes cantidad 
	if($this->cantidadesExistentesPuntoDeVenta($productoId)>=$cantidadTrasladada)
		{
			$bucket=array();//array que me guardara las cantidades que existem por cada linea
			$n=0;
			$break=0;
			//Hay suficientes existencias entonces filtro la tabla con lo que ncesito
			   $sql="SELECT trasladoId, productoId, productosTrasladosExistenciaActual, productosTrasladosTipo FROM 
			 productosTraslados WHERE productoId='".$productoId."' and productosTrasladosExistenciaActual>0 AND productosTrasladosTipo=0";

			$query=mysql_query($sql);


			while ($rs=mysql_fetch_array($query) AND  ($break==0)) {
				# code...

				if ($cantidadCumplida>$rs["productosTrasladosExistenciaActual"]) {
					# code...
					 $cantidadCumplida=($cantidadCumplida)-($rs["productosTrasladosExistenciaActual"]);

					  $sql="UPDATE productosTraslados SET productosTrasladosExistenciaActual= 0 WHERE trasladoId='".$rs["trasladoId"]."'";
					mysql_query($sql);

				
				}
				elseif ($cantidadCumplida<=$rs["productosTrasladosExistenciaActual"]) {
					# code...
					$break=1;

					 $cantidadNueva=($rs["productosTrasladosExistenciaActual"])-($cantidadCumplida);
					    $sql="UPDATE productosTraslados SET productosTrasladosExistenciaActual= ".$cantidadNueva." WHERE trasladoId='".$rs["trasladoId"]."'";
						mysql_query($sql);

				}

			}

		 	$sql="INSERT INTO inventarioConvenio SET inventarioConvenioFecha='".fechaActual."',
													inventarioConvenioCantidadComprada='".$cantidadTrasladada."',
													inventarioConvenioExistencia='".$cantidadTrasladada."',
													inventarioConvenioRetraslado=1,
													productoId='".$productoId."',
													convenioId='".$this->decrypt($_REQUEST["id"], key)."'


			";
			if (mysql_query($sql)) {
				# code...
				return 1;
			}
			else
			{
				//Error  al hacer un traslado de un producto  del punto de venta a la bodega
				$this->errorLog("02-02-01-03-01-02");
				return 0;
			}

		}
	conectar::desconectar();
}


/*******************************[FIN TRASLADO DE MERCANCIAS]*******************************************/


















/*******************************[VERIFICADORES DE EXISTENCIAS]*******************************************/

//Cálculo la existencia de un producto en bodega
private  function cantidadEnExistenciaEnBodega($productoId)
{

   $sql="SELECT SUM(inventarioConvenioExistencia) AS cantidadesExistentes 
                                                      FROM inventarioConvenio WHERE
                                                      productoId='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["cantidadesExistentes"];

}




//Cálculo la existencia de un producto en el punto de venta.
public  function cantidadesExistentesPuntoDeVenta($productoId)
{

  $sql="SELECT SUM(productosTrasladosExistenciaActual) AS cantidadesExistentes 
                                                      FROM productosTraslados WHERE
                                                      productoId='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["cantidadesExistentes"];

}



/*******************************[FIN DE  VERIFICADORES DE EXISTENCIAS]*******************************************/







/*******************************[FILTROS]*******************************************/
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

/*******************************[FIN DE LOS FILTROS]*******************************************/

}