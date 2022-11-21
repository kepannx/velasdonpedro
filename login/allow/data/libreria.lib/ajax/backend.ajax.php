<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class ingresosAjax  {


//DATOS DE LAS CAJAS 
//conexiones
public function conectar()
{
	define('CHARSET', 'ISO-8859-1');
		$servername = "localhost";
		$username   = "bWDigital"; 
		$password   = "DYFUNszt4yX5frmS";
		$dbname     = "billware_digital";
		return $conn = new mysqli($servername, $username, $password, $dbname);

}

//Datos del provedor
public function datosProvedores($parametro, $vector)
{
  
	$conn=$this->conectar();
  	$idprovedor=$this->filtroNumerico($parametro);
  	$sql="SELECT *  FROM  provedores WHERE idprovedor='".$idprovedor."'";
  	$query=mysqli_query($conn, $sql);
  	$rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  

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




//Datos del provedor
public function datosBanco($parametro, $vector)
{
  
	$conn=$this->conectar();
  	$idBanco=$this->filtroNumerico($parametro);
  	$sql="SELECT *  FROM  bancos WHERE idBanco='".$idBanco."'";
  	$query=mysqli_query($conn, $sql);
  	$rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  

  switch ($vector) {


    case 'nombreBanco':
      # code...
      return $rs["nombreBanco"];
      break;


    case 'nroCuenta':
      # code...
      return $rs["nroCuenta"];
      break;

    case 'saldo':
      # code...
      return $rs["saldo"];
      break;

    case 'tipoCuenta':
      # code...
      return $rs["tipoCuenta"];
      break;

    case 'activada':
      # code...
      return $rs["activada"];
      break;

    
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}


//Datos del provedor
public function datosProductoBancario($parametro, $vector)
{
  
	$conn=$this->conectar();
  	$idProductoBancario=$this->filtroNumerico($parametro);
  	$sql="SELECT *  FROM  productoBancario WHERE idProductoBancario='".$idProductoBancario."'";
  	$query=mysqli_query($conn, $sql);
  	$rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  

  switch ($vector) {


    case 'tipo':
      # code...
      return $rs["tipo"];
      break;


    case 'descripcion':
      # code...
      return $rs["descripcion"];
      break;

    case 'saldo':
      # code...
      return $rs["saldo"];
      break;

    case 'deuda':
      # code...
      return $rs["deuda"];
      break;

    case 'fechaCorte':
      # code...
      return $rs["fechaCorte"];
      break;


    case 'idBanco':
      # code...
      return $rs["idBanco"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}





//Datos Factura Provedor

public function datosFacturaProvedor($parametro, $vector)
{
  
	$conn=$this->conectar();
  	$idfacturaProvedor=$this->filtroNumerico($parametro);
  	$sql="SELECT *  FROM facturasProvedores WHERE idfacturaProvedor='".$idfacturaProvedor."'";
  	$query=mysqli_query($conn, $sql);
  	$rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  

  switch ($vector) {


    case 'idProvedor':
      # code...
      return $rs["idProvedor"];
      break;


    case 'nroFacturaProvedor':
      # code...
      return $rs["nroFacturaProvedor"];
      break;

    case 'fechaFacturaProvedor':
      # code...
      return $rs["fechaFacturaProvedor"];
      break;

    case 'estadoFactura':
      # code...
      return $rs["estadoFactura"];
      break;

    case 'valorFacturaProvedor':
      # code...
      return $rs["valorFacturaProvedor"];
      break;

    case 'deudaFacturaProvedor':
      # code...
      return $rs["deudaFacturaProvedor"];
      break;

    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}


//Datos de la facturación o cuenta de cobro
public function datosFacturaCliente($parametro, $vector)
{
  
	$conn=$this->conectar();
  	$idFactura=$this->filtroNumerico($parametro);
  	$sql="SELECT *  FROM  facturacion WHERE idFactura='".$idFactura."'";
  	$query=mysqli_query($conn, $sql);
  	$rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  

  switch ($vector) {


    case 'nroFactura':
      # code...
      return $rs["nroFactura"];
      break;


    case 'nroCotizacion':
      # code...
      return $rs["nroCotizacion"];
      break;

    case 'idCliente':
      # code...
      return $rs["idCliente"];
      break;

    case 'fechaFactura':
      # code...
      return $rs["fechaFactura"];
      break;

    case 'estadoFactura':
      # code...
      return $rs["estadoFactura"];
      break;

    case 'valorFactura':
      # code...
      return $rs["valorFactura"];
      break;

     case 'deudaFactura':
      # code...
      return $rs["deudaFactura"];
      break;

    case 'codigoVendedor':
      # code...
      return $rs["codigoVendedor"];
      break;
    

    case 'tipoPago':
      # code...
      return $rs["tipoPago"];
      break;
    

    case 'incremento':
      # code...
      return $rs["incremento"];
      break;
    

    case 'nroCheque':
      # code...
      return $rs["nroCheque"];
      break;
    

    case 'fechaCobroCredito':
      # code...
      return $rs["fechaCobroCredito"];
      break;
    

    case 'liquidada':
      # code...
      return $rs["liquidada"];
      break;
    
    case 'justificacionAnulacion':
      # code...
      return $rs["justificacionAnulacion"];
      break;
    
    case 'separada':
      # code...
      return $rs["separada"];
      break;
    

    case 'idCajaCierre':
      # code...
      return $rs["idCajaCierre"];
      break;
    
   
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}







//Ingreso abonos globales
public function ingresoAbonoGlobales($parametros)
{
		$conn=$this->conectar();
		extract($parametros);

		//filtro los parámetros que pase a través de json
		$deuda=$this->filtroNumerico($valorDeuda);
	  	$abono=$this->filtroNumerico($this->normalizacionDeCaracteres($abono));
	  	$idCliente=$this->filtroNumerico($this->decrypt($idCliente, publickey)); 
	  	//VERIFICO SI EL VALOR QUE SE ABONÓ ES IGUAL O MAYOR A LA DEUDA ACTUAL
	  if ($deuda>$abono) {
	    # debo hacer el proceso de verficación de las facturas que debe hasta que abono = 0...
	     //$residuo=$deuda-$abono;//diferencia en caso que haya

	     //Filtro las facturas con deuda
	    $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE idCliente='".$idCliente."' AND estadoFactura='en credito'";

	   //  $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE estadoFactura='en credito'";

	    $query=mysqli_query($conn, $sql);
	    $bucket=0;//Recojo la suma de los valores adeudados en la factura
	    $controlAbono=$abono;//Con esta variable controlo los ciclos hasta donde puedo abonar
	   	
	    $objResponse->Registrado = 1;

	    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	      # code...
	       if($bucket<$controlAbono){
	          $bucket=$bucket+$rs['deudaFactura'];
	          $deudaFactura=$rs['deudaFactura'];
	          if ($deudaFactura<=$abono) {
	            # code...
	              $abono=$abono-$deudaFactura;//Resto el valor abonado al abono
	              $deudaFactura=0;
	              $estadoFactura='pagada';
	              $abonoTotal=$rs['deudaFactura'];

	          }
	          else//En caso que la deuda a la factura sea mayor a la del abono
	          {
	            $abonoTotal=$abono;
	            $deudaFactura=$deudaFactura-$abono;
	            $abono=0;
	            $estadoFactura='en credito';
	          }

	          $sqlAbono="UPDATE facturacion SET deudaFactura=$deudaFactura, `estadoFactura` = '".$estadoFactura."' WHERE idFactura='".$rs['idFactura']."'";
	          mysqli_query($conn, $sqlAbono);
	          $sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=".$rs['idFactura'].", valorAbono='".$abonoTotal."' ,  fechaAbono='".date('Y-m-d')."'  , tipoPago='efectivo'";
	          mysqli_query($conn, $sqlAbonoFactura);

	       }
	      
	    }//fin while control abono
	    	 
	  } //Fin if($deuda>$abono)

	  elseif ($deuda<=$abono) {
	    # Cancelo todas las deudas que el cliente tiene y las igualo a cero ...
	    //Verifico diferencias
	    $residuo=abs($deuda-$abono);//diferencia en caso que haya

	    //Filtro las facturas con deuda
	    $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE idCliente='".$idCliente."' AND estadoFactura='en credito'";
	   // $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE  estadoFactura='en credito'";
	    //$query=mysqli_query($conn, $sql);
	    $query=mysqli_query($conn, $sql);
	    $objResponse->Registrado = 1;
	    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	      # code...
	      $deudaFactura=$rs['deudaFactura'];
	      $abonoTotal=$rs['deudaFactura']-$abono;//lo que abonaré a la factura
	      $residuo=abs($rs['deudaFactura']-$abono);//si queda un residuo este es el nuevo valor del abono para el próximo
	      //Igualo los valores para el abono de esa factura
	      if ($residuo>=0) {
	        # code...
	        $abonoTotal=$rs['deudaFactura'];//Existe aun residuo para abonar
	      }
	      //Actualizo la factura
	      $sqlAbono="UPDATE facturacion SET deudaFactura='0', `estadoFactura` = 'pagada' WHERE idFactura='".$rs['idFactura']."'";
	      mysqli_query($conn, $sqlAbono);
	      //Ingreso el abono a estas facturas
	      $sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=".$rs['idFactura'].", valorAbono='".$abonoTotal."' ,  fechaAbono='".date('Y-m-d')."'  , tipoPago='efectivo'";

	      mysqli_query($conn, $sqlAbonoFactura);

	    }//Fin del ciclo de cancelación de facturas

	  }//fin del los else que verifican los valores de deuda y abono

	  	echo json_encode($objResponse);

}



//Ingresar Provedores
public function ingresarProvedor($parametros){
		$conn=$this->conectar();
		extract($parametros);
		$nombreProvedor=$this->filtroStrings($nombreProvedor,2);
		$ideProvedor=$this->filtroStrings($ideProvedor, 1);
		$direccionProvedor=$this->filtroStrings($direccionProvedor, 1);
		$ciudadProvedor=$this->filtroStrings($ciudadProvedor,2);
		$telefonoProvedor=$this->filtroStrings($telefonoProvedor, 2);
		$emailProvedor=$this->filtrarEmail($emailProvedor);
		$contactoProvedor=$this->filtroStrings($contactoProvedor, 1);


		//Consulta sql
		$sql="INSERT INTO provedores SET nombreProvedor='".$nombreProvedor."',
										ideProvedor='".$ideProvedor."',
										direccionProvedor='".$direccionProvedor."',
										ciudadProvedor='".$ciudadProvedor."', 
										emailProvedor='".$emailProvedor."',
										telefonoProvedor='".$telefonoProvedor."', 
										contactoProvedor='".$contactoProvedor."'";

		if ($conn->query($sql) === TRUE) {
			$objResponse->Registrado = 1;
		} else {
			$objResponse->Registrado = 0;
		}

		$conn->close();

		echo json_encode($objResponse);

}




//Ingresar Productos
public function ingresarProductoServicio($parametros)
{

		extract($parametros);
		$conn=$this->conectar();
		//Filtro de valores
		$nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
		$tipoProductoServicio=$this->filtroStrings($tipoProductoServicio, 0);
		$valorVentaUnidad=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaUnidad));
    $sku=$this->filtroStrings($sku, 1);

		$cantidadMinima=$this->filtroNumerico($this->normalizacionDeCaracteres($cantidadMinima));
        $impuesto=$this->filtroNumericoDecimal($impuesto);
        $retiroTemporal=$this->filtroStrings($retiroTemporal, 0);

		//Consulta SQL
	$sql="INSERT INTO PRODUCTOSERVICIOS SET nombreProductosServicios='".$nombreProductosServicios."',
    sku='".$sku."',
											 tipoProductoServicio='".$tipoProductoServicio."',
											 valorVentaUnidad='".$valorVentaUnidad."',
											 valorVentaPorMayor='".$valorVentaPorMayor."',
											 cantidadMinima='".$cantidadMinima."',
                                             impuesto='".$impuesto."',
                                             retiroTemporal='".$retiroTemporal."' ";


		if ($conn->query($sql) === TRUE) {
			$objResponse->Registrado = 1;
		} else {
			$objResponse->Registrado = 0;
		}

		$conn->close();

		echo json_encode($objResponse);

}




//Ingresar Abonos de factura
public function ingresoAbonoFactura($parametros){

		$conn=$this->conectar();
		extract($parametros);

		//filtro los parámetros que pase a través de json
		$deuda=$this->filtroNumerico($valorDeuda);
	  	$abono=$this->filtroNumerico($this->normalizacionDeCaracteres($abono));
	  	$idCliente=$this->filtroNumerico($this->decrypt($idCliente, publickey)); 
	  	$idFactura=$this->filtroNumerico($this->decrypt($idFactura, publickey));

	  	if ($deuda>$abono) {		
	  		$nuevaDeuda=$this->filtroNumerico($deuda-$abono);
	  		
	  		$sql="UPDATE facturacion SET deudaFactura=$nuevaDeuda WHERE idFactura=$idFactura";
	  		mysqli_query($conn, $sql);

	  		$objResponse->Registrado = 1;
	  	}//fin del if. deuda>abono
	  	elseif ($deuda<=$abono) {
	  		# code...
	  		$nuevaDeuda=0;
	  		$sql="UPDATE facturacion SET deudaFactura=0, estadoFactura='pagada' WHERE idFactura=$idFactura";
	  		mysqli_query($conn, $sql);
	  	}//fin del elseif deuda<=abono
	  	
	  	//Registro el abono de la factura
	  	$sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=$idFactura, valorAbono=$abono, fechaAbono='".date('Y-m-d')."' ";
	  	mysqli_query($conn, $sqlAbonoFactura);
	  	echo json_encode($objResponse);


}




//Ingreso Abono Provedor
public function ingresoAbonoFacturaProvedor($parametros){

		$conn=$this->conectar();
		extract($parametros);

		//filtro los parámetros que pase a través de json
		$deuda=$this->filtroNumerico($deudaFacturaProvedor);
	  	$abono=$this->filtroNumerico($this->normalizacionDeCaracteres($abono));
	  	$idfacturaProvedor=$this->filtroNumerico($this->decrypt($idfacturaProvedor, publickey)); 
	  	

	  	//Abono primero a la factura actualizando los valores
	  	if ($deuda>$abono) {		
	  		$nuevaDeuda=$this->filtroNumerico($deuda-$abono);
	  		
	  		$sql="UPDATE  facturasProvedores SET deudaFacturaProvedor=$nuevaDeuda WHERE idfacturaProvedor=$idfacturaProvedor";
	  		mysqli_query($conn, $sql);

	  		$objResponse->Registrado = 1;
	  	}//fin del if. deuda>abono
	  	elseif ($deuda<=$abono) {
	  		# code...
	  		$sql="UPDATE facturasProvedores SET deudaFacturaProvedor=0, estadoFactura='cancelado' WHERE idfacturaProvedor=$idfacturaProvedor";
	  		mysqli_query($conn, $sql);
	  	}

	  	//Hago el registro del abono

	  	$sqlRegistroAbono="INSERT INTO abonosFacturaProvedor SET idFacturaProvedor=$idfacturaProvedor, fechaAbonoFactura='".date('Y-m-d')."' , valorAbonoFactura=$abono";
	  	
	  	if (mysqli_query($conn, $sqlRegistroAbono)) {
	  		# code...
	  		$objResponse->Registrado = 1;
	  	}

	  	//Movimientos de Tipos de pago
	  	$viaDePago=$this->decrypt($viaDePago, publickey);
	  	$viaDePago=explode('|', $viaDePago);
	  	//[0]:id. [1]:tipo
	  	$nombreProvedor=$this->datosProvedores($this->datosFacturaProvedor($idfacturaProvedor, 'idProvedor'), 'nombreProvedor');



	  	if ($viaDePago[1]=='cajaMenor') {
	  		# Ponerlo como egreso...
	  		$sql="INSERT INTO egresosGastos SET tipoEgresoGasto='egreso', fechaEgresoGasto='".date('Y-m-d')."', descripcion='Abono a Factura nro ".$this->datosFacturaProvedor($idfacturaProvedor, 'nroFacturaProvedor')." del provedor ".$nombreProvedor."', valorEgresoGasto=$abono  ";
	  	}
	  	elseif ($viaDePago[1]=='cuentaBancos') {
	  		# hacer débito  a la cuenta...
	  		//Verifico el saldo actual del banco
	  		$idBanco=$viaDePago[0];
	  		$saldoBanco=$this->filtroNumerico($this->datosBanco($idBanco, 'saldo'));
	  		//Saco el total del nuevo saldo
	  		$saldoNuevoBanco=$saldoBanco-$abono; //El nuevo saldo del banco
	  		//Actualizo el saldo
	  		$sqlActualizoBanco="UPDATE bancos SET saldo=$saldoNuevoBanco WHERE idBanco=$idBanco";
	  		mysqli_query($conn, $sqlActualizoBanco);

	  		//Ingreso el movimiento bancario en OperacionesMovimientosBancarios
	  		$sql="INSERT INTO operacionesMovimientosBancarios SET idBanco=$idBanco, descripcionOperacion='Debito por concepto de Abono a factura nro ".$this->datosFacturaProvedor($idfacturaProvedor, 'nroFacturaProvedor')." del provedor ".$nombreProvedor."', fechaOperacion='".date("Y-m-d")."', valorOperacion=$abono";


	  	}
	  	elseif ($viaDePago[1]=='productoBancario') {
	  		# hacer débito al producto bancario...
	  		//Verifico el saldo actual del producto bancario
	  		$idProductoBancario=$viaDePago[0];
	  		$deudaProductoBancario=$this->filtroNumerico($this->datosProductoBancario($idProductoBancario, 'deuda'));
	  		$idBanco=$this->datosProductoBancario($idProductoBancario, 'idBanco');
	  		//Calculo el saldo nuevo
	  		$deudaNuevoProductoBancario=$deudaProductoBancario+$abono; //El nuevo saldo del banco
	  		//Actualizo el saldo
	  		$sqlActualizoProductoBancario="UPDATE productoBancario SET deuda=$deudaNuevoProductoBancario WHERE idProductoBancario=$idProductoBancario";
	  		mysqli_query($conn, $sqlActualizoProductoBancario);


	  		//Ingreso el movimiento bancario en OperacionesMovimientosBancarios
	  		$sql="INSERT INTO operacionesMovimientosBancarios SET idBanco=$idBanco,
	  								idProductoBancario=$idProductoBancario,

	  							descripcionOperacion='Pago concepto de Abono a factura nro ".$this->datosFacturaProvedor($idfacturaProvedor, 'nroFacturaProvedor')." del provedor ".$nombreProvedor."', fechaOperacion='".date("Y-m-d")."', valorOperacion=$abono";


	  	}



	  	//Fin 
	  	if (mysqli_query($conn, $sql)) {
	  		# code...
	  		echo json_encode($objResponse);
	  	}
	  	
	  	//Afecto al tipo de pago elegido

}


//Registro del movimiento bancario
public function registrarMovimientoBancario($parametros){
	extract($parametros);
	$conn=$this->conectar();
	$tipoMovimiento=$this->filtroStrings($tipoMovimiento, 0);
	

  $justificacionMovimiento=$this->filtroStrings($justificacionMovimiento, 0);
  $justificacionTraslado=$this->filtroStrings($justificacionTraslado, 0);


	$valorOperacion=$this->filtroNumerico($this->normalizacionDeCaracteres($valorMovimiento));
	$idBanco=$this->filtroNumerico($this->decrypt($idBanco, publickey));
  $identificacionBanco=$this->filtroNumerico($this->decrypt($identificacionBanco, publickey));
	 
  if ($tipoMovimiento=='traslado') {
      $textoOperacion=$justificacionTraslado;
  }
  else{
    $textoOperacion=$justificacionMovimiento;
  }


   $sql="INSERT INTO operacionesMovimientosBancarios SET idBanco=$idBanco, descripcionOperacion='".$textoOperacion."', fechaOperacion='".date("Y-m-d")."', valorOperacion=$valorOperacion, tipoOperacion='$tipoMovimiento'";

  
	if (mysqli_query($conn, $sql)==TRUE){
		# Actualizo el valor de las cuentas bancarias...
		$saldoBanco=$this->datosBanco($idBanco, 'saldo');
    $saldoBancoDestino=$this->datosBanco($identificacionBanco, 'saldo');
		//Actualizo el valor del saldo actual de la cuenta
		if ($tipoMovimiento=='ingreso') {//Consigno a la cuenta
			# Sumo el valor de la operación al saldo actual...
			$nuevoSaldo=$saldoBanco+$valorOperacion;

		}

	

		elseif ($tipoMovimiento=='egreso' OR $tipoMovimiento=='traslado') {//Debito de la cuenta
			# resto el valor de la operación al saldo actual...
			$nuevoSaldo=$saldoBanco-$valorOperacion;

      if ($tipoMovimiento=='traslado') {
        # code...
        
        $nuevoSaldoDestino=$saldoBancoDestino+$valorOperacion;

      $sqlBanco="UPDATE bancos SET saldo=$nuevoSaldoDestino WHERE idBanco=$identificacionBanco";

        if (mysqli_query($conn, $sqlBanco)==TRUE) {
           $sqlMovimiento="INSERT INTO operacionesMovimientosBancarios SET idBanco=$identificacionBanco, descripcionOperacion='Traslado desde ".$this->datosBanco($idBanco, 'nombreBanco')." ', fechaOperacion='".date("Y-m-d")."', valorOperacion=$valorOperacion, tipoOperacion='$tipoMovimiento'";
          mysqli_query($conn, $sqlMovimiento);
        }

      }


		}


		
		$sqlBanco="UPDATE bancos SET saldo=$nuevoSaldo WHERE idBanco=$idBanco";
		if (mysqli_query($conn, $sqlBanco)==TRUE) {
			# code...
			$objResponse->Registrado = 1;
		}
		else
		{//Error al ingresar el nuevo saldo en el banco
			$objResponse->Registrado = 0;
		}

		//
	}
	else{
		//Error al ingresar laoperación bancaria
		$objResponse->Registrado = 0;
	}

	echo json_encode($objResponse);

}






//Ingreso EGRESOS Y GASTOS
public function ingresoEgresosGastos($parametros){
	extract($parametros);
	$conn=$this->conectar();
	$tipoEgresoGasto=$this->filtroStrings($tipoEgresoGasto, 0);
	$descripcion=$this->filtroStrings($descripcion, 0);
	$valorEgresoGasto=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEgresoGasto));
	$sql="INSERT INTO egresosGastos SET tipoEgresoGasto='".$tipoEgresoGasto."', fechaEgresoGasto='".date("Y-m-d")."', descripcion='".$descripcion."', valorEgresoGasto=$valorEgresoGasto";
	if (mysqli_query($conn, $sql)==TRUE) {
		# code...
		$objResponse->Registrado = 1;
	}
	else
	{
		$objResponse->Registrado = 0;
	}
	echo json_encode($objResponse);

}



//Ingreso EGRESOS Y GASTOS
public function ingresoUsuarios($parametros){
	extract($parametros);
	$conn=$this->conectar();
	$nombre=$this->filtroStrings($nombre, 2);
	$email=$this->filtrarEmail($email);
	$tipoUsuario=$this->filtroStrings($tipoUsuario, 0);
	$usuario=$this->encrypt($this->remplazartildesyotros($this->filtrocaracteres($usuario)), key);
	$contrasena=$this->encrypt($this->remplazartildesyotros($this->filtrocaracteres($contrasena)), key);
	$valorEgresoGasto=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEgresoGasto));
  $puntoAsignado=$this->filtroNumerico($puntoAsignado);


	$sql="INSERT INTO  usuarios SET usuario='".$usuario."', contrasena='$contrasena', nombre='".$nombre."', email='$email', tipoUsuario='$tipoUsuario', puntoAsignado=$puntoAsignado, codigo='".$this->proximoCodigoUsuario()."' ";
	


	if (mysqli_query($conn, $sql)==TRUE) {
		# code...
		$objResponse->Registrado = 1;
	}
	else
	{
		$objResponse->Registrado = 0;
	}
	echo json_encode($objResponse);

}



