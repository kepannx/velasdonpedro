<?php
class consultaInventarios extends conectar {



/*SQL DE CONSULTAS*/
public  function sqlConvenio($id){
conectar::conexiones();
$id=$this->decrypt($id, publickey);
$sql="SELECT * FROM convenio WHERE convenioId='".intval($id)."'";
return  mysql_query($sql);
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

    case 'sku':
      # code...
      return $rs["sku"];
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


public function consultaDatosFacturacion($parametro, $vector)
{
  conectar::conexiones();
  $idFactura=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM facturacion WHERE idFactura='".$idFactura."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  switch ($vector) {
   
    case 'nroFactura':
      # code...
      return $rs['nroFactura'];
      break;

    case 'nroCotizacion':
      # code...
      return $rs['nroCotizacion'];
      break;

    
    case 'idCliente':
      # code...
      return $rs['idCliente'];
      break;


    case 'fechaFactura':
      # code...
      return $rs['fechaFactura'];
      break;


    case 'estadoFactura':
      # code...
      return $rs['estadoFactura'];
      break;
    
    default:
      # code...
      break;
  }

}








//Lista de todas las ventas
public  function listaInventario($id)
{
  conectar::conexiones();

  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  
  $sql="SELECT productosConvenioId, productosConvenioNombre FROM  productosConvenio WHERE convenioId='".$convenioId."'";
  $query=mysql_query($sql);
  echo '<table id="tablaInventario" class="table table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad Comprada Último Mes</th>
                  <th>Cantidades Existentes</th>  
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
          
          echo '<tr>                  
                  <td>
                    '.$rs["productosConvenioNombre"].'
                    </td><!-- Nombre del Clienre-->
                 
                  <td align="center">'.$this->cantidadCompradaUltimoMes($rs["productosConvenioId"]).' '.$this->definicionMedida($rs["productosConvenioId"]).'</td><!-- Cantidades Compradas Último Mes -->
                 
                  <td align="center">'.$this->cantidadEnExistencia($rs["productosConvenioId"]).' '.$this->definicionMedida($rs["productosConvenioId"]).'</td><!-- Cantidades Existentes -->

                  
                  <td>'.$this->alertaEstadosMinimosProductos($rs["productosConvenioId"]).'</td><!-- Estado de la factura -->
                 
                  <td>
                     <a href="'.$this->datospagina(5).'modulos/productos/detalleProducto.php?id='.$id.'&idProducto='.$this->encrypt($rs["productosConvenioId"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';


               }

     echo '  </tbody>
            </table>';
  conectar::desconectar();

}











//LISTA  DE LOS PRODUCTOS
public  function listaProductos()
{
  conectar::conexiones();

  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  
  //Aqui va el condicional para filtrar por fechas
  $sql="SELECT sku, idproductosServicios, nombreProductosServicios, valorVentaUnidad, valorVentaPorMayor, retiroTemporal FROM   PRODUCTOSERVICIOS WHERE  idproductosServicios!=0";


  $query=mysql_query($sql);
  echo '<table id="tablaInventario" class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>sku</th>
                  <th>Producto</th>
                  <th>Valor Público</th>
                  <th>Cant Vendidas</th>
                  <th>Existencia</th>    
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
          
          echo '<tr>  
                  <td>
                    '.$this->iconoShowMeProductoServicio($rs["retiroTemporal"]).'
                    </td><!-- Nombre de la receta-->  

                     <td>
                    '.$rs["sku"].'
                    </td><!-- Nombre de la receta-->              
                    <td>
                    '.$rs["nombreProductosServicios"].'
                    </td><!-- Nombre de la receta-->
                 
                  <td align="center">$ '.number_format($rs["valorVentaUnidad"]).'</td><!-- Valor al publico en general -->

                  <td align="center">'.$this->cantidadesVendidasProdicto($rs["idproductosServicios"]).'</td><!-- Valor al mayoreo -->
                 
                  <td align="center">'.$this->cantidadesExistentesPuntoDeVenta($rs["idproductosServicios"]).'</td><!-- Cantidades Que hay en bodega -->
                  <!-- Las cantidades existentes en bodega-->
               
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/productos/detalleProducto.php?id='.$_REQUEST['id'].'&idProducto='.$this->encrypt($rs["idproductosServicios"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';


               }

     echo '  </tbody>
            </table>';
  conectar::desconectar();

}



