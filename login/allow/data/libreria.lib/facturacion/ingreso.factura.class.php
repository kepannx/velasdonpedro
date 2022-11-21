<?php
class ingresoFacturas extends conectar {


/***************consultas clientes */

public function consultaDatosCliente($parametro, $vector)
{
  
  conectar::conexiones();

  $idCliente=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM clientes WHERE idcliente='".$idCliente."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'nombreCliente':
      # code...
      return $rs["nombreCliente"];
      break;


    case 'identificacionCliente':
      # code...
      return $rs["identificacionCliente"];
      break;


    case 'clienteNombres':
      # code...
      return $rs["clienteNombres"];
      break;


    case 'direccionCliente':
      # code...
      return $rs["direccionCliente"];
      break;

    case 'telefonosCliente':
      # code...
      return $rs["telefonosCliente"];
      break;


    case "emailCliente":
      return $rs["emailCliente"];
      break;


    case 'ciudadCliente':
      # ...
      return $rs["ciudadCliente"];
      break;

    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}




/***************consultas de productos */
public function consultaDatosProducto($parametro, $vector)
{
  conectar::conexiones();
  $idproductosServicios=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM PRODUCTOSERVICIOS WHERE idproductosServicios='".$idproductosServicios."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'nombreProductosServicios':
      # code...
      return $rs["nombreProductosServicios"];
      break;


    case 'tipoProductoServicio':
      # code...
      return $rs["tipoProductoServicio"];
      break;

    case 'valorVentaUnidad':
      # code...
      return $rs["valorVentaUnidad"];
      break;

    case 'valorVentaPorMayor':
      # code...
      return $rs["valorVentaPorMayor"];
      break;


    case 'impuesto':
      return $rs["impuesto"];
      break;

    case 'cantidadMinima':
      # code...
      return $rs["cantidadMinima"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}





/**********************CONSULTA DE LAS RECETAS ****************************/

public function consultaDatosRecetas($parametro, $vector)
{
  conectar::conexiones();
  $recetaId=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM recetaConvenio WHERE recetaConvenioId='".$recetaId."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'recetasConvenioNombre':
      # code...
      return $rs["recetasConvenioNombre"];
      break;


    case 'recetasConvenioValor':
      # code...
      return $rs["recetasConvenioValor"];
      break;

    case 'convenioId':
      # code...
      return $rs["convenioId"];
      break;

   
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}


/****************Datos de una  factura ****************************/


public function datosFactura($parametro, $vector)
{
  conectar::conexiones();
  $idFactura=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM facturacion WHERE idFactura='".$idFactura."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

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
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}






public  function ingresarNuevaFactura($parametros)
{

  conectar::conexiones();
  extract($parametros);

  //Ingreso  la  factura

    //Verifico existencia dle cliente
    $nuevoCliente=$this->filtroNumerico($nuevoCliente);
    if ($nuevoCliente==0) {
      # ingreso el cliente...
      $idCliente=$nuevoCliente=$this->ingresarNuevoCliente($nombresApellidos, $identificacionCliente,$direccionCliente, $telefonosCliente, $emailCliente, $ciudadCliente);
    }
    else
    {
      $idCliente=$nuevoCliente;
    }



    //Verifico con qué tipo de pago se realizó y pongo el incremento en caso de existir

     $tipoPago=$this->filtroStrings($tipoPago[0], 0);
     $totalFinal=$this->filtroNumerico($this->normalizacionDeCaracteres($totalFinal));
     $incremento=$this->filtroNumericoDecimal($incremento);
     $valorComisionBancaria = NULL;

     if ($tipoPago=='efectivo') {
       # code...
        $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($efectivo));     
 
     }
     elseif ($tipoPago=='tarjeta debito' || $tipoPago=='tarjeta credito') {//Si paga con tarjeta
       # code...
        if ($tipoPago=='tarjeta debito'){

            $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($totalFinal));
        }
        elseif ($tipoPago=='tarjeta credito') {
          # code...
          $incremento=3.5;


          $totalNeto=$this->filtroNumerico($this->normalizacionDeCaracteres($totalFinal));
          $valorFinal=((($totalNeto*$incremento)/100)-$totalNeto)*(-1);
          $valorComisionBancaria=$totalNeto-$valorFinal;
          $efectivo=$valorFinal;
          $totalFinal=$valorFinal;
        }
    }