//UPLOAD LOGO
public function uploadLogo($parametro)
{
	extract($parametro);
	foreach ($_FILES["images"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $name = $_FILES["images"]["name"][$key];
        $tamano= $_FILES["images"]["size"][$key];
        $extencion=$_FILES["images"]["type"][$key];
        $nombreArchivo="logo";
        if($tamano<1000000){//1mg
        move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "../../../../../images/" . $nombreArchivo.".png");
       	}
    }
}


echo "<h2>Logo Actualizado</h2>";
}



//INGRESO BANCOS

public function guardarBanco($parametro){
	extract($parametro);
	$conn=$this->conectar();
	$nombreBanco=$this->filtroStrings($nombreBanco,2);
	$nroCuenta=$this->filtroStrings($nroCuenta,0);
	$tipoCuenta=$this->filtroStrings($tipoCuenta,0);
	$saldo=$this->filtroNumerico($this->normalizacionDeCaracteres($saldo));
	$sql="INSERT INTO  bancos SET nombreBanco='".$nombreBanco."', 
									nroCuenta='".$nroCuenta."',
									tipoCuenta='".$tipoCuenta."',
									saldo=$saldo";
	if (mysqli_query($conn, $sql)) {
		# code...
		$objResponse->Registrado=1;
	}
	else
	{
		$objResponse->Registrado=0;
	}

	echo json_encode($objResponse);
}




