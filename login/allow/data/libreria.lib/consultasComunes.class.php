<?php
class consultasComunes extends conectar {


//**********************LISTA DE LAS CONSULTAS COMUNES DE LOS CONVENIOS****************************//

/*******************************[CONSULTAS SQLS Y ENVIOS DE QUERYS]*********************************/

public function sqlConvenioAdmin($id)
  {
    conectar::conexiones();
    $id=$this->decrypt($id, key);
    $sql = "SELECT * FROM usuarios  where idusuario='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
  }

//Datos de la empresa
public function sqlDatosEmpresa(){
    $sql = "SELECT * FROM  datosEmpresa ";
    return mysql_query($sql);
}


//Consultas de los datos del cliente
public function sqlCliente($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM clientes  where idcliente='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}



//Consultas de los datos del cliente
public function sqlProvedor($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM provedores  where idprovedor='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}



//Consultas de los datos del cliente
public function sqlFactura($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM facturacion  where idFactura='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}



//Consultas de los datos del provedor
public function sqlFacturaProvedor($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM facturasProvedores  where idfacturaProvedor='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}




//Consultas de los datos del cliente
public function sqlCaja($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM cajas  where idcaja='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}



//Consultas de los datos de los bancos
public function sqlBanco($id)
{
    conectar::conexiones();
    $id=$this->decrypt($id, publickey);
    $sql = "SELECT * FROM bancos  where idBanco='".intval($id)."'";
    return mysql_query($sql);
    conectar::desconectar();
}






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



    case 'direccionCliente':
      # code...
      return $rs["direccionCliente"];
      break;

      


    case 'telefonosCliente':
      # code...
      return $rs["telefonosCliente"];
      break;


    case 'emailCliente':
      # code...
      return $rs["emailCliente"];
      break;

    case 'ciudadCliente':
      # code...
      return $rs["ciudadCliente"];
      break;



    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}





public function datosProductoBancario($parametro, $vector)
{
  
  conectar::conexiones();

  $idCliente=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM  productoBancario WHERE idProductoBancario='".$idCliente."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

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
      return "-";
      break;
  }

  conectar::desconectar();
}






//*****************DATOS PROVEDORES ****************************/

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


//DATOS FACTURA
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
/**************DATOS DEL BANCO**************************/

public function datosBanco($parametro, $vector)
{
  

  $idBanco=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM bancos WHERE idBanco='".$idBanco."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

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


/***************consultas de productos */
public function consultaDatosProducto($parametro, $vector)
{
  $idproductosServicios=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM  PRODUCTOSERVICIOS WHERE idproductosServicios='".$idproductosServicios."'";
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

}




//*********************+CONSULTA DATOS FACTURA******************//

public function consultaDatosFactura($parametro, $vector)
{
  $idFactura=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM  facturacion WHERE idFactura='".$idFactura."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'nroFactura':
      # code...
      return $rs["nroFactura"];
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

    case 'separada':
      # code...
      return $rs["separada"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

}



//Datos de las cajas
public function consultaDatosCaja($idcaja, $vector)
{

  $idCaja=$this->filtroNumerico($idcaja);
  $sqlConsultaCaja="SELECT *  FROM cajas WHERE idcaja=$idCaja";
  $queryCajas=mysql_query($conn, $sqlConsultaCaja);
  $rs=mysql_fetch_array($queryCajas);
  

  switch ($vector) {


    case 'fechaAperturaCaja':
      # code...
      return $rs["fechaAperturaCaja"];
      break;

    case 'fechaCierreCaja':
      # code...
      return $rs["fechaCierreCaja"];
      break;

    case 'valorBase':
      # code...
      return $rs["valorBase"];
      break;

    case 'valorGastosEgresos':
      # code...
      return $rs["valorGastosEgresos"];
      break;

    case 'valorEfectivo':
      # code...
      return $rs["valorEfectivo"];
      break;

    case 'valorEnDocumentos':
      # code...
      return $rs["valorEnDocumentos"];
      break;

    case 'diferencia':
      # code...
      return $rs["diferencia"];
      break;

    case 'tokenCierre':
      # code...
      return $rs["tokenCierre"];
      break;

    case 'estado':
      # code...
      return $rs["estado"];
      break;

    default:
      # code...
      return "No hay datos :(";
      break;


    }
}





public function actualizarVentas(){
  $n=1;
  $sql="SELECT idFactura FROM facturacion WHERE idFactura>=240";
  $query=mysql_query($sql);
  while ($rs=mysql_fetch_array($query)) {//Inicio del recorrido

    $sqlItems="SELECT idFactura, idProductoServicio, unidades FROM  itemsFactura
      where idFactura='".$rs['idFactura']."'";
      $queryItem=mysql_query($sqlItems);
      while ( $rsItem=mysql_fetch_array($queryItem)) {
        # code...
         $sqlInventario="SELECT idProductoServicio, unidadesExistentes FROM  INVENTARIOS
                              WHERE idProductoServicio='".$rsItem['idProductoServicio']."'";
          $queryInventario=mysql_query($sqlInventario);
          $rsInventario=mysql_fetch_array($queryInventario);

          $unidadesExistentes= $rsInventario['unidadesExistentes'];
          $unidadesVendidas=$rsItem['unidades'];

          $unidadesActuales=$unidadesExistentes-$unidadesVendidas;

          echo "Factura: ".$rs['idFactura']."<br>";
          echo 'Unidades Existentes:'.$unidadesExistentes."<br>";
          echo 'Unidades Vendidas:'.$unidadesVendidas."<br>";
          echo $sqlActualizacion="UPDATE  INVENTARIOS SET unidadesExistentes='".$unidadesActuales."' WHERE idProductoServicio='".$rsItem['idProductoServicio']."'";

          echo "<hr><br>";
          $queryActualizacion=mysql_query($sqlActualizacion);
      }
      

     $n++;

  }//Fin del recorrido
}







//Datos de un cliente




//***************************************LISTAS*************************************/




//Lista de todas las ventas
public  function listaVentas($fecha)
{
  $sql="SELECT idFactura, nroFactura, fechaFactura, valorTotalFactura, estadoFactura, idCliente FROM  facturacion WHERE fechaFactura LIKE '".$fecha."%' ";
  
  //Aqui va el condicional para filtrar por fechas
  $query=mysql_query($sql);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th>Nro Factura</th>
                  <th>Fecha Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">'.$rs["nroFactura"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorTotalFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
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

}






//LISTA DE LAS FACTURAS
public  function listaFacturas($parametros)
{
  conectar::conexiones();
  extract($parametros);
  $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE nroFactura != 'NULL'  ORDER BY(nroFactura) DESC ";
  //Aqui va el condicional para filtrar por fechas
  $query=mysql_query($sqlFactura);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th><div align="center">Nro Factura</div></th>
                  <th>Fecha Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">'.$rs["nroFactura"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
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

}






//LISTA DE LAS FACTURAS
public  function listaFacturasMetodoPago($parametros)
{
  conectar::conexiones();
  extract($parametros);

  if ($tipo=='efectivo') {
    # code...
    $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE nroFactura != 'NULL' AND tipoPago='efectivo' AND idCajaCierre = ".$this->decrypt($idHistorico, publickey)." ORDER BY(nroFactura) DESC ";

        echo '<h1 align ="center">Compras Con Efectivo</h1>';

  }elseif ($tipo == 'tarjetas credito') {
    # code...
    $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE nroFactura != 'NULL' AND tipoPago='tarjeta credito' AND idCajaCierre = ".$this->decrypt($idHistorico, publickey)."  ORDER BY(nroFactura) DESC ";

        echo '<h1 align ="center">Compras Con Tarjeta Crédito</h1>';

  }elseif ($tipo == 'tarjetas debito') {
    # code...
    $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE nroFactura != 'NULL' AND tipoPago='tarjeta debito'  AND idCajaCierre = ".$this->decrypt($idHistorico, publickey)." ORDER BY(nroFactura) DESC ";


    echo '<h1 align ="center">Compras Con Tarjeta Débito</h1>';
  }


  //Aqui va el condicional para filtrar por fechas
  $query=mysql_query($sqlFactura);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th><div align="center">Nro Factura</div></th>
                  <th>Fecha Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">'.$rs["nroFactura"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
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



}



//FACTURAS CON BÚSQUEDA
public  function listaFacturasBusqueda($parametros)
{
    conectar::conexiones();
    extract($parametros);
    $filtroBusquedaFactura=mysql_escape_string($filtroBusquedaFactura);
    if ($filtroBusquedaFactura=='nombreCliente') {
      # //Solo busco con nombres...
      $nombreClienteFacturas=$this->filtroStrings($nombreClienteFacturas,2);
      $sqlClientes="SELECT idCliente, nombreCliente FROM clientes WHERE nombreCliente LIKE '%".$nombreClienteFacturas."%' ";
      $queryClientes=mysql_query($sqlClientes);
    

    }//Fin buscar por nombre
    elseif ($filtroBusquedaFactura=='nroFactura') {
      # Solo busco con el número de la factura...
      $nroFactura=$this->filtroNumerico($this->normalizacionDeCaracteres($nroFactura));
      $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE nroFactura = $nroFactura ";
    }//fin buscar por nro factura
    elseif ($filtroBusquedaFactura=='rangoFecha') {
      # búsco entre rángos de fecha...
      $inicioFechaFactura=mysql_escape_string($this->formatoFecha($inicioFechaFactura));
      $finalFechaFactura=mysql_escape_string($this->formatoFecha($finalFechaFactura));



      $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente FROM  facturacion WHERE nroFactura>0 AND fechaFactura BETWEEN '".$inicioFechaFactura." 00:00:00' AND '".$finalFechaFactura." 23:59:59'  ";


      echo "<div class='col-md-12' align='center'> <h2>Estos son los resultados de las facturas entre el ".$inicioFechaFactura." y el ".$finalFechaFactura." <br><i class='fa fa-arrow-down'></i> </h2> </div>";
    }//fin buscar por fecha
      //Aqui va el condicional para filtrar por fechas
 
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th><div align="center">Nro Factura</div></th>
                  <th>Fecha Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';

      if ($filtroBusquedaFactura=='nombreCliente') {
        # code...
        while ($rsCliente=mysql_fetch_array($queryClientes)) {
          # code...
          $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE idCliente = ".$rsCliente['idCliente'] ."  AND nroFactura>0";

          $query=mysql_query($sqlFactura);
          while ($rs=mysql_fetch_array($query)) {
            # code...
            $fecha=explode(" ", $rs["fechaFactura"]);
            echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">'.$rs["nroFactura"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$id.'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';
          }
          
          

        }
      exit();
      }

      $query=mysql_query($sqlFactura);
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">'.$rs["nroFactura"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$id.'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
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

}





//List de la factura bloque

public function listaFacturasBloque($parametros){
   conectar::conexiones();
    extract($parametros);
    $filtroBusquedaFactura=mysql_escape_string($filtroBusquedaFactura);
    if ($filtroBusquedaFacturaBloque=='nombreClienteBloque') {
      # //Solo busco con nombres...
      $nombreClienteFacturasBloque=$this->filtroStrings($nombreClienteFacturasBloque,2);
      $sqlClientes="SELECT idCliente, nombreCliente FROM clientes WHERE nombreCliente LIKE '%".$nombreClienteFacturasBloque."%' ";
      $queryClientes=mysql_query($sqlClientes);
    

    }
    elseif ($filtroBusquedaFacturaBloque=='rangoFechaBloque') {
      # búsco entre rángos de fecha...
      $inicioFechaFacturaBloque=mysql_escape_string($this->formatoFecha($inicioFechaFacturaBloque));
      $finalFechaFacturaBloque=mysql_escape_string($this->formatoFecha($finalFechaFacturaBloque));



      $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, incremento FROM  facturacion WHERE nroFactura>0 AND fechaFactura BETWEEN '".$inicioFechaFacturaBloque." 00:00:00' AND '".$finalFechaFacturaBloque." 23:59:59'  ";

    }//fin buscar por fecha
      //Aqui va el condicional para filtrar por fechas
    if ($filtroBusquedaFacturaBloque=='nombreClienteBloque') {
      while ($rsCliente=mysql_fetch_array($queryClientes)) {
          $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura, incremento FROM  facturacion WHERE idCliente = ".$rsCliente['idCliente'] ."  AND nroFactura>0";

          $query=mysql_query($sqlFactura);
          while ($rs=mysql_fetch_array($query)) {
              $this->tiposFacturas($rs['idFactura'], "mediaCarta", "Factura", $rs['incremento']);
              echo "<hr>";
          }
      }
    }
    else
    {
      $query=mysql_query($sqlFactura);
      while ($rs=mysql_fetch_array($query)) {
        $this->tiposFacturas($rs['idFactura'], "mediaCarta", "Factura", $rs['incremento']);
        echo "<hr>";
        # code...
      }
    }

}
//FIN DE LISTA DE FACTURAS






//LISTA DE LAS CUENTAS DE COBRO


//LISTA DE LAS FACTURAS
public  function listaCuentaCobro($parametros)
{
  conectar::conexiones();
  extract($parametros);
  $sqlFactura="SELECT idFactura, nroFactura, fechaFactura, valorFactura, estadoFactura, idCliente, nroCotizacion FROM  facturacion WHERE nroCotizacion != 'NULL' ";
  //Aqui va el condicional para filtrar por fechas
  $query=mysql_query($sqlFactura);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th><div align="center">Nro Factura</div></th>
                  <th>Fecha Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">C-'.$rs["nroCotizacion"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
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

}



public  function listaCuentaCobroBusqueda($parametros)
{
  conectar::conexiones();

    extract($parametros);
    $filtroBusquedaCuentaCobro=mysql_escape_string($filtroBusquedaCuentaCobro);

    if ($filtroBusquedaCuentaCobro=='nombreClienteCuentaDeCobro') {
      # //Solo busco con nombres...
      $nombreClienteCuentaDeCobro=$this->filtroStrings($nombreClienteCuentaDeCobro,2);
      $sqlClientes="SELECT idCliente, nombreCliente FROM clientes WHERE nombreCliente LIKE '%".$nombreClienteCuentaDeCobro."%' ";
      $queryClientes=mysql_query($sqlClientes);
    

    }//Fin buscar por nombre
    elseif ($filtroBusquedaCuentaCobro=='nroCuentaDeCobro') {
      # Solo busco con el número de la factura...

      
      $nroCuentaCobro=$this->filtroNumerico($this->normalizacionDeCaracteres($nroCuentaCobro));
      $sqlFactura="SELECT idFactura, nroCotizacion, fechaFactura, valorFactura, estadoFactura, idCliente, nroCotizacion FROM  facturacion WHERE nroCotizacion = $nroCuentaCobro ";
    }//fin buscar por nro factura
    elseif ($filtroBusquedaCuentaCobro=='rangoFecha') {
      # búsco entre rángos de fecha...
      $inicioFechaFacturaCuentaCobro=mysql_escape_string($this->formatoFecha($inicioFechaFacturaCuentaCobro));
      $finalFechaFacturaCuentaCobro=mysql_escape_string($this->formatoFecha($finalFechaFacturaCuentaCobro));



      $sqlFactura="SELECT idFactura, nroCotizacion, fechaFactura, valorFactura, estadoFactura, idCliente FROM  facturacion WHERE nroCotizacion>0 AND fechaFactura BETWEEN '".$inicioFechaFacturaCuentaCobro." 00:00:00' AND '".$finalFechaFacturaCuentaCobro." 23:59:59'  ";


      echo "<div class='col-md-12' align='center'> <h2>Estos son los resultados de las facturas entre el ".$inicioFechaFacturaCuentaCobro." y el ".$finalFechaFacturaCuentaCobro." <br><i class='fa fa-arrow-down'></i> </h2> </div>";
    }//fin buscar por fecha

  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th><div align="center">Nro Cuenta de Cobro</div></th>
                  <th>Fecha Cuenta de Cobro</th>
                  <th>Valor Cuenta de Cobro</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';

      if ($filtroBusquedaCuentaCobro=='nombreClienteCuentaDeCobro') {
        # code...
        while ($rsCliente=mysql_fetch_array($queryClientes)) {
          # code...
          $sqlFactura="SELECT idFactura, nroCotizacion, fechaFactura, valorFactura, estadoFactura, idCliente, nroFactura FROM  facturacion WHERE idCliente = ".$rsCliente['idCliente'] ."  AND nroCotizacion>0";

          $query=mysql_query($sqlFactura);
          ;
          while ($rs=mysql_fetch_array($query)) {
            # code...
            $fecha=explode(" ", $rs["fechaFactura"]);
            echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">C-'.$rs["nroCotizacion"].'</td><!-- Nro de Factura -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$id.'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';
          }
          
          

        }
      exit();
      }

      $query=mysql_query($sqlFactura);
       while ($rs=mysql_fetch_array($query)) {
        $fecha=explode(" ", $rs["fechaFactura"]);
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idCliente"], "nombreCliente").' </td><!-- Nombre del Clienre-->
                 
                  <td  align="center">'.$this->consultaDatosCliente($rs["idCliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center"> C-'.$rs["nroCotizacion"].'</td><!-- Nro de Cuenta de Cobro -->


                  <td>'.$fecha[0].'</td><!-- Fecha de la Factura -->
                 
                  <td>$'.number_format($rs["valorFactura"]).'</td><!-- Valor de la Factura-->
                  
                  <td>'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$id.'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
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

}

//FIN DE LA LISTA DE LAS CUENTAS DE COBRO 








//Listas de los clientes que han comprado a ese convenio
public  function listaMisClientes($id)
{
  $sql="SELECT * FROM clientes";


  $query=mysql_query($sql);
  echo '<table id="tablaClientes" class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th align="center">Identificación</th>
                  <th>Compas</th>
                  <th>Deudas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
       
          echo '<tr>                  
                  <td>'.$this->consultaDatosCliente($rs["idcliente"], "nombreCliente").'</td><!-- Nombre del Clienre-->
                 
                  <td align="center">'.$this->consultaDatosCliente($rs["idcliente"], "identificacionCliente").'</td><!-- Identificación -->
                 
                  <td align="center">$ '.number_format($this->totalComprasCliente($rs["idcliente"])).'</td><!-- Valor de la Factura-->
                 
                  <td align="center">$ '.number_format($this->totalDeudaCliente($rs["idcliente"])).'</td><!-- Valor de la Factura-->
                  
                    
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/asociados/perfilCliente.php?id='.$id.'&idCliente='.$this->encrypt($rs["idcliente"], publickey).'" >
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

}




//Listas de los clientes que han comprado a ese convenio
public  function listaMisUsuarios($id)
{
  $sql="SELECT * FROM  usuarios";
  $query=mysql_query($sql);
  echo '<table id="tablaClientes" class="table table-striped">
              <thead>
                <tr>
                  <th><div style="text-align:center">Nombre</div></th>
                  <th><div style="text-align:center">Codigo</div></th>
                  <th><div style="text-align:center">Email</div></th>
                  <th><div style="text-align:center">Tipo</div></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
       
          echo '<tr>                  
                  <td>'.$rs["nombre"].'</td><!-- Nombre del usuario-->
                 
                  <td align="center">'.$rs["codigo"].'</td><!-- codigo de empleado -->
                 
                  <td align="center">'.$rs["email"].'</td><!-- Correo Electrónico-->
                 
                  <td align="center">'.$rs["tipoUsuario"].'</td><!-- Valor de la Factura-->
                  
                    
                 
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/settings/link.php?idUsuario='.$this->encrypt($rs["idusuario"], publickey).'" >
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

}






//LISTADO DE LOS ABONOS HECHOS A UNA FACTURA

public function listaAbonosFactura($idFactura)
{

  $idFactura=$this->filtroNumerico($idFactura);
  $sql="SELECT idFactura, valorAbono, fechaAbono FROM abonoFacturas WHERE idFactura=$idFactura ";
  $query=mysql_query($sql);

  echo '<h2 align="center"><i class="fa fa-book"></i>Abonos Hechos</h2>
    <table class="table">
                <thead>
                  <tr>
                    <th>Fecha del Abono</th>
                    <th>Valor Abono</th>
                  </tr>
                </thead>
            <tbody> 

        ';
  while ($rs=mysql_fetch_array($query)) {

    echo '<tr>
              <td>'.$rs['fechaAbono'].'</td>
              <td align="center">$ '.number_format($rs['valorAbono']).'</td>
        </tr>';
      }
  echo '          </tbody>
      </table>';

}




//listo los abonos hechos a  una factura de algún provedor
public function listaAbonosFacturaProvedor($idFactura)
{

  $idFactura=$this->filtroNumerico($idFactura);
  $sql="SELECT idFacturaProvedor, valorAbonoFactura, fechaAbonoFactura FROM abonosFacturaProvedor WHERE idFacturaProvedor=$idFactura ";
  $query=mysql_query($sql);

  echo '<h2 align="center"><i class="fa fa-book"></i>Abonos Hechos A Esta Factura</h2>
    <table class="table">
                <thead>
                  <tr>
                    <th>Fecha del Abono</th>
                    <th>Valor Abono</th>
                  </tr>
                </thead>
            <tbody> 

        ';
  while ($rs=mysql_fetch_array($query)) {

    echo '<tr>
              <td>'.$rs['fechaAbonoFactura'].'</td>
              <td align="center">$ '.number_format($rs['valorAbonoFactura']).'</td>
        </tr>';
      }
  echo '          </tbody>
      </table>';

}



//Listado de los ingresos que aún están sin cerrar
  public function listaIngresosSinCerrar(){

  $sqlFacturas="SELECT nroFactura, valorFactura, tipoPago, separada, liquidada FROM  facturacion WHERE liquidada='1' AND separada='no'";
  $sqlAbonos="SELECT idFactura, valorAbono, tipoPago FROM abonoFacturas WHERE liquidada='1' ";
  $queryFacturas=mysql_query($sqlFacturas);
  $queryAbonos=mysql_query($sqlAbonos);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Nro Factura</th>
                    <th>Tipo Pago</th>
                    <th>Valor</th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsFacturas=mysql_fetch_array($queryFacturas)) {
        # code...
        echo '<tr>
              <td align="center">'.$rsFacturas['nroFactura'].'</td>
              <td align="center">'.$rsFacturas['tipoPago'].'</td>
              <td align="center">$ '.number_format($rsFacturas['valorFactura']).'</td>
        </tr>';
      }
      //While Abonos
      while ($rsAbonos=mysql_fetch_array($queryAbonos)) {
        # code...
         echo '<tr>
              <td align="center" class="text-danger"><b>'.$this->consultaDatosFactura($rsAbonos['idFactura'],"nroFactura").'</b></td>
              <td align="center">'.$rsAbonos['tipoPago'].'</td>
              <td align="center">$ '.number_format($rsAbonos['valorAbono']).'</td>
        </tr>';
      }
  echo '</tbody>
      </table>';
  }



  //Listado de los ingresos que aún están sin cerrar
  public function listaIngresosCerrados($idcaja){

  $idcaja=$this->filtroNumerico($idcaja);
  $sqlFacturas="SELECT idFactura, nroFactura, valorFactura, tipoPago, separada, nroCotizacion, idCajaCierre, valorIncremento FROM  facturacion WHERE idCajaCierre=$idcaja AND separada='no'";
  


  $sqlAbonos="SELECT idFactura, valorAbono, tipoPago, idCajaCierre FROM abonoFacturas WHERE idCajaCierre=$idcaja ";
  $queryFacturas=mysql_query($sqlFacturas);
  $queryAbonos=mysql_query($sqlAbonos);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Nro Factura</th>
                    <th>Tipo Pago</th>
                    <th>Valor</th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsFacturas=mysql_fetch_array($queryFacturas)) {
        # code...
        if ($rsFacturas['nroFactura']!=NULL) {
          # code...
          $nro=$rsFacturas['nroFactura'];
        }
        else{
            $nro= '<div class="text-danger">C-'.$rsFacturas['nroCotizacion'].'</div>';
        }
        echo '
        
          <tr>
                <td align="center"><a href="'.$this->datospagina(5).'/modulos/ventas/facturaCliente.php?id='.$_REQUEST['id'].'&idFactura='.$this->encrypt($rsFacturas['idFactura'], publickey).'">'.$nro.'</a></td>
                <td align="center">'.$rsFacturas['tipoPago'].'</td>
                <td align="center">$ '.number_format($rsFacturas['valorFactura']+$rsFacturas['valorIncremento']).'</td>
          </tr>
        ';
      }
      //While Abonos
      while ($rsAbonos=mysql_fetch_array($queryAbonos)) {
        # code...
         echo '
          <a href="'.$this->datospagina(5).'/">
           <tr>
                <td align="center" class="text-danger"><a href="'.$this->datospagina(5).'/modulos/ventas/facturaCliente.php?id='.$_REQUEST['id'].'&idFactura='.$this->encrypt($rsAbonos['idFactura'], publickey).'"><b>'.$this->consultaDatosFactura($rsAbonos['idFactura'],"nroFactura").'</b></a></td>
                <td align="center">'.$rsAbonos['tipoPago'].'</td>
                <td align="center">$ '.number_format($rsAbonos['valorAbono']).'</td>
          </tr>
        </a>
          ';
      }
  echo '</tbody>
      </table>';
  }






//LISTADO DE LOS EGRESOS QUE NO SE HAN LIQUIDADO
public function listaEgresosSinCerrar(){

   $sqlEgreso="SELECT tipoEgresoGasto, descripcion, valorEgresoGasto,liquidada FROM egresosGastos    WHERE liquidada='1'";
  $queryEgreso=mysql_query($sqlEgreso);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsEgreso=mysql_fetch_array($queryEgreso)) {
        # code...
        echo '<tr>
              <td align="center">'.$rsEgreso['tipoEgresoGasto'].'</td>
              <td align="center">'.$rsEgreso['descripcion'].'</td>
              <td align="center">$ '.number_format($rsEgreso['valorEgresoGasto']).'</td>
        </tr>';
      }
     
  echo '</tbody>
      </table>';
  }



//LISTADO DE LOS EGRESOS QUE NO SE HAN LIQUIDADO
public function listaEgresosCerrados($idcaja){

  $idcaja=$this->filtroNumerico($idcaja);
   $sqlEgreso="SELECT tipoEgresoGasto, descripcion, valorEgresoGasto,idCajaCierre FROM egresosGastos    WHERE idCajaCierre=$idcaja";
  $queryEgreso=mysql_query($sqlEgreso);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsEgreso=mysql_fetch_array($queryEgreso)) {
        # code...
        echo '<tr>
              <td align="center">'.$rsEgreso['tipoEgresoGasto'].'</td>
              <td align="center">'.$rsEgreso['descripcion'].'</td>
              <td align="center">$ '.number_format($rsEgreso['valorEgresoGasto']).'</td>
        </tr>';
      }
     
  echo '</tbody>
      </table>';
  }











//Listado de los productos bancarios que hay creados

  public function listaProductosBancarios($parametro){

  
  if (isset($parametro)) {
    # code...
     $idBanco=$this->filtroNumerico($parametro);
     $sqlBancos="SELECT * FROM  productoBancario  where idBanco=$idBanco";
  }
  else
  {
     $sqlBancos="SELECT * FROM  productoBancario ";
  }
  
  $query=mysql_query($sqlBancos);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th ><div style="text-align:center">Banco</div></th>
                    <th ><div style="text-align:center">Tipo de Producto</div></th>
                    <th ><div style="text-align:center">Descripción</div></th>
                    <th ><div style="text-align:center">Saldo</div></th>
                    <th ><div style="text-align:center">Deuda</div></th>
                    <th ><div style="text-align:center"></th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsProductoBancario=mysql_fetch_array($query)) {
        # code...
        echo '<tr>
              <td align="center">'.$this->iconoCssActivadoDesactivado($rsProductoBancario['activada']).'</td>
              <td align="center">'.$this->datosBanco($rsProductoBancario['idBanco'], 'nombreBanco').'</td>
              <td align="center">'.$rsProductoBancario['tipo'].'</td>
              <td align="center">'.$rsProductoBancario['descripcion'].'</td>
              <td align="center">$ '.number_format($rsProductoBancario['saldo']).'</td>
              <td align="center">$ '.number_format($rsProductoBancario['deuda']).'</td>
              <td align="center">
                  <a href="'.$this->datospagina(5).'/modulos/contabilidad/productoBancario.php?id='.$_REQUEST['id'].'&idBanco='.$this->encrypt($rsProductoBancario['idBanco'], publickey).'">
                      <button class="btn btn-outline btn-info waves-effect waves-light">
                          <i class="fa  fa-search-plus m-r-5"></i>
                          <span>Muestrame Mas</span>
                      </button>


                  </a>
              </td>
        </tr>';
      }
     
  echo '</tbody>
      </table>';
  }






//Lista de los movimientos bancarios

  public function listaMovimientosBancarios($parametro){

  
  if (isset($parametro)) {
    # code...
     $idBanco=$this->filtroNumerico($parametro);
     $sqlmovimientoBancario="SELECT * FROM  operacionesMovimientosBancarios  where idBanco=$idBanco";
  }
  else
  {
     $sqlBancos="SELECT * FROM  operacionesMovimientosBancarios ";
  }
  
  $query=mysql_query($sqlmovimientoBancario);

  echo '<table class="table">
                <thead>
                  <tr>
                    <th ><div style="text-align:center">Fecha Operación</div></th>
                    <th ><div style="text-align:center">Producto Relacionado</div></th>
                    <th ><div style="text-align:center">Descripción del Movimiento</div></th>
                    <th ><div style="text-align:center">Valor Movimiento</div></th>
                  </tr>
                </thead>
            <tbody> ';

    //Whiles Facturas
      while ($rsMovimientoBancario=mysql_fetch_array($query)) {
        # code...
        echo '<tr>
              <td align="center">'.$rsMovimientoBancario['fechaOperacion'].'</td>
              <td align="center">'.$this->datosProductoBancario($rsMovimientoBancario['idProductoBancario'], 'descripcion').'</td>
              <td align="center">'.$rsMovimientoBancario['descripcionOperacion'].'</td>
              <td align="center">$ '.number_format($rsMovimientoBancario['valorOperacion']).'</td>
              
        </tr>';
      }
     
  echo '</tbody>
      </table>';
  }








//Listas de las compras del cliente en ese convenio
public  function historicoCompras()
{
  $sql="SELECT idFactura, fechaFactura, nroFactura, estadoFactura, valorTotalFactura, deudaFactura  FROM   facturacion WHERE idCliente='".$this->decrypt($_SESSION["IDCLIENTE"], publickey)."'";


  $query=mysql_query($sql);
  echo '<table id="tablaClientes" class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nro</th>
                  <th><div style="text-align:center">Estado de Cuenta</div></th>
                  <th><div style="text-align:center">Deuda</div></th>
                  <th><div style="text-align:center">Valor</div></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
       
          echo '<tr>                  
                  <td>'.$rs["fechaFactura"].'</td><!-- Fecha Factura-->
                  <td align="center">'.$rs["nroFactura"].'</td><!-- nro Factura-->
                  <td align="center">'.$this->estadoCuentaCss($rs["estadoFactura"]).'</td><!-- Estado de la factura -->
                  <td align="center"> $'.number_format($rs['deudaFactura']).'
                  </td>
                  <td align="center">$ '.number_format($rs["valorTotalFactura"]).'</td><!-- Valor de la Factura-->
                  <td>
                  

                   <a href="'.$this->datospagina(5).'modulos/ventas/facturaCliente.php?id='.$id.'&idFactura='.$this->encrypt($rs["idFactura"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                     
                    </button>
                    </a>


                  </td><!-- Propiedades -->
                
                </tr>
               ';


               }

     echo '  </tbody>
            </table>';

}



//LISTA DE INVENTARIOS




//**********************CONSULTAS INTERNAS *****************************//

public function verificacionCreditos($idCliente)
{
  conectar::conexiones();
  //Codigo para la verificación del créditos
  conectar::desconectar();
}









//Defino las medidas segun el producto
public  function definicionMedida($parametro)
{

  $sql="SELECT productoId, inventarioConvenioMedida FROM inventarioConvenio WHERE productoId='".intval($parametro)."'";
  $rs=mysql_fetch_array(mysql_query($sql));
  $parametro=$rs["inventarioConvenioMedida"];

  return $this->stringMedidas($parametro);

}









//Indicadores


//Indico las ventas del día QUE  no esten liquidadas
public  function ventasHoy()
{
  //$fechaActualFija=fechaActualFija;
  $sql="SELECT SUM(valorFactura) AS resultadoSumaPagadas FROM facturacion 
    WHERE fechaFactura LIKE '".date("Y-m-d")."%'
    AND estadoFactura='pagada' AND  separada='no' AND liquidada='1' ";

  $sqlAbonos="SELECT SUM(valorAbono) AS resultadoAbonos FROM abonoFacturas 
    WHERE fechaAbono = '".date("Y-m-d")."'  AND liquidada='1' ";


  $facturas = mysql_fetch_assoc(mysql_query($sql)); 
  $abonos = mysql_fetch_assoc(mysql_query($sqlAbonos));  
  return  $facturas["resultadoSumaPagadas"]+$abonos['resultadoAbonos'];


}




//Indico las ventas que se han hecho y no se han liquidado
public  function ventasSinLiquidar()
{
  //$fechaActualFija=fechaActualFija;
  $sql="SELECT SUM(valorFactura) AS resultadoSumaPagadas FROM facturacion 
    WHERE estadoFactura='pagada' AND  separada='no' AND liquidada='1'";

  $sqlAbonos="SELECT SUM(valorAbono) AS resultadoAbonos FROM abonoFacturas 
    WHERE fechaAbono = '".date("Y-m-d")."' AND liquidada='1'";


  $facturas = mysql_fetch_assoc(mysql_query($sql)); 
  $abonos = mysql_fetch_assoc(mysql_query($sqlAbonos));  
  return  $facturas["resultadoSumaPagadas"]+$abonos['resultadoAbonos'];

}






//Indico las ventas que se se hicieron en este ciclo de facturación
public  function ventasLiquidadas($idcaja)
{
   $idcaja=$this->filtroNumerico($idcaja);
  //$fechaActualFija=fechaActualFija;
 $sqlValorFactura="SELECT SUM(valorFactura) AS resultadoSumaPagadas FROM facturacion 
    WHERE idCajaCierre =$idcaja AND  separada='no'";
  

  $sqlComisionesBancarias ="SELECT SUM(valorIncremento) AS comisionesBanco FROM facturacion 
    WHERE idCajaCierre =$idcaja AND  separada='no'";



  $sqlAbonos="SELECT SUM(valorAbono) AS resultadoAbonos FROM abonoFacturas 
    WHERE  idCajaCierre =$idcaja";

  $facturas = mysql_fetch_assoc(mysql_query($sqlValorFactura)); 
  $comisionesBancarias = mysql_fetch_assoc(mysql_query($sqlComisionesBancarias)); 
  $abonos = mysql_fetch_assoc(mysql_query($sqlAbonos));  
  return  $facturas["resultadoSumaPagadas"]+$abonos['resultadoAbonos']+$comisionesBancarias['comisionesBanco'];

}







//Indico los creditos del día del convenio
public  function creditosHoy()
{
  $sql="SELECT SUM(deudaFactura) AS resultadoTotalCreditos FROM facturacion 
    WHERE fechaFactura LIKE '".date("Y-m-d")."%'
    AND estadoFactura='en credito' ";
  $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return  $resultado["resultadoTotalCreditos"];

}



/******************FACTURACION*********************/


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
    <td class="tg-9hbo"><b>N.I.T cliente</b> </td>
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
                            <td colspan="3" align="right"> <b class="text-danger">$</b></td>
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
        # code...
      }//Fin Tirilla
  }//fin del modo factura CC 
}






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
public function proximoCodigoUsuario(){
  $sql="SELECT codigo FROM usuarios ORDER BY(codigo) DESC";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  if ($rs['codigo']==0) {
    # code...
    return 1;
  }
  elseif ($rs['codigo']>=1) {
    # code...
    return $rs['codigo']+1;
  }
}




