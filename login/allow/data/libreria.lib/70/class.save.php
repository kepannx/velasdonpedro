<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class guardarAjax extends conect  {


//DATOS DE LAS CAJAS 
//conexiones

  private function getDatosProductoConImei($codigo){
      $conn=$this->conectar();
      $codigo=$this->filtroStrings($codigo, 1);
      $sql="SELECT * FROM serialesImeis WHERE codigo ='".$codigo."'";
      $queryCodigos=$conn->query($sql);
      return mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC);

  }



//GET DATOS DE LOS PUNTOS DE VENTA
public  function getDatosFactura($idFactura){
    $conn=$this->conectar();
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($idPuntoVenta, publickey));
    $idFactura=$this->filtroNumerico($idFactura);
    $sqlFactura="SELECT * FROM facturacion WHERE idFactura=$idFactura";
    $query=$conn->query($sqlFactura);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}



public function datosProductoServicio($id)
    {
      $conn=$this->conectar();
      $id=$this->filtroNumerico($id);
      $sql = "SELECT * FROM  PRODUCTOSERVICIOS  where idproductosServicios=".intval($id)."";
       return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    } 

public function getDatosProductoConSku($sku)
    {
      $conn=$this->conectar();
        $sql = "SELECT * FROM  PRODUCTOSERVICIOS  where sku='".trim($sku)."' ";
       return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    } 



//Guardo los puntos de venta 
public function guardarPuntoVenta($parametros){
  $conn=$this->conectar();
  extract($parametros);


  $nombrePunto=$this->filtroStrings($nombrePunto, 2);
  $direccion=$this->filtroStrings($direccion, 0);
  $departamentos=$this->filtroStrings($departamentos, 2);
  $ciudadPunto=$this->filtroStrings($ciudadPunto, 2);
  $telefonoPunto=$this->filtroStrings($telefonoPunto, 0);
  $sitioWebPunto=$sitioWebPunto;
  $bodegas=filter_var($bodegas, FILTER_VALIDATE_BOOLEAN);
  $username=$this->encrypt($username, key);
  $password=$this->encrypt($password, key);
  $nitPunto=$this->filtroStrings($nitPunto, 0);
  $regimenTributario=$this->filtroStrings($regimenTributario, 0);
  $representanteLegal=$this->filtroStrings($representanteLegal, 2);
  $formatoImpresion=$this->filtroStrings($formatoImpresion, 0);
  $nroInicioFactura=$this->filtroNumerico($nroInicioFactura);
  $terminosCondicionesFactura=$this->filtroStrings(htmlentities($terminosCondicionesFactura, ENT_QUOTES), 0);

  //Saco los datos de los usuarios
  $sqlUsuario="SELECT idusuario, nombre FROM usuarios WHERE nombre='".$idAdministrador."' ";
  $queryUsuario=$conn->query($sqlUsuario);
  $rs=mysqli_fetch_array($queryUsuario, MYSQL_ASSOC);
  $idAdministrador=$rs['idusuario'];



  //Verifico si le creo bodega
  /*
  if ($bodegas==true) {
    # code...
    $sqlBodegas="INSERT INTO bodegas SET nombreBodega='Bodega De Punto ".$nombrePunto."', tipo='base' ";
    $conn->query($sqlBodegas);
    $idBodega=mysqli_insert_id($conn);
  }
  else{
    $idBodega=NULL;
  }*/
   $sql="INSERT INTO puntosVenta SET nombrePunto='".$nombrePunto."',
                                    direccionPunto='".$direccion."',
                                    ciudadPunto='".$ciudadPunto."',
                                    departamentoPunto='".$departamentos."',
                                    telefonoPunto='".$telefonoPunto."',
                                    regimenTributario='".$regimenTributario."',
                                    idAdministrador='".$idAdministrador."',
                                    bodega='".$idBodega."',
                                    sitioWebPunto='".$sitioWebPunto."',
                                    nitPunto='".$nitPunto."',
                                    formatoImpresion='".$formatoImpresion."',
                                    nroInicioFactura='".$nroInicioFactura."',
                                    representanteLegal='".$representanteLegal."',
                                    terminosCondicionesFactura='".$terminosCondicionesFactura."',
                                    usuario='".$username."',
                                    contrasena='".$password."'
   ";

   if ($conn->query($sql) === TRUE) {
    $objResponse->Registrado = 1;
   }
   else
   {  
      $this->write_log("Error al registrar un punto de venta", 'error');
      echo 'error';
   }
    $conn->close();
    echo json_encode($objResponse);
}





/*=============================================
=            GUARDAR PREVIA CODIGO            =
=============================================*/