//Guardo productos de banco
public function guardarProductoBanco($parametro){
	extract($parametro);
	$conn=$this->conectar();

	
	$tipo=$this->filtroStrings($tipo,0);
	$idBanco=$this->filtroNumerico($this->decrypt($idBanco, publickey));
	$descripcion=$this->filtroStrings($descripcion,0);
	$fechaCorte=$this->formatoFecha($fechaCorte);
	$saldo=$this->filtroNumerico($this->normalizacionDeCaracteres($saldo));
	$deuda=$this->filtroNumerico($this->normalizacionDeCaracteres($deuda));
	

	$sql="INSERT INTO productoBancario SET tipo='".$tipo."', 
									descripcion='".$descripcion."',
									fechaCorte='".$fechaCorte."',
									idBanco='".$idBanco."',
									saldo=$saldo,
									deuda=$deuda
									";
	if (mysqli_query($conn, $sql)) {
		# code...
		$objResponse->Registrado=1;
	}
	else
	{
		$objResponse->Registrado=0;
	}

	echo json_encode($objResponse);
}


/*********************[CAJAS]*************************************/

//ABRO LAS CAJAS
public function aperturaCaja($parametros)
{
		$conn=$this->conectar();
		extract($parametros);
		//filtro parámetros
		$valorCajaBase=$this->filtroNumerico($this->normalizacionDeCaracteres($valorCajaBase));

		$sql="INSERT INTO  cajas SET 	fechaAperturaCaja='".date("Y-m-d H:i:s")."', 
										tokenCierre='".strtotime(date('Y-m-d H:i:s'))."', 
                              			valorBase='".$valorCajaBase."', estado='1'";
        	if (mysqli_query($conn, $sql)==TRUE) {
				# code...
				$objResponse->Registrado = 1;
			}
			else
			{
				$objResponse->Registrado = 0;
			}
		echo json_encode($objResponse);

}