//LISTA  DE LOS PRODUCTOS
public  function listaProductosVendidos()
{
  conectar::conexiones();

  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  
  //Aqui va el condicional para filtrar por fechas
  $sql="SELECT  idProductoServicio,idFactura, unidades, valorVentaUnidadNeta FROM    itemsFactura WHERE idProductoServicio != 0 AND idProductoServicio != 1830";


  $query=mysql_query($sql);
  echo '<table id="tablaInventario" class="table table-striped">
              <thead>
                <tr>
                  <th>sku</th>
                  <th>Producto</th>
                  
                  <th>Factura</th>

                  <th>Venta</th>    
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
          
          echo '<tr>  
                 

                     <td>
                    '.$this->consultaDatosProducto($rs["idProductoServicio"], 'sku').'
                    </td>             
                    <td>
                    '.$this->consultaDatosProducto($rs["idProductoServicio"], 'nombreProductosServicios').'
                    </td>
                 
                  <td align="center"> '.$this->consultaDatosFacturacion($rs["idFactura"], 'nroFactura').'</td><!--NRO FACTURA -->

                  <td align="center"> '.number_format($rs["unidades"]).'</td><!--VENTA-->
               
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$_REQUEST['id'].'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';


               }

     echo '  </tbody>
            </table>';
  conectar::desconectar();

}





//Seleccion de las subcategorias según la categoría pasada como parámetro
public function selectSubCategorias($categoria, $subCategorias){
    conectar::conexiones(); 
    $categoria=$this->filtroNumerico($this->decrypt($categoria, publickey));
    $sql="SELECT idCategoria, tipo, padre, nombreCategoria FROM categorias  WHERE 
                                                              padre = $categoria
                                                          AND tipo='subCategoria'";

    $query=mysql_query($sql);
    if(mysql_num_rows($query)>0){
      echo '<select id="subCategoria" class="form-control" >
            <option>Selecciona SubCategoria</option>
      ';
        while ($rs=mysql_fetch_array($query)) {

          echo '<option value="'.$this->encrypt($rs['idCategoria'], publickey).'" '.$this->selected($this->encrypt($rs['idCategoria'], publickey), $subCategorias).' >'.$rs['nombreCategoria'].'</option>';
        }
        echo '</select>';
      }
    else{//Si no hay subcategorias 
      echo '<h3 class="text-danger">'.txtSinSubCategoria.' <i class="fa  fa-frown-o"></i> </h3>';
    }
    conectar::desconectar();
  }











/***********************************AJAX & JSONS**************************************/


public function jsonProductosFacturero()
{
  conectar::conexiones();
  $sql="SELECT  idproductosServicios, sku, nombreProductosServicios, tipoProductoServicio FROM PRODUCTOSERVICIOS where  tipoProductoServicio!='servicio'";
  $query=mysql_query($sql);
  $array= array();
  $num=0;
  while ($rs=mysql_fetch_array($query)) {
      $array[$num]='"'.$rs["idproductosServicios"].'|'.$rs["sku"].'|'.$rs["nombreProductosServicios"].'"';
      $num++;
  }
  $producto=implode(",", $array);
  return ''.$producto.'';

  conectar::desconectar();

}






//Sumatoria de las cantidades existentes en bodega y punto de venta
public  function cantidadEnExistencia($productoId)
{
    $sql="SELECT SUM(unidadesExistentes) AS existencia FROM INVENTARIOS 
    WHERE idProductoServicio='".$productoId."' AND unidadesExistentes>0";
    $resultado = mysql_fetch_assoc(mysql_query($sql));  
    return  $resultado["existencia"];


}


public  function cantidadProductosEnMinimos()
{

    $sql="SELECT idproductosServicios, cantidadMinima, tipoProductoServicio from PRODUCTOSERVICIOS WHERE  tipoProductoServicio='producto'";
    $query=mysql_query($sql);
    
    $productosEnMinimos=array();
    $n=0;
    while ($rs=mysql_fetch_array($query)) {
      # code...
      $cantidadMinima=$rs["cantidadMinima"];
      $cantidadExistente=$this->cantidadEnExistencia($rs["idproductosServicios"]);
      if ($cantidadMinima<=$cantidadExistente) {
        # code...
        $productosEnMinimos[$n]=1;
        $n++;
      }
     // $productosEnMinimos[$n]
     
    }

     return  sizeof($productosEnMinimos);
}


//Sumatoria de las cantidades existentes EN LA BODEGA
public  function cantidadEnExistenciaEnBodega($productoId)
{

  $sql="SELECT SUM(unidadesExistentes) AS existencia 
                                                      FROM INVENTARIOS WHERE
                                                      idProductoServicio='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["existencia"];

}