//Saco el valor de todo lo que el cliente ha  abonado
public  function totalAbodadoCliente($clienteId)
{

$clienteId=$this->filtroNumerico($clienteId);
$convenioId=$this->filtroNumerico($this->decrypt($_REQUEST["id"], key));
$facturaConvenioId=$this->filtroNumerico($facturaConvenioId);
  $sql="SELECT SUM(abonoFacturaConvenioValorAbono) AS resultadoSuma FROM  abonoFacturaConvenio 
    WHERE clienteId ='".$clienteId."' and   convenioId='".$convenioId."'";
  $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return  $resultado["resultadoSuma"];

}




//Indico la deuda actual que tiene el cliente 
public  function totalDeudaCliente($clienteId)
{
  $clienteId=$this->filtroNumerico($clienteId);
  $sql="SELECT SUM(deudaFactura) AS resultadoSuma FROM facturacion 
    WHERE idCliente='".$clienteId."' AND estadoFactura='en credito'";
  $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return  $resultado["resultadoSuma"];

}



//Indico la deuda actual que tiene el cliente 
public  function totalComprasCliente($clienteId)
{
  $clienteId=$this->filtroNumerico($clienteId);
  $sql="SELECT SUM(valorFactura) AS resultadoSuma FROM facturacion 
    WHERE idCliente='".$clienteId."'";
  $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return  $resultado["resultadoSuma"];

}








//averiguo si ese cliente tiene un crédito pendiente
private  function estadoCuentaCliente($idCliente)
{

  $sql="SELECT idCliente, estadoFactura FROM facturacion WHERE idCliente='".$this->filtroNumerico($idCliente)."'";
  $a=array();
  $n=0;
  $query=mysql_query($sql);
  while ($rs=mysql_fetch_array($query)) {
    # code...
    $a[$n]=$rs["estadoFactura"];
    $n++;
  }

  if (in_array('en credito', $a)) {
    # code...
    return 2; //Existe
  }
  else
  {
    return 1; //no
  }

}









//Cajas

public function checkAperturaCaja($id)
{
  $sql="SELECT estado  FROM cajas where estado='1'";
  if (mysql_num_rows(mysql_query($sql))>0) {
    # code...
    return 1; //si hay cajas abiertas
  }
  else
  {
    return 0; //No hay cajas abiertas
  }
}



//Grupo de Bodegas y Puntos de Venta
public function optionGroupBodegasPuntosVenta(){
 // $sqlBodegas="SELECT idBodega, nombreBodega FROM bodegas";
  $sqlPuntosVenta="SELECT idPunto, nombrePunto, nitPunto FROM puntosVenta  WHERE  activada = 'si' ";
//  $queryBodegas=$conn->query($sqlBodegas);
  $queryPuntosVenta=mysql_query($sqlPuntosVenta);

  /*  //Grupo Bodegas
    echo '<optgroup label="Bodegas">';
    while ($rsBodegas=mysqli_fetch_array($queryBodegas, MYSQLI_ASSOC)) {
        echo '<option value="'.$this->encrypt("bodega|".$rsBodegas['idBodega']." ", publickey).'">'.$rsBodegas['nombreBodega'].'</option>';
    }
    echo '</optgroup>';

  */
    //Grupo Puntos de Venta
    echo '<optgroup label="Puntos de Venta">';
    while ($rsPuntosVenta=mysql_fetch_array($queryPuntosVenta)) {
        echo '<option value="'.$this->encrypt("puntoVenta|".$rsPuntosVenta['idPunto']." ", publickey).'">'.$rsPuntosVenta['nombrePunto'].'</option>';
    }
    echo '</optgroup>';
}


//******************jsons

//json productos



//Listo todos los productos de ese usuario
public  function jsonProductos()
{

 // $id=$this->filtroNumerico($consultaComun);
 $sql="SELECT idproductosServicios, sku, nombreProductosServicios, valorVentaUnidad, valorVentaPorMayor, impuesto, retiroTemporal FROM PRODUCTOSERVICIOS WHERE retiroTemporal='si' AND  idproductosServicios!=0  ";
  $query=mysql_query($sql);
  $arrayProductos=array();
  $contador=0;

  while ($rs=mysql_fetch_array($query)) {
    # code...
      $arrayProductos[$contador]='"'.$rs["idproductosServicios"].'|'.$rs["sku"].'|'.$rs["nombreProductosServicios"].'|'.$rs["valorVentaUnidad"].'|'.$rs['impuesto'].'"';
    
         $contador++;
  }

  $productos=implode(",", $arrayProductos);
  return $productos;
}



//QUEDE EN REVISAR EL JSON DE LA FACTURACIÓN Y CORREGIRLO






//Listo todos los provedores de ese convenio
public  function jsonProvedores()
{
 // $id=$this->filtroNumerico($consultaComun);
 $sql="SELECT nombreProvedor, ideProvedor FROM provedores ";
  $query=mysql_query($sql);
  $arrayProductos=array();
  $contador=0;
  while ($rs=mysql_fetch_array($query)) {
    # code...
    $arrayProductos[$contador]='"'.$rs["nombreProvedor"].'|'.$rs['ideProvedor'].'"';


    $contador++;
  }
  $productos=implode(",", $arrayProductos);
  echo 'var provedores = ['.$productos.'];';
}



/*
//Listo todos los clientes 
public  function jsonClientes()
{
 // $id=$this->filtroNumerico($consultaComun);
 $sql="SELECT identificacionCliente, nombreCliente FROM clientes ";
  $query=mysql_query($sql);
  $arrayProductos=array();
  $contador=0;
  while ($rs=mysql_fetch_array($query)) {
    # code...
    $arrayProductos[$contador]='"'.$rs["nombreCliente"].'|'.$rs['identificacionCliente'].'"';


    $contador++;
  }
  $productos=implode(",", $arrayProductos);
  echo 'var clientes = ['.$productos.'];';
}


*/




//Jquery para  sacar las recetas
public function jsonProductosParaRecetas()
{
  conectar::conexiones();
  $convenioId=$this->decrypt($_REQUEST["id"], key);
  
  $sql="SELECT    productosConvenioId, productosConvenioNombre, productoConvenioMedida, productosConvenioProductoReceta, convenioId  FROM productosConvenio WHERE productosConvenioProductoReceta=1 AND convenioId='".intval($convenioId)."'";


  $query=mysql_query($sql);
  $array= array();
  $num=0;
  while ($rs=mysql_fetch_array($query)) {
    # code...

    $array[$num]='"'.$rs["productosConvenioId"].'|'.$rs["productosConvenioNombre"].'|1|'.$this->stringMedidasMinimizadas($rs["productoConvenioMedida"]).'"';
    $num++;
  }
  $producto=implode(",", $array);
  return ''.$producto.'';

  conectar::desconectar();

}



public function jsonProductosParaProductosEnExitencia()
{
  conectar::conexiones();
  $convenioId=$this->decrypt($_REQUEST["id"], key);

  $query=mysql_query($sql);
  $array= array();
  $num=0;
  while ($rs=mysql_fetch_array($query)) {
    # code...
    $array[$num]='"'.$rs["productosConvenioId"].'|'.$rs["productosConvenioNombre"].'|1|'.$this->stringMedidasMinimizadas($rs["productoConvenioMedida"]).'"';
    $num++;
  }
  $producto=implode(",", $array);
  return ''.$producto.'';

  conectar::desconectar();

}









//Debo  averiguar cuanto tiene  en crédito disponible 
public  function checkEstadoDeudaClientes($idCliente)
{
  $idCliente=$this->filtroNumerico($idCliente);
  
  $sql="SELECT idCliente, estadoFactura, deudaFactura FROM   facturacion where idCliente='".$idCliente."' AND estadoFactura='en credito' ";
  $query=mysql_query($sql);
  $facturas= array();
  $n=0;
  while ($rs=mysql_fetch_array($query)) {
    # code...
    $facturas[$n]=$rs["deudaFactura"];
    $n++;
  }

  return array_sum($facturas);

}






  





//**********HTML***********/

//BOTON DE CHECK ABONO O PAZ Y SALVO

public function botonAbonoPazYSalvo($clienteId, $nombreCliente, $tipo)
{
  //TIPO[1]:boton para el abono global
  //TIPO[2]:botón para el abono a factura  
  if($tipo==1){
      $verificacion=$this->checkEstadoDeudaClientes($clienteId) ;
      if($verificacion>0)
      {

        echo '<button type="button" id="noPrint" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#abonoDeCreditos" ><i class="fa fa-warning"></i> '.$nombreCliente.' tiene un crédito pendiente  de <h1 style="color: #fff;">$'.number_format($verificacion).'</h1></button>';
      }
      elseif($verificacion==0)
      {
        echo '<div  class="btn btn-success col-md-12" ><i class="fa fa-thumbs-up"></i>'.$nombreCliente.' está a paz y salvo</div>';
      }
  }
  elseif($tipo==2){
     echo '<button type="button" id="noPrint" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#abonoDeCreditos" ><i class="fa fa-warning"></i>Abonar a esta factura</h1></button>';
  }
  //Verifico si ese cliente tiene créditos pendientes
  

}
//******************CSS****************************/




//Esta me saca los iconos y el texto de cada estado según el parámetro que se le pase
public  function estadoCuentaCss($parametro)
{
  if ($parametro=='pagada') {
    # pago...
    return "<i class='fa fa-thumbs-up text-success'></i> <strong class='text-success'>Pagada</strong>";
  }
  elseif ($parametro=='en credito') {
    # A Crédito...
    return "<i class='fa fa-warning text-danger'></i> Crédito";
  }
  elseif ($parametro=='anulada') {
    # A Anulada...
    return "<i class='fa fa-bell text-danger'></i> Anulada";
  }
}



private function iconoCssRecetaVenta($parametro)
{
  if ($parametro==1) {
    # pago...
    return "<i class='fa fa-book text-success'></i>";
  }
  elseif ($parametro==0) {
    # A Crédito...
    return "<i class='fa fa-square text-info'></i>";
  }
  

}

//Saco el icono que simboliza si una caja esta en orden o esta descuadrada
public function iconoCssActivadoDesactivado($vector){
  if ($vector=='si') {
    # code...
    return '<i class="fa fa-check-circle text-success" title="Esta Activada"></i>';
  }
  elseif ($vector=='no') {
    # code...
    return '<i class="fa fa-circle text-danger" title="esta Desactivada"></i>';
  }
 
}




/********************************[html]************************************************/

public function selectEstadoFactura($parametro)
{

  return '<select name="estadoFactura[]" class="form-control" id="estadoFactura" required>
          <option value="pagada" '.$this->selected($parametro, 'pagada').'>Pagada</option>
          <option value="en credito" '.$this->selected($parametro, 'en credito').'>Crédito</option>
          <option value="anulada" '.$this->selected($parametro, 'anulada').'>Anulada</option>
        </select>';
}




//Select de los productos o servicios
public function selectTipoServicioProducto($parametro)
{

  echo '<select id="tipoProductoServicio" class="form-control " >
          <option value="producto" '.$this->selected($parametro, 'producto').'>Producto</option>
          <option value="servicio" '.$this->selected($parametro, 'servicio').'>Servicio</option>
        </select>';
}



//Select de los productos o servicios
public function selectshowProductoServicio($parametro)
{

  echo '<select id="retiroTemporal" class="form-control " >
          <option value="si" '.$this->selected($parametro, 'si').'>Si, Muestra este item</option>
          <option value="no" '.$this->selected($parametro, 'no').'>No, Retira este item</option>
        </select>';
}



//Select de los productos o servicios
public function selectCuentaActivada($parametro)
{

  echo '<select id="activada" class="form-control " >
          <option value="si" '.$this->selected($parametro, 'si').'>Si, Activa Esta Cuenta</option>
          <option value="no" '.$this->selected($parametro, 'no').'>No, Desactivala</option>
        </select>';
}

//Select de los tipos de cuenta bancaria 
public function selectTiposCuenta($parametro)
{

  echo '<select id="tipoCuenta" class="form-control " >
          <option value="ahorros" '.$this->selected($parametro, 'ahorros').'>Ahorros</option>
          <option value="corriente" '.$this->selected($parametro, 'corriente').'>Corriente</option>
          <option value="empresarial" '.$this->selected($parametro, 'empresarial').'>Empresarial</option>
            <option value="otra" '.$this->selected($parametro, 'otra').'>Otra</option>
        </select>';
}



//Select de los tipos de cuenta bancaria 
public function selectActivarDesactivar($parametro)
{

  echo '<select id="activada" class="form-control " >
          <option value="si" '.$this->selected($parametro, 'si').'>Activado</option>
          <option value="no" '.$this->selected($parametro, 'no').'>Desactivado</option>
          
        </select>';
}


//SELECT TODO LO DE PUNTOS DE VENTA
public function selectCategorias($parametro){
  
   echo  $sql="SELECT idCategoria, tipo, nombreCategoria FROM categorias  WHERE  tipo = 'categoria' ";
    $query=mysql_query($sql);
    while ($rs=mysql_fetch_array($query)) {
      # code...
      echo '<option value="'.$this->encrypt($rs['idCategoria'], publickey).'" '.$this->selected($parametro, $this->encrypt($rs['idCategoria'], publickey)).'> '.$rs['nombreCategoria'].'  </option>';
    }
    
}



//Select de los tipos de cuenta de usuario
public function selectTiposUsuario($parametro)
{

  echo '<select id="tipoUsuario" class="form-control " >
          <option value="vendedor" '.$this->selected($parametro, 'vendedor').'>Vendedor</option>
          <option value="empleado" '.$this->selected($parametro, 'empleado').'>Empleado</option>
          <option value="administrador" '.$this->selected($parametro, 'administrador').'>Administrador</option>
          <option value="super administrador" '.$this->selected($parametro, 'super administrador').'>Super Administrador</option>


        </select>';
}





//Select de los tipos de cuenta de usuario
public function selectTiposRegimenTributario($parametro)
{

  echo '<select id="regimenEmpresa" class="form-control " >
          <option value="persona natural" '.$this->selected($parametro, 'persona natural').'>Persona Natural</option>
          <option value="empresa unipersonal" '.$this->selected($parametro, 'empresa unipersonal').'>Empresa Unipersonal</option>
          <option value="s.a.s" '.$this->selected($parametro, 's.a.s').'>S.A.S</option>
          <option value="sociedad colectiva" '.$this->selected($parametro, 'sociedad colectiva').'>Sociedad Colectiva</option>

          <option value="s.a" '.$this->selected($parametro, 's.a').'>S.A</option>

          <option value="ltda" '.$this->selected($parametro, 'ltda').'>Ltda</option>

          <option value="S.en C" '.$this->selected($parametro, 'S.en C').'>S.en C</option>

          <option value="S.C.A" '.$this->selected($parametro, 'S.C.A').'>S.C.A</option>


        </select>';
}


//Tipo de pagos 
public function selectOpcionesPago($parametro)
{

  return '<select name="tipoPago[]" class="form-control" id="tipoPago" required>
          <option value="efectivo" '.$this->selected($parametro, 'efectivo').'>Efectivo</option>
          <option value="tarjeta credito" '.$this->selected($parametro, 'tarjeta credito').'>Tarjeta de Crédito</option>
          <option value="tarjeta debito" '.$this->selected($parametro, 'tarjeta debito').'>Tarjeta Débito</option>
          <option value="cheque" '.$this->selected($parametro, 'cheque').'>Cheque</option>
          <option value="otro" '.$this->selected($parametro, 'otro').'>Otro</option>
        </select>';
}




//Select de los bancos que estan activos
public function selectBancos($parametro)
{

  $sql="SELECT idBanco, nombreBanco, activada FROM bancos WHERE activada='si'";
  echo '<select id="idenBancos" class="form-control " >';
  $query=mysql_query($sql);
  while ($rs=mysql_fetch_array($query)) {
    # code...
    echo '<option value="'.$this->encrypt($rs['idBanco'], publickey).'" '.$this->selected($parametro, $rs['idBanco']).'>'.$rs['nombreBanco'].'</option>';
      }
  echo  '</select>';
}




//Select de los bancos que estan activos
public function selectMoneda($parametro)
{

  $sql="SELECT CurrencyName, CurrencyISO FROM currency";
  echo '<select id="moneda" class="form-control " >';
  $query=mysql_query($sql);
  while ($rs=mysql_fetch_array($query)) {
    # code...
    echo '<option value="'.$rs['CurrencyISO'].'" '.$this->selected($parametro, $rs['CurrencyISO']).'>'.$rs['CurrencyName'].'</option>';
      }
  echo  '</select>';
}




public function selectProductosDebitar()
{

    $sqlCaja="SELECT idCaja, valorBase, estado FROM cajas WHERE estado='1' AND valorBase>0 ORDER BY(idCaja) DESC LIMIT 0,1";
    $sqlBancos="SELECT idBanco, nombreBanco,nroCuenta, activada, saldo FROM bancos WHERE activada='si' AND saldo>0";
    $sqlProductosBancarios="SELECT idProductoBancario, tipo, descripcion, saldo, idBanco FROM  productoBancario WHERE saldo > 0 ";

    $queryCaja=mysql_query($sqlCaja);
    $queryBancos=mysql_query($sqlBancos);
    $queryProductosBancarios=mysql_query($sqlProductosBancarios);

    echo '<select id="viaDePago" class="form-control " required>';
    
    //select para caja
    if (mysql_num_rows($queryCaja)>0) {
      # code...
        $rsCaja=mysql_fetch_array($queryCaja);

       echo '<option value="'.$this->encrypt($rsCaja['idCaja']."|cajaMenor", publickey).'" >Caja Menor</option>';
    }

    //While para bancos
    while ($rsBancos=mysql_fetch_array($queryBancos)) {
      # code...
      echo '<option value="'.$this->encrypt($rsBancos['idBanco']."|cuentaBancos", publickey).'" >'.$rsBancos['nombreBanco'].'| '.$rsBancos['nroCuenta'].' | $'.number_format($rsBancos['saldo']).'</option>';
        }

    //While de productos bancarios
    while ($rsProductosBancarios=mysql_fetch_array($queryProductosBancarios)) {
      # code...
      echo '<option value="'.$this->encrypt($rsProductosBancarios['idProductoBancario']."|productoBancario", publickey).'" >'.$rsProductosBancarios['descripcion'].' | $'.number_format($rsProductosBancarios['saldo']).'</option>';
        }
    //separo con | para poder identificar a cual pertenece


    echo  '</select>';

}








//Selecciono los tipos de productos bancarios que manejo
public function selectTipoProductoBanco($parametro)
{

  return '<select name="tipoPago[]" class="form-control" id="tipo" required>
          <option value="tarjeta credito" '.$this->selected($parametro, 'tarjeta credito').'>Tarjeta de Crédito</option>
          <option value="chequera" '.$this->selected($parametro, 'chequera').'>Chequera</option>
          <option value="prestamo" '.$this->selected($parametro, 'prestamo').'>Prestamo</option>
          <option value="otro" '.$this->selected($parametro, 'otro').'>Otro</option>
        </select>';
}
//**************************************Filtros****************************************//


/*******STRINGS */



//String para las medidas
public  function stringMedidas($parametro)
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
    return "Kilos";
  }
  elseif ($parametro==4) {
    # code...
    return "Litros";
  }

   elseif ($parametro==5) {
    # code...
    return "Mililitros";
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





//Aqui digo si aplica o no aplica ese producto para una receta
public  function stringAplicaReceta($parametro)
{
  if ($parametro==1) {
    # unidades...
    return "Si Aplica";
  }
  else
  {
    return "No Aplica";
  }
}




public function mensajeEstadoCaja($valor)
{
    if ($valor==0) {
      # code...
      echo '<div class="alert alert-success" align="center">
              <h2>La caja cuadró perfectamente <i class="fa fa-thumbs-up"></i></h2>
            </div>';
    }
    elseif ($valor>0) {
      # code...

      echo '<div class="alert alert-danger" align="center">
              <h2><i class="fa fa-thumbs-down"></i>
                Hubo un excedente en la caja de $ '.number_format(abs($valor)).'
              </h2>
            </div>';


 
    }
    elseif ($valor<0) {
      # code...
      echo '<div class="alert alert-warning" align="center">
              <h2> <i class="fa fa-warning"></i>
                Hubo un faltante  en la caja de $ '.number_format(abs($valor)).'
              </h2>
            </div>';
    }
}











public function niveladorProvedores(){

   echo $sqlRepetidos="SELECT idprovedor, nombreProvedor, count(*) FROM provedores GROUP BY nombreProvedor HAVING count(*) > 1";
    $query=mysql_query($sqlRepetidos);
    $array= array();
    $n=0;
  while ($rs=mysql_fetch_array($query)) { //Obtengo los ids primarios que estan repetidos

    if (strlen($rs['nombreProvedor'])) {
      # code...
      $sqlNombreProvedor="SELECT idprovedor, nombreProvedor  FROM provedores WHERE nombreProvedor='".$rs['nombreProvedor']."' AND idprovedor != '".$rs['idprovedor']."'"; 
      $queryNombres=mysql_query($sqlRepetidos);
      while ($rsRepetidos=mysql_fetch_array($queryNombres)) {
          # code...
            echo $sqlUpdate="UPDATE facturasProvedores SET idProvedor='".$rs['idprovedor']."' WHERE  idprovedor = '".$rsRepetidos['idprovedor']."' ";
            //mysql_query($sqlUpdate);

            $queryDelete="DELETE FROM provedores WHERE    `nombreProvedor` LIKE '".$rsRepetidos['nombreProvedor']." AND idprovedor= '".$rsRepetidos['idprovedor']."";
            //mysql_query($queryDelete);
            echo '<br>';
        }
    }
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



//Me checkea o   descheckea los parametros
  public function selectedCheckbox($parametro)
  {
    if($parametro==1)
    {
      return 'checked';
    }
    else
    {
      return '';
    }
  }


//ENMASCARO LA CONTRASEÑA QUE ME PASARON A *
 public  function enmascararContrasena($dato)
 {
 	$n=strlen($dato); while($n>$a){ echo "* "; $a++;}
 }


//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
  $fecha=explode("/", $parametro);
  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
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


public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER , "UTF-8")));

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

?>