//CIERRO LA CAJA Y LIQUIDO TODOS LOS MOVIMIENTOS A LA CAJA DE HOY
public function cerrarCaja($parametros)
{
		$conn=$this->conectar();
		extract($parametros);
		//filtro parámetros
		$idCierreCaja=$this->filtroNumerico($idCierreCaja);//Esta es a la caja que pertenece este cierre
		if ($idCierreCaja==0) {
			# saqueme de aqui...
			exit();
		}
		$valorEnEfectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEnEfectivo));
		$valorEnDocumentos=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEnDocumentos));
		$totalEnSistema=$this->filtroNumerico($this->normalizacionDeCaracteres($totalEnSistema));
		$valorGastosEgresos=$this->filtroNumerico($valorGastosEgresos);

		//Sumo los valores que me pasaron 
		$valorLiquidarEnCajas=($valorEnEfectivo+$valorEnDocumentos);

		$valorLiquidado=$valorLiquidarEnCajas-$totalEnSistema;
			//QUEDE EN CERRAR LAS CAJAS.  1 CIERRE LAS CAJAS SIN PROBLEMA, LUEGO  CIERRE LOS CUADRES PROBLEMÁTCOS
		$sqlActualizarFacturas="UPDATE facturacion SET idCajaCierre=$idCierreCaja, liquidada='0' WHERE  liquidada='1'";
				mysqli_query($conn, $sqlActualizarFacturas);
			//Cierro todos los abonos
				$sqlActualizarAbonos="UPDATE abonoFacturas SET idCajaCierre=$idCierreCaja, liquidada='0' WHERE  liquidada='1'";
				mysqli_query($conn, $sqlActualizarAbonos);

			//Cierro todos los egresos
				$sqlActualizarEgresosGastos="UPDATE egresosGastos SET idCajaCierre=$idCierreCaja, liquidada='0' WHERE  liquidada='1'";
				mysqli_query($conn, $sqlActualizarEgresosGastos);
			//Actualizo el registro de la caja
		if ($valorLiquidado==0) {
			# code...
			//Liquido todo porque todo es correcto
			//Cierro todas las facturas
				

				$sqlActualizacionRegistroCaja="UPDATE cajas SET 
														idcaja=$idCierreCaja, 
														fechaCierreCaja='".date("Y-m-d H:i")."',
														valorGastosEgresos=$valorGastosEgresos,
														valorEfectivo=$valorEnEfectivo,
														valorEnDocumentos=$valorEnDocumentos,
														estado='0' 
														WHERE  estado='1'";
				



		}

		elseif ($valorLiquidado<0 OR $valorLiquidado>0) {
			# Existe un faltante en las cajas...

			$sqlActualizacionRegistroCaja="UPDATE cajas SET 
														idcaja=$idCierreCaja, 
														fechaCierreCaja='".date("Y-m-d H:i")."',
														valorGastosEgresos=$valorGastosEgresos,
														valorEfectivo=$valorEnEfectivo,
														valorEnDocumentos=$valorEnDocumentos,
														estado='0',
														diferencia=$valorLiquidado 
														WHERE  estado='1'";
		}
	


		if(mysqli_query($conn, $sqlActualizacionRegistroCaja)==TRUE)
					{
						$objResponse->Registrado = 1;
					}

				echo json_encode($objResponse);

}