public function guardarPreCodigo($parametros){
    $conn=$this->conectar();
    extract($parametros);

  $codigo=trim($this->comillaSimplePorGuion($codigo));
  $token=$this->filtroNumerico($token);
  $serial=$this->filtroStrings($serial, 0);
  $imei=$this->filtroStrings($imei, 0);
  $otro=$this->filtroStrings($otro, 0);
  if ($serial=='si') {
    $tipo='serial';
  }
  if ($imei=='si') {
    $tipo='imei';
  }
  if ($otro=='si') {
    # code...
    $tipo='otro';
    $codigo="R-".$codigo;
  }

 
    //Comparo el codigo si no esta reptido
      $sqlImeis="SELECT  codigo  FROM serialesImeis WHERE codigo='".$codigo."'";
      $queryPreInventario=$conn->query($sqlImeis);
      if (mysqli_num_rows($queryPreInventario)==1) {
        $objResponse->Registrado = 1;//ESTE SERIAL YA ESTA REGISTRADO EN EL SISTEMA
      }
      else{ //Verifico si esta pre-registrado
        $sqlPreserializacion="SELECT  codigo  FROM  preSerializacion WHERE codigo='".$codigo."'";
        $queryPreserializacion=$conn->query($sqlPreserializacion);
        if (mysqli_num_rows($queryPreserializacion)==1) {
          $objResponse->Registrado = 2;//ESTE SERIAL YA ESTA REGISTRADO EN EL SISTEMA
          }else{
          
          $sku=trim($this->comillaDoblePorGuion($sku));
          $token=$this->filtroNumerico($token);
          $imei=$this->filtroStrings($imei, 1);
          $sqlInsert="INSERT INTO preSerializacion SET  codigo='".$codigo."', 
                                                        tipo='".$tipo."',
                                                        sku='".$sku."',
                                                        token=$token";
          $conn->query($sqlInsert);
          $objResponse->Registrado = 0;


        }
      }



    /* 
    [1]: ESTE SERIAL YA ESTA REGISTRADO EN EL SISTEMA
    [2]: ESTE SERIAL YA ESTA PREREGISTRADO
    [0]: PRODUCTO PRE-REGISTRADO
    */
    echo json_encode($objResponse);


}

/*=====  End of GUARDAR PREVIA CODIGO  ======*/





//Guardo productos y servicios 
public function guardarServicioProducto($parametros){
  $conn=$this->conectar();
  extract($parametros);
  //Filtro datos
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
  $sqlInsertarProductoServicio="INSERT INTO PRODUCTOSERVICIOS SET  sku='".$sku."', 
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
                                           
                                            
    ";
    if ($conn->query($sqlInsertarProductoServicio) === TRUE) {

       $objResponse->Registrado = 1;
    }
    else
    {  
      $this->write_log("Error al registrar un producto", 'error');
        $objResponse->Registrado = 0;
    }

  $conn->close();
  echo json_encode($objResponse);
}




//GUARDAR  CATEGORIAS Y SUBCATEGORIAS

public function guardarCategoriasSubCategorias($parametros){


  $conn=$this->conectar();
  extract($parametros);
  $padre=$this->filtroNumerico($padre);
  $tipo=$tipo;
  $nombreCategoria=$this->filtroStrings($nombreCategoria, 2);
  $aplicaTopeImpuesto=$this->filtroStrings($aplicaTopeImpuesto, 0);
  $valorTopeImpuesto=$this->filtroNumerico($this->normalizacionDeCaracteres($valorTopeImpuesto));
  
   $sql="INSERT INTO categorias SET  tipo= '".$tipo."',
                                  padre='".$padre."',
                                  nombreCategoria='".$nombreCategoria."',
                                  aplicaTopeImpuesto='".$aplicaTopeImpuesto."',
                                  valorTopeImpuesto='$valorTopeImpuesto'
   "; 
   if ($conn->query($sql) === TRUE) {
    $objResponse->Registrado = 1;
   }
   else
   {  
      $this->write_log("Error al registrar una categoria", 'error');
      echo 'error';
   }
  $conn->close();
  echo json_encode($objResponse);
}








/*===========================================================================================================
=            SELECCION DE INVENTAROS,  SOLO SE ACTIVA AL MOMENTO DE HACER UN INVENTARIOS COMPLETP            =
===========================================================================================================*/




public function comparacionInventarios($parametros){
  $conn=$this->conectar();
  extract($parametros);

  $codigo=trim($codigo);
  $restar=$fc;
  $sqlConsulta="SELECT idproductosServicios, sku, serializacion, serial, imei FROM  PRODUCTOSERVICIOS WHERE sku ='".$codigo."'";
  $query=$conn->query($sqlConsulta);
  if (mysqli_num_rows($query)>0) {//EL PRODUCTO EXISTE
    $rsPreconsulta=mysqli_fetch_array($query, MYSQLI_ASSOC);

    if ($rsPreconsulta['serializacion']=='no') {
      # code...
        $sqlPreinventario="SELECT idProducto, cantidades, idPreinventario FROM preInventario WHERE idProducto='".$rsPreconsulta['idproductosServicios']."' ";
        $queryPreInventario=$conn->query($sqlPreinventario);
        $rsPreinventario=mysqli_fetch_array($queryPreInventario, MYSQLI_ASSOC);
        if (mysqli_num_rows($queryPreInventario)==0) {
           $sqlCantidadesPreinventario="INSERT INTO preInventario SET idProducto='".$rsPreconsulta['idproductosServicios']."', cantidades=1";

        }else{

            if ($restar == 'false') {
              # code...
              $cantidades=(1+$rsPreinventario['cantidades']);

            }else{
              $cantidades=($rsPreinventario['cantidades']-1);
              }
              $sqlCantidadesPreinventario="UPDATE preInventario  SET cantidades=$cantidades WHERE idProducto='".$rsPreconsulta['idproductosServicios']."'";
        }
          $conn->query($sqlCantidadesPreinventario);//ACTUALIZO LAS CANTIDADES
          $objResponse->Registrado = 0;//Error de  producto con serial/imei
    }//SI NO TIENE SERIAL
  else {

      $objResponse->Registrado = 1;//EL PRODUCTO EXISTE PERO TIENE SERIAL/IMEI


  }
    

  }else{//BUSQUELO POR SERIALES

      $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, inventariado FROM serialesImeis WHERE codigo='".$codigo."'AND inventariado=0";
      $queryPreInventario=$conn->query($sqlImeis);
      if (mysqli_num_rows($queryPreInventario)>0) {//hay un imei con esa existencia
        # code...
        $rsPreinventario=mysqli_fetch_array($queryPreInventario, MYSQLI_ASSOC); //Saco los datos de ese serial/imei
        //Busco si esta ya en  el pre-INVENTARIOS
        $sqlPreinventario="SELECT idProducto, cantidades, idPreinventario FROM preInventario WHERE idProducto='".$rsPreinventario['idProductoServicio']."' ";
        $queryPre=$conn->query($sqlPreinventario);

        if (mysqli_num_rows($queryPre)==0) {//no hay registro
            $sqlCantidadesPreinventario="INSERT INTO preInventario SET idProducto='".$rsPreinventario['idProductoServicio']."', cantidades=1";
            $sqlActualizarSerialImei="UPDATE serialesImeis SET inventariado=1 WHERE idSerialImei='".$rsPreinventario['idSerialImei']."'";
        }else{//Ya existe un registro
            $rsPreIn=mysqli_fetch_array($queryPre);
            $cantidades=(1+$rsPreIn['cantidades']);
            $sqlCantidadesPreinventario="UPDATE preInventario  SET cantidades=$cantidades WHERE idProducto='".$rsPreinventario['idProductoServicio']."'";
          $sqlActualizarSerialImei="UPDATE serialesImeis SET inventariado=1 WHERE idSerialImei='".$rsPreinventario['idSerialImei']."'";

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
            $objResponse->Registrado = 3;
          }

        //Error de  producto con serial/imei NO EXISTE
      }//Fin de. la no existencia de los seriales relacionados

  }
  
  //echo $sqlImeis;
/* 
[0]= todo ok
[1]= EL PRODUCTO EXISTE PERO TIENE SERIAL/IMEI
[2]= EL PRODUCTO ESTA YA INVENTARIADO
[3]= EL PRODUCTO NO EXISTE NI ESTA INVENTARIADO

*/

//echo $sqlCantidadesPreinventario;
  
echo json_encode($objResponse);



/*
  $codigos=explode(',', $parametros);

  $sinRepetir=array_unique($codigos);//Tengo el numero de productos unicos que tengo en esa cadena
  //echo sizeof($sinRepetir); 
  $cantidadProductosUnico=sizeof($sinRepetir);
  

 


  $conn->close();
*/
}


/*=====  End of SELECCION DE INVENTAROOS,  SOLO SE ACTIVA AL MOMENTO DE HACER UN INVENTARIOS COMPLETP  ======*/




//Guardo los productos ingresados a partir deuna factura de un provedor
public function guardarFacturaProvedorLotes($parametros){
  $conn=$this->conectar();
  extract($parametros);
    //Verifico existencia de provedor
    if ($this->filtroNumerico($idProvedor)==0 || $idProvedor==NULL) {
      # code...
        $idProvedor=$this->basicoNuevoProvedor($provedor);
    }
    //Creo las facturas
    $nroFacturaProvedor=$this->filtroStrings($nroFacturaProvedor, 0);
    $estadoFactura=$this->filtroStrings($estadoFactura, 0);
    $fechaFacturaProvedor=$this->formatoFecha($fechaIngreso);
    $destinoId=$this->decrypt($destino, publickey);
    $fechaCompromisoPago=$this->formatoFecha($fechaCompromisoPago);
    $valorAbonoFactura=$this->filtroNumerico($valorAbonoFactura);
    $valorFacturaProvedor = $this->mathCalculoValorFacturaProvedor($this->filtroNumerico($totalFactura));  //Calculo con impuestos
    $valorFacturaProvedorNeto = $this->mathCalculoValorFacturaProvedor($this->filtroNumerico($subTotal)); //Calculo sin impuestos
    $deudaFacturaProvedor=($valorFacturaProvedor - $valorAbonoFactura);
    $destinoId=explode("|", $destinoId);
    
    

  if ($deudaFacturaProvedor<=0) {# resto lo que se debe a la factura...
      $deudaFacturaProvedor=0;
    }
    //Pendiente el deudaFacturaProvedor
     $sqlFactura= "INSERT INTO facturasProvedores SET idProvedor= ".$this->filtroNumerico($idProvedor).", 
                                                    nroFacturaProvedor='".$nroFacturaProvedor."',
                                                    fechaFacturaProvedor= '".$fechaFacturaProvedor."',
                                                    fechaPagar= '".$fechaCompromisoPago."',
                                                    deudaFacturaProvedor=$deudaFacturaProvedor,
                                                    valorFacturaProvedor = $valorFacturaProvedor,
                                                    valorFacturaNetoProvedor = $valorFacturaProvedorNeto";

    $conn->query($sqlFactura);
    $idFactura=mysqli_insert_id($conn);

    if($deudaFacturaProvedor>0){
      $sqlabono="INSERT INTO  abonosFacturaProvedor SET idFacturaProvedor=$idFactura, 
                                                  valorAbonoFactura=$valorAbonoFactura,
                                                  fechaAbonoFactura='$fechaFacturaProvedor' ";
      $conn->query($sqlabono);
    }


    $token=$this->filtroNumerico($token);
    $sqlPreCompra="SELECT * FROM preCompra WHERE token = $token";
    $query=$conn->query($sqlPreCompra);

    while ($rsPrecompra=mysqli_fetch_array($query)) {
      # code...
      //INGRESO NUEVOS



      if ($rsPrecompra['idproductosServicios']==0) { //Es un producto nuevo

        $producto=preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($rsPrecompra['nombreProductosServicios'], ENT_QUOTES));
        $categoria=$this->filtroNumerico($rsPrecompra['categoria']);
        $subCategoria=$this->filtroNumerico($rsPrecompra['subCategoria']);
        $valorVentaPublico=$this->filtroNumerico($this->normalizacionDeCaracteres($rsPrecompra['valorVentaPublico']));
        $valorVentaMayorista=$this->filtroNumerico($this->normalizacionDeCaracteres($rsPrecompra['valorVentaPublico']));

          //Verifico con el SKU        //Verifico si el producto ya se ingreso en esta compra

          if ($this->filtroNumerico(($this->getDatosProductoConSku($rsPrecompra['sku'])['idproductosServicios']))==0) {
            # code...

              if ($rsPrecompra['tipo']=='serial') { //Es con serial
                # code...
                $sqlInsertProducto="INSERT INTO PRODUCTOSERVICIOS  SET sku='".$rsPrecompra['sku']."',
                                                        nombreProductosServicios='".$this->comillaDoblePorGuion($this->filtroStrings($rsPrecompra['nombreProductosServicios'], 1))."',
                                                        tipoProductoServicio='producto',
                                                        valorVentaUnidad=$valorVentaPublico,
                                                        valorVentaPorMayor=$valorVentaMayorista,
                                                        categoria=$categoria,
                                                        subCategoria=$subCategoria,
                                                        serializacion='si',
                                                        serial='si'";
              }else{//Es sin serial
                $sqlInsertProducto="INSERT INTO PRODUCTOSERVICIOS  SET sku='".$rsPrecompra['sku']."',
                                                        nombreProductosServicios='".$this->comillaDoblePorGuion($this->filtroStrings($rsPrecompra['nombreProductosServicios'], 1))."',
                                                        tipoProductoServicio='producto',
                                                        valorVentaUnidad=$valorVentaPublico,
                                                        valorVentaPorMayor=$valorVentaMayorista,
                                                        categoria=$categoria,
                                                        subCategoria=$subCategoria,
                                                        serializacion='no'";
              }
                
               $conn->query($sqlInsertProducto);
               $idProducto=mysqli_insert_id($conn);




          }else{ //El producto ya esta ingresado
            $idProducto=$this->getDatosProductoConSku($rsPrecompra['sku'])['idproductosServicios'];
          }
        





          //Ingreso a inventarios
         $sqlInsert="INSERT INTO  INVENTARIOS SET idProvedor= ".$this->filtroNumerico($idProvedor).", 
                                                IdFacturaProvedor=$idFactura,
                                                fechaIngreso= '".$fechaFacturaProvedor."',
                                                idProductoServicio=$idProducto,
                                                valorUnidad ='".$rsPrecompra['costoUnidad']."',
                                                impuesto='".$rsPrecompra['impuesto']."',
                                                tipoNegocio = 'compra',
                                                unidadesCompradas='".$rsPrecompra['unidades']."',
                                                unidadesExistentes='".$rsPrecompra['unidades']."'
                                                ";
        $conn->query($sqlInsert);



      }else{//Inicio del ciclo de linea
        $sqlInsert="INSERT INTO  INVENTARIOS SET idProvedor= ".$this->filtroNumerico($idProvedor).", 
                                                IdFacturaProvedor=$idFactura,
                                                fechaIngreso= '".$fechaFacturaProvedor."',
                                                idProductoServicio='".$rsPrecompra['idproductosServicios']."',
                                                valorUnidad ='".$rsPrecompra['costoUnidad']."',
                                                impuesto='".$rsPrecompra['impuesto']."',
                                                tipoNegocio = 'compra',
                                                unidadesCompradas='".$rsPrecompra['unidades']."',
                                                unidadesExistentes='".$rsPrecompra['unidades']."'
                                                ";
      $conn->query($sqlInsert);
      $idProducto=$rsPrecompra['idproductosServicios'];
      }//Fin dle ciclo de linea
      //Inserto en los traslados
     $sqlRepartir="INSERT INTO trasladosExistencia SET idProductoServicio=$idProducto,
                                                      tipoTraslado='bodega-puntoVenta',
                                                      origenId=0,
                                                      destinoId='".$destinoId[1]."',
                                                      fechaTraslado='".date('Y-m-d H:i:s')."',
                                                      estadoTraslado='Trasladado',
                                                      cantidadTrasladada='".$rsPrecompra['unidades']."',
                                                      cantidadExistenteTraslado='".$rsPrecompra['unidades']."',
                                                      tokenTraslado=$token
                                                      ";

      $conn->query($sqlRepartir);

            //INGRESO LOS SERIALES EN CSO QUE EXISTAN
          if($rsPrecompra['tipo']=='serial'){

                $sqlSerial="SELECT * FROM preSerializacion WHERE sku='".trim($rsPrecompra['sku'])."' AND token=$token";

                $querySerial=$conn->query($sqlSerial);
                while ($rsSeriales=mysqli_fetch_array($querySerial, MYSQLI_ASSOC)) {
                  # INSERTO  SERIALES/IMEIS
                  if ($idProducto>0) {
                    # code...
                    $sqlSeriales="INSERT INTO serialesImeis SET codigo='".$this->comillaSimplePorGuion($rsSeriales['codigo'])."',
                                                                    idFacturaProvedor=$idFactura,
                                                                    idProductoServicio=$idProducto,
                                                                    ubicacion='".$destinoId[1]."',
                                                                    fechaRegistro='".date('Y-m-d H:i:s')."',
                                                                    estado='en almacen'";

                      mysql_query($sqlSeriales);

                  }
                   

                }
          }//Fin del ingreso de seriales/imeis

        //Actualizo precios

            $sqlActualizar="UPDATE PRODUCTOSERVICIOS SET 
                      valorVentaUnidad='".$rsPrecompra['valorVentaPublico']."', valorVentaPorMayor='".$rsPrecompra['valorVentaMayorista']."',
                        categoria=".$rsPrecompra['categoria'].", subCategoria = ".$rsPrecompra['subCategoria']."
                      WHERE idproductosServicios=$idProducto";
           mysql_query($sqlActualizar);

    }//Fin del ciclo

    //Borrar Temprares

    //preSerializacion
    $sqlSerializacion="DELETE FROM preSerializacion WHERE token=$token";
    $sqlCompra="DELETE FROM preCompra WHERE token=$token";
    mysql_query($sqlSerializacion);
    mysql_query($sqlCompra);
    $objResponse=strtotime(date('Y-m-d H:i:s'));
  $conn->close();
  echo json_encode($objResponse);
}







//GUARDAR FACTURACIÓN 

public function guardarFacturas($parametros){
  $conn=$this->conectar();
  extract($parametros);
  $p=$idCliente;
  //Verificación de Existencia de Clientes
  if ($idCliente==='NaN' OR !isset($idCliente) OR $idCliente==0) {
    $idCliente=$this->crearCliente($parametros);
  }else{
    $idCliente=$this->decrypt($idCliente, publickey);
  }

    $fechaFactura=$this->formatoFecha($fechaFactura);
    $nroFactura=$this->proximoNumeroFactura();//Genero el número de factura
    $horaFactura=date('H:i:s');
    $codigoVendedor=$this->filtroNumerico($this->decrypt($codigoVendedor, publickey));
    $valorFactura = $this->mathCalculoValorFacturaProvedor($valorTotal);  //Calculo con impuestos
    $valorNeto=$this->mathCalculoValorFacturaProvedor($valorNeto);
    //$valorNeto=explode(',',$valorNeto);
    $sku=explode(',', $skus);
    $idProductoServicios=explode(',',$idProductoServicios);
    $taxes=explode(',',$taxes);
    $unidades=explode(',',$unidades);
    $valorUnidad=explode(',', $valorUnidad);
    //$valorVentaPublico=explode(',',$valorVentaPublico);
    $bukandserial=json_decode($bucketSerials);
    $tipoPago=$conn->real_escape_string($tipoPago);
    //CREO LA BASE DE LA FACTURA
    $sqlFactura="INSERT INTO facturacion SET 
                                              nroFactura=$nroFactura,
                                              idPuntoVenta=1,
                                              idCliente=$idCliente,
                                              fechaFactura='".$fechaFactura."',
                                              horaFactura='".$horaFactura."',
                                              valorNetoFactura=$valorNeto,
                                              valorTotalFactura=$valorFactura, 
                                              codigoVendedor=$codigoVendedor,
                                              tipoPago='".$tipoPago."'";

    $conn->query($sqlFactura);
    $idFactura=mysqli_insert_id($conn);//ID FACTURA
    $valorEfectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($valorEfectivo));
    $valorDebito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorDebito));
    $valorDebito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorDebito));
    $valorCredito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorCredito));
    $valorCheque=$this->filtroNumerico($this->normalizacionDeCaracteres($valorCheque));
    $valorServicredito=$this->filtroNumerico($this->normalizacionDeCaracteres($valorServicredito));
    


    //Perfíl de Pago
   $residuo= $this->perfilVerificacionPago($valorEfectivo, $valorDebito, $valorCredito, $valorCheque, $valorServicredito, $idFactura);


    //Verificación de ingreso de factura en cartera
    if (($valorFactura - $residuo)<=0) {
      # code...
        $estadoFactura='pagada';
    }else{
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
          # code...
          $valorNeto=($valorUnidad[$i]*$unidades[$i]);
          $valorTotal=($valorNeto*$taxes[$i])/100;
          $sqlItemsFactura="INSERT INTO itemsFactura SET
                                          idFactura=$idFactura,
                                          idProductoServicio='".$this->decrypt($idProductoServicios[$i], publickey)."',
                                          unidades='".$unidades[$i]."',
                                          valorNeto=$valorNeto,
                                          valorTotal=$valorTotal,
                                          porcentajeImpuesto='".$taxes[$i]."'

          ";
          //Actualización del INVENTARIOS
          $conn->query($sqlItemsFactura);
          $this->sacarDeInventario($this->decrypt($idProductoServicios[$i], publickey), $unidades[$i]);
          $i++;
        }
    //FIN DE INGRESOFACTURA

      
  $objResponse=$taxes[0];
  echo json_encode($objResponse);
}
//FIN DE GUARDAR FACTURACION








/*=====  End of PRE-TRASLADO  ======*/




public function guardarPreTraslado($parametros){
    $conn=$this->conectar();
    extract($parametros);
    $idOrigen=$this->filtroNumerico($idOrigen);
    $idDestino=$this->filtroNumerico($idDestino);
    $codigo=trim($this->comillaSimplePorGuion($codigo));
    $sku=$this->filtroStrings($sku, 1);
    $cantidades=$this->filtroNumerico($unidades);
    $tipo=$this->filtroStrings($tipo, 0);
    $token=$this->filtroNumerico($token);
    //Filtro el id del producto
    if ( gettype($idProductoServicio) == 'string') {
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
                                            idDestino=$idDestino,
                                            token=$token";

  $conn->query($sql);
  $objResponse->Registrado = $token;//OK
  echo json_encode($objResponse);
}






//Guardar PreCompra
public function guardadPreCompra($parametros){
    $conn=$this->conectar();
    extract($parametros);
    $sku=trim($this->filtroStrings($this->filtrocaracteres($sku), 1));
    $nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 1);
    $valorUnidad=$this->filtroNumerico($this->normalizacionDeCaracteres($valorUnidad));
    $valorVentaPublico=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaPublico));
    $valorVentaMayorista=$this->filtroNumerico($this->normalizacionDeCaracteres($valorVentaMayorista));

    $tax=$this->filtroNumerico($impuesto);
    $cantidades=$this->filtroNumerico($this->normalizacionDeCaracteres($cantidades));
    $tipo=$this->filtroStrings($tipo,0);
    $token=$this->filtroNumerico($token);
    $tax=($tax/100)+1;
    $CostoTotal=$valorUnidad*$cantidades;
    $costoNeto=($CostoTotal/$tax);
    $categoria=$this->filtroNumerico($categoria);
    $subCategoria=$this->filtroNumerico($subCategoria);
    $this->getDatosProductoConSku($sku)['idproductosServicios'];
    $idproductosServicios=$this->filtroNumerico($this->getDatosProductoConSku($sku)['idproductosServicios']);
    //INSERTAR PRECOMPRA
      

      //Verifiqueme si ese sku ya esta ingresado para que lo sume

   //echo "hello". $this->checkPreCompraSku($sku, $token);

    $idPre=$this->checkPreCompraSku($sku, $token);
    if ($idPre>0) {//
      # code...
      if( $tipo == 'serial'){
        
          $sqlActualizacion="UPDATE preCompra 
            SET unidades=$cantidades  
            WHERE idCompra= '".$idPre."' ";
            $conn->query($sqlActualizacion);
      }else{
          $sqlCheck="SELECT idCompra, sku, unidades,  token  FROM preCompra WHERE sku='".$sku."' AND token=$token";
          $query=$conn->query($sqlCheck);
          $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
          $cant=$cantidades+$rs['unidades'];
           $sqlActualizacion="UPDATE preCompra SET unidades='".$cant."'  WHERE idCompra= '".$idPre."' ";
          $conn->query($sqlActualizacion);

      }



    }else{//no existe aun
      $sqlPreCompra="INSERT INTO  preCompra SET sku='".$sku."',
                                idproductosServicios='".$idproductosServicios."',
                                tipo = '".$tipo."',
                                nombreProductosServicios='".$nombreProductosServicios."',
                                unidades='".$cantidades."',
                                costoUnidad='".$valorUnidad."',
                                costoNeto='".$costoNeto."',
                                impuesto='".$tax."',
                                CostoTotal='".$CostoTotal."',
                                categoria = $categoria,
                                subCategoria= $subCategoria,
                                valorVentaPublico=$valorVentaPublico,
                                valorVentaMayorista=$valorVentaMayorista,
                                token='".$token."'";
        $conn->query($sqlPreCompra);
    }
    
 
    $objResponse->resultado=0;
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



//CHECKEO SI HAY UNA PRE COMPRA CON ESE SKU Y EL TOKEN
private function checkPreCompraSku($sku, $token){
      $conn=$this->conectar();
       $sqlCheck="SELECT idCompra, sku, token  FROM preCompra WHERE sku='".$sku."' AND token=$token";
      $query=$conn->query($sqlCheck);

      if ($rs=mysqli_num_rows($query)>0) {
        # code...
        $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $rs['idCompra'].'<br>';//Si existe
      }else{
        return 0;//no existe
      }

}



//GUARDAR ABONO DE LA FACTURACIÓN
public function ingresoAbonoFactura($parametros){

    $conn=$this->conectar();
    extract($parametros);
    //filtro los parámetros que pase a través de json
      $deuda=$this->filtroNumerico($deuda);
      $abono=$this->filtroNumerico($this->normalizacionDeCaracteres($abono));
      $idFactura=$this->filtroNumerico($this->decrypt($_SESSION['ideFactura'], publickey));
      $tipoPago=$this->filtroStrings($metodoPago, 0);
      $idPuntoVenta=$this->getDatosFactura($idFactura)['idPuntoVenta'];
      
      if ($deuda>$abono) {    
        $nuevaDeuda=$this->filtroNumerico($deuda-$abono);
        
        $sql="UPDATE facturacion SET deudaFactura=$nuevaDeuda WHERE idFactura=$idFactura";
        $conn->query($sql);

        
      }//fin del if. deuda>abono
      elseif ($deuda<=$abono) {
        # code...
        $nuevaDeuda=0;
        $sql="UPDATE facturacion SET deudaFactura=0, estadoFactura='pagada' WHERE idFactura=$idFactura";
        $conn->query($sql);
      }//fin del elseif deuda<=abono
      $tokenAbono=strtotime(now);
      
      //Registro el abono de la factura
      $sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=$idFactura, valorAbono=$abono, fechaAbono='".date('Y-m-d')."', tipoPago='".$tipoPago."', tokenAbono=$tokenAbono ";

      $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura=$idFactura,
                                                  idPuntoVenta=$idPuntoVenta,
                                                  tipoPago='".$tipoPago."',
                                                  valor=$abono, 
                                                  fechaRegistrado='".date('Y-m-d H:i:s')."',
                                                  estado='activa'
                                                   ";

      $conn->query($sqlAbonoFactura);
      $conn->query($sqlPerfilPago);
      $objResponse->Registrado = $this->encrypt($tokenAbono.'-'.$idFactura, publickey);
      //DEJO EL LOG
      $this->write_log('LA FACTURA CON ID '.$this->decrypt($_SESSION['ideFactura'], publickey).' SE LE HIZO UN ABONO DE '.number_format($abono).' Y LO REALIZÓ EL USUARIO CON ID:  '.$this->decrypt($_SESSION['datos'], key));

      echo json_encode($objResponse);


}



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




//NUEVO PROVEDOR CLIENTE 
public  function crearCliente($parametro){
   $conn=$this->conectar();
   extract($parametro);
    $identificacionCliente=$this->filtroStrings(htmlentities($identificacionCliente), 1);
   $nombreCliente=$this->filtroStrings($nombreCliente, 1);
   $direccionCliente=$this->filtroStrings($direccionCliente, 1);
   $telefonosCliente=$this->filtroStrings($telefonoCliente, 1);
   $emailCliente=$this->filtrarEmail($this->filtroStrings($emailCliente, 1));
   $ciudadCliente=$this->filtroStrings($ciudadCliente, 1);

   $sql="INSERT INTO clientes SET nombreCliente = '".$nombreCliente."',
                                    identificacionCliente='".$identificacionCliente."',
                                    direccionCliente='".$direccionCliente."',
                                    telefonosCliente='".$telefonosCliente."',
                                    emailCliente='".$emailCliente."',
                                    ciudadCliente='".$ciudadCliente."'";

   $query=$conn->query($sql);
   return mysqli_insert_id($conn);
   $conn->close();
}





//perfilVerificacionPago

private function perfilVerificacionPago($valorEfectivo, $valorDebito, $valorCredito, $valorCheque, $valorServicredito, $idFactura){
   $conn=$this->conectar();
    

   //Pagos en Efectivo
   if ($valorEfectivo>0) { //Valores en caso que sea pago en efectivo
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura=$idFactura, tipoPago='efectivo', valor=$valorEfectivo, fechaRegistrado='".date('Y-m-d H:i:s')."' ";
    $conn->query($sqlPerfilPago);
   }

   if ($valorDebito>0) { //Valores en caso que sea pago por tarjeta débito
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura, tipoPago='tarjeta debito', valor=$valorDebito, fechaRegistrado='".date('Y-m-d H:i:s')."' ";
    $conn->query($sqlPerfilPago);
   }
   if ($valorCredito>0) { //Valores en caso que sea  tarjeta de crédito
     # code...


    $comisionBancaria=(($valorCredito*valorComisionBancaria)/100);
    $valorFinal=($valorCredito-$comisionBancaria);

    
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura, tipoPago='tarjeta credito', valor=$valorFinal, comision='".$comisionBancaria."', fechaRegistrado='".date('Y-m-d H:i:s')."' ";
    $conn->query($sqlPerfilPago);
   }
   if ($valorCheque>0) {//Valores en caso que sea cheque
     # code...
    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura, tipoPago='cheque', valor=$valorCheque, fechaRegistrado='".date('Y-m-d H:i:s')."' ";
    $conn->query($sqlPerfilPago);
   }
   if ($valorServicredito>0) { //Valores en caso que sea entidad crediticia
    $comisionBancaria=(($valorServicredito*valorComisionBancaria)/100);
    $valor=($valorServicredito-$comisionBancaria);
     

    $sqlPerfilPago="INSERT INTO perfilPagos SET idFactura= $idFactura, tipoPago='entidad crediticia', valor=$valor, comision='".$comisionBancaria."', fechaRegistrado='".date('Y-m-d H:i:s')."' ";
    $conn->query($sqlPerfilPago);
   }


   $resultado=($valorEfectivo+$valorDebito+$valorCredito+$valorCheque+$valorServicredito);

   return $resultado;

   $conn->close();
}







/*================================================================
=            INGRESO DE INVENTARIOS POR SINCRONIZACIÓN            =
================================================================*/
public function nivelacionSerialesSinSerial(){
   $conn=$this->conectar();

   $sql="SELECT idproductosServicios, serializacion FROM PRODUCTOSERVICIOS where serializacion='si'";
   $query=$conn->query($sql);
   $n=0;
   while ($rsProductos=mysqli_fetch_array($query, MYSQL_ASSOC)) {
     # code...
      //SELECCIONO EN LA LISTA DE SERIALES
      $sqlSeriales="SELECT idProductoServicio FROM serialesImeis where idProductoServicio='".$rsProductos['idproductosServicios']."'";
      $querySeriales=$conn->query($sqlSeriales);
      if (mysqli_num_rows($querySeriales)==0) {

          $sqlActualizacion="UPDATE PRODUCTOSERVICIOS SET serializacion='no', serial='no', imei='no', otroTipoSerial='no' WHERE idproductosServicios='".$rsProductos['idproductosServicios']."' ";
          $conn->query($sqlActualizacion);
        $n++;
      }
   }

   echo 'cambiados un total de '.$n.' Productos';
}






public function formatearCantidadAccesorios(){
  $conn=$this->conectar();
  $sql="SELECT idproductosServicios, serializacion FROM PRODUCTOSERVICIOS where serializacion='si'";
  $query=$conn->query($sql);
  $n=0;
  while ($rsProductos=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      //ACTUALIZO  todo lo del INVENTARIOS a 0
       $sqlActualizacionInventario="UPDATE  INVENTARIOS SET unidadesExistentes=0 WHERE idProductoServicio='".$rsProductos['idproductosServicios']."'";
      $conn->query($sqlActualizacionInventario); 
      //actualizo las cantidades trasladadas
      $sqlActualizacionTraslados="UPDATE trasladosExistencia SET cantidadExistenteTraslado = 0 WHERE idProductoServicio='".$rsProductos['idproductosServicios']."'";
      $conn->query($sqlActualizacionTraslados);

  }

}






/*=====  End of INGRESO DE INVENTARIOS POR SINCRONIZACIÓN  ======*/






private function sacarDeInventario($idItem, $cantidad)
{
  $conn=$this->conectar();
  $idItem=$this->filtroNumerico($idItem);
  $cantidad=$this->filtroNumerico($cantidad);
  $tipo=1;
    //Saco la existencia de los productos en bodega
    $cantidadCumplida=$cantidad;

      $bucket=array();//array que me guardara las cantidades que existem por cada linea
      $n=0;
      $break=0;
      $sql="SELECT idinventario, idProductoServicio, unidadesExistentes FROM  INVENTARIOS WHERE idProductoServicio='".$idItem."'  and unidadesExistentes>0";
      $query=$conn->query($sql);
       
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
  
}


//Numero de Factura

//Te digo cuál es el próximo número de factura que sigue
public function proximoNumeroFactura(){
  $conn=$this->conectar();
  $sql="SELECT nroFactura FROM facturacion ORDER BY(nroFactura) DESC";
  $query=$conn->query($sql);
  $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
  if ($rs['nroFactura']==0) {
    # code...
    return 1020;
  }
  elseif ($rs['nroFactura']>=1) {
    # code...
    return $rs['nroFactura']+1;
  }
}







//EXISTENCIA EN INVENTARIOS


private  function cantidadEnExistenciaEnBodega($productoId)
{
  $conn=$this->conectar();
   $sql="SELECT SUM(unidadesExistentes) AS cantidadesExistentes 
                                                      FROM INVENTARIOS WHERE
                                                      idProductoServicio='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN

  $resultado = mysqli_fetch_assoc($conn->query($sql));
  return $resultado["cantidadesExistentes"];

}





public function mathCalculoValorFacturaProvedor($parametro){

  $numeros=explode(',', $parametro);

  $resultado=0;
  for ($b=0; $b < sizeof($numeros) ; $b++) { 
    # code...
   $resultado=$resultado + ($this->filtroNumerico($numeros[$b]));

  }
  return $resultado;

}


/**************************[FILTROS]******************************+*/




/* Selecciono el tipo de mes */
private function analisisDelMes($mes)
{
  //[1]31  [2]28-29   [3]30
  switch ($mes) {
    case 1:
      # enero...
      return 1;
      break;

    case 2:
      # febrero...
      return 2;
      break;

    case 3:
      # marzo...
      return 1;
      break;


    case 4:
      # abril...
      return 3;
      break;

    case 5:
      # mayo...
      return 1;
      break;

    case 6:
      # junio...
      return 3;
      break;

    case 7:
      # julio...
      return 1;
      break;

    case 8:
      # agosto...
      return 1;
      break;

    case 9:
      # septiembre...
      return 3;
      break;

    case 10:
      # octubre...
      return 1;
      break;

    case 11:
      # noviembre...
      return 3;
      break;

    case 12:
      # diciembre...
      return 1;
      break;


    default:
      # code...
      break;
  }
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
      $encontrar    = array( ".", ",", " ", "=", "_"," ", "#","`:","+", "-", "(", ")", '"', "'");
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


public function comillaSimplePorGuion($parametro){
      $encontrar    = array( "'", "'", "&#39;");
      $remplazar = array( "-", "-", "-");
      return str_ireplace($encontrar, $remplazar,$parametro);
}



public function comillaDoblePorGuion($parametro){
      $encontrar    = array( '"');
      $remplazar = array( "-");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}



//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
  $fecha=explode("/", $parametro);
  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
}
  


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