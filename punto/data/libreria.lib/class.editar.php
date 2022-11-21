<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class editarAjax  extends conect {


	//Edito los Datos Básicos del Punto de Venta
	public function editarDatosBasicosPuntoVenta($parametros){
		  $conn=$this->conectar();
	      $idPunto=$this->filtroNumerico($this->decrypt($_SESSION['idPunto'], publickey));
	      extract($parametros);
		  $nombrePunto=$this->filtroStrings($nombrePunto, 2);
		  $direccion=$this->filtroStrings($direccion, 0);
		  $departamentos=$this->filtroStrings($departamentos, 2);
		  $ciudadPunto=$this->filtroStrings($ciudadPunto, 2);
		  $telefonoPunto=$this->filtroStrings($telefonoPunto, 0);
		  $sitioWebPunto=$sitioWebPunto;
		  $bodegas=filter_var($bodegas, FILTER_VALIDATE_BOOLEAN);
		  
		  if(strlen($username)>3){
		  	$username=$this->encrypt($username, key);;
		  	$user= ", usuario='".$username."'";
		  }
		  if(strlen($password)>3){
		  	$password=$this->encrypt($password, key);
		  	$pass= ", contrasena='".$password."'";
		  }
		  //Saco los datos de los usuarios
		 	$sqlPuntoVenta="UPDATE 	puntosVenta SET nombrePunto='".$nombrePunto."',
                                    direccionPunto='".$direccion."',
                                    ciudadPunto='".$ciudadPunto."',
                                    departamentoPunto='".$departamentos."',
                                    telefonoPunto='".$telefonoPunto."',
                                    idAdministrador='".$idAdministrador."',
                                    bodega='".$idBodega."',
                                    sitioWebPunto='".$sitioWebPunto."'
                                    ".$user." ".$pass." WHERE
                                    idPunto=$idPunto";
	   		if ($conn->query($conn->query($sqlPuntoVenta)) == TRUE) {
    			$objResponse->Registrado = 1;
   				}
		   else{  
		      		$this->write_log("Error al editar un punto de venta", 'error');
		      		$objResponse->Registrado = 'error';
		   		}
    	$conn->close();
    	echo json_encode($objResponse);
	}
//Fin de la edición de datos básicos de los puntos de venta.

	




	//edición de los datos tributarios
	public function editarDatosTributariosPunto($parametros){
		$conn=$this->conectar();
		$idPunto=$this->filtroNumerico($this->decrypt($_SESSION['idPunto'], publickey));
	      extract($parametros);
		$nitPunto=$this->filtroStrings($nitPunto, 0);
		$regimenTributario=$this->filtroStrings($regimenTributario, 0);
		$representanteLegal=$this->filtroStrings($representanteLegal, 2);
		$formatoImpresion=$this->filtroStrings($formatoImpresion, 0);
		$terminosCondicionesFactura=$this->filtroStrings(htmlentities($terminosCondicionesFactura, ENT_QUOTES), 0);

		 $sqlPuntoVenta="UPDATE 	puntosVenta SET nitPunto='".$nitPunto."',
                                    regimenTributario='".$regimenTributario."',
                                    representanteLegal='".$representanteLegal."',
                                    formatoImpresion='".$formatoImpresion."',
                                    terminosCondicionesFactura='".$terminosCondicionesFactura."' WHERE
                                    idPunto=$idPunto";
	   		if ($conn->query($conn->query($sqlPuntoVenta)) == TRUE) {
    			$objResponse->Registrado = 1;
   				}
		   else{  
		      		$this->write_log("Error al editar informacion tributaria un punto de venta", 'error');
		      		$objResponse->Registrado = 'error';
		   		}
    	$conn->close();
    	echo json_encode($objResponse);
	}



public function editarServicioProducto($parametros){
  $conn=$this->conectar();
  extract($parametros);
  //Filtro datos
  $idProductosServicios=$this->filtroNumerico($this->decrypt($_SESSION['idProductoServicio'], publickey));
  $nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
  $tipoProductoServicio=$this->filtroStrings($tipoProductoServicio, 0);
  $marca=$this->filtroStrings($marca, 2);
  $serializacion=$this->filtroStrings($serializacion, 0);
  $categoria=$this->filtroNumerico($this->decrypt($categoria, publickey));
  $subCategoria=$this->filtroNumerico($this->decrypt($subCategoria, publickey));
  $sku=$this->filtroStrings($sku, 1);
  $mostrar=$this->filtroStrings($mostrar,0);
  $web=$this->filtroStrings($web,0);


  $valorVentaUnidad=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaUnidad));
  $valorVentaPorMayor=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaPorMayor));
  $cantidadMinimaGlobal=$this->filtroNumerico($this->normalizacionDeCaracteres($cantidadMinimaGlobal));
  $cantidadMinimaPuntos=$this->filtroNumerico($this->normalizacionDeCaracteres($cantidadMinimaPuntos));
  //Fin del filtro de los datos
  $ventaCruzada=explode(",", $ventaCruzada);
  $vc=array();
  for ($i=0; $i < sizeof($ventaCruzada); $i++) { 
    $vc[$i]=$this->decrypt($ventaCruzada[$i], publickey);
  }
  $ventaCruzada=implode("|", $vc);
  $sqlInsertarProductoServicio="UPDATE PRODUCTOSERVICIOS SET  sku='".$sku."', 
                                            nombreProductosServicios='".$nombreProductosServicios."',
                                            tipoProductoServicio='".$tipoProductoServicio."',
                                            marca='".$marca."',
                                            categoria='".$categoria."',
                                            subCategoria='".$subCategoria."',
                                            serializacion='".$serializacion."',
                                            serial='".$serial."',
                                            imei='".$imei."',
                                            otroTipoSerial='".$otroTipoSerial."',
                                            valorVentaUnidad='".$valorVentaUnidad."',
                                            valorVentaPorMayor='".$valorVentaPorMayor."',
                                            cantidadMinimaGlobal='".$cantidadMinimaGlobal."',
                                            ventaCruzada='".$ventaCruzada."',
                                            cantidadMinimaPuntos='".$cantidadMinimaPuntos."',
                                            web='".$web."',
                                            retiroTemporal='".$mostrar."'
								WHERE idProductosServicios=$idProductosServicios

    ";
    if ($conn->query($sqlInsertarProductoServicio) === TRUE) {

      $objResponse->Registrado = 1;
    }
    else
    {  
      $this->write_log("Error al editar un producto", 'error');
      echo 'error';
    }

  $conn->close();
  echo json_encode($objResponse);
}





}