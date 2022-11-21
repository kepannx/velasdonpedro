<?php
class consultaProductos extends conectar {



/*SQL DE PRODUCTOS*/
public  function sqlProductos($idProducto){
conectar::conexiones();
$idConvenio=$this->decrypt($_REQUEST["id"], key);
$idProducto=$this->decrypt($idProducto, publickey);
$sql="SELECT * FROM productosConvenio WHERE productosConvenioId='".$idProducto."' AND convenioId='".intval($idConvenio)."'";
return  mysql_query($sql);
conectar::desconectar();
}





//Asocio a  receta

public function asocioReceta($idProducto)
{
  conectar::conexiones();
  $sql="SELECT productosConvenioId FROM itemReceta WHERE productosConvenioId='".intval($idProducto)."'";
  return mysql_num_rows(mysql_query($sql));
  conectar::desconectar();
}



/***************consultas de productos */
public function consultaDatosProducto($parametro, $vector)
{
  conectar::conexiones();
  $idproductosServicios=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM PRODUCTOSERVICIOS WHERE idproductosServicios='".$idproductosServicios."' ";
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
      # code...
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



//RECETAS PRODUCTOS
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





//******************************[HISTORIAL DE TRASLADOS DE UN PRODUCTO]*********************************/

public function historicosTraslados($productoId)
{
  conectar::conexiones();
  //Saco los traslados hechos hacia el punto de venta
        $sqlTrasladosAPuntoVenta="SELECT productoId, convenioId, productosTrasladosFechaTraslado, productosTrasladosUnidadesTrasladadas FROM productosTraslados WHERE productoId='".$this->filtroNumerico($productoId)."'
    ";

    //Saco los traslados hechos hacia la bodega
      $sqlTrasladosABodega="SELECT productoId, inventarioConvenioRetraslado, inventarioConvenioFecha, inventarioConvenioCantidadComprada FROM inventarioConvenio 
                                          WHERE productoId='".$this->filtroNumerico($productoId)."' AND inventarioConvenioRetraslado=1";
    


  
    $queryPuntoVenta=mysql_query($sqlTrasladosAPuntoVenta);
    $queryBodega=mysql_query($sqlTrasladosABodega);

    $par=0;
    $impar=1;
    $bucket= array();
    $bucket2= array();

  while ($rs=mysql_fetch_array($queryPuntoVenta)) {
    # code...
     
         $bucket[$par]="'-".$rs["productosTrasladosFechaTraslado"]."-".$rs["productosTrasladosUnidadesTrasladadas"]."-Bodega-Punto De Venta";
        $par++;
  }

   while ($rsBodega=mysql_fetch_array($queryBodega)) {
      # code...

         $bucket[$par]="1-".$rsBodega["inventarioConvenioFecha"]."-".$rsBodega["inventarioConvenioCantidadComprada"]."-Punto de Venta-Bodega";
  
      $par++;
    }

   $t=sizeof($bucket);
   $n=0;
  
   echo '<div class="table-responsive">';
    echo '<table id="historialTraslados" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Fecha del Traslado</th>
                                    <th>Cantidad</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    
                                </tr>
                            </thead>
    ';

    echo '<tbody>';


   // echo $this->listaTraslados($n, $t, $bucket);
   while ($t>$n) {
      # code...
      $rs=explode("-", $bucket[$n]);
       echo '
                                <tr>
                                    <td>'.$this->fechaHumana(date("Y-m-d",$rs[1])).'</td>
                                    <td>'.$rs[2].'</td>
                                    <td>'.$rs[3].'</td>
                                    <td>'.$rs[4].'</td>
                                </tr>
                               
                            <br>
                      ';
    $n++;
    }
 

    echo ' </tbody>';

         echo '</table>';

         echo '</div>';
conectar::desconectar();

}










//Productos facturados en relación a factura de cliente
public function productosFacturados($facturaId)
{

  $facturaId=$this->filtroNumerico($facturaId);
  $sql="SELECT idProductoServicio, valorNeto, valorTotal, unidades, porcentajeImpuesto FROM  itemsFactura where idFactura='".$facturaId."' ";
  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Valor Neto</th>
                    <th align="center"><div align="center">% Impuestos</div></th>
                    <th>Valor Total</th>
                  </tr>
                </thead>
            <tbody>
      ';
    $query=mysql_query($sql);
      while ($rs=mysql_fetch_array($query)) {
        # code...
        $totalNeto=$rs["valorVentaUnidadNeta"]*$rs["unidades"];
        $totalTaxes=(($totalNeto*$rs["porcentajeImpuesto"])/100);
        $valorTotal=$totalNeto+$totalTaxes;
        $productoNombre=$this->consultaDatosProducto($rs["idProductoServicio"], 'nombreProductosServicios');

        if ($rs["idProductoServicio"]>0) {
          # code...
       
        echo '
                  <tr>
                    <td>'.$productoNombre.'</td>
                    <td>'.$rs["unidades"].'</td>
                    <td>$ '.number_format($rs["valorNeto"]).'</td>
                    <td align="center">'.$rs["porcentajeImpuesto"].' % </td>
                    <td>$ '.number_format((($rs["valorNeto"]*$rs["porcentajeImpuesto"])/100)*$rs["unidades"]+($rs["valorNeto"]* $rs['unidades'])).'</td>
                  </tr>';
               }
      }
                
                  
       echo '</tbody>
         </table>';
}






//Lista  de los imeis relacionados con la factura
public function listaImeisFactura($facturaId){
   $facturaId=$this->filtroNumerico($facturaId);
   $sql="SELECT idFactura, idProductoServicio, imei FROM  itemsFactura where idFactura='".$facturaId."' AND imei !=''";
   $query=mysql_query($sql);
   if (mysql_num_rows($query)>0) {
     # code...
    echo  '<h1 align="center"> <i class="fa  fa-flag-o"></i>Imei Relacionados</h1>';
    echo '<table class="table">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Imei</th>
                   
                  </tr>
                </thead>
            <tbody>
      ';
      while ($rs=mysql_fetch_array($query)) {
        # code...
        echo '
                  <tr>
                    <td>'.$this->consultaDatosProducto($rs["idProductoServicio"], 'nombreProductosServicios').'</td>
                    <td>'.$rs["imei"].'</td>
                  </tr>';
      }


     echo '</tbody>
         </table>';

   }



}





public function productosFacturadosFacturaProvedor($facturaId)
{

  $facturaId=$this->filtroNumerico($facturaId);
  $sql="SELECT idProductoServicio, unidadesCompradas, valorUnidad,impuesto FROM  inventario where IdFacturaProvedor='".$facturaId."' ";
  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Valor Unidad</th>
                    <th>Impuesto</th>
                    <th>Valor Total</th>
                  </tr>
                </thead>
            <tbody>
      ';
    $query=mysql_query($sql);
      while ($rs=mysql_fetch_array($query)) {
        # code...
        $totalNeto=$rs["valorUnidad"]*$rs["unidadesCompradas"];
        $totalTaxes=(($totalNeto*$rs["impuesto"])/100);
        $valorTotal=$totalNeto+$totalTaxes;
        $productoNombre=$this->consultaDatosProducto($rs["idProductoServicio"], 'nombreProductosServicios');
        echo '
                  <tr>
                    <td>'.$productoNombre.'</td>
                    <td>'.$rs["unidadesCompradas"].'</td>
                    <td>$ '.number_format($rs["valorUnidad"]).'</td>
                    <td>'.$rs["impuesto"].'</td>
                    <td>$ '.number_format($valorTotal).'</td>
                  </tr>';
      }
                
                  
       echo '</tbody>
         </table>';
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




//Fechas


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

}