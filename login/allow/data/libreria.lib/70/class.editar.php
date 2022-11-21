<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class editarAjax extends conect {






//Conexi´n a base de datos alterna
public function conectarAlterno()
{
  define('CHARSET', 'ISO-8859-1');
    $servername = "localhost";
    $username   = "bWDigital";
    $password   = "DYFUNszt4yX5frmS";
    $dbname     = "billware_p";
    return $conn = new mysqli($servername, $username, $password, $dbname);

}






//GET DATOS DE LOS PRODUCTOS
public  function getDatosProductoServicio($idProductoServicio){
    $conn=$this->conectar();
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($idPuntoVenta, publickey));
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
     $sqlProductoServicio="SELECT * FROM  PRODUCTOSERVICIOS WHERE idproductosServicios=$idProductoServicio";
    $query=$conn->query($sqlProductoServicio);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}



public  function getDatosClientes($idcliente){
    $conn=$this->conectar();
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($idPuntoVenta, publickey));
    $idcliente=$this->filtroNumerico($idcliente);
     $sqlProductoServicio="SELECT * FROM  clientes WHERE idcliente=$idcliente";
    $query=$conn->query($sqlProductoServicio);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}



/*============================================
=            EDICIÓN DE PRODUCTOS            =
============================================*/



public function editarServicioProducto($parametros){
  $conn=$this->conectar();
  extract($parametros);
  //Filtro datos
  $idProductosServicios=$this->filtroNumerico($this->decrypt($_SESSION['idProductoServicio'], publickey));
  $nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
  $tipoProductoServicio=$this->filtroStrings($tipoProductoServicio, 0);
  $marca=$this->filtroStrings($marca, 2);
  $serializacion=$this->filtroStrings($serializacion, 0);
  $categoria=$this->filtroNumerico($categoria);
  $subCategoria=$this->filtroNumerico($subCategoria);
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
  echo $sqlInsertarProductoServicio="UPDATE PRODUCTOSERVICIOS SET  sku='".$sku."', 
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
                                            cantidadMinimaPuntos='".$cantidadMinimaPuntos."'
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

/*=====  End of EDICIÓN DE PRODUCTOS  ======*/



public function editarItemsFactura($parametros){
    $conn=$this->conectar();
    extract($parametros);

    $idinventario=$this->filtroNumerico($this->decrypt($id, publickey));
    $valor=$this->filtroNumerico($this->normalizacionDeCaracteres($valor));

    $tipo = $this->filtroStrings($tipo, 0);

    if ($tipo=='valorunidad') {
      # code...
          $sqlUpdate="UPDATE INVENTARIOS SET valorUnidad=$valor WHERE idinventario=$idinventario";
          $this->write_log('SE EDITÓ EL VALOR DEL IDINVENTARIO  '.$idinventario.' A UN VALOR DE  '.$valor.'  DESDE LA SESSION '.$this->decrypt($_SESSION['datos'], key));

    }else if($tipo=='impuestos'){
          $sqlUpdate="UPDATE INVENTARIOS SET impuesto=$valor WHERE idinventario=$idinventario";
           $this->write_log('SE EDITÓ EL VALOR DEL IMPUESTO  AL ID INVENTARIOS '.$idinventario.' A UN VALOR DE  '.$valor.'  DESDE LA SESSION '.$this->decrypt($_SESSION['datos'], key));

    }else if($tipo == 'unidadescompradas'){
          $sqlUpdate="UPDATE INVENTARIOS SET unidadesCompradas=$valor,  unidadesExistentes=$valor WHERE idinventario=$idinventario";

           $this->write_log('SE EDITÓ EL VALOR DEL LAS UNIDADES COMPRADAS DEL ID INVENTARIOS:   '.$idinventario.' A   '.$valor.' UNIDADES  DESDE LA SESSION '.$this->decrypt($_SESSION['datos'], key));
    }
    
    if($conn->query($sqlUpdate)){
        return 1;

    };


  # code...
}




public function anulacionFactura($justificarAnulacion){
  $conn=$this->conectar();
  $justificarAnulacion=$this->filtroStrings($justificarAnulacion, 1);
  $idFactura=$this->filtroNumerico($this->decrypt($_SESSION['ideFactura'], publickey));
  //AJUSTO LOS DATOS FINANCIEROS DE LA FACTURA
   $sqlFactura='UPDATE facturacion SET estadoFactura="anulada",
                                      justificacionAnulacion="'.$justificarAnulacion.'"
                WHERE idFactura= '.$idFactura.' ';
  $sqlPerfilPagos="UPDATE perfilPagos SET estado='anulada' WHERE  idFactura = $idFactura";
  $conn->query($sqlFactura);
  $conn->query($sqlPerfilPagos);
  
  $sqlGetInfoFactura="SELECT idPuntoVenta FROM facturacion   WHERE idFactura=$idFactura";
  $queryFactura=$conn->query($sqlGetInfoFactura);
  $resPunto=mysqli_fetch_array($queryFactura, MYSQL_ASSOC);
  $idPuntoVenta=$resPunto['idPuntoVenta'];//Obtengo el punto de venta para la devolución

  //AJUSTO LOS DATOS DE PRODUCTOS DE LA FACTURA
    ///chequeo los items y lo devuelvo
    $sqlItemsFactura="SELECT idFactura, idProductoServicio, unidades, valorTotal,utilidad,  porcentajeImpuesto FROM itemsFactura WHERE idFactura=$idFactura";
    $queryItems=$conn->query($sqlItemsFactura);


    //Hago el cilo para retornar la mercancia
    while ($rs=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...
      $idProductoServicio=$rs['idProductoServicio'];
      $unidades=$rs['unidades'];
      $utilidad=$rs['utilidad'];

      if ($utilidad<=0) {
        # si la utilidad es < 0 ...
        $utilidad=0;
      }

        if ($this->getDatosProductoServicio($idProductoServicio)['serializacion']=='si') {
          # Este producto es un producto con serial...

          $this->reponerImeisSeriales($idFactura, $idProductoServicio, $idPuntoVenta);
           $objResponse = 1;

        }else{
             $sqlTraslado="INSERT INTO trasladosExistencia SET idProductoServicio=$idProductoServicio,
                                        tipoTraslado='reingreso', origenId=$idPuntoVenta ,
                                        destinoId=$idPuntoVenta, fechaTraslado='".date('Y-m-d H:i:s')."',
                                        cantidadTrasladada=$unidades, 
                                        cantidadExistenteTraslado=$unidades
            ";
            $conn->query($sqlTraslado);

            $valorTotalUnidad=($rs['valorTotal']/$unidades);
            $valorUtilidadUnidad=($utilidad/$unidades);
            $valorUnidad=$valorTotalUnidad-$valorUtilidadUnidad;

            if ($valorUnidad<=0) {
              # En caso que el valor de la unidad de 0 o <0... HISTORICO
                  $valorUnidad=$this->calcularValorPromedio($idProductoServicio, 1);

            }
             $sqlInventario="INSERT INTO INVENTARIOS SET idProvedor=NULL, IdFacturaProvedor=NULL,
                                                idProductoServicio=$idProductoServicio, 
                                                fechaIngreso='".date('Y-m-d')."', 
                                                valorUnidad=$valorUnidad,
                                                tipoNegocio='compra',
                                                unidadesCompradas=$unidades,
                                                unidadesExistentes=$unidades
            ";

             $conn->query($sqlInventario);
           $objResponse = 1;

        }
     
  
    }
    //Registro en log Actividad

   $this->write_log('LA FACTURA CON ID '.$this->decrypt($_SESSION['ideFactura'], publickey).' SE ANULO  DESDE LA SESSION '.$this->decrypt($_SESSION['datos'], key));
   unset($_SESSION['ideFactura']);
   echo json_encode($objResponse);
}





private function reponerImeisSeriales($idFactura, $idProductoServicio,$idPuntoVenta){
  $conn=$this->conectar();

  $sqlSeriales="SELECT idSerialImei, idFacturaVenta, idFacturaProvedor FROM serialesImeis
                          WHERE idFacturaVenta=$idFactura AND idProductoServicio=$idProductoServicio
  ";
  $query=$conn->query($sqlSeriales);
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    # Actualizo el serial...
      $sql='UPDATE serialesImeis SET estado="en almacen", liquidado="no", fechaFacturado=NULL, idFacturaVenta= 0 , inventariado=0
                                  WHERE idSerialImei="'.$rs['idSerialImei'].'"
      ';
     $conn->query($sql);

      //Obtengo el valor del producto
      $sqlProducto="SELECT IdFacturaProvedor,idProductoServicio, unidadesExistentes FROM INVENTARIOS WHERE 
                                    IdFacturaProvedor=".$rs['idFacturaProvedor']." AND idProductoServicio=$idProductoServicio";
      $queryGetDato=$conn->query($sqlProducto);
      $rsGetDato=mysqli_fetch_array($queryGetDato, MYSQL_ASSOC);
      $existencias=(($rsGetDato['unidadesExistentes'])+1);
      //ACTUALIZO  LAS CANTIDADES EXISTENTES DE ESE PRODUCTO EN 1

      if ($rs['idFacturaProvedor']==0) {
    
        $valorUnidad=$this->calcularValorPromedio($idProductoServicio, 1);
        $sqlActualizarExistencias="INSERT INTO INVENTARIOS SET idProductoServicio=$idProductoServicio, unidadesExistentes = 1, unidadesCompradas = 1, IdFacturaProvedor = NULL, fechaIngreso='".date('Y-m-d')."', tipoNegocio='compra', valorUnidad='".$valorUnidad."'  ";



      }else{
          $sqlActualizarExistencias="UPDATE INVENTARIOS SET unidadesExistentes= $existencias WHERE 
                                    IdFacturaProvedor='".$rs['idFacturaProvedor']."' AND idProductoServicio=$idProductoServicio";
      }



      $conn->query($sqlActualizarExistencias);

      //HAGO EL TRASLADO DE NUEVO
      $sqlTraslado="INSERT INTO trasladosExistencia SET idProductoServicio=$idProductoServicio,
                                        tipoTraslado='reingreso', origenId=$idPuntoVenta ,
                                        destinoId=$idPuntoVenta , fechaTraslado='".date('Y-m-d H:i:s')."',
                                        cantidadTrasladada=1, 
                                        cantidadExistenteTraslado=1
            ";
      $conn->query($sqlTraslado);


  }
}





