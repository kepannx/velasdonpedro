<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class guardarAjax extends conect  {


//DATOS DE LOS PUNTOS DE VENTA
public function datosPuntosVenta($idPuntoVenta){
    $conn=$this->conectar();

  if (isset($idPuntoVenta)) {
     # code...
    $idPuntoVenta=$this->decrypt($idPuntoVenta, key);
   }else{
        $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
   }
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    $sql="SELECT * FROM puntosVenta WHERE idPunto=$idPuntoVenta AND activada='si'";
    $queryPunto=$conn->query($sql);
    return mysqli_fetch_array($queryPunto, MYSQLI_ASSOC);
  }




//Saco los datos del producto o servicio que necesito
public function datosProductoServicio($idProductoServicio){
  //ID NO VIENE ENCRIPTADO
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
    $sql="SELECT * FROM PRODUCTOSERVICIOS WHERE idproductosServicios=$idProductoServicio";
    $queryProducoServicio=$conn->query($sql);
    return mysqli_fetch_array($queryProducoServicio, MYSQLI_ASSOC);
  }



  private function getDatosPruductoConImei($codigo){
      $conn=$this->conectar();
      $codigo=$this->filtroStrings($codigo, 1);
      $sql="SELECT * FROM serialesImeis WHERE codigo ='".$codigo."'";
      $queryCodigos=$conn->query($sql);
      return mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC);

  }



private function getDatosPruductoConSku($codigo){
      $conn=$this->conectar();
      $codigo=$this->filtroStrings($codigo, 1);
      $sql="SELECT * FROM PRODUCTOSERVICIOS WHERE sku='".$codigo."'";
      $queryCodigos=$conn->query($sql);
      return mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC);

  }




//GET LOS DATOS DE LA CATEGORIA DE UN PRODUCTO O SERVICIO
  private function getDatosCategoria($idCategoria){
    $conn=$this->conectar();
    $idCategoria=$this->filtroNumerico($idCategoria);
    $sqlCategoria="SELECT * FROM categorias WHERE idCategoria=$idCategoria";
    $queryCodigos=$conn->query($sql);
    return mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC);

  }





/*==============================================
=            TRASLADOS DE MERCANCIA            =
==============================================*/
//Ejecuto los traslados a los puntos de venta


public function guardarTraslado($idTraslado){
  $conn=$this->conectar();
  $idTraslado=$this->filtroNumerico($idTraslado);
  //Saco el row del traslado
   $sqlTraslado="SELECT idTraslado, sku, unidades, codigo, idOrigen, idDestino, confirmacion, token FROM trasladosMercancia
                                            WHERE idTraslado = $idTraslado AND confirmacion='no'
  ";
  $query=$conn->query($sqlTraslado);
  $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  $idProductoServicio=$this->getDatosPruductoConSku($rs['sku'])['idproductosServicios'];
  //Verifico la existencia en el punto de origen
  $cantidadExistente=$this->cantidadEnExistenciaEnPuntoVenta($idProductoServicio, $rs['idOrigen']);
  $idProductoServicio.'<br>';

  //Verifico que las canditades existentes sean suficientes para el traslado
  if ($cantidadExistente>= $rs['unidades']) { 
    # code...
    //Ciclo de existencia del producto
    $n=0;
    while ($n<$rs['unidades']) {
      # code...
      //AQUI COMINEZO EL CILO DE DESCUENTO POR UNO EN CADA ROW DE ORIGEN
       $sqlSelect="SELECT idTraslado, idProductoServicio, destinoId, cantidadExistenteTraslado FROM  trasladosExistencia 
                                          WHERE destinoId='".$rs['idOrigen']."'
                                          AND idProductoServicio = '".$idProductoServicio."'
                                          AND cantidadExistenteTraslado >0
      ";
      $queryOrigen=$conn->query($sqlSelect);

      if (mysqli_num_rows($query)>0) {
          $rsOrigen=mysqli_fetch_array($queryOrigen, MYSQLI_ASSOC);
          $cantidadOrigen=$rsOrigen['cantidadExistenteTraslado']-1;

        //Restar 1 al row de origen;
        $sqlResta="UPDATE  trasladosExistencia SET cantidadExistenteTraslado= '".$cantidadOrigen."' WHERE  idTraslado = '".$rsOrigen['idTraslado']."'";
        $conn->query($sqlResta);
        $n++;
      }



    }//Fin del ciclo de unidades


    //Verifico si se trata de un producto con serial/imei

    if (strlen($rs['codigo'])>0) {
      # Actualizar el codigo...
      $sqlActualizacionCodigo="UPDATE  serialesImeis SET ubicacion = '".$rs['idDestino']."' WHERE codigo='".$rs['codigo']."'";
      $conn->query($sqlActualizacionCodigo);

    }
    //Fin de la actualización de codigo


     //inserto las cantidades que logré trasladar
      $sqlInsertOrigen="INSERT INTO trasladosExistencia SET idProductoServicio='".$idProductoServicio."', 
                                                        tipoTraslado = 'puntoVenta-puntoVenta',
                                                        origenId ='".$rs['idOrigen']."',
                                                        destinoId = '".$rs['idDestino']."',
                                                        fechaTraslado='".date('Y-m-d H:i:s')."',
                                                        estadoTraslado='Trasladado',
                                                        cantidadTrasladada='".$n."',
                                                        cantidadExistenteTraslado= '".$n."',
                                                        tokenTraslado='".$rs['token']."'";
      $conn->query($sqlInsertOrigen);

      //Actualizo el estado del traslado
      $sqlActualizacionEstado="UPDATE trasladosMercancia SET confirmacion='si' WHERE idTraslado = $idTraslado ";
      $conn->query($sqlActualizacionEstado);
      $objResponse->Registrado = 0;

  }else{
    //Log para reportar inconsistencia
    $objResponse->Registrado = 1;

  }
    
  echo json_encode($objResponse);

}