     elseif ($tipoPago=='cheque') {//Si paga con cheque
       # code...
        $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($totalFinal));
        $nroCheque=$this->normalizacionDeCaracteres($nroCheque);

     }
     else//Por defecto es efectivo
     {
        $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($efectivo)); 
     }



    //Verifico si la factura es para crédito o  se va a pagar
     $valorFinal=$efectivo-$totalFinal;
     if ($valorFinal>=0) {
       # code...
        $estadoFactura='pagada';
        $deudaFactura=0;
        $separada='no';
        $devolver=$valorFinal;
     }
     else
     {
        $estadoFactura='en credito';
        $separada='si';
        $deudaFactura=abs($valorFinal);

     }




    //Recupero en número de la factura
   
    if ($tipoFactura=='Factura') {
      # code...
      $nroFactura=$this->proximoNumeroFactura();
      $tp= "nroFactura='".$nroFactura."'";
    }
    elseif ($tipoFactura=='Cuenta de Cobro') {
      # code...
      $nroCotizacion=$this->proximoNumeroCuentaCobro();
      $tp= "nroCotizacion='".$nroCotizacion."'";
    }
    $fechaFacturaProvedor=$this->formatoFecha($fechaFacturaProvedor);


    //Inserto la factura base.
    $sql="INSERT INTO  facturacion SET  $tp,
                                      fechaFactura='".$fechaFacturaProvedor." ".date('H:i')."',
                                      valorFactura='".$totalFinal."',
                                      deudaFactura='".$deudaFactura."',
                                      estadoFactura='".$estadoFactura."',
                                      valorIncremento='".$valorComisionBancaria."',
                                      nroCheque='".$nroCheque."',
                                      tipoPago='".$tipoPago."', 
                                      incremento='".$incremento."',
                                      codigoVendedor='".$this->filtroNumerico($codigoVendedor)."',
                                      separada='".$separada."',
                                      idCliente='".$this->filtroNumerico($idCliente)."'
                                      ";
    mysql_query($sql);
    $facturaId=mysql_insert_id();

    //Verifico si es un crédito y si existe un valor que abonaron a la factura
    if ($estadoFactura=='en credito') {
      # verifico si existe abonos...
      if ($efectivo>0) {
        # Existe abono...
        $sql="INSERT INTO abonoFacturas SET idFactura='".$facturaId."', valorAbono='".$efectivo."', fechaAbono='".$fechaFacturaProvedor."', tipoPago='".$tipoPago."' ";
        mysql_query($sql);//Realizo el abono
      }

    }
  //Ingreso los items de la factura


    //QUEDE LISTO PARA EL INGRESO DE LOS SUBPRODUCTOS

   $t=sizeof($itemNo);


   $n=0;


   
   while ($t>$n)
   {
     # code...

      $tax=$impuesto[$n];
      $valorVentaUnidadNeta=$this->filtroNumerico($price[$n]);


      //$valorVentaImpuesto=($valorVentaUnidadNeta*$tax)/100;
     

     
      if (strlen($imei[$n])>0) {
        # code...
        $insertarImei=  "imei = '".$this->filtroStrings($imei[$n], 1)."', ";

      }
      else
      {
         $insertarImei=  "imei = NULL, ";
      }

      $sql="INSERT INTO itemsFactura SET  
                                  idProductoServicio='".$this->filtroNumerico($itemNo[$n])."',
                                  valorVentaUnidadNeta='".$valorVentaUnidadNeta."',
                                  porcentajeImpuesto='".$this->filtroNumericoDecimal($tax)."',
                                  unidades='".$this->filtroNumerico($quantity[$n])."', 
                                  ".$insertarImei."

                                  idFactura='".$facturaId."'";

     if (mysql_query($sql)) {
        /*
        if($incremento>0)
        {

          $incrementoBancario=($totalNeto*$incremento)/100;
          $sql="INSERT INTO  itemsFactura SET  
                                  idProductoServicio='Incremento del ".$this->filtroNumericoDecimal($incremento)."% Serv Ban',
                                  valorVentaUnidadNeta='".$incrementoBancario."',
                                  porcentajeImpuesto='-',
                                  unidades='-',
                                  idFactura='".$facturaId."'";
          mysql_query($sql);
        }*/
       # Actualizo el INVENTARIOS...
        $this->sacarDeInventario($itemNo[$n], $quantity[$n]);
        $n++;

     }
     else
     {

        $this->errorLog("02-02-00-00");
        return 0;
        exit();
        

     }
   
      
   } //Fin del while
   //Ya ingresé la factura.

   //Genero Factura
   $this->tiposFacturas($facturaId, 'tirilla', $tipoFactura, $incremento);
   //fin de la generación de la factura

	 
}









//Saco del INVENTARIOS

private function sacarDeInventario($idItem, $cantidad, $tipo)
{
  $idItem=$this->filtroNumerico($idItem);
  $cantidad=$this->filtroNumerico($cantidad);
  $tipo=1;
    //Saco la existencia de los productos en bodega
    $cantidadCumplida=$cantidad;

      $bucket=array();//array que me guardara las cantidades que existem por cada linea
      $n=0;
      $break=0;
      $sql="SELECT idinventario, idProductoServicio, unidadesExistentes FROM  INVENTARIOS WHERE idProductoServicio='".$idItem."'  and unidadesExistentes>0";
       $query=mysql_query($sql);
       
       while ($rs=mysql_fetch_array($query) AND  ($break==0))
       {

         if ($cantidadCumplida>$rs["unidadesExistentes"])
          {//En caso que la cantidad que pida exceda las existencias de la primera linea de consulta
            $cantidadCumplida=($cantidadCumplida)-($rs["unidadesExistentes"]);
            $sql="UPDATE INVENTARIOS SET unidadesExistentes= 0 WHERE idinventario='".$rs["idinventario"]."'";
            mysql_query($sql);
          }
          elseif ($cantidadCumplida<=$rs["unidadesExistentes"]) {
            $break=1;
            $cantidadNueva=($rs["unidadesExistentes"])-($cantidadCumplida);
            $sql="UPDATE INVENTARIOS SET unidadesExistentes= ".$cantidadNueva." WHERE idinventario='".$rs["idinventario"]."'";
            mysql_query($sql);
          }
       }//Fin del ciclo
  
}