//Sumatoria de las cantidades existentes En Punto de Venta
public  function cantidadesExistentesPuntoDeVenta($productoId)
{
   
  $sql="SELECT SUM(unidadesExistentes) AS cantidadesExistentes 
                                                      FROM  INVENTARIOS WHERE
                                                      idProductoServicio='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  if ($resultado["cantidadesExistentes"] == NULL) {
    # code...
    return 0;
  }
  else{
    return $resultado["cantidadesExistentes"];
  
  }
  
}





//Sumatoria de las cantidades existentes En Punto de Venta

//
public  function cantidadesVendidasProdicto($productoId)
{
   
  $sql="SELECT SUM(unidades) AS unidadesVendidas 
                                                      FROM  itemsFactura WHERE
                                                      idProductoServicio='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  if ($resultado["unidadesVendidas"] == NULL) {
    # code...
    return 0;
  }
  else{
    return $resultado["unidadesVendidas"];
  
  }
  
}





/*===================================
=            AJAX QUERYS            =
consulto todos los productos en  versión ajax
===================================*/

//Checkeo el SKU o Código. repetido
public function checkSkuRepetido($parametro)
{
   conectar::conexiones();
  $sql="SELECT sku FROM PRODUCTOSERVICIOS";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  //$query=$conn->query($sql);
  $query=mysql_query($sql);

  while ($rs=mysql_fetch_array($query)) {
    # code...
    if ($this->normalizacionDeCaracteres($rs['sku'])==$comparar) {
      $n++;
    }
  }
  if ($n>0) {
   $objResponse = true;
    }
    else{
      $objResponse = false;
    }
    echo json_encode($objResponse); 
    conectar::desconectar();
}




//Chequeo Productos
public function checkProductoServicioReperido($parametro)
{
   conectar::conexiones();
  $sql="SELECT nombreProductosServicios FROM PRODUCTOSERVICIOS";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  //$query=$conn->query($sql);
  $query=mysql_query($sql);

  while ($rs=mysql_fetch_array($query)) {
    # code...
    if ($this->normalizacionDeCaracteres($rs['nombreProductosServicios'])==$comparar) {
      $n++;
    }
  }
  if ($n>0) {
   $objResponse = true;
    }
    else{
      $objResponse = false;
    }
    echo json_encode($objResponse); 
    conectar::desconectar();
}


//Checkeo el SKU o Código. repetido
public function checkCliente($parametro)
{
   conectar::conexiones();
  $sql="SELECT identificacionCliente FROM  clientes";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  //$query=$conn->query($sql);
  $query=mysql_query($sql);

  while ($rs=mysql_fetch_array($query)) {
    # code...
    if ($this->normalizacionDeCaracteres($rs['identificacionCliente'])==$comparar) {
      $n++;
    }
  }
  if ($n>0) {
   $objResponse = true;
    }
    else{
      $objResponse = false;
    }
    echo json_encode($objResponse); 
    conectar::desconectar();
}




//Checkeo Producto Repetido
public function checkProductosServicios($parametro)
{
  conectar::conexiones();
  $sql="SELECT nombreProductosServicios, tipoProductoServicio FROM PRODUCTOSERVICIOS";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  $query=mysql_query($sql);
  while ($rs=mysql_fetch_array($query)) {
    # code...
    if ($this->normalizacionDeCaracteres($rs['nombreProductosServicios'])==$comparar) {
      $n++;
    }
  }
  if ($n>0) {
   $objResponse = true;
    }
    else{
      $objResponse = false;
    }

    echo json_encode($objResponse); 
 
  conectar::desconectar();
}





//JSON DE DATOS DE LOS PRODUCTOS 

public function jsonProductoServicio($sku, $nombreProductosServicios)
{
  conectar::conexiones();

  $nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
  $sku=$this->filtroStrings($sku, 1);

 $sqlProductoServicio="SELECT * FROM PRODUCTOSERVICIOS WHERE sku='".$sku."' 
                                          OR nombreProductosServicios='".$nombreProductosServicios."' AND retiroTemporal = 'no' ";
  $n=0;
  //$queryProductoServicio=$conn->query($sqlProductoServicio);
  $query=mysql_query($sqlProductoServicio);
  $rs=mysql_fetch_array($query);
  //  $rs=mysqli_fetch_array($queryProductoServicio);
  $resultado=array('idproductosServicios'=> $this->encrypt($rs['idproductosServicios'], publickey),
                    'sku'=>$rs['sku'],
                    'nombreProductosServicios'=>$rs['nombreProductosServicios'],
                    'tipoProductoServicio'=>$rs['tipoProductoServicio'],
                    'marca'=>$rs['marca'],
                    'categoria'=>$rs['categoria'],
                    'subCategoria'=>$rs['subCategoria'],
                    'serializacion'=>$rs['serializacion'],
                    'serial'=>$rs['serial'],
                    'imei'=>$rs['imei'],
                    'otroTipoSerial'=>$rs['otroTipoSerial'],
                    'valorVentaUnidad'=>$rs['valorVentaUnidad'],
                    'valorVentaPorMayor'=>$rs['valorVentaPorMayor'],
                    'impuesto'=>$rs['impuesto'],
                    'cantidadMinimaGlobal'=>$rs['cantidadMinimaGlobal'],
                    'cantidadMinimaPuntos'=>$rs['cantidadMinimaPuntos'],
                    'retiroTemporal'=>$rs['retiroTemporal']

);
    $objResponse = $resultado;
    echo json_encode($objResponse); 
  conectar::desconectar();
}