//EXISTENCIA EN PUNTOS DE VENTA
private function cantidadEnExistenciaEnPuntoVenta($productoId, $origenId){
  //trasladosExistencia
  $conn=$this->conectar();
  $sql="SELECT SUM(cantidadExistenteTraslado) AS cantidadesExistentes 
                                                      FROM trasladosExistencia WHERE
                                                      destinoId=$origenId
                                            AND idProductoServicio= $productoId"; //METER AQUI EL BETWEN


  $resultado = mysqli_fetch_assoc($conn->query($sql));
  return $resultado["cantidadesExistentes"];


}

/*=====  End of TRASLADOS DE MERCANCIA  ======*/



/*=====  End of INVENTARIOS   ======*/



/*===============================
=            EGRESOS            =
===============================*/

public function ingresoEgresosGastos($parametros){
  extract($parametros);
  $conn=$this->conectar();
  $tipoEgresoGasto=$this->filtroStrings($tipoEgresoGasto, 0);
  $descripcion=$this->filtroStrings($descripcion, 0);
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $nroRecibo=$this->filtroStrings($nroRecibo,0);
  $provedor=$this->filtroStrings($provedor, 1);
  $valorEgresoGasto=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEgresoGasto));
  $sqlEgreso="INSERT INTO egresosGastos SET tipoEgresoGasto='".$tipoEgresoGasto."',
                                            fechaEgresoGasto='".date("Y-m-d")."', 
                                            descripcion='".$descripcion."', 
                                            nroRecibo='".$nroRecibo."',
                                            provedor='".$provedor."',
                                            idPuntoVenta=$idPuntoVenta, 
                                            valorEgresoGasto=$valorEgresoGasto";


  if ($conn->query($sqlEgreso)==TRUE) {
    # code...
    $objResponse->Registrado = $this->encrypt($idFactura=mysqli_insert_id($conn), publickey);
  }
  else
  {
    $objResponse->Registrado = 0;
  }
  echo json_encode($objResponse);

}

/*=====  End of EGRESOS  ======*/



/*====================================
=            PRE-TRASLADO            =
====================================*/





/*=====  End of PRE-TRASLADO  ======*/
public function guardarPreTraslado($parametros){
    $conn=$this->conectar();
    extract($parametros);
    $idOrigen=$this->decrypt($_SESSION['datos'], key);
    $codigo=trim(htmlentities($this->comillaSimplePorGuion($codigo)));
    $sku=$this->comillaSimplePorGuion($this->filtroStrings($sku, 1));
    $cantidades=$this->filtroNumerico($unidades);
    $tipo=$this->filtroStrings($tipo, 0);
    $token=$this->filtroNumerico($token);
    //Filtro el id del producto
    if ( $this->filtroNumerico($idProductoServicio) == 0) {
        $idProductoServicio=$this->filtroNumerico($this->decrypt($idProductoServicio, publickey));
    }
    $nombreProductosServicios=$this->datosProductoServicio($idProductoServicio)['nombreProductosServicios'];
    if ($tipo=='serial') {
      # code...
        $codigo=$sku;
        $sku=$this->datosProductoServicio($idProductoServicio)['sku'];
    }
     $sql="INSERT INTO trasladosMercancia SET sku='".$sku."',
                                            nombreProductosServicios = '".$nombreProductosServicios."', 
                                            unidades=$cantidades,
                                            codigo = '".$codigo."',
                                            fechaTraslado='".date('Y-m-d H:i:s')."',
                                            idOrigen=$idOrigen,
                                            token=$token";
  $conn->query($sql);
  $objResponse->Registrado = $token;//OK
  echo json_encode($objResponse);
}



/*===================================
=            FACTURACIÓN            =
===================================*/



//Organizo la prefactura
public function guardarPreFactura($parametros){
    $conn=$this->conectar();
    extract($parametros);

    $puntoVenta=$this->decrypt($_SESSION['datos'], key);
    $sku=trim(htmlentities($this->comillaSimplePorGuion($sku)));
    $codigo=trim(htmlentities($this->comillaSimplePorGuion($codigo)));
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProductoServicio, publickey));
    $nombreProductosServicios=$nombreProductosServicios;
    $cantidades=$this->filtroNumerico($cantidades);
    $serializado=$this->filtrocaracteres($serializado);
    $valorUnidad=$this->filtroNumerico($this->normalizacionDeCaracteres($valorUnidad));
    $impuesto=$this->filtroNumericoDecimal($this->normalizacionDeCaracteres($impuesto));
    $tipoDocumento=htmlentities($tipoDocumento);
    $tokenPrefactura=$this->filtroNumerico($tokenPrefactura);
    $tiempo=$this->normalizacionDeCaracteres(date('dHis'.substr((string)microtime(), 1, 8)));
    $taxes=($impuesto/100)+1;
    $valorNeto=$valorUnidad/$taxes;
    $valorIva=$valorUnidad-$valorNeto;


    if ($serializado!=NULL) {
      // code...
      $nombreProductosServicios=$this->datosProductoServicio($idProductoServicio)['nombreProductosServicios'];
      $tipo='serialandimei';
    }

    if ($tokenPrefactura>0) {//la prefactura esta iniciada!
        $sqlCantidadesPreinventario="INSERT INTO preVenta SET       nombreProductosServicios='".$nombreProductosServicios."', 
                                                                 idProducto=$idProductoServicio,
                                                                 cantidades=$cantidades,
                                                                 puntoVenta=$puntoVenta,
                                                                 retefuente=0,
                                                                 valorUnidad=$valorNeto,
                                                                 impuesto=$valorIva,
                                                                 codigo =  '".$codigo."',
                                                                 token='".$tokenPrefactura."',
                                                                 time='".$tiempo."'";


      $conn->query($sqlCantidadesPreinventario);//ACTUALIZO LAS CANTIDADES
      if ($tipo=='serialandimei') {
        // code...
      $sqlInsertImeiSerial='INSERT INTO preSerializacion SET  codigo='.$idProductoServicio.',
                                                                sku="'.$codigo.'",
                                                                tipo="'.$serializado.'",
                                                                token='.$tokenPrefactura.' ';

        $conn->query($sqlInsertImeiSerial);//INGRESO EL IMEI CORRESPONDIENTE A ESTE EQUIPO
      }


      $objResponse->Registrado = 0;//OK



    }


    echo json_encode($objResponse);


}