//Te digo cuál es el próximo número de factura que sigue
public function proximoCodigoUsuario(){
  $sql="SELECT codigo FROM usuarios ORDER BY(codigo) DESC";
  $query=mysqli_query($this->conectar(), $sql);
  $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  if ($rs['codigo']==0) {
    # code...
    return 1;
  }
  elseif ($rs['codigo']>=1) {
    # code...
    return $rs['codigo']+1;
  }
}


/**************************[FILTROS]******************************+*/

//Filtro Strings
public function filtroStrings($parametro, $tipo)
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

//Filtro con decimal en punto (.) 
public function filtroNumericoDecimal($parametro)
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
public function filtrarEmail($original_email)
{
  $original_email=$this->filtroStrings($original_email, 0);
  $clean_email = filter_var($original_email,FILTER_SANITIZE_EMAIL);
  if ($original_email == $clean_email && filter_var($original_email,FILTER_VALIDATE_EMAIL))
  {
  return $original_email;
  }

}


public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER , "UTF-8")));

}

public function remplazartildesyotros($parametro) {
    $encontrar = array("á", "é", "í", "ó", "ú", " ", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ä", "Ë", "Ï", "Ö", "Ü", "ä", "ë", "ï", "ö", "ü");
    $remplazar = array("a", "e", "i", "o", "u", "_", "n", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u");
    return str_ireplace($encontrar, $remplazar, $parametro);
  }
public function filtrocaracteres($parametro){
      $encontrar    = array( ".", ",", " ", "=", "_"," ", "#","`:","+", "-", "(", ")");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}


public function filtroNumerico($parametro)
{
  if(intval(filter_var($parametro, FILTER_VALIDATE_INT)==TRUE))
  {
    return $parametro;
  }
  elseif(intval(filter_var($parametro, FILTER_VALIDATE_INT)==FALSE))
  {
    return 0;
  }
}



public function espacioPorGuion($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "_");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}



//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
  $fecha=explode("/", $parametro);
  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
}
  