//JSON DATOS DE LOS CLIENTES 
public function jsonClientes($identificacionCliente)
{
  conectar::conexiones();

  $identificacionCliente=$this->filtroStrings($identificacionCliente, 2);
  $sku=$this->filtroStrings($sku, 1);

 $sqlCliente="SELECT * FROM clientes WHERE identificacionCliente='".$identificacionCliente."' ";
  $n=0;
  $query=mysql_query($sqlCliente);
  $rs=mysql_fetch_array($query);

  $resultado=array('idcliente'=> $this->encrypt($rs['idcliente'], publickey),
                    'nombreCliente'=>$rs['nombreCliente'],
                    'identificacionCliente'=>$rs['identificacionCliente'],
                    'telefonosCliente'=>$rs['telefonosCliente'],
                    'direccionCliente'=>$rs['direccionCliente'],
                    'emailCliente'=>$rs['emailCliente'],
                    'ciudadCliente'=>$rs['ciudadCliente']

);
    $objResponse = $resultado;
    echo json_encode($objResponse); 
 
  conectar::desconectar();
}










    /*=================================
    =            TYPERHEAD            =
    =================================*/

        //Listado de los productos para pasarlos en JSON
public function listadoProductosServicios(){
    conectar::conexiones();
     $sqlProductos="SELECT nombreProductosServicios FROM  PRODUCTOSERVICIOS";
     //$query=$conn->query($sqlProductos);
     $query=mysql_query($sqlProductos);
     $productos= array();
     $n=0;
     while ($rs=mysql_fetch_array($query)) {
       # code...
        $productos[$n]=$rs['nombreProductosServicios'];
        $n++;
     }
    $objResponse = $productos;

    echo json_encode($objResponse); 
    conectar::desconectar();
  }


//JSON SKU PRODUCTOS REGISTRADOS

  
    public function listadoJsonSku(){
    conectar::conexiones();  
     $sqlMarcas="SELECT sku, tipoProductoServicio, retiroTemporal FROM PRODUCTOSERVICIOS 
                                                  WHERE  tipoProductoServicio = 'producto'
                                                  AND retiroTemporal='si'";
     $query=mysql_query($sqlMarcas);
     $jsonSku= array();
     $n=0;
      while ($rs=mysql_fetch_array($query)) {
        $jsonSku[$n]=$rs['sku'];
        $n++;
      }
    $objResponse = $jsonSku;
    
    conectar::desconectar();
    echo json_encode($objResponse); 

  }




//Selecciono el LISTADO DE NOMBRE DE PRODUCTOS
public function listadoJsonNombreProductos(){
    conectar::conexiones();  
     $sqlMarcas="SELECT sku, nombreProductosServicios, tipoProductoServicio, retiroTemporal FROM PRODUCTOSERVICIOS 
                                                  WHERE  tipoProductoServicio = 'producto'
                                                  AND retiroTemporal='si'";
     $query=mysql_query($sqlMarcas);
     $jsonSku= array();
     $n=0;
      while ($rs=mysql_fetch_array($query)) {
        $jsonSku[$n]=$rs['nombreProductosServicios'].' |'.$rs['sku'].'';
        $n++;
      }
    $objResponse = $jsonSku;
    conectar::desconectar();
    echo json_encode($objResponse); 
  }


    public function listadoClientesIdentificacion(){
    conectar::conexiones();  
     $sqlMarcas="SELECT identificacionCliente FROM  clientes ";
     $query=mysql_query($sqlMarcas);
     $jsonSku= array();
     $n=0;
      while ($rs=mysql_fetch_array($query)) {
        $jsonSku[$n]=$rs['identificacionCliente'];
        $n++;
      }
    $objResponse = $jsonSku;
    
    conectar::desconectar();
    echo json_encode($objResponse); 

  }





  //Listado de provedores
    public function listadoJsonProvedores(){
    conectar::conexiones();  
      //$usuario=$this->encrypt($usuario, key);
     $sqlMarcas="SELECT nombreProvedor FROM  provedores";
     $query=mysql_query($sqlMarcas);
     $provedores= array();
     $n=0;
    while ($rs=mysql_fetch_array($query)) {
      $provedores[$n]=$rs['nombreProvedor'];
      $n++;
    }
    $objResponse = $provedores;
    
    conectar::desconectar();
    echo json_encode($objResponse); 

  }

/*
public function listadoClientesIdentificacion(){
    conectar::conexiones();  
     $sqlMarcas="SELECT sku, tipoProductoServicio, retiroTemporal FROM PRODUCTOSERVICIOS 
                                                  WHERE  tipoProductoServicio = 'producto'
                                                  AND retiroTemporal='si'";
     $query=mysql_query($sqlMarcas);
     $jsonSku= array();
     $n=0;
      while ($rs=mysql_fetch_array($query)) {
        $jsonSku[$n]=$rs['sku'];
        $n++;
      }
    $objResponse = $jsonSku;
    
    conectar::desconectar();
    echo json_encode($objResponse); 

  }

*/

//Typerhead Marcas
  public function listadoJsonMarcas(){
   conectar::conexiones();  
     $sqlMarcas="SELECT nombreMarca FROM  marcas";
     $query=mysql_query($sqlMarcas);
     $marcas= array();
     $n=0;
    while ($rs=mysql_fetch_array($query)) {
      $marcas[$n]=$rs['nombreMarca'];
      $n++;
    }
    $objResponse = $marcas;
    
    conectar::desconectar();
    echo json_encode($objResponse); 

  }



    /*=====  End of TYPERHEAD  ======*/






/*=====  End of AJAX QUERYS  ======*/







//Sumo las cantidades compradas en el último mes
public function cantidadCompradaUltimoMes($productoId)
{

  $sql="SELECT SUM(inventarioConvenioCantidadComprada) AS cantidadesCompradas 
                                                      FROM inventarioConvenio WHERE
                                                      productoId='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
  
  $resultado = mysql_fetch_assoc(mysql_query($sql)); 
  return $resultado["cantidadesCompradas"];
}




//Defino las medidas segun el producto
public  function definicionMedida($parametro)
{

  $sql="SELECT productoId, inventarioConvenioMedida FROM inventarioConvenio WHERE productoId='".intval($parametro)."'";
  $rs=mysql_fetch_array(mysql_query($sql));
  $parametro=$rs["inventarioConvenioMedida"];

  return $this->stringMedidas($parametro);

}






//Alerta sobre los minimos de cada producto
public function alertaEstadosMinimosProductos($productoId)
{

  $existencia=$this->cantidadEnExistenciaEnBodega($productoId);
  $minimoEstablecido=$this->consultaDatosProducto($productoId, "cantidadMinima");

  if ($existencia>$minimoEstablecido) {
    # code...
    return "Hay suficientes Existencias";
  }
  elseif ($existencia<=$minimoEstablecido) {
    # code...
    return "<p class='text-danger'> <i class='fa fa-warning'></i><b>Se pasó el mínimo establecido</b></p>";
  }

}





//Muestro los iconos que correspondan al mostrar en listado el producto o servicio o no
public function iconoShowMeProductoServicio($parametro){
  if ($parametro=='si') {
    # code...
    return '<i class="fa fa-check-circle text-success"></i>';
  }
  else{
    return '<i class="fa fa-minus-circle text-danger"></i>';
  }


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





//String para las medidas cuando necesariamente tengo que bajarlas a si divisor por 1000
public  function stringMedidasMinimizadas($parametro)
{
  if ($parametro==1) {
    # unidades...
    return "Unidades";
  }
  elseif ($parametro==2) {
    # code...
    return "Gramos";
  }
  elseif ($parametro==3) {
    # code...
    return "Gramos";
  }
  elseif ($parametro==4) {
    # code...
    return "Mililitros";
  }

  elseif ($parametro==5) {
    # code...
    return "Mililitros";
  }
}

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

public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER , "UTF-8")));

}

private function remplazartildesyotros($parametro) {
    $encontrar = array("á", "é", "í", "ó", "ú", " ", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ä", "Ë", "Ï", "Ö", "Ü", "ä", "ë", "ï", "ö", "ü");
    $remplazar = array("a", "e", "i", "o", "u", "_", "n", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u");
    return str_ireplace($encontrar, $remplazar, $parametro);
  }
private function filtrocaracteres($parametro){
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



private function espacioPorGuion($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "_");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}



}