//GUARDAR FACTURA
public function guardarFacturas($parametros){
  $conn=$this->conectar();
  extract($parametros);
  //Verificación de Existencia de Clientes
  $idCliente=$this->filtroNumerico($this->decrypt($idCliente, publickey));


  if ($idCliente==0) {//CREO EL CLIENTE EN CASO QUE NO EXISTA.
     $idCliente=$this->crearCliente($parametros);
  }
    $fechaFactura=$fechaFactura;
    //Filtro de digital aqui

    if ($fc=='true') {//Es una factura foranea
      $idPuntoVenta=$this->encrypt(5, key);
    }else if ($fc=='false') {
      $idPuntoVenta=$_SESSION['datos'];
    }
    $pertenencia=$this->decrypt($_SESSION['datos'], key);

 

    $nroFactura=$this->proximoNumeroFactura($idPuntoVenta);//Genero el número de factura
    $prefijo= $this->datosPuntosVenta($idPuntoVenta)['prefijo']; 
    if (strlen($prefijo)>0) {
      $prefijo=$prefijo.'-';
    } 

    $horaFactura=date('H:i:s');
    $codigoVendedor=$this->filtroNumerico($this->decrypt($codigoVendedor, publickey));
    $valorFactura = $this->mathCalculoValorFacturaProvedor($valorTotal);  //Calculo con impuestos
    $valorNeto=$this->mathCalculoValorFacturaProvedor($valorNeto);
    $sku=explode(',', $skus);
    $idProductoServicios=explode(',',$idProductoServicios);
    $tokenPrefactura=$this->filtroNumerico($tokenPrefactura);
    $taxes=explode(',',$taxes);
    $unidades=explode(',',$unidades);
    $valorUnidad=explode(',', $valorUnidad);
    //$valorVentaPublico=explode(',',$valorVentaPublico);
    $bukandserial=json_decode($bucketSerials);
    $tipoPago=$conn->real_escape_string($tipoPago);
    //CREO LA BASE DE LA FACTURA

    //filtro de digital aqui
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    

    $sqlFactura="INSERT INTO facturacion SET 
                                              nroFactura=$nroFactura,
                                              prefijo ='".$prefijo."',
                                              idPuntoVenta=".$this->decrypt($idPuntoVenta, key).",
                                              idCliente=$idCliente,
                                              fechaFactura='".$fechaFactura."',
                                              horaFactura='".date('H:i:s')."',
                                              valorNetoFactura=$valorNeto,
                                              valorTotalFactura=$valorNeto, 
                                              codigoVendedor=$codigoVendedor,
                                              tipoPago='".$tipoPago."',
                                              pertenencia=$pertenencia
                                               " ;

   $conn->query($sqlFactura);

   
    $idFactura=mysqli_insert_id($conn);//ID FACTURA
    $valorEfectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEfectivo));
    $valorDebito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorDebito));
    $valorDebito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorDebito));
    $valorCredito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorCredito));
    $valorCheque=$this->filtroNumerico($this->normalizacionDeCaracteres($valorCheque));
    $valorServicredito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorServicredito));
   

    //Perfíl de Pago
   $fecha=$fechaFactura.' '.$horaFactura; 

   //AQUI REGISTRO LOS PAGOS HECHOS POR DIFERENTES MEDIOS PARA LUEGGO DISCRIMINARLOS
   $residuo= $this->perfilVerificacionPago($valorEfectivo, $valorDebito, $valorCredito, $valorCheque, $valorServicredito, $idFactura, $fecha, $idPuntoVenta, $pertenencia );

    //Verificación de ingreso de factura en cartera
    if (($valorFactura - $residuo)<=0) {
        $estadoFactura='pagada';
    }else{
      //Si la factura entra en credito
      $estadoFactura='en credito';
      $deudaFactura=$valorFactura - $residuo;
      if ($residuo>0) {
        # code..
        //Ingreso el abono de  la factura en caso que sea crédito
      $sqlAbono="INSERT INTO abonoFacturas SET idFactura=$idFactura,
                                              fechaAbono = '".date('Y-m-d')."',
                                              valorAbono=$residuo,
                                              tipoPago='".$tipoPago."'
                                              ";
      $conn->query($sqlAbono);
      }
      
    }



    //ACTUALIZO LA FACTURA COMO EN CARTERA
    $sqlActualizacion="UPDATE facturacion SET estadoFactura='".$estadoFactura."', deudaFactura=$deudaFactura WHERE idFactura=$idFactura";
    $conn->query($sqlActualizacion);
    //Fin del ingreso de factura de cartera

    //INGRESO DE ITEMSFACTURA








    //VERIFICO SI HAY PRODUCTOS IMEIS O SERIALES
    $separadas=explode("%",$bucketSerials);
      for ($i=0; $i < sizeof($separadas); $i++) { 
        # code...
        if ($separadas[$i]!=null) {//Filtro los ciclos que estan vacios
          # Ingreso los seriales e Imeis...
            $sr=explode("|",$separadas[$i]);
            //filtro los que no tienen serial
            if ($sr[0]!=null) {
              # SERIALES E IMEIS...
              $seriales=explode(',',$sr[0]);//Separo los seriales e imes en las ,
              $tamano=sizeof($seriales);
              $control=0;
              while ($tamano>$control) {
                # code...
                $idProducto=$this->decrypt($sr[1],publickey);
                $sql="UPDATE serialesImeis SET estado='vendido', idFacturaVenta=$idFactura, fechaFacturado='".date('Y-m-d H:i:s')."' WHERE codigo='".$seriales[$control]."' AND idProductoServicio='".$idProducto."' ";
                $conn->query($sql);
                $control++;
               }           
            }
            $control=$control;
        }
                
      }//FIN DE LA VERIFICACIÓN DE SERIALES 



      //Ingreso los ITEMS DE LA FACTURA
        $t=sizeof($idProductoServicios);
        $i=0;

        while ($t>$i) {
         // $this->sacarDeInventario($this->decrypt($idProductoServicios[$i], publickey), $unidades[$i]);
          $this->sacarDeInventario($idProductoServicios[$i], $unidades[$i]);

          $convercionImpuesto = ($taxes[$i]/100)+1;  
          $valorTotal=($valorUnidad[$i]+$taxes[$i])*$unidades[$i]; 
          $valorSinImpuesto=$valorTotal/$convercionImpuesto;
          $valorNeto=$valorUnidad[$i];
          $idProducto=$this->filtroNumerico($idProductoServicios[$i]);
         // ;
          $utilidad=($valorTotal-$this->getUtilidad($idProducto, $idFactura,$unidades[$i]));

          $sqlItemsFactura="INSERT INTO itemsFactura SET
                                          idFactura=$idFactura,
                                          idProductoServicio='".$idProducto."',
                                          unidades='".$unidades[$i]."',
                                          valorNeto=$valorNeto,
                                          valorTotal=$valorTotal,
                                          utilidad=$utilidad,
                                          porcentajeImpuesto='".$taxes[$i]."'

          ";
          //Actualización del INVENTARIOS
          $conn->query($sqlItemsFactura);
          $i++;
        }



    //FIN DE INGRESOFACTURA */