//Encriptar
		//ENCRIPTO INFORMACION
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




/************************************[EDICIÓN]*************************/
class edicionAjax extends ingresosAjax  {

	//Edito  Producto o servicio
	public function editarProductosServicios($parametros){

		$conn=ingresosAjax::conectar();
		extract($parametros);


		$nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
		$tipoProductoServicio=$this->filtroStrings($tipoProductoServicio, 0);
		$valorVentaUnidad=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaUnidad));
    $sku=$this->filtroStrings($sku, 1);
		$cantidadMinima=$this->filtroNumerico($cantidadMinima);
		$idproductosServicios=$this->filtroNumerico($idproductosServicios);
		$impuesto=$this->filtroNumericoDecimal($impuesto);
		$retiroTemporal=$this->filtroStrings($retiroTemporal, 0);

		$sql="UPDATE PRODUCTOSERVICIOS SET nombreProductosServicios='".$nombreProductosServicios."', sku='".$sku."',
											tipoProductoServicio='".$tipoProductoServicio."',
											valorVentaUnidad=$valorVentaUnidad,
											cantidadMinima=$cantidadMinima,
											impuesto='".$impuesto."',
											retiroTemporal='".$retiroTemporal."'

										WHERE idproductosServicios=$idproductosServicios
		";
		if(mysqli_query($conn, $sql)==TRUE)
					{
						$objResponse->Registrado = 1;
					}

				echo json_encode($objResponse);

	}


	//Edición de provedores
	public function editarProvedor($parametros){

			$conn=ingresosAjax::conectar();
			extract($parametros);
			$nombreProvedor=$this->filtroStrings($nombreProvedor,2);
			$ideProvedor=$this->filtroStrings($ideProvedor, 1);
			$direccionProvedor=$this->filtroStrings($direccionProvedor, 1);
			$ciudadProvedor=$this->filtroStrings($ciudadProvedor,2);
			$telefonoProvedor=$this->filtroStrings($telefonoProvedor, 2);
			$emailProvedor=$this->filtrarEmail($emailProvedor);
			$contactoProvedor=$this->filtroStrings($contactoProvedor, 1);
			$idprovedor=$this->filtroNumerico($this->decrypt($idprovedor, publickey));

			//Consulta sql
			$sql="UPDATE provedores SET nombreProvedor='".$nombreProvedor."',
										ideProvedor='".$ideProvedor."',
										direccionProvedor='".$direccionProvedor."',
										ciudadProvedor='".$ciudadProvedor."', 
										emailProvedor='".$emailProvedor."',
										telefonoProvedor='".$telefonoProvedor."', 
										contactoProvedor='".$contactoProvedor."'
									WHERE idprovedor=$idprovedor
										";
			if(mysqli_query($conn, $sql)==TRUE)
					{
						$objResponse->Registrado = 1;
					}
			echo json_encode($objResponse);

	}


//EDITA A USUARIO
	public function editarUsuario($parametros){

			$conn=ingresosAjax::conectar();
			extract($parametros);
			$nombre=$this->filtroStrings($nombre,2);
			$identificacion=$this->filtroStrings($identificacion, 2);
			$direccion=$this->filtroStrings($direccion, 2);
			$ciudad=$this->filtroStrings($ciudad,2);
			$telefonos=$this->filtroStrings($telefonos, 2);
			$email=$this->filtrarEmail($email);
			$tipoUsuario=$this->filtroStrings($tipoUsuario, 1);
			$activada=$this->filtroStrings($activada, 1);
			$eps=$this->filtroStrings($eps,2);
			$ips=$this->filtroStrings($ips,2);
			$arp=$this->filtroStrings($arp,2);
			$cajasCompensacion=$this->filtroStrings($cajasCompensacion,2);
			$cesantias=$this->filtroStrings($cesantias,2);
			$fondoPensiones=$this->filtroStrings($fondoPensiones,2);
			$sueldoPromedio=$this->filtroNumerico($this->normalizacionDeCaracteres($sueldoPromedio));
      $puntoAsignado=$this->filtroNumerico($puntoAsignado);


			$idUsuario=$this->filtroNumerico($this->decrypt($idUsuario, publickey));

			//Consulta sql
			$sql="UPDATE usuarios SET nombre='".$nombre."',
										identificacion='".$identificacion."',
										direccion='".$direccion."',
										ciudad='".$ciudad."', 
										telefonos='".$telefonos."',
										email='".$email."', 
										tipoUsuario='".$tipoUsuario."', 
                    puntoAsignado=$puntoAsignado,
										eps='".$eps."', 
										ips='".$ips."', 
										arp='".$arp."',
										activada='".$activada."',
										cajasCompensacion='".$cajasCompensacion."', 
										fondoPensiones='".$fondoPensiones."', 
										sueldoPromedio='$sueldoPromedio'
									WHERE idusuario=$idUsuario
										";


			if(mysqli_query($conn, $sql)==TRUE)
					{
						$objResponse->Registrado = 1;
					}
			echo json_encode($objResponse);

	}