/*===============================
=            ALTERNO            =
===============================*/

public function backupFactura(){
  $conn=$this->conectar();
  $connAlt=$this->conectarAlterno();


  $idFactura=$this->decrypt($_SESSION['ideFactura'], publickey);
  //get datos factura bases
  $sqlFactura="SELECT * FROM facturacion WHERE idFactura=$idFactura";
  $query=$conn->query($sqlFactura);
  $rs=mysqli_fetch_array($query, MYSQL_ASSOC);//Recojo los datos basicos de esa factura
  //Get productos relacionados
  $itemsProductos = array();
  $sqlItemsFactura="SELECT * FROM itemsFactura WHERE idFactura=$idFactura";
  $queryItems=$conn->query($sqlItemsFactura);
  $i=0;
  while ($rsItemsFactura=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {//Recojo los items facturados de esa factura
    $itemsProductos[$i]=$rsItemsFactura['idFactura'].'|'.$rsItemsFactura['idProductoServicio'].'|'.$rsItemsFactura['unidades'].'|'.$rsItemsFactura['valorNeto'].'|'.$rsItemsFactura['valorTotal'].'|'.$rsItemsFactura['utilidad'].'|'.$rsItemsFactura['porcentajeImpuesto'];
    $i++;
  }
   

  $sqlPerfilPagos="SELECT * FROM  perfilPagos WHERE idFactura='".$idFactura."'";
  $queryPerfilPagos=$conn->query($sqlPerfilPagos);
  $i=0;
  $itemsPerfilPagos = array();//Recojo los perfiles de pago de esa factura
  while ($rsPerfilPagos=mysqli_fetch_array($queryPerfilPagos, MYSQL_ASSOC)) {


    $itemsPerfilPagos[$i]=$rsPerfilPagos['idFactura'].'|'.$rsPerfilPagos['idPuntoVenta'].'|'.$rsPerfilPagos['tipoPago'].'|'.$rsPerfilPagos['valor'].'|'.$rsPerfilPagos['comision'].'|'.$rsPerfilPagos['fechaRegistrado'].'|'.$rsPerfilPagos['estado'].'|'.$rsPerfilPagos['pertenencia'];
    $i++;
  }







  //INSERCIÓN AL BACKUP


  //Verificación del cliente :
  $identificacionCliente=$this->getDatosClientes($rs['idCliente'])['identificacionCliente'];
  $sqlCliente="SELECT idCliente, identificacionCliente  FROM clientes WHERE identificacionCliente='".$identificacionCliente."'";
  $queryCliente=$connAlt->query($sqlCliente);


  if (mysqli_num_rows($queryCliente)==0){
    # Creo el cliente..
    $sqlInsertCliente="INSERT INTO clientes SET   nombreCliente='".$this->getDatosClientes($rs['idCliente'])['nombreCliente']."', 
                                                  identificacionCliente='".$this->getDatosClientes($rs['idCliente'])['identificacionCliente']."',  
                                                  tipoDocumento='".$this->getDatosClientes($rs['idCliente'])['tipoDocumento']."', 
                                                  direccionCliente='".$this->getDatosClientes($rs['idCliente'])['direccionCliente']."',
                                                  telefonosCliente='".$this->getDatosClientes($rs['idCliente'])['telefonosCliente']."',
                                                  emailCliente='".$this->getDatosClientes($rs['idCliente'])['emailCliente']."',
                                                  ciudadCliente='".$this->getDatosClientes($rs['idCliente'])['ciudadCliente']."'

    ";
    $connAlt->query($sqlInsertCliente);
    //Ingreso de cliente 
    $idCliente=mysqli_insert_id($connAlt);
  }else{
    $rsCliente=mysqli_fetch_array($queryCliente, MYSQL_ASSOC);
    $idCliente=$rsCliente['idCliente'];//El cliente ya existe
  }

   
  //Ingreso los datos de la factura
  $sqlFacturaBackup="INSERT INTO facturacion SET nroFactura='".$rs['nroFactura']."', prefijo='".$rs['prefijo']."', idPuntoVenta='".$rs['idPuntoVenta']."', idCliente='".$idCliente."', fechaFactura='".$rs['fechaFactura']."',
                                    horaFactura='".$rs['horaFactura']."', estadoFactura='".$rs['estadoFactura']."', valorNetoFactura='".$rs['valorNetoFactura']."', valorTotalFactura='".$rs['valorTotalFactura']."', deudaFactura='".$rs['deudaFactura']."', 
                                    retefuente='".$rs['retefuente']."', codigoVendedor='".$rs['codigoVendedor']."', tipoPago='".$rs['tipoPago']."', nroCheque='".$rs['nroCheque']."', fechaCobroCredito='".$rs['fechaCobroCredito']."', liquidada='".$rs['liquidada']."',
                                    justificacionAnulacion='".$rs['justificacionAnulacion']."', separada='".$rs['separada']."', pertenencia='".$rs['pertenencia']."'";

    $connAlt->query($sqlFacturaBackup);
  //Ingreso items factuta
    $idFacturaBackup=mysqli_insert_id($connAlt);
    $numeroItems=sizeof($itemsProductos);//Numero de items
    $nItems=0;
    $numeroPerfilPagos=sizeof($itemsPerfilPagos);//Numero de perfil 
    $nPerfil=0;


    //BACKUP ITEMS DE LA FACTURA
    while ($nItems<$numeroItems) {
        $vectores=explode('|',$itemsProductos[$nItems]);
        $idProducto=$vectores[1];
        $unidades=$vectores[2];
        $valorNeto=$vectores[3];
        $valorTotal=$vectores[4];
        $utilidad=$vectores[5];
        $porcentajeImpuesto=$vectores[6];


        //aqui van los imeis si los queremos ingresar


        $sqlItemsFactura="INSERT INTO  itemsFactura SET idFactura=$idFacturaBackup, idProductoServicio=$idProducto, unidades=$unidades, valorTotal='".$valorTotal."', utilidad='".$utilidad."', porcentajeImpuesto='".$porcentajeImpuesto."'    ";
        $connAlt->query($sqlItemsFactura);
      $nItems++;
    }


    //BACKUPS MÉTODOS DE PAGO
     while ($nPerfil<$numeroPerfilPagos) {
      $vector=explode('|',$itemsPerfilPagos[$nPerfil]);
      $idPuntoVenta=$vector[1];
      $tipoPago=$vector[2];
      $valor=$vector[3];
      $comision=$vector[4];
      $fechaRegistrado=$vector[5];
      $estado=$vector[6];
      $pertenencia=$vector[7];
      $sqlPerfilPagos="INSERT INTO perfilPagos SET idFactura=$idFacturaBackup, idPuntoVenta=$idPuntoVenta, tipoPago='".$tipoPago."', valor='".$valor."', comision='".$comision."', fechaRegistrado='".$fechaRegistrado."', estado='".$estado."', pertenencia='".$pertenencia."'";
      $connAlt->query($sqlPerfilPagos);
      $nPerfil++;
     }


      $sqlFactura="UPDATE  facturacion SET backup = 'si' WHERE idFactura=$idFactura";
      $query=$conn->query($sqlFactura);


}

/*=====  End of ALTERNO  ======*/




/*============================
=            MATH            =
============================*/

private function calcularValorPromedio($idProducto, $tipo){
  //[0]: EN EXISTENCIA. [1]: HISTORICO
  $conn=$this->conectar();

  if ($tipo==0) {
    $sqlInventario="SELECT idProductoServicio, unidadesExistentes, valorUnidad, unidadesCompradas 
              FROM  INVENTARIOS
                    WHERE idProductoServicio=$idProducto AND unidadesExistentes>0 AND valorUnidad>0
  ";
  }elseif ($tipo==1) {
    # code...
    $sqlInventario="SELECT idProductoServicio, unidadesExistentes, valorUnidad, unidadesCompradas 
              FROM  INVENTARIOS
                    WHERE idProductoServicio=$idProducto AND valorUnidad>0
  ";
  }
   


  $queryInventario=$conn->query($sqlInventario);
  $arrayCostos=array();
  $n=0;
  $cantidades=mysqli_num_rows($queryInventario);
  while ($rs=mysqli_fetch_array($queryInventario, MYSQL_ASSOC)) {
    # code...
    $arrayCostos[$n]=($rs['valorUnidad']);//Saco el coste promedio por cada registro  en el INVENTARIOS
    $n++;

  }
  $numeroCiclos=sizeof($arrayCostos);
  $costoTotal=0;
  for ($i=0; $i <= $numeroCiclos; $i++) { 
    # code...
    $costoTotal=$arrayCostos[$i]+$costoTotal;
  }
  return ceil($costoTotal/$cantidades);

}

/**************************[FILTROS]******************************+*/


//registrar log
public function write_log($cadena,$tipo)
{
  $conn=$this->conectar();

  $sql='INSERT INTO logsActividades SET idUsuario = "'.$this->decrypt($_SESSION['datos'], key).'", log="'.$cadena.'", fechaLog="'.date('Y-m-d H:i:s').'"';
  $conn->query($sql);
  $arch = fopen("logs/.biiWareLog_".date("Y-m-d")."", "a+"); 

  fwrite($arch, "[".date("Y-m-d H:i:s")." ".$_SERVER['REMOTE_ADDR']." ".
                   $_SERVER['HTTP_X_FORWARDED_FOR']." - $tipo ] ".$cadena."\n");
  fclose($arch);
}


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
    return $parametro;
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

	return filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT);
 
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
  

//********************************ENCRYPTS********************************//

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

define(key, "KqJWpanXZHKq2BOB43TSaYhEWsQ1Lr5QNyPCDH");
define(publickey, "5663284166397124291158310398993993");