//Verifico si existen seriales o imeis para sacar del inventario
  $sqlCheckImeiSerial="SELECT * FROM preSerializacion WHERE token='$tokenPrefactura'";
  $queryImeiSerial=$conn->query($sqlCheckImeiSerial);
  while ($rsImeiSerial=mysqli_fetch_array($queryImeiSerial, MYSQLI_ASSOC)) {
    // Actualizo los seriales e imeis 
  $sql="UPDATE serialesImeis SET estado='vendido', idFacturaVenta=$idFactura, fechaFacturado='".date('Y-m-d H:i:s')."' WHERE codigo='".$rsImeiSerial['sku']."' AND idProductoServicio='".$rsImeiSerial['codigo']."' ";
    $conn->query($sql);

    //elimino del  preserial el serial que acabe de actualizar.
    $sqlDelete="DELETE FROM preSerializacion WHERE sku='".$rsImeiSerial['sku']."' ";
    $conn->query($sqlDelete);
  }




  //ELIMINO LA PREFACTURA
      $sqlDelete="DELETE FROM preVenta WHERE token='$tokenPrefactura'";
      $conn->query($sqlDelete);
      $objResponse=$this->encrypt($idFactura, publickey);
  echo json_encode($objResponse);
}




//Utilidad de producto 
private function getUtilidad($idProducto, $idFactura, $unidades){
  $conn=$this->conectar();

  $serializado=$this->datosProductoServicio($idProducto)['serializacion'];
  if ($serializado=='si') {
      //Selecciono los seriales e imeis que existen en esta factura
       $sqlCodigos="SELECT idSerialImei,  idFacturaProvedor, idProductoServicio, idFacturaVenta, liquidado FROM 
                                    serialesImeis WHERE idProductoServicio=$idProducto
                                                    AND  idFacturaVenta=$idFactura AND liquidado='no' ";

      $queryCodigos=$conn->query($sqlCodigos);
      //Saco cada  serial para sacarle la factura del provedor y a esta sacarle el costo con el que entró
      while ($rsCodigo=mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC)) {//<--- 
        # code...
        $idFacturaProvedor=$rsCodigo['idFacturaProvedor'];
        $idProductoServicio=$rsCodigo['idProductoServicio'];
        $idSerialImei=$rsCodigo['idSerialImei'];

        //SELECCIONO DE DONDE PERTENECE ESE PRODUCTO
        if ($idFacturaProvedor==0) {
          #NO HAY PROVEDOR  Y DEBO SELECCIONAR EN EL INVENTARIOS IDFACTURA PROVEDOR COMO NULL
          $sqlFacturaProvedor="SELECT IdFacturaProvedor, idProductoServicio, valorUnidad FROM INVENTARIOS
                                                WHERE idProductoServicio=$idProductoServicio
                                                AND IdFacturaProvedor IS NULL";
        }else{
            $sqlFacturaProvedor="SELECT IdFacturaProvedor, idProductoServicio, valorUnidad FROM INVENTARIOS
                                                  WHERE idProductoServicio=$idProductoServicio
                                                  AND IdFacturaProvedor=$idFacturaProvedor";
        }
        //Fin de los condicionales de las facturas de provedor que son con NULL

        $queryDatosFacturaProvedor=$conn->query($sqlFacturaProvedor);
        $rsDatosFacturaProvedor=mysqli_fetch_array($queryDatosFacturaProvedor, MYSQL_ASSOC);
        $costoEnFactura=explode('.', $rsDatosFacturaProvedor['valorUnidad']);
        if ($costoEnFactura[0]==0) {
          # Si el costo = 0 entonces calculeme el valor promedio de ese equipo y paselo como costo...
          $costo=$this->calcularValorPromedio($idProductoServicio);

        }else{
            //Existe costo de factura
            $costo=($costoEnFactura[0]+$costo); 
        }
        //Actualizo el estado de ese imei
        $actualizacion="UPDATE serialesImeis SET liquidado='si' WHERE idSerialImei=$idSerialImei"; 
        $conn->query($actualizacion);
      }//Fin del while de codigos de los seriales


  }else{//NO ESTA SERIALIZADO
    $costoUnidad=$this->calcularValorPromedio($idProducto);
    $costo= $costoUnidad*$unidades;
  }

  return $costo;
}
//fin de la utilidad del producto