//FIN DE LA EDICION DE USUARIOS

//EDITA LOS DATOS BÁSICOS DEL NEGOCIO
	public function editarDatosTriburariosEmpresa ($parametros){

			$conn=ingresosAjax::conectar();
			extract($parametros);
			$regimenEmpresa	=$this->filtroStrings($regimenEmpresa,0);
			$representanteEmpresa=$this->filtroStrings($representanteEmpresa, 2);
			$moneda=$this->filtroStrings($moneda,1);
			$terminosCondicionesFactura=$this->filtroStrings($terminosCondicionesFactura, 0);
			
			
			
			//Consulta sql
			$sql="UPDATE datosEmpresa SET regimenEmpresa='".$regimenEmpresa."',
										representanteEmpresa='".$representanteEmpresa."',
										moneda='".$moneda."', 
										terminosCondicionesFactura='".$terminosCondicionesFactura."'
										";
		
			if(mysqli_query($conn, $sql)==TRUE)
					{
						$objResponse->Registrado = 1;
					}
			
			echo json_encode($objResponse);
	

	}


//EDITA LOS DATOS TRIBUTARIOS DE LA EMPRESA
	public function editarDatosBasicosEmpresa($parametros){

			$conn=ingresosAjax::conectar();
			extract($parametros);
			$nombreEmpresa	=$this->filtroStrings($nombreEmpresa	,2);
			$direccionEmpresa=$this->filtroStrings($direccionEmpresa, 2);
			$ciudadEmpresa=$this->filtroStrings($ciudadEmpresa,2);
			$estadoEmpresa=$this->filtroStrings($estadoEmpresa, 2);
			$paisEmpresa=$this->filtroStrings($paisEmpresa, 2);
			$telefonosEmpresa=$this->filtroStrings($telefonosEmpresa, 2);
			$emailEmpresa=$this->filtrarEmail($emailEmpresa);
			$sitioWeb=$this->filtroStrings($sitioWeb,0);
			
			
			//Consulta sql
			$sql="UPDATE datosEmpresa SET nombreEmpresa='".$nombreEmpresa."',
										direccionEmpresa='".$direccionEmpresa."',
										ciudadEmpresa='".$ciudadEmpresa."', 
										estadoEmpresa='".$estadoEmpresa."',
										telefonosEmpresa='".$telefonosEmpresa."', 
										paisEmpresa='".$paisEmpresa."', 
										emailEmpresa='".$emailEmpresa."', 
										sitioWeb='".$sitioWeb."'
										";

			if(mysqli_query($conn, $sql)==TRUE)
					{
						$objResponse->Registrado = 1;
					}
			
			echo json_encode($objResponse);

	}

//EDITAR BANCO

	public function editarBanco($parametro){
	extract($parametro);
	$conn=ingresosAjax::conectar();
	$nombreBanco=$this->filtroStrings($nombreBanco,2);
	$nroCuenta=$this->filtroStrings($nroCuenta,0);
	$tipoCuenta=$this->filtroStrings($tipoCuenta,0);
	$idBanco=$this->filtroNumerico($this->decrypt($idBanco, publickey));
	$activada=$this->filtroStrings($activada,0);
	$sql="UPDATE  bancos SET nombreBanco='".$nombreBanco."', 
									nroCuenta='".$nroCuenta."',
									tipoCuenta='".$tipoCuenta."',
									activada='".$activada."'
							WHERE idBanco=$idBanco";
	if (mysqli_query($conn, $sql)==TRUE) {
		# code...
		$objResponse->Registrado=1;
	}
	else
	{
		$objResponse->Registrado=0;
	}

	echo json_encode($objResponse);
}





//Anulo la factura o cuenta de cobro
public function anulacionFacturas($parametros){
	extract($parametros);
	$conn=ingresosAjax::conectar();

	
	$idFactura=$this->filtroNumerico(ingresosAjax::decrypt($idFactura, publickey));
	$justificarAnulacion=$this->filtroStrings($justificarAnulacion,0);
	$sql="UPDATE  facturacion SET estadoFactura='anulada', justificacionAnulacion='".$justificarAnulacion."', liquidada=1 WHERE idFactura=$idFactura";

	if (mysqli_query($conn, $sql)==TRUE) {
		# code...
		if($this->datosFacturaCliente($idFactura, 'separada')=='si'){//Es o fue un crédito

			$sqlAbonos="UPDATE abonoFacturas SET liquidada='0', idCajaCierre = NULL WHERE idFactura=$idFactura";
			if (mysqli_query($conn, $sqlAbonos)==TRUE) {
				# code...
				$objResponse->Registrado=1;
			}
			else
			{
				$objResponse->Registrado=0;
			}

		}
		else //En caso que no tenga abonos
		{
			$objResponse->Registrado=1;
		}

	}

	//Pendiente log
	echo json_encode($objResponse);
}
//fin de la anulación de ls facturas




}



//fin de la clase editar


define(key, "SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen");
define(publickey, "5663284166397124291158310398993993");