//Ingresar Clientes

public function ingresarNuevoCliente($nombresApellidos, $identificacionCliente,$direccionCliente, $telefonosCliente, $emailCliente, $ciudadCliente)
{
  //Filtro parámetros
  $nombresApellidos=$this->filtroStrings($nombresApellidos, 2);
  $identificacionCliente=$this->filtroStrings($identificacionCliente, 1);
  $direccionCliente=$this->filtroStrings($direccionCliente, 2);
  $telefonosCliente=$this->filtroStrings($telefonosCliente,0);
  $emailCliente=$this->filtroStrings($emailCliente, 0);
  $ciudadCliente=$this->filtroStrings($ciudadCliente, 0);
  $nombresApellidos=explode('|', $nombresApellidos);
  $sql="INSERT INTO clientes SET  nombreCliente='".$nombresApellidos[0]."',
                                  identificacionCliente='".$identificacionCliente."',
                                  direccionCliente='".$direccionCliente."',
                                  telefonosCliente='".$telefonosCliente."',
                                  emailCliente='".$emailCliente."',
                                  ciudadCliente='".$ciudadCliente."' ";
  mysql_query($sql);
  return mysql_insert_id();//Retorno el ID del cliente como quedo

}













//String para las medidas
public  function stringMedidas($parametro)
{
  if ($parametro==1) {
    # unidades...
    return "Unidades";
  }
  elseif ($parametro==2) {
    # Gramos...
    return "Gramos";
  }
  elseif ($parametro==3) {
    # Kilos...
    return "Kilos";
  }
  elseif ($parametro==4) {
    # Litros...
    return "Litros";
  }

  elseif ($parametro==5) {
    # Mililitros...
    return "MiliLitros";
  }
}

//Hago  una normalización de las medidas  de las medidas de los ingredientes que se necesitan para  hacer la  receta,  es decir  si el producto se esta midiendo en kilos y la receta  se mide en gramos entonces  convierto de kilos a  gramos  y retorno la medida que me pasadon como existencia actual en gramos
private  function normalizacionMedidas($productoId, $productosTrasladosExistenciaActual,  $itemsRecetaMedida, $vector)
{
  

  //Inicio Vector 1;
  if ($vector==1) {
    # code...
    //Saco la medida  con la que se mide el producto
  $medidaProducto=$this->consultaDatosProducto($productoId, "productoConvenioMedida");

  if ($itemsRecetaMedida!=$medidaProducto) {
    # Al ser diferente  se  debe hacer la conversión ...
      if ($medidaProducto==2) {
        # Convierto de gramos a Kilos... (G x 0,001)
        return  $medidaFinal=$productosTrasladosExistenciaActual*0.001;
      }
      if ($medidaProducto==3) {
        # De Kilos a Gramos ...
        return  $productosTrasladosExistenciaActual*1000;
      
      }
      elseif ($medidaProducto==4) {
        # De Litros a Mililitros...
        return   $medidaFinal=$productosTrasladosExistenciaActual*0.001;
      }
      elseif ($medidaProducto==5) {
        # de mililitros a Litros...
        return  $medidaFinal=$productosTrasladosExistenciaActual*1000;
      } 
  }
  else
  {   //No existe diferencia  devuelva como esta
      return $productosTrasladosExistenciaActual;
  }



  }//Fin Vector 1

  elseif ($vector==2) {//inicio Vector 2
    # code...
    # Al ser diferente  se  debe hacer la conversión ...
      if ($itemsRecetaMedida==1) {
        # code...
        return $productosTrasladosExistenciaActual;
      }
      elseif ($itemsRecetaMedida==2) {
        # Convierto de gramos a Kilos... (G x 0,001)
        return  $medidaFinal=$productosTrasladosExistenciaActual*0.001;
      }
      elseif ($itemsRecetaMedida==3) {
        # De Kilos a Gramos ...
        return  $productosTrasladosExistenciaActual*0.001;
      
      }
      elseif ($itemsRecetaMedida==4) {
        # De Litros a Mililitros...
        return   $medidaFinal=$productosTrasladosExistenciaActual*0.001;
      }
      elseif ($itemsRecetaMedida==5) {
        # de mililitros a Litros...
        return  $medidaFinal=$productosTrasladosExistenciaActual*1000;
      } 

  }//Fin Vector 2;

  
}





private function recetaProductoNombre($itemConvenioProducto, $itemConvenioTipo)
{
  if($itemConvenioTipo==1)
  {
   
    return $this->consultaDatosProducto($itemConvenioProducto, "productosConvenioNombre");
  }
  elseif ($itemConvenioTipo==2) {
    # code...

   return  $this->consultaDatosRecetas($itemConvenioProducto, "recetasConvenioNombre");
  }
}
//Averigui el número  siguiente de la factura

//Te digo cuál es el próximo número de factura que sigue
public function proximoNumeroFactura(){
  $sql="SELECT nroFactura FROM facturacion ORDER BY(nroFactura) DESC";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  if ($rs['nroFactura']==0) {
    # code...
    return 1020;
  }
  elseif ($rs['nroFactura']>=1) {
    # code...
    return $rs['nroFactura']+1;
  }
}



//Te digo cuál es el próximo número de factura que sigue
public function proximoNumeroCuentaCobro(){
  $sql="SELECT nroCotizacion FROM facturacion ORDER BY(nroCotizacion) DESC";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  if ($rs['nroCotizacion']==0) {
    # code...
    return 1;
  }
  elseif ($rs['nroCotizacion']>=1) {
    # code...
    return $rs['nroCotizacion']+1;
  }
}



//retorno el valor que tiene que devolver
private  function analizarDevuelta($valorFinal, $efectivo)
{
    $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($efectivo));   
    $valorFinal=$this->filtroNumerico($this->normalizacionDeCaracteres($valorFinal));
    $valorFinal=$efectivo-$valorFinal;
     if ($valorFinal>=0) {
       # code...
        return $valorFinal;
     }
     else
     {
        return 0;
     }

}




//Retorno en string el estado de la factura

public  function analizarEstadoFactura($parametro)
{
    if($parametro==1)
    {
        return "Pagado";
    }
    elseif ($parametro==2) {
        # code...
        return "Crédito";
    }
    elseif ($parametro==3) {
        # code...
        return "Anulada";
    }
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






//Tipos y Estilos de Facturacion
public function tiposFacturas($facturaId, $tipoFactura, $modoFactura, $incremento){

//[idFactura]: el ide de la factura [tipoFactura]:si es tirilla o mediaCarta [modoFactura]:Si es con Cuentadecobro o es normal

  if ($modoFactura=='Factura') {
    # code...
      if ($tipoFactura=='mediaCarta') {
        echo '

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:;overflow:hidden;word-break:normal;}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>


        <table class="tg" style="undefined;table-layout: fixed; width: 800px">
<colgroup>
<col style="width: 160px">
<col style="width: 130px">
<col style="width: 100px">
<col style="width: 130px">
<col style="width: 111px">
<col style="width: 117px">
<col style="width: 131px">
</colgroup>
  <tr>
    <th class="tg-031e" rowspan="4">
      
      <img src="'.$this->datospagina(9).'/images/logo.png" width="150" alt="" align="center">
      <H5 align="center">'.$this->datospagina(0).'</H5>
      <h6 align="center">'.$this->datospagina(4).'</h6>
      <h6 align="center">'.$this->datospagina(1).'</h6>
    </th>
    <th class="tg-9hbo">Cliente</th>
    <th class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "nombreCliente").'</th>
    <th class="tg-9hbo">Factura Nro</th>
    <th class="tg-yw4l">'.$this->datosFactura($facturaId, "nroFactura").'</th>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>N.I.T cliente</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "identificacionCliente").'</td>
    <td class="tg-9hbo"><b>Ciudad</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "ciudadCliente").'</td>
    <td class="tg-9hbo"><b>Teléfonos</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "telefonosCliente").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Dirección</b></td>
    <td class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "direccionCliente").'</td>
    <td class="tg-9hbo"><b>Forma de Pago</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "tipoPago").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Estado Factura</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "estadoFactura").'</td>
    <td class="tg-9hbo"><b>Fecha Factura</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "fechaFactura").'</td>
    <td class="tg-9hbo"><b>Vendedor</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "codigoVendedor").'</td>
  </tr>

  <!-- Tablas de Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">

    <h4 align="center"> <i class="fa fa-check-circle"></i> Items Facturados</h4>
      <table class="tg" style="undefined;table-layout: fixed; width: 790px">
<colgroup>
<col style="width: 201px">
<col style="width: 133px">
<col style="width: 98px">
<col style="width: 124px">
<col style="width: 117px">
</colgroup>
  <tr>
    <th class="tg-9hbo">Item</th>
    <th class="tg-9hbo">Valor Unidad</th>
    <th class="tg-9hbo">Cantidad</th>
    <th class="tg-9hbo">%Impuesto</th>
    <th class="tg-9hbo">Valor Total</th>
  </tr>
  <!-- WHILE HERE-->

';
  $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
  $query=mysql_query($sql);
  $valorFinal=0;
 while ($rs=mysql_fetch_array($query)) {
  # code...
echo '
  <tr>
    <td class="tg-031e">'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</td>
    <td class="tg-031e">'.number_format($rs["valorVentaUnidadNeta"]).'</td>
    <td class="tg-031e">'.$rs["unidades"].'</td>
    <td class="tg-031e">'.$rs["porcentajeImpuesto"].'</td>';

  $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
  $valorTotal=(($valorTotalNeto*$rs['porcentajeImpuesto'])/100)+$valorTotalNeto;
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
  }//Fin del while de los item de la factura

//En caso que exista un incremento
if($incremento>0)
{

$incrementoBancario=($valorFinal*$incremento)/100;

  echo '
  <tr>
    <td class="tg-031e">Incremento del '.$this->filtroNumericoDecimal($incremento).'% por servicios bancarios</td>
    <td class="tg-031e">'.number_format($incrementoBancario).'</td>
    <td class="tg-031e">1</td>
    <td class="tg-031e">0</td>';

   $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
   $valorTotal=($incrementoBancario);
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
}

echo '
  <!-- FIN DEL WHILE-->

  <tr>
    <td class="tg-031e" colspan="3" rowspan="3"></td>
    <td class="tg-9hbo"><b>Valor Total</b></td>
    <td class="tg-yw4l">'.number_format($valorFinal).'</td>
  </tr>
</table>
    </td>
  </tr>

  <!-- Fin Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.$this->datospagina(10).'</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.piePaginaFacturas.'</td>
  </tr>
</table>';
      }//Fin MediaCarta








      elseif ($tipoFactura=='tirilla') {
        # code...
      echo '<table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0">
                              <tr>
                                <td colspan="4" align="center">
                                    <img src="'.$this->datospagina(9).'/images/logo.png" width="150" align="center">
                                  <br>
                               
                                  <b>'.$this->datospagina(0).'</br>'.$this->datospagina(4).' <b> <br>'.$this->datospagina(1).'</td>
                                </tr>
                              <tr>
                        
                          <tr>
                            <td colspan="1">Remisión:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->datosFactura($facturaId, "nroFactura").'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Fecha:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->datosFactura($facturaId, "fechaFactura").'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Cliente</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "nombreCliente").'</b></td>
                          </tr>
                    </table>  
                    <hr>
                    <table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0">

                          <!--Productos Adquiridos-->
                         <td colspan="4">
                            <table width="110%" border="0" style="font-size:13px" align="center">
                              <tr>
                                <td width="43%" align="center" class="text-danger"><b>Prod</b></td>
                                <td width="21%" align="center" class="text-danger"><b>Base</b></td>

                                <td width="21%" align="center" class="text-danger"><b>Cant</b></td>
                                <td width="12%" align="center" class="text-danger"><b>Imp</b></td>
                                <td width="24%" align="center" class="text-danger"><b>Sub</b></td>
                              </tr>

                    ';

                 $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
                 $query=mysql_query($sql);
                 $valorFinal=0;

        while ($rs=mysql_fetch_array($query)) {
            # code...
            echo '<tr>
                                <td><b>'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</b></td><!--Nombre Producto -->


                                <td align="center"><b>'.number_format($rs["valorVentaUnidadNeta"]).'</b></td><!--Valor Producto -->

                                <td align="center"><b>'.$rs["unidades"].'</b></td>
                                
                                <td align="center"><b>'.$rs["porcentajeImpuesto"].'</b></td>
                                
                                ';
                               $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
                               $valorTotal=(($valorTotalNeto*$rs['porcentajeImpuesto'])/100)+$valorTotalNeto;
                               
                                 echo '
                                <td align="center"><b>'.number_format($valorTotal).'</b></td>
                              </tr>';



                              $valorFinal=$valorFinal+$valorTotal;
        }

        /*----------  VERIFICO SI HAY EXISTENCIA DE IMEI  ----------*/
        
         $sql="SELECT idFactura, idProductoServicio, imei  FROM itemsFactura WHERE idFactura='".$facturaId."' AND imei != '' ";
         $query=mysql_query($sql);
         if (mysql_num_rows($query)>0) {
           # code...
          echo '<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 300px" align="center">
<colgroup>
<col style="width: 150px;">
<col style="width: 100px;">
</colgroup>

  <h2 align="center">Relación de Imei</h2>
  <tr>
    <th class="tg-031e">Producto</th>
    <th class="tg-031e">Imei</th>
  </tr>
';

while ($rsimei=mysql_fetch_array($query)) {
  # code...
  if(strlen($rsimei['imei'])>0){
    echo '<tr>
    <td class="tg-yw4l">'.$this->consultaDatosProducto($rsimei["idProductoServicio"], "nombreProductosServicios").'</td>
    <td class="tg-yw4l">'.$rsimei['imei'].'</td>
  </tr>';
  }
  
}
  
  
 echo '  <tr>
    <td class="tg-031e" colspan="2"><h5 align="center">Recuerda registrar el equipo ante el operador que vayas a usar, de lo contrario el equipo podría ser sometido a BLOQUEO por parte de las entidades de control y el desbloqueo NO ES RESPONSABILIDAD DE '.$this->datospagina(0).'<h5></td>
  </tr>
</table>
';



         
         }


        /*----------  FIN DE LA VERIFICACIÓN DE LA EXISTENCIA DE IMEI  ----------*/
        
          //incremento
         echo '</table>



                         </td>
                      </table>


                         <hr>

                        <table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0">
                         <!-- Fin  Productos Adquiridos-->

                          <tr>
                            <td colspan="1">Total:</td>
                            <td colspan="3" align="right"><b class="text-danger">$'.number_format($valorFinal).'</b></td>
                          </tr>
                    

                          <tr>
                            <td colspan="1">Efectivo:</td>
                            <td colspan="3" align="right"><b class="text-danger">$'.number_format($efectivo).'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Cambio:</td>
                            <td colspan="3" align="right"><b class="text-danger">$ '.number_format($this->analizarDevuelta($valorFinal, $efectivo)).'</b></td>
                          </tr>


                          <tr>
                            <td colspan="1">Estado:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->datosFactura($facturaId, "estadoFactura").'</b></td>
                          </tr>


                          <tr>
                            <td colspan="1">Pagado Con:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->datosFactura($facturaId, "tipoPago").'</b></td>
                          </tr>


                          <tr>
                            <td colspan="4" align="center" class="text-muted" style="font-size:10px;"> '.piePaginaFacturas.'</td>
                          </tr>
                          
                      

                          </table>

                      ';
      }//Fin Tirilla

  }//Fin del modo de factura normal
  elseif ($modoFactura=='Cuenta de Cobro') {
    # code...
     if ($tipoFactura=='mediaCarta') {
         echo '
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:;overflow:hidden;word-break:normal;}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
         <table class="tg" style="undefined;table-layout: fixed; width: 800px">
<colgroup>
<col style="width: 160px">
<col style="width: 130px">
<col style="width: 100px">
<col style="width: 130px">
<col style="width: 111px">
<col style="width: 117px">
<col style="width: 131px">
</colgroup>
  <tr>
    <th class="tg-031e" rowspan="4">
     <h2>Cuenta De Cobro</h2>  
    </th>
    <th class="tg-9hbo"><b>Cliente</b></th>
    <th class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "nombreCliente").'</th>
    <th class="tg-9hbo"><b>Cuenta de Cobro Nro</b></th>
    <th class="tg-yw4l">C-'.$this->datosFactura($facturaId, "nroCotizacion").'</th>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>N.I.T cliente</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "identificacionCliente").'</td>
    <td class="tg-9hbo"><b>Ciudad</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "ciudadCliente").'</td>
    <td class="tg-9hbo"><b>Teléfonos</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "telefonosCliente").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Dirección</b></td>
    <td class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "direccionCliente").'</td>
    <td class="tg-9hbo"><b>Forma de Pago</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "tipoPago").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Estado Cuenta de Cobro</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "estadoFactura").'</td>
    <td class="tg-9hbo"><b>Fecha Cuenta de Cobro</b></td>
    <td class="tg-yw4l">';
        $fecha=explode(' ', $this->datosFactura($facturaId, "fechaFactura"));
        echo $fecha[0];
     echo '</td>
    <td class="tg-9hbo"><b>Vendedor</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "codigoVendedor").'</td>
  </tr>

  <!-- Tablas de Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">
      <table class="tg" style="undefined;table-layout: fixed; width: 790px">
    <colgroup>
    <col style="width: 201px">
    <col style="width: 133px">
    <col style="width: 98px">
    <col style="width: 124px">
    <col style="width: 117px">
    </colgroup>
  <tr>
    <th class="tg-9hbo">Item</th>
    <th class="tg-9hbo">Valor Unidad</th>
    <th class="tg-9hbo">Cantidad</th>
    <th class="tg-9hbo">%Impuesto</th>
    <th class="tg-9hbo">Valor Total</th>
  </tr>


  <!-- WHILE HERE-->

';
  $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
  $query=mysql_query($sql);
  $valorFinal=0;
 while ($rs=mysql_fetch_array($query)) {
  # code...
echo '
  <tr>
    <td class="tg-031e">'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</td>
    <td class="tg-031e">'.number_format($rs["valorVentaUnidadNeta"]).'</td>
    <td class="tg-031e">'.$rs["unidades"].'</td>
    <td class="tg-031e">'.$rs["porcentajeImpuesto"].'</td>';

   $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
   $valorTotal=(($valorTotalNeto*$rs['porcentajeImpuesto'])/100)+$valorTotalNeto;
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
  }//Fin del while de los item de la factura

//En caso que exista un incremento
if($incremento>0)
{

$incrementoBancario=($valorFinal*$incremento)/100;

  echo '
  <tr>
    <td class="tg-031e">Incremento del '.$this->filtroNumericoDecimal($incremento).'% por servicios bancarios</td>
    <td class="tg-031e">'.number_format($incrementoBancario).'</td>
    <td class="tg-031e">1</td>
    <td class="tg-031e">0</td>';

   $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
   $valorTotal=($incrementoBancario);
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
}

echo '
  <!-- FIN DEL WHILE-->
  <tr>
    <td class="tg-031e" colspan="3" rowspan="3"></td>
    <td class="tg-9hbo"><b>Valor Total</b></td>
    <td class="tg-yw4l">'.number_format($valorFinal).'</td>
  </tr>





</table>
    </td>

  <!-- Fin Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.$this->datospagina(10).'</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.piePaginaFacturas.'</td>
  </tr>
</table>';
      }//Fin MediaCarta
      elseif ($tipoFactura=='tirilla') {
        # Inicio Tirilla...
        echo '<table width="200" border="0" style="font-size:12px; font-family:arial" align="center">
  <tr>
    <td colspan="2" align="center">
       <img src="'.$this->datospagina(9).'/images/logo.png" width="150" align="center">
        <H5 align="center">'.$this->datospagina(0).'</H5>
        <h6 align="center">'.$this->datospagina(4).'</h6>
        <h6 align="center">'.$this->datospagina(1).'</h6>
    </td>
  </tr>
  <tr >
    <td width="100"><b>Número de Orden</b></td>
    <td width="100" align="right" style="color:#F00; font-weight:bold">'.$this->datosFactura($facturaId, "nroFactura").'</td>
  </tr>
  <tr>
    <td><b>Fecha de Ingreso</b></td>
    <td align="right" >'.$this->datosFactura($facturaId, "fechaFactura").'</td>
  </tr>
  <tr>
    <td colspan="2" align="center"> <b>TU COMPRA</b></td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td colspan="2">
      <table class="tg" style="undefined;table-layout: fixed; width: 203px">
        <colgroup>
        <col style="width: 120px">
        <col style="width: 50px">
        <col style="width: 60px">
        </colgroup>
          <tr>
            <th class="tg-ir4y" style="text-align: center;"><b>ITEM</b></th>
            <th class="tg-pi53"><b>Cant</b></th>
            <th class="tg-pi53"><b>Valor</b></th>
          </tr>

          ';
      $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
      $query=mysql_query($sql);
      $valorFinal=0;

        while ($rs=mysql_fetch_array($query)) {

        echo '<tr>
                <td class="tg-q19q">'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</td>
                <td class="tg-214n">'.$rs["unidades"].'</td>
                <td class="tg-214n">'.$rs["unidades"]*$rs["valorVentaUnidadNeta"].'</td>
              </tr>';
        $valorFinal=$valorFinal+($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
          }
      echo '
        </table>
    </td>

  </tr>
  <tr>
    <td><b>Valor Total</b></td>
    <td align="right"><b>$'.number_format($valorFinal).'</b></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:8px" align="center">

    '.$this->datospagina(10).'
     </td>
  </tr>

  <tr>
    <td colspan="2" style="font-size:8px" align="center">
  <br><b>
    '.piePaginaFacturas.'
</b>
     </td>
  </tr>
</table>';
      }//Fin Tirilla

  }//Fin del modo de factura normal
  elseif ($modoFactura=='Cuenta de Cobro') {
    # code...
     if ($tipoFactura=='mediaCarta') {
         echo '
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:;overflow:hidden;word-break:normal;}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
         <table class="tg" style="undefined;table-layout: fixed; width: 800px">
<colgroup>
<col style="width: 160px">
<col style="width: 130px">
<col style="width: 100px">
<col style="width: 130px">
<col style="width: 111px">
<col style="width: 117px">
<col style="width: 131px">
</colgroup>
  <tr>
    <th class="tg-031e" rowspan="4">
     <h2>Cuenta De Cobro</h2>  
    </th>
    <th class="tg-9hbo"><b>Cliente</b></th>
    <th class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "nombreCliente").'</th>
    <th class="tg-9hbo"><b>Cuenta de Cobro Nro</b></th>
    <th class="tg-yw4l">C-'.$this->datosFactura($facturaId, "nroCotizacion").'</th>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>N.I.T cliente</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "identificacionCliente").'</td>
    <td class="tg-9hbo"><b>Ciudad</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "ciudadCliente").'</td>
    <td class="tg-9hbo"><b>Teléfonos</b></td>
    <td class="tg-yw4l">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "telefonosCliente").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Dirección</b></td>
    <td class="tg-yw4l" colspan="3">'.$this->consultaDatosCliente($this->datosFactura($facturaId, "idCliente"), "direccionCliente").'</td>
    <td class="tg-9hbo"><b>Forma de Pago</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "tipoPago").'</td>
  </tr>
  <tr>
    <td class="tg-9hbo"><b>Estado Cuenta de Cobro</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "estadoFactura").'</td>
    <td class="tg-9hbo"><b>Fecha Cuenta de Cobro</b></td>
    <td class="tg-yw4l">';
        $fecha=explode(' ', $this->datosFactura($facturaId, "fechaFactura"));
        echo $fecha[0];
     echo '</td>
    <td class="tg-9hbo"><b>Vendedor</b></td>
    <td class="tg-yw4l">'.$this->datosFactura($facturaId, "codigoVendedor").'</td>
  </tr>

  <!-- Tablas de Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">
      <table class="tg" style="undefined;table-layout: fixed; width: 790px">
    <colgroup>
    <col style="width: 201px">
    <col style="width: 133px">
    <col style="width: 98px">
    <col style="width: 124px">
    <col style="width: 117px">
    </colgroup>
  <tr>
    <th class="tg-9hbo">Item</th>
    <th class="tg-9hbo">Valor Unidad</th>
    <th class="tg-9hbo">Cantidad</th>
    <th class="tg-9hbo">%Impuesto</th>
    <th class="tg-9hbo">Valor Total</th>
  </tr>


  <!-- WHILE HERE-->

';
  $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
  $query=mysql_query($sql);
  $valorFinal=0;
 while ($rs=mysql_fetch_array($query)) {
  # code...
echo '
  <tr>
    <td class="tg-031e">'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</td>
    <td class="tg-031e">'.number_format($rs["valorVentaUnidadNeta"]).'</td>
    <td class="tg-031e">'.$rs["unidades"].'</td>
    <td class="tg-031e">'.$rs["porcentajeImpuesto"].'</td>';

   $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
   $valorTotal=(($valorTotalNeto*$rs['porcentajeImpuesto'])/100)+$valorTotalNeto;
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
  }//Fin del while de los item de la factura

//En caso que exista un incremento
if($incremento>0)
{

$incrementoBancario=($valorFinal*$incremento)/100;

  echo '
  <tr>
    <td class="tg-031e">Incremento del '.$this->filtroNumericoDecimal($incremento).'% por servicios bancarios</td>
    <td class="tg-031e">'.number_format($incrementoBancario).'</td>
    <td class="tg-031e">1</td>
    <td class="tg-031e">0</td>';

   $valorTotalNeto=($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
   $valorTotal=($incrementoBancario);
echo '<td class="tg-yw4l">'.number_format($valorTotal).'</td>
  </tr>
  ';
   $valorFinal=$valorFinal+$valorTotal;
}

echo '
  <!-- FIN DEL WHILE-->
  <tr>
    <td class="tg-031e" colspan="3" rowspan="3"></td>
    <td class="tg-9hbo"><b>Valor Total</b></td>
    <td class="tg-yw4l">'.number_format($valorFinal).'</td>
  </tr>





</table>
    </td>

  <!-- Fin Items Factura-->
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.$this->datospagina(10).'</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="7" align="center">'.piePaginaFacturas.'</td>
  </tr>
</table>';
      }//Fin MediaCarta
      elseif ($tipoFactura=='tirilla') {
        # code...

      echo '<table width="200" border="0" style="font-size:12px; font-family:arial" align="center">
  <tr>
    <td colspan="2" align="center">
      CUENTA DE COBRO
    </td>
  </tr>
  <tr >
    <td width="100"><b>Número de Orden</b></td>
    <td width="100" align="right" style="color:#F00; font-weight:bold">'.$this->datosFactura($facturaId, "nroFactura").'</td>
  </tr>
  <tr>
    <td><b>Fecha de Ingreso</b></td>
    <td align="right" >'.$this->datosFactura($facturaId, "fechaFactura").'</td>
  </tr>
  <tr>
    <td colspan="2" align="center"> <b>TU COMPRA</b></td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td colspan="2">
      <table class="tg" style="undefined;table-layout: fixed; width: 203px">
        <colgroup>
        <col style="width: 120px">
        <col style="width: 50px">
        <col style="width: 60px">
        </colgroup>
          <tr>
            <th class="tg-ir4y" style="text-align: center;"><b>ITEM</b></th>
            <th class="tg-pi53"><b>Cant</b></th>
            <th class="tg-pi53"><b>Valor</b></th>
          </tr>

          ';
      $sql="SELECT *  FROM itemsFactura WHERE idFactura='".$facturaId."' AND idProductoServicio != 0";
      $query=mysql_query($sql);
      $valorFinal=0;

        while ($rs=mysql_fetch_array($query)) {

        echo '<tr>
                <td class="tg-q19q">'.$this->consultaDatosProducto($rs["idProductoServicio"], "nombreProductosServicios").'</td>
                <td class="tg-214n">'.$rs["unidades"].'</td>
                <td class="tg-214n">'.$rs["unidades"]*$rs["valorVentaUnidadNeta"].'</td>
              </tr>';
        $valorFinal=$valorFinal+($rs["unidades"]*$rs["valorVentaUnidadNeta"]);
      }
      echo '
        </table>
    </td>

  </tr>
  <tr>
    <td><b>Valor Total</b></td>
    <td align="right"><b>$'.number_format($valorFinal).'</b></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:8px" align="center">

    '.$this->datospagina(10).'
     </td>
  </tr>

  <tr>
    <td colspan="2" style="font-size:8px" align="center">
  <br><b>
    '.piePaginaFacturas.'
</b>
     </td>
  </tr>
</table>';
      }//Fin Tirilla
  }//fin del modo factura CC 
}













/********FECHAS*************/


public   function fechaHumana($parametro)
{
  $fecha=explode('-',$parametro);
  if($fecha[2]>0){                 
  return $fecha[2].' de '.$this->meses($fecha[1]). ' del '.$fecha[0] ; 
  }
  else
  {
    return "No se ha asignado fecha";
  }
}


//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
  $fecha=explode("/", $parametro);
  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
}
  



//Convierto los números de los meses en los meses string
private function meses($parametro)
  {
  switch($parametro)
    {
    
    case 01:
    return 'Enero';
    break;
    
    
    case 02:
    return 'Febrero';
    break;
    
    
    case 03:
    return 'Marzo';
    break;
    
    
    case 04:
    return 'Abril';
    break;
    
    
    case 05:
    return 'Mayo';
    break;
    
    
    case 06:
    return 'Junio';
    break;
    
    
    case 07:
    return 'Julio';
    break;
    
    
    case "08":
    return 'Agosto';
    break;
    
    
    case "09":
    return 'Septiembre';
    break;
    
    
    case "10":
    return 'Octubre';
    break;
    
    
    case "11":
    return 'Noviembre';
    break;
    
    
    case "12":
    return 'Diciembre';
    break;
    
    }
  
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
  
  if(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==TRUE)
  {
    return $parametro;
  }
  elseif(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==FALSE)
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