//FIN DE GUARDAR FACTURACION




public function getCostoBase($idFactura, $idProducto){
    $conn=$this->conectar();

    $ideProducto=$this->filtroNumerico($idProducto);
    $ideFactura=$this->filtroNumerico($idFactura)  ;  

    if ($idFactura==0) {
      # code...
      $sqlInventario="SELECT idProductoServicio, IdFacturaProvedor, valorUnidad 
                  FROM  INVENTARIOS
                        WHERE idProductoServicio=$ideProducto AND IdFacturaProvedor IS NULL";
    }else{
     $sqlInventario="SELECT idProductoServicio, IdFacturaProvedor, valorUnidad 
                  FROM  INVENTARIOS
                        WHERE idProductoServicio=$ideProducto AND IdFacturaProvedor = $ideFactura";
    }

    $queryInventario=$conn->query($sqlInventario);
    while ($rValor=mysqli_fetch_array($queryInventario, MYSQL_ASSOC)) {

               $costoDecimal=explode('.',intval($rValor['valorUnidad']));

               //echo 'Costo Decimal: '.$costoDecimal[0].'<br>';
                if ($costoDecimal[0]==0) {
                  # code...
                  $costoDecimal=$this->calcularValorPromedio($ideProducto);
                }
                $cost=$this->filtroNumerico($costoDecimal[0])+$cost;
                $n++;
            
          }


      return  $cost;


}



//Calculo el valor promedio de un producto
private function calcularValorPromedio($idProducto){
  $conn=$this->conectar();
   $sqlInventario="SELECT idProductoServicio, unidadesExistentes, valorUnidad, unidadesCompradas 
              FROM  INVENTARIOS
                    WHERE idProductoServicio=$idProducto AND unidadesExistentes>0
  ";
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

//SACAR DEL INVENTARIOS
private function sacarDeInventario($idItem, $cantidad)
{
  $conn=$this->conectar();
  $idItem=$this->filtroNumerico($idItem);
  $cantidad=$this->filtroNumerico($cantidad);
  $destinoId=$this->decrypt($_SESSION['datos'], key);
  $tipo=1;
    //Saco la existencia de los productos en bodega
  $cantidadCumplida=$cantidad;

      $bucket=array();//array que me guardara las cantidades que existem por cada linea
      $n=0;
      $break=0;
      $sql="SELECT idinventario, idProductoServicio, unidadesExistentes FROM  INVENTARIOS WHERE idProductoServicio='".$idItem."'  and unidadesExistentes>0";
     


       $sqlTraslados="SELECT idTraslado, idProductoServicio, destinoId, cantidadExistenteTraslado FROM trasladosExistencia WHERE destinoId=$destinoId AND  cantidadExistenteTraslado>0 AND
          idProductoServicio ='".$idItem."'
       ";


      $query=$conn->query($sql);
      $queryTraslados=$conn->query($sqlTraslados);
       while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC) AND  ($break==0))
       {

         if ($cantidadCumplida>$rs["unidadesExistentes"])
          {//En caso que la cantidad que pida exceda las existencias de la primera linea de consulta
            $cantidadCumplida=($cantidadCumplida)-($rs["unidadesExistentes"]);
            $sql="UPDATE INVENTARIOS SET unidadesExistentes= 0 WHERE idinventario='".$rs["idinventario"]."'";

            $conn->query($sql);
          }
          elseif ($cantidadCumplida<=$rs["unidadesExistentes"]) {
            $break=1;

            $cantidadNueva=($rs["unidadesExistentes"])-($cantidadCumplida);
            $sql="UPDATE INVENTARIOS SET unidadesExistentes= ".$cantidadNueva." WHERE idinventario='".$rs["idinventario"]."'";
            $conn->query($sql);
          }
       }//Fin del ciclo





       //Ciclo de traslados 
        $bucketTralsado=array();//array que me guardara las cantidades que existem por cada linea
        $n=0;
        $break=0;
        $cantidadCumplida=$cantidad;



        while ($rs=mysqli_fetch_array($queryTraslados, MYSQL_ASSOC) AND  ($break==0))
       {  
         if ($cantidadCumplida>$rs["cantidadExistenteTraslado"])
          {//En caso que la cantidad que pida exceda las existencias de la primera linea de consulta
            $cantidadCumplida=($cantidadCumplida)-($rs["cantidadExistenteTraslado"]);
             $sql="UPDATE trasladosExistencia SET cantidadExistenteTraslado= 0 WHERE idTraslado='".$rs["idTraslado"]."'";

            $conn->query($sql);
          }
          elseif ($cantidadCumplida<=$rs["cantidadExistenteTraslado"]) {
            $break=1;

            $cantidadNueva=($rs["cantidadExistenteTraslado"])-($cantidadCumplida);
              $sql="UPDATE trasladosExistencia SET cantidadExistenteTraslado= ".$cantidadNueva." WHERE idTraslado = '".$rs["idTraslado"]."'";
            $conn->query($sql);
          }
       }//Fin del ciclo
      
}
//FIN DE SACAR DEL INVENTARIOS










/*=================================
=            IMPUESTOS            =
=================================*/




//Saco el valor de la retefuente de un producto
private function getRetefuente($tipoItem, $valorItem){
  $conn=$this->conectar();
  $sqlImpuestos="SELECT valor, aplicacion, tipo, incrementoDecremento FROM  taxes WHERE  aplicacion='empresas' and tipo='".$tipoItem."'";
  $query=$conn->query($sqlImpuestos);
  $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  if ($rs['incrementoDecremento']=='decrementar') {
      $retefuente=($valorItem*$rs['valor'])/100;
  }

  echo $retefuente;

  return $retefuente;

}

/*=====  End of IMPUESTOS  ======*/




/*=================================================
=            MODULO DE PRE-INVENTARIOS            =
=================================================*/



public function comparacionInventarios($parametros){

  $conn=$this->conectar();
  extract($parametros);
  $puntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $codigo=trim($this->comillaSimplePorGuion($codigo));
  $restar=$fc;
  $sqlConsulta="SELECT idproductosServicios, sku, serializacion, serial, imei FROM  PRODUCTOSERVICIOS WHERE sku ='".$codigo."'";
  $query=$conn->query($sqlConsulta);
  $tiempo=$this->normalizacionDeCaracteres(date('dHis'.substr((string)microtime(), 1, 8)));
  if (mysqli_num_rows($query)>0) {//EL PRODUCTO EXISTE
    $rsPreconsulta=mysqli_fetch_array($query, MYSQLI_ASSOC);

    if ($rsPreconsulta['serializacion']=='no') {
      # code...
        $sqlPreinventario="SELECT idProducto, cantidades, idPreinventario, puntoVenta FROM preInventario WHERE idProducto='".$rsPreconsulta['idproductosServicios']."' AND puntoVenta=$puntoVenta ";
        $queryPreInventario=$conn->query($sqlPreinventario);
        $rsPreinventario=mysqli_fetch_array($queryPreInventario, MYSQLI_ASSOC);
        if (mysqli_num_rows($queryPreInventario)==0) {
           $sqlCantidadesPreinventario="INSERT INTO preInventario SET idProducto='".$rsPreconsulta['idproductosServicios']."', cantidades=1, puntoVenta=$puntoVenta, time='".$tiempo."'";
        }else{

            if ($restar == 'false') {
              # code...
              $cantidades=(1+$rsPreinventario['cantidades']);

            }else{
              $cantidades=($rsPreinventario['cantidades']-1);
              }
              $sqlCantidadesPreinventario="UPDATE preInventario  SET cantidades=$cantidades, time='".$tiempo."' WHERE idProducto='".$rsPreconsulta['idproductosServicios']."' AND puntoVenta=$puntoVenta ";
        }
          $conn->query($sqlCantidadesPreinventario);//ACTUALIZO LAS CANTIDADES
          $objResponse->Registrado = 0;//Error de  producto con serial/imei
    }//SI NO TIENE SERIAL
  else {
      $objResponse->Registrado = 1;//EL PRODUCTO EXISTE PERO TIENE SERIAL/IMEI
  }
  }else{//BUSQUELO POR SERIALES

      $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, inventariado FROM serialesImeis WHERE codigo='".$codigo."'AND inventariado!=1 AND ubicacion=$puntoVenta ";
      $queryPreInventario=$conn->query($sqlImeis);
      if (mysqli_num_rows($queryPreInventario)>0) {//hay un imei con esa existencia
        # code...
        $rsPreinventario=mysqli_fetch_array($queryPreInventario, MYSQLI_ASSOC); //Saco los datos de ese serial/imei
        //Busco si esta ya en  el pre-INVENTARIOS
         $sqlPreinventario="SELECT idProducto, cantidades, idPreinventario FROM preInventario WHERE idProducto='".$rsPreinventario['idProductoServicio']."' AND puntoVenta=$puntoVenta ";
        $queryPre=$conn->query($sqlPreinventario);

        if (mysqli_num_rows($queryPre)==0) {//no hay registro
            $sqlCantidadesPreinventario="INSERT INTO preInventario SET idProducto='".$rsPreinventario['idProductoServicio']."', cantidades=1, puntoVenta=$puntoVenta, time='".$tiempo."' ";
            $sqlActualizarSerialImei="UPDATE serialesImeis SET inventariado=1 WHERE idSerialImei='".$rsPreinventario['idSerialImei']."'";
        }else{//Ya existe un registro
            $rsPreIn=mysqli_fetch_array($queryPre);
            $cantidades=(1+$rsPreIn['cantidades']);
            $sqlCantidadesPreinventario="UPDATE preInventario  SET cantidades=$cantidades, time='".$tiempo."' WHERE idProducto='".$rsPreinventario['idProductoServicio']."' AND puntoVenta=$puntoVenta ";
            $sqlActualizarSerialImei="UPDATE serialesImeis SET inventariado=1 WHERE idSerialImei='".$rsPreinventario['idSerialImei']."' AND ubicacion=$puntoVenta ";

        }
        $conn->query($sqlCantidadesPreinventario);//ACTUALIZO LAS CANTIDADES
        $conn->query($sqlActualizarSerialImei);//ACTUALIZO INVENTARIADOS
        $objResponse->Registrado = 0; //ok
      }//Fin de existencia en seriales
      else{//No exsten seriales. relacionados
          $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, inventariado FROM serialesImeis WHERE codigo='".$codigo."'AND inventariado=1";
          $queryPreInventario=$conn->query($sqlImeis);
          if (mysqli_num_rows($queryPreInventario)==1) {
            # code...
              $objResponse->Registrado = 2;
          }else{

            //BUSQUELO EN OTRO PUNTO DE VENTA
           $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, inventariado FROM serialesImeis WHERE codigo='".$codigo."' ";
              $queryPreInventario=$conn->query($sqlImeis);
              if (mysqli_num_rows($queryPreInventario)>0) {

                //Script para marcarlo como si estuviera en otro punto de venta
                $sqlUpdateSerial="UPDATE serialesImeis SET inventariado=$puntoVenta  WHERE codigo='".$codigo."'";
                $conn->query($sqlUpdateSerial);
                $objResponse->Registrado = 4;
              }else{
                  $objResponse->Registrado = 3;//No esta en INVENTARIOS
              }
          }

        //Error de  producto con serial/imei NO EXISTE
      }//Fin de. la no existencia de los seriales relacionados

  }



/* 
[0]= todo ok
[1]= EL PRODUCTO EXISTE PERO TIENE SERIAL/IMEI
[2]= EL PRODUCTO ESTA YA INVENTARIADO
[3]= EL PRODUCTO NO EXISTE NI ESTA INVENTARIADO
[4]= ESTA EN INVENTARIOS PERO EN OTRO PUNTO DE VENTA

*/

  
echo json_encode($objResponse);

}

/*=====  End of MODULO DE PRE-INVENTARIOS  ======*/







/*=====  End of FACTURACIÓN  ======*/


/*=============================================
=            ANULACIÓN DE FACTURAS            =
=============================================*/

public function anulacionFactura($parametros){

$conn=$this->conectar();
extract($parametros);
$idFactura=$this->decrypt($idFactura, publickey);
$idPuntoVenta=$this->decrypt($_SESSION['idPunto'], publickey);
$sqlFactura="SELECT idFactura,nroFactura, idPuntoVenta,estadoFactura FROM facturacion
                                              WHERE idFactura=$idFactura AND idPuntoVenta=$idPuntoVenta
";

$query=$conn->query($sqlFactura);
$rsFactura=mysqli_fetch_array($query);

$sqlItemsFactura="SELECT idFactura,idProductoServicio, unidades,estadoFactura FROM facturacion
                                              WHERE idFactura=$idFactura AND idPuntoVenta=$idPuntoVenta
";

}


/*=====  End of ANULACIÓN DE FACTURAS  ======*/


/*========================================
=            INGRESOS BÁSICOS            =
========================================*/
/**
 *
 * SON LOS INGRESOS DE PROVEDORES O CLIENTES O PRODUCTOS DE FORMA BASICA()
 *
 */

/*
//NUEVO PROVEDOR BÁSICO
private function basicoNuevoProvedor($parametro){
   $conn=$this->conectar();
   $parametro=$this->filtroStrings(htmlentities($parametro), 2);
   $sql="INSERT INTO provedores SET nombreProvedor = '".$parametro."'";
  // mysqli_query($sql);
   $query= $conn->query($sql);
   return mysqli_insert_id($conn);
   $conn->close();
}



//NUEVO PRODUCTO BÁSICO
private function basicoNuevoProducto($sku, $nombreProductosServicios, $valorVentaPublico, $valorVentaMayorista)
{
  $conn=$this->conectar();

  $conn->close();
}


*/


/*----------  creación de clientes  ----------*/


//NUEVO PROVEDOR CLIENTE 
public  function crearCliente($parametro){
    
   $conn=$this->conectar();
   extract($parametro);
   $identificacionCliente=$this->filtroStrings(htmlentities($identificacionCliente), 1);
   $nombreCliente=$this->filtroStrings($nombreCliente, 1);
   $direccionCliente=$this->filtroStrings($direccionCliente, 1);
   $telefonosCliente=$this->filtroStrings($telefonoCliente, 1);
   $emailCliente=$this->filtroStrings($emailCliente, 1);
   $ciudadCliente=$this->filtroStrings($ciudadCliente, 1);
   $tipoDocumento=htmlentities($tipoDocumento);


    $sql="INSERT INTO clientes SET nombreCliente = '".$nombreCliente."',
                                    tipoDocumento = '".$tipoDocumento."',
                                    identificacionCliente='".$identificacionCliente."',
                                    direccionCliente='".$direccionCliente."',
                                    telefonosCliente='".$telefonosCliente."',
                                    emailCliente='".$emailCliente."',
                                    ciudadCliente='".$ciudadCliente."'";

   $query=$conn->query($sql);
   return mysqli_insert_id($conn);
   //$conn->close();*/
}



/*=====  End of INGRESOS BÁSICOS  ======*/




/*============================
=            MATH            =
============================*/
/**
 *
 * AQUI HAGO LAS OPERACIONES MATEMÁTICAS NECESARIAS QUE NECESITE ANTES O DURANTE EL PROCESO DE LOS DATOS
 *
 */







//Calculo el valor completo con impuestos de una factura de provedor
private function mathCalculoValorFacturaProvedor($parametro){

  $numeros=explode(",", $parametro);
  $t=sizeof($numeros);
  $resultado=0;
  for ($i=0; $i < $t; $i++) { 
    $resultado=$resultado + ($this->filtroNumericoDecimal($numeros[$i]));
  }
  return $resultado;

}


/*=====  End of MATH  ======*/






//Ingreso de los documentos del punto de venta.
public function ingresarDocumentosPuntosVentas($nombreArchivo, $nombreDocumento){
  $conn=$this->conectar();
  session_start();
  if (strlen($nombreDocumento)<=2) {
    # code...
    $nombreDocumento=$nombreArchivo;
  }
  $nombreDocumento=$this->filtroStrings($nombreDocumento, 2);
  $sql="INSERT INTO documentosPuntosVenta SET 
                                              idPuntoVenta='".$this->decrypt($_SESSION['idPunto'], publickey)."',
                                              nombreDocumento='".$nombreDocumento."',
                                              fechaUpload='".date('Y-m-d')."',
                                              nombreArchivo='".$nombreArchivo."'";
  if ($conn->query($sql) === TRUE) {

    $objResponse->Registrado = 1;
   }
   else
   {  
      $this->write_log("Error al registrar un punto de venta", 'error');
      echo 'error';
   }
    $conn->close();
}
//fin del ingreso de puntos de venta.



private function actualizarLogoPunto($nombreLogo){
  $conn=$this->conectar();
  $sql="SELECT idPunto FROM puntosVenta ORDER BY(idPunto) ASC";
  $queryPunto=$conn->query($sql);
  $rs=mysqli_fetch_array($queryPunto, MYSQL_ASSOC);
  $sqlPunto="UPDATE puntosVenta SET logoPunto='".$nombreLogo."' WHERE idPunto='".$rs['idPunto']."'";
  $conn->query($sqlPunto);

  $conn->close();
}
/*----------  UPLOAD FILES  ----------*/


//Subir logos
public function uploadLogo($parametros)
{
  extract($parametros);
  if(isset($_FILES["logo"]) && $_FILES["logo"]["error"]== UPLOAD_ERR_OK)
{
  ############ Edit settings ##############
  $UploadDirectory  = '../../../modulos/uploads/'; //specify upload directory ends with / (slash)
  ##########################################

  if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    die();
  }
  
  
  //Is file size is less than allowed size.
  if ($_FILES["logo"]["size"] > 1020400) {
    die("Archivo Muy Grande!");
  }
  
  //allowed file type Server side check
  switch(strtolower($_FILES['logo']['type']))
    {
      //allowed file types
      case 'image/png': 
      case 'image/gif': 
      case 'image/jpeg': 
      case 'image/pjpeg':
      
        break;
      default:
        die('Archivo Incompatible!'); //output error
  }
  
  $File_Name          = strtolower($_FILES['logo']['name']);
  $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
  $Random_Number      = rand(0, 9999999999); //Random number to be added to name.
  $NewFileName    = $Random_Number.$File_Ext; //new file name
  sleep(1);
  if(move_uploaded_file($_FILES['logo']['tmp_name'], $UploadDirectory.$NewFileName ))
     {

     $this->actualizarLogoPunto($NewFileName);
      /*require('../../libreria.lib/70/libreria.class.php');
    $archivos=new guardarAjax();
    if (strlen($nombreArchivo)<=1) {
      # code...
      $nombreArchivo=$NewFileName;
    }
    $archivos->guardarRegistroArchivos($idBanco, $idCliente, $nombreArchivo,$NewFileName, $tipo);*/
    return $NewFileName;
    //die('<script>swal("Listo", "Ya subí el archivo", "success");</script>');
  }else{
    die('error uploading File!');
  }
  
}
else
{
  //die('<div id="mensaje" class="alert alert-warnign"><i class="fa fa-warning"></i>Ops! Algo salió mal, intentalo de nuevo</div>');
}

}



/*===================================
=            CKECK VERIFICACIÓN            =
===================================*/


//perfilVerificacionPago

private function perfilVerificacionPago($valorEfectivo, $valorDebito, $valorCredito, $valorCheque, $valorServicredito, $idFactura, $fechaFactura, $idPuntoVenta, $pertenencia){
   $conn=$this->conectar();
   $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
   //Pagos en Efectivo

     if ($valorEfectivo>0) { //Valores en caso que sea pago en efectivo
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura=$idFactura,
                                                tipoPago='efectivo',
                                                valor=$valorEfectivo,
                                                idPuntoVenta=$idPuntoVenta,
                                                pertenencia=$pertenencia,
                                                fechaRegistrado='".date('Y-m-d H:i:s')."'
                                                ";
    $conn->query($sqlPerfilPago);
   }

   if ($valorDebito>0) { //Valores en caso que sea pago por tarjeta débito
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura,
                                                tipoPago='tarjeta debito',
                                                valor=$valorDebito,
                                                idPuntoVenta=$idPuntoVenta,
                                                pertenencia=$pertenencia,
                                                fechaRegistrado='".date('Y-m-d H:i:s')."'";
    $conn->query($sqlPerfilPago);
   }
   if ($valorCredito>0) { //Valores en caso que sea  tarjeta de crédito
     # code...


    $comisionBancaria=(($valorCredito*valorComisionBancaria)/100);
    $valorFinal=($valorCredito-$comisionBancaria);

    
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura,
                                                tipoPago='tarjeta credito', 
                                                valor=$valorFinal,
                                                idPuntoVenta=$idPuntoVenta,
                                                pertenencia=$pertenencia,
                                                comision='".$comisionBancaria."',
                                                fechaRegistrado='".date('Y-m-d H:i:s')."'";
    $conn->query($sqlPerfilPago);
   }
   if ($valorCheque>0) {//Valores en caso que sea cheque
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura,
                                                tipoPago='cheque',
                                                valor=$valorCheque,
                                                idPuntoVenta=$idPuntoVenta,
                                                pertenencia=$pertenencia,
                                                fechaRegistrado='".date('Y-m-d H:i:s')."'";
    $conn->query($sqlPerfilPago);
   }
   if ($valorServicredito>0) { //Valores en caso que sea entidad crediticia
    $comisionBancaria=(($valorServicredito*valorComisionBancaria)/100);
    $valor=($valorServicredito-$comisionBancaria);
     

    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura,
                                                tipoPago='entidad crediticia',
                                                idPuntoVenta=$idPuntoVenta,
                                                pertenencia=$pertenencia,
                                                valor=$valor, comision='".$comisionBancaria."',
                                                fechaRegistrado='".date('Y-m-d H:i:s')."'";
    $conn->query($sqlPerfilPago);
   }







   $resultado=($valorEfectivo+$valorDebito+$valorCredito+$valorCheque+$valorServicredito);

   return $resultado;

   $conn->close();
}



//Te digo cuál es el próximo número de factura que sigue
public function proximoNumeroFactura($idPuntoVenta){
   $conn=$this->conectar();
   if (isset($idPuntoVenta)) {
     # code...
    $idPuntoVenta=$this->decrypt($idPuntoVenta, key);
   }else{
        $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
   }
  $nroBaseFacturacion= $this->datosPuntosVenta()['nroInicioFactura'];

  $sql="SELECT nroFactura, idPuntoVenta FROM  facturacion where idPuntoVenta=$idPuntoVenta ORDER BY(idFactura) DESC";
  $query=$conn->query($sql);
  $rs=mysqli_fetch_array($query);

    if ($rs['nroFactura']==NULL) {
        $nroFactura=$nroBaseFacturacion;
    }else{
      $nroFactura=$rs['nroFactura']+1;
    }
    return $nroFactura;
}

/*=====  End of VERIFICACIONES  ======*/




}