<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class queryAjax extends conect {

private function sqlCliente($id)
{
    $conn=$this->conectar();
    $sql = "SELECT * FROM clientes  where idcliente='".intval($id)."'";
        return mysqli_fetch_array($conn->query($sql), MYSQLI_ASSOC);
    conectar::desconectar();
}


//GET DATOS DE LOS PUNTOS DE VENTA
public  function getDatosPuntosVenta($id){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($id, publickey));
    $sqlPunto="SELECT * FROM puntosVenta WHERE idPunto=$idPuntoVenta";
    $query=$conn->query($sqlPunto);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}



//GET DATOS PROVEDORES
public  function getDatosProvedor($id){
    $conn=$this->conectar();
    $idprovedor=$this->filtroNumerico($this->decrypt($id, publickey));
    $sqlProvedor="SELECT * FROM provedores WHERE idprovedor=$idprovedor";
    $query=$conn->query($sqlProvedor);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
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


//GET DATOS DE LOS PUNTOS DE VENTA
public  function getDatosProductoServicio($idProductoServicio){
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
     $sqlProductoServicio="SELECT * FROM  PRODUCTOSERVICIOS WHERE idproductosServicios=$idProductoServicio";
    $query=$conn->query($sqlProductoServicio);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}


private function getDatosProductoServicioDesdeSku($sku){
    $conn=$this->conectar();

    $sqlProductoServicio="SELECT * FROM  PRODUCTOSERVICIOS WHERE sku='".$sku."'";
    $query=$conn->query($sqlProductoServicio);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
}


  private function getDatosPruductoConImei($codigo){
      $conn=$this->conectar();
      $codigo=$this->filtroStrings($codigo, 1);
      $sql="SELECT * FROM serialesImeis WHERE codigo ='".$codigo."'";
      $queryCodigos=$conn->query($sql);
      return mysqli_fetch_array($queryCodigos, MYSQLI_ASSOC);

  }


public function getDatosTrasladdos($fechaTraslado, $destinoId){
    $conn=$this->conectar();
     $sqlTrasladosExistencia="SELECT * FROM trasladosExistencia WHERE destinoId=$destinoId
                                            AND fechaTraslado='".$fechaTraslado."'";
    $query=$conn->query($sqlTrasladosExistencia);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}


public function datosPuntoVenta($id)
    {
      $conn=$this->conectar();
      $id=$this->filtroNumerico($this->decrypt($id, publickey));
      $sql = "SELECT * FROM  puntosVenta  where idPunto='".intval($id)."'";
      return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    }





//GET LOS DATOS DE LOS VENDEDORES
public function datosVendedores($codigoVendedor)
    {
      $conn=$this->conectar();
      $codigo=$this->filtroNumerico($codigoVendedor);
      $sql = "SELECT * FROM  usuarios  where idusuario=$codigo OR codigo=$codigo";
      return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
    }




public function getDatosFacturaProvedores($idFactura){
      $conn=$this->conectar();
      $idFactura=$this->filtroNumerico($idFactura);
      $sql = "SELECT * FROM  facturasProvedores  where idfacturaProvedor=$idFactura";
      return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
}

public function jsonDatosHojaTraslados($parametros){

  $datos=explode('|',$this->decrypt($parametros, publickey));
  $fecha=$datos[0];
  $destinoId=$datos[1];
  $datosHoja=array('idTraslado'=>$this->getDatosTrasladdos($fecha, $destinoId)['idTraslado'],
                    'idProductoServicio'=>$this->getDatosTrasladdos($fecha, $destinoId)['idProductoServicio'],
                    'tipoTraslado'=>$this->getDatosTrasladdos($fecha, $destinoId)['tipoTraslado'],
                    'origenTraslado'=>$this->getDatosPuntosVenta($this->encrypt($this->getDatosTrasladdos($fecha, $destinoId)['origenId'],publickey))['nombrePunto'],
                    'destinoTraslado'=>$this->getDatosPuntosVenta($this->encrypt($this->getDatosTrasladdos($fecha, $destinoId)['destinoId'],publickey))['nombrePunto'],
                    'fechaTraslado'=>$this->getDatosTrasladdos($fecha, $destinoId)['fechaTraslado'],
                    'estadoTraslado'=>$this->getDatosTrasladdos($fecha, $destinoId)['estadoTraslado'],
                    'cantidadTrasladada'=>$this->getDatosTrasladdos($fecha, $destinoId)['cantidadTrasladada'],
                    'cantidadExistenteTraslado'=>$this->getDatosTrasladdos($fecha, $destinoId)['cantidadExistenteTraslado']
   );
  echo json_encode($datosHoja);
}


//Saco en json los datos de un punto de venta
public function jsonDatosPuntoVenta($idPuntoVenta){
  $datos = array('matricula'=>$this->getDatosPuntosVenta($idPuntoVenta)['matricula'],
                'bodega'=>$this->getDatosPuntosVenta($idPuntoVenta)['bodega'],
                'nombrePunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['nombrePunto'],
                'direccionPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['direccionPunto'],
                'ciudadPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['ciudadPunto'],
                'departamentoPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['departamentoPunto'],
                'sitioWebPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['sitioWebPunto'],
                'logoPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['logoPunto'],
                'telefonoPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['telefonoPunto'],
                'idAdministrador'=>$this->getDatosPuntosVenta($idPuntoVenta)['idAdministrador'],
                'regimenTributario'=>$this->getDatosPuntosVenta($idPuntoVenta)['regimenTributario'],
                'nitPunto'=>$this->getDatosPuntosVenta($idPuntoVenta)['nitPunto'],
                'formatoImpresion'=>$this->getDatosPuntosVenta($idPuntoVenta)['formatoImpresion'],
                'nroInicioFactura'=>$this->getDatosPuntosVenta($idPuntoVenta)['nroInicioFactura'],
                'representanteLegal'=>$this->getDatosPuntosVenta($idPuntoVenta)['representanteLegal'],
                'terminosCondicionesFactura'=>$this->getDatosPuntosVenta($idPuntoVenta)['terminosCondicionesFactura'],
                'ultimaSesion'=>$this->getDatosPuntosVenta($idPuntoVenta)['ultimaSesion'],
                'permitirCreditos'=>$this->getDatosPuntosVenta($idPuntoVenta)['permitirCreditos'],
                'activada'=>$this->getDatosPuntosVenta($idPuntoVenta)['activada'],
                'validacion'=>$this->getDatosPuntosVenta($idPuntoVenta)['validacion'],
                'usuario'=>$this->getDatosPuntosVenta($idPuntoVenta)['usuario'],
                'ipReal'=>$this->getDatosPuntosVenta($idPuntoVenta)['ipReal']);

  return json_encode($datos); 
  $conn->close();
}






//Saco en json los datos de un punto de venta
public function jsonDatosProvedor($idProvedor){
  $datos = array( 'nombreProvedor'=>utf8_decode($this->getDatosProvedor($idProvedor)['nombreProvedor']),
                  'ideProvedor'=>$this->getDatosProvedor($idProvedor)['ideProvedor'],
                  'direccionProvedor'=>$this->getDatosProvedor($idProvedor)['direccionProvedor'],
                  'ciudadProvedor'=>$this->getDatosProvedor($idProvedor)['ciudadProvedor'],
                  'departamentos'=>$this->getDatosProvedor($idProvedor)['departamentos'],
                  'sitioWebProvedor'=>$this->getDatosProvedor($idProvedor)['sitioWebProvedor'],
                  'emailProvedor'=>$this->getDatosProvedor($idProvedor)['emailProvedor'],
                  'telefonoProvedor'=>$this->getDatosProvedor($idProvedor)['telefonoProvedor'],
                  'contactoProvedor'=>$this->getDatosProvedor($idProvedor)['contactoProvedor']
                  );

  return json_encode($datos); 
}



//Saco en json los datos de una factura
public function jsonDatosFacturaProvedor($idFacturaProvedor){
  $datos = array( 'idProvedor'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['idProvedor'],
                  'nroFacturaProvedor'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['nroFacturaProvedor'],
                  'fechaFacturaProvedor'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['fechaFacturaProvedor'],
                  'fechaPagar'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['fechaPagar'],
                  'estadoFactura'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['estadoFactura'],
                  'valorFacturaProvedor'=>number_format($this->getDatosFacturaProvedores($idFacturaProvedor)['valorFacturaProvedor']),
                  'valorFacturaNetoProvedor'=>number_format($this->getDatosFacturaProvedores($idFacturaProvedor)['valorFacturaNetoProvedor']),
                  'deudaFacturaProvedor'=>$this->getDatosFacturaProvedores($idFacturaProvedor)['deudaFacturaProvedor']
                  );
  return json_encode($datos); 
}







//DATOS DE FACTURA EN JSON
public function jsonFacturacion($idFactura)
{
  $conn=$this->conectar();
  $idFactura=$this->decrypt($idFactura, publickey);
  $sqlFactura="SELECT * FROM facturacion WHERE idFactura=$idFactura ";
  $queryFactura=$conn->query($sqlFactura);
  $rs=mysqli_fetch_array($queryFactura);
  $resultado=array('idFactura'=> $this->encrypt($rs['idFactura'], publickey),
                    'nroFactura'=>$rs['nroFactura'],
                    'idPuntoVenta'=>$rs['idPuntoVenta'],
                    'idCliente'=>$rs['idCliente'],
                    'fechaFactura'=>$rs['fechaFactura'],
                    'horaFactura'=>$rs['horaFactura'],
                    'estadoFactura'=>$rs['estadoFactura'],
                    'valorNetoFactura'=>$rs['valorNetoFactura'],
                    'valorTotalFactura'=>round($rs['valorTotalFactura']),
                    'deudaFactura'=>round($rs['deudaFactura']),
                    'codigoVendedor'=>$rs['codigoVendedor'],
                    'tipoPago'=>$rs['tipoPago'],
                    'nroCheque'=>$rs['nroCheque'],
                    'fechaCobroCredito'=>$rs['fechaCobroCredito'],
                    'liquidada'=>$rs['liquidada'],
                    'justificacionAnulacion'=>$rs['justificacionAnulacion'],
                    'separada'=>$rs['separada'],
                    'idCajaCierre'=>$rs['idCajaCierre'],
                    'ventaCruzada'=>$rs['ventaCruzada'],
                    'web'=>$rs['web'],
                    'pertenencia'=>$rs['pertenencia'],
                    'retiroTemporal'=>$rs['retiroTemporal'],
                    'backup'=> $rs['backup']

);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
  $conn->close();
}





//Checkeo metodos de pago  de una factura
public function checkMetodosPagoFactura($idFactura){
  $conn=$this->conectar();
  $idFactura=$this->decrypt($idFactura, publickey);
  $sqlPerfilPago="SELECT idFactura, idPuntoVenta, tipoPago, valor, comision, fechaRegistrado 
                                          FROM perfilPagos  
                                          WHERE  idFactura=$idFactura";
  $queryPerfilPagos=$conn->query($sqlPerfilPago);
  $n=0;
  while ($rs=mysqli_fetch_array($queryPerfilPagos)) {
    # code...
      $valor=explode('.', $rs['valor']);
      if ($rs['tipoPago']=='efectivo') {
        # code...
        echo '<div class="btn btn-outline btn-default col-md-6">Efectivo: '.number_format($valor[0]).'</div>';
      }

      if ($rs['tipoPago']=='tarjeta credito') {
        # Pago con tarjeta...
        echo '<div class="btn btn-outline btn-info col-md-6">T Tarjeta: '.number_format($rs['valor']+$rs['comision']).'</div>';
      }
      if ($rs['tipoPago']=='tarjeta debito') {
        # code...
        echo '<div class="btn btn-outline btn-success col-md-6">T Debito: '.number_format($valor[0]).'</div>';
      }

      if ($rs['tipoPago']=='cheque') {
        # code...
        echo '<div class="btn btn-outline btn-primary col-md-6">En Cheque: '.number_format($valor[0]).'</div>';
      }

      if ($rs['tipoPago']=='entidad crediticia') {
        # code...
        echo '<div class="btn btn-outline btn-danger col-md-6">Entidad Crediticia: '.number_format($rs['valor']+$rs['comision']).'</div>';
      }

  }
}





//DATOS DE FACTURA EN JSON
public function listaTrasladosExistencia($parametro)
{
  $conn=$this->conectar();
  $datos=explode('|',$this->decrypt($parametro, publickey));
  $fecha=$datos[0];
  $destinoId=$datos[1];

  $sqlTraslado="SELECT * FROM  trasladosExistencia WHERE destinoId=$destinoId  AND fechaTraslado='".$datos[0]."'  ";
  $sqlImeis="SELECT * FROM serialesImeis  WHERE ubicacion=$destinoId AND fechaTraslado='".$datos[0]."' ";
  $queryTraslado=$conn->query($sqlTraslado);
  $queryImeis=$conn->query($sqlImeis);

  if ((mysqli_num_rows($queryImeis))>0) {
    # En caso que exista un imei o serial  en este traslado...
    $style='col-md-6';
    echo '
        <div class="'.$style.'">
        <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th ><div align="center">Serial/Imei</div></th>
                  <th ><div align="center">Estado</div></th>
                </tr>
              </thead>
              <tbody>';
        while ($rd=mysqli_fetch_array($queryImeis, MYSQLI_ASSOC)) {
        # code...

           echo '<tr>
                <td>'.$this->getDatosProductoServicio($rd['idProductoServicio'])['nombreProductosServicios'].'</td>
                <td align="center"><span class="label label-success label-rouded">'.$rd['codigo'].'</span></td>
                <td>'.$rd['estado'].'</td>
              </tr>';



        
      }

    echo '</tbody>
    </table>

    </div>';

  }else{
    $style='col-md-12';
  }

  echo '
        <div class="'.$style.'">
        <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th ><div align="center">Cantidad Trasladada</div></th>
                </tr>
              </thead>
              <tbody>';
  while ($rs=mysqli_fetch_array($queryTraslado, MYSQLI_ASSOC)) {
        echo '<tr>
                <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                <td align="center"><span class="label label-success label-rouded">'.$rs['cantidadTrasladada'].'</span></td>
              </tr>';
  }

  echo '</tbody>
      </table>
      </div>
  ';
  
  $conn->close();
}





//JSON DATOS DE LOS CLIENTES 
public function jsonClientes($identificacionCliente, $idCliente)
{
  $conn=$this->conectar();
  if (isset($identificacionCliente)) {
    # code...
      $identificacionCliente=$this->filtroStrings($identificacionCliente, 2);
      $sqlCliente="SELECT * FROM clientes WHERE identificacionCliente='".$identificacionCliente."' ";
  }else if(isset($idCliente)){
    $idcliente=$this->filtroNumerico($idCliente);
    $sqlCliente="SELECT * FROM clientes WHERE idcliente=$idcliente";
  }
  $query=$conn->query($sqlCliente);
  $rs=mysqli_fetch_array($query, MYSQL_ASSOC);

  $resultado=array('idcliente'=> $this->encrypt($rs['idcliente'], publickey),
                    'nombreCliente'=>$rs['nombreCliente'],
                    'identificacionCliente'=>$rs['identificacionCliente'],
                    'telefonosCliente'=>$rs['telefonosCliente'],
                    'direccionCliente'=>$rs['direccionCliente'],
                    'emailCliente'=>$rs['emailCliente'],
                    'ciudadCliente'=>$rs['ciudadCliente'],
                    'tipoDocumento'=>$rs['tipoDocumento']

);
    $objResponse = $resultado;
    echo json_encode($resultado); 
 
  $conn->close();
}




public function datosProductoServicio($id)
    {
      $conn=$this->conectar();
      $id=$this->filtroNumerico($this->decrypt($id, publickey));
      $sql = "SELECT * FROM  PRODUCTOSERVICIOS  where idproductosServicios=".intval($id)."";
       return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    } 



//Comparo los  nits y veo si estan repetidos
public function compararIdsNitsPuntos($identificacion){
    $conn=$this->conectar();
    $identificacion=$this->filtroStrings($identificacion);
    $sqlIdentificacion="SELECT nitPunto FROM puntosVenta WHERE nitPunto='".$identificacion."'";
    if (mysqli_num_rows($conn->query($sqlIdentificacion))>0) {
      # code...
      $objResponse = array('aviso' => true );
      
    }
    else{
      $objResponse = array('aviso' => false );
    }
    $conn->close();
    echo json_encode($objResponse); 
  }






//Datos de la categorias
public function datosCategoria($parametro, $vector){
  $conn=$this->conectar();
  $sql="SELECT * FROM  categorias WHERE idCategoria = $parametro";
  $query=$conn->query($sql);
  if(mysqli_num_rows($query)>0){
      $rs=mysqli_fetch_array($query);
      switch ($vector){
      case 'nombreCategoria':
        # code...
        return '<i class="fa fa-sort-amount-asc"></i>'.$rs['nombreCategoria'];
        break;
      
      default:
        return 'no aplica';
        # code...
        break;
    }
  }else{
    return '<i class="fa fa-minus-circle text-danger"></i>';
  }
 

  
  $conn->close();
}

//Load Select Categorias
public function loadSelectCategorias($tipo, $padre){


      $conn=$this->conectar();

      echo '<div class="form-group">
              <label>Pertenece A:</label>
              <select id="padre" class="form-control">
      ';
      if($tipo =='categoria'){
         $sql="SELECT idCategoria, tipo, nombreCategoria FROM  categorias WHERE padre = $padre ORDER BY nombreCategoria ASC";
        }
      else if($tipo =='subCategoria'){
          $sql="SELECT idCategoria, tipo, nombreCategoria FROM  categorias WHERE tipo='categoria' ORDER BY nombreCategoria ASC";
      }



        $query=$conn->query($sql);
        if (mysqli_num_rows($query)>0) {
          
            while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              echo ' <option value="'.$rs['idCategoria'].'">'.$rs['nombreCategoria'].'</option>';
            } 
        }

        echo '
          </select>
        </div>';
       $conn->close();
    }

    
   







//Select option los puntos de venta
public function loadSelectPuntosVentas($parametro){
 $conn=$this->conectar();
 $parametro=$this->filtroNumerico($parametro);
    $sql="SELECT idPunto, nombrePunto FROM puntosVenta";
  $query=$conn->query($sql);

   while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        echo ' <option value="'.$rs['idPunto'].'" '.$this->selected($parametro, $rs['idPunto']).' >'.$rs['nombrePunto'].'</option>';
          } 
  // $conn->close(); 
}





//Comparo los  usernames y veo si estan repetidos
public function compararUsernamesClientes($usuario){
    $conn=$this->conectar();  
    $usuario=$this->encrypt($usuario, key);
     $sqlIdentificacion="SELECT usuario FROM  puntosVenta WHERE usuario='".$usuario."'";
    if (mysqli_num_rows($conn->query($sqlIdentificacion))>0) {
      # code...
      $objResponse = array('aviso' => true );
    }
    else{
      $objResponse = array('aviso' => false );
    }
    $conn->close();
    echo json_encode($objResponse); 
  }




  //Comparo los  usernames y veo si estan repetidos
public function getIdProductoServicio($sku){
    $conn=$this->conectar();  
    
      $sqlSku="SELECT idproductosServicios, sku FROM  PRODUCTOSERVICIOS WHERE sku='".$sku."'";

      $query=$conn->query($sqlSku);
    if (mysqli_num_rows($query)>0) {
      $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
      return $rs['idproductosServicios'];
    }
    else{
      return 0;
    }
    $conn->close();
  }




//CHECKEO LOS IMEIS REPETIDOS
public function checkImeisRepetidos($imeis){
    $conn=$this->conectar();  
    
      $sqlImei="SELECT codigo FROM  serialesImeis
                                            WHERE codigo='".$imeis."'";

      $query=$conn->query($sqlImei);

      return mysqli_num_rows($query);
    $conn->close();
  }





/* TABLAS  Y LISTADOS */






//Lista de los items de una factura
public function listaItemsFactura($idFactura){
  $conn=$this->conectar();
  $idFactura=$this->decrypt($_SESSION['ideFactura'], publickey);
  $sqlItems="SELECT * FROM itemsFactura WHERE idFactura=$idFactura";
  $sqlImeiSerial="SELECT idFacturaVenta, idProductoServicio, codigo FROM serialesImeis WHERE idFacturaVenta =$idFactura ";
  $queryImeiSerial=$conn->query($sqlImeiSerial);
  $queryItems=$conn->query($sqlItems);

  if (mysqli_num_rows($queryImeiSerial)>0) { //Tiene al menos un imei o serial registrado  o asociado
    # code...
    echo '<div class="col-md-8">
        <h4 align="center"> <i class="fa fa-list"></i> Items Facturados </h4>
          <div class="table-responsive">
            <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Valor Neto</th>
                  <th>Impuestos</th>
                  <th>Totales</th>
                </tr>
              </thead>
              <tbody>';
    while ($rsItems=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...

       echo '<tr>
                  <td>'.$this->datosProductoServicio($this->encrypt($rsItems['idProductoServicio'], publickey))['nombreProductosServicios'].'</td>
                  <td align="center"> '.$rsItems['unidades'].'</td>
                  <td  align="center"> '.number_format($rsItems['valorNeto']).'</td>
                  <td align="center"> '.$rsItems['porcentajeImpuesto'].'</td>
                  <td  align="center">$ '.number_format($rsItems['valorTotal']).' </td>
                 
                </tr>';
    }



          echo '</tbody>
          </table>
      </div>
    </div>';


    //Listado de los seriales e imeis
    echo '<div class="col-md-4">
          <h3 align="center"> <i class="fa fa-check-circle"></i> Imeis o Seriales Asociados </h4>
      <div class="table-responsive">
            <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th><div  align="center">Código</div></th>
                  <th><div  align="center">Producto</div></th>
                </tr>
              </thead>
              <tbody>
          ';
    while ($rsImei=mysqli_fetch_array($queryImeiSerial, MYSQL_ASSOC)) {
      # code...
        echo '<tr>
                  <td  align="center">'.$rsImei['codigo'].'</td>
                  <td>'.$this->datosProductoServicio($this->encrypt($rsImei['idProductoServicio'], publickey))['nombreProductosServicios'].'</td>                 
                </tr>';
    }
echo '  </tbody>
      </table>

          </div>';
  }
  else{//No tiene ningun Imei o Serial Registrado o asociado
    echo '<div class="col-md-12">
            <h4 align="center"> <i class="fa fa-list"></i> Items Facturados </h4>
            <div class="table-responsive">
            <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Valor Neto</th>
                  <th>Impuestos</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>';
      $valorServicioTecnico=0;
       while ($rsItems=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...


        if ($rsItems['idProductoServicio']==10010) { //Es el ID del Servicio Tecnico
          # UTILIDAD DE CESAR...

          $valorServicioTecnico=$valorServicioTecnico+$rsItems['valorTotal'];

        }
       echo '<tr>
                  <td>'.$this->datosProductoServicio($this->encrypt($rsItems['idProductoServicio'], publickey))['nombreProductosServicios'].'</td>
                  <td align="center"> '.$rsItems['unidades'].'</td>
                  <td  align="center"> '.number_format($rsItems['valorNeto']).'</td>
                  <td align="center"> '.$rsItems['porcentajeImpuesto'].'</td>
                  <td  align="center">$'.number_format($rsItems['valorTotal']).' </td>
                 
                </tr>';
    }

    if ($valorServicioTecnico>0) {
      # code...
   
        echo '<tr>
                <td colspan="3"></td>
                <td><h3>Utilidad Servicio Técnico:</h3></td>
                <td>$ '.number_format($valorServicioTecnico).'</td>
              </tr>';

       }
          echo '</tbody>


          </table>
      </div>
    </div>';
  }

}





public function listaAbonosFactura($idFactura){
  $conn=$this->conectar();

  $idFactura=$this->filtroNumerico($this->decrypt($_SESSION['ideFactura'], publickey));
  $sql="SELECT idFactura, valorAbono, fechaAbono FROM abonoFacturas WHERE idFactura=$idFactura ";
  $query=$conn->query($sql);

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
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {

    echo '<tr>
              <td>'.$rs['fechaAbono'].'</td>
              <td align="center">$ '.number_format($rs['valorAbono']).'</td>
        </tr>';
      }
  echo '          </tbody>
      </table>';
}


//Listado del reporte de las ventas por rángo de fecha

public function reporteVentasRangoFecha($fecha1, $fecha2){
  $conn=$this->conectar();
  $fecha1=$this->formatoFecha($fecha1);
  $fecha2=$this->formatoFecha($fecha2);

  $sqlFactura="SELECT  DISTINCT  fechaFactura  FROM facturacion  WHERE fechaFactura BETWEEN  '".$fecha1."' and '".$fecha2."'";
  $queryFactura=$conn->query($sqlFactura);

echo '<h2 align="center"> <i class="fa fa-calendar"></i> Lista de Ventas del '.$fecha1.' Al '.$fecha2.' </h2> <i align="center">Año-Mes-Día</i>';
echo '<table id="tablaRelacionFacturas" class="table color-table primary-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Total Ventas</th>
                                    <th>Total Créditos</th>
                                    <th></th>
                                </tr>
                            </thead>
    ';

    echo '<tbody>';
   while ($rsFactura=mysqli_fetch_array($queryFactura, MYSQL_ASSOC)) {
      
       echo '
              <tr>
                  <td>'.$rsFactura['fechaFactura'].'</td>
                  <td>'.number_format($this->checkValorTotalVentasRangoFechas($rsFactura['fechaFactura'], $rsFactura['fechaFactura'])).'</td>
                  <td>'.number_format($this->checkValorTotalCreditosRangoFechas($rsFactura['fechaFactura'], $rsFactura['fechaFactura'])).'</td>
                  <td>
                    <a href="listaFacturas.php?id='.$_REQUEST['id'].'&fecha='.$this->encrypt($rsFactura['fechaFactura'], publickey).'">
                      <button type="button" class="btn btn-info">Ver Todas Las Facturas</button></a>
                  </td>
              </tr>                 
                      ';

    }
    echo ' </tbody>';
    echo '</table>';

echo '<div class="col-md-12">

          <div class="pull-right m-t-30 text-right">
            <p>Total Ventas Globales</p>
            <hr>
            <h3><b>Total :</b> $ '.number_format($this->checkValorTotalVentasRangoFechas($fecha1, $fecha2)).'</h3>
          </div>
      </div>';



}







/*======================================
=            PRE-INVENTARIOS            =
======================================*/

public function listadoPreinventario(){
  $conn=$this->conectar();
   $sql="SELECT * FROM  preInventario ORDER BY idPreinventario asc";
  $query=$conn->query($sql);

  echo '<table id="tablaRelacionFacturas" class="table color-table primary-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>CANTIDAD</th>
                                    <th>CODIGO</th>
                                    <th>PRODUCTO</th>
                                    <th>CANT  REG</th>
¡                                </tr>
                            </thead>
    ';
 while ($rsFactura=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    echo '<tr>
                  <td>'.$rsFactura['cantidades'].'</td>
                  <td>'.$this->getDatosProductoServicio($rsFactura['idProducto'])['sku'].'</td>
                  <td>'.$this->getDatosProductoServicio($rsFactura['idProducto'])['nombreProductosServicios'].'</td>
                  <td align="center">'.$this->getCantidadExistenciasProductoEnGlobal($rsFactura['idProducto']).'</td>
              </tr>                 
                      ';
 }
 echo ' </tbody>';
 echo '</table>';


}



//nIVELO EL PRE-INVENTARIOS AL INVENTARIOS ACTUAL
public function nivelacionDelPreinventario($puntoVenta){
    $conn=$this->conectar();
    $puntosVenta=$this->filtroNumerico($puntoVenta);
    echo $sqlDelete="DELETE from trasladosExistencia WHERE destinoId=$puntoVenta AND  cantidadTrasladada>0";
    $conn->query($sqlDelete);
     $sql="SELECT idProducto, cantidades, puntoVenta  FROM preInventario ORDER BY `preInventario`.`idProducto` ASC";
    $query=$conn->query($sql);
    $N=0;
 while ($rsPreinventario=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      # code...

       
           $sqlTraslado="INSERT INTO trasladosExistencia SET 
            idProductoServicio = '".$rsPreinventario['idProducto']."', tipoTraslado='puntoVenta-puntoVenta', origenId= '".$rsPreinventario['puntoVenta']."', 
            destinoId= '".$rsPreinventario['puntoVenta']."', fechaTraslado='".date('Y-m-d H:i:s')."', estadoTraslado='Trasladado', cantidadTrasladada='".$rsPreinventario['cantidades']."', cantidadExistenteTraslado= '".$rsPreinventario['cantidades']."', tokenTraslado='".strtotime(date('Y-m-d H:i:s'))."'  ";

          $conn->query($sqlTraslado);
          $n++;
   
    }



    echo '<br>final: '.$n.'<br>';
}



public function nivelacionSerialesAExistencias($ubicacion){
    $conn=$this->conectar();
    $ubicacion=$this->filtroNumerico($ubicacion);
    $sql="SELECT idproductosServicios, serializacion FROM PRODUCTOSERVICIOS WHERE  serializacion='si' ";
    $query=$conn->query($sql);
    $nm=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC) OR ($nm==10)) {
      $sqlSeriales="SELECT idProductoServicio, ubicacion, estado  FROM serialesImeis WHERE estado='en almacen' and ubicacion=$ubicacion AND  idProductoServicio='".$rs['idproductosServicios']."'";

      $queryC=$conn->query($sqlSeriales);
      $existenciaReal=mysqli_num_rows($queryC);
      $nm++;
      if ($existenciaReal>0) {
        echo $existenciaReal.' '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'<br>';
        $sqlActualizacion="UPDATE trasladosExistencia SET cantidadExistenteTraslado=0 WHERE idProductoServicio='".$rs['idproductosServicios']."'
                                                      AND destinoId=$ubicacion";
        $conn->query($sqlActualizacion);
        $sqlInsert="INSERT INTO trasladosExistencia SET idProductoServicio='".$rs['idproductosServicios']."',
                                                      tipoTraslado='reingreso', 
                                                      origenId=$ubicacion,
                                                      destinoId=$ubicacion,
                                                      fechaTraslado='".date('Y-m-d')."',
                                                      cantidadTrasladada=$existenciaReal,
                                                      cantidadExistenteTraslado=$existenciaReal,
                                                      tokenTraslado='".strtotime(date('Y-m-d'))."'
                                                      ";
        # code...
        $conn->query($sqlInsert); 
      }
                                                 
    }
}


public function nivelarInventario(){
    $conn=$this->conectar();
   // $arrayName = array('idProducto' => , );
    //$sql="SELECT COUNT(DISTINCT ubicacion) from  serialesImeis WHERE estado='en almacen'";
    $sql="SELECT idProductoServicio, ubicacion, idFacturaProvedor, estado FROM serialesImeis WHERE  estado='en almacen'";


    $query=$conn->query($sql);
    $productos = array();
    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      # code...
      $sqlCosto="SELECT IdFacturaProvedor, valorUnidad FROM  INVENTARIOS WHERE IdFacturaProvedor='".$rs['idFacturaProvedor']."' AND unidadesExistentes=0";
      $queryCosto=$conn->query($sqlCosto);
      $rsCosto=mysqli_fetch_array($queryCosto, MYSQL_ASSOC);
      $costoPromedio=$rsCosto['valorUnidad'];
      $sqlInventario="INSERT INTO INVENTARIOS SET idProductoServicio='".$rs['idProductoServicio']."',fechaIngreso='".date('Y-m-d')."', valorUnidad='".$costoPromedio."', tipoNegocio='compra', unidadesCompradas=1, unidadesExistentes=1,  idfacturaProvedor='".$rs['idFacturaProvedor']."'";


      $sqlTraslado="INSERT INTO trasladosExistencia SET idProductoServicio= '".$rs['idProductoServicio']."', origenId='".$rs['ubicacion']."', destinoId='".$rs['ubicacion']."', fechaTraslado='".date('Y-m-d H:m:s')."', cantidadTrasladada=1, cantidadExistenteTraslado=1, tokenTraslado='".strtotime(date('Y-m-d H:i:s'))."'";

      $conn->query($sqlInventario);
      $conn->query($sqlTraslado);

     
    }



    //echo implode(',',$productos);
}





//VERIFICACION DE IMEIS Y CANTIDADES NIVELADAS

public function comparacionImeisCantidades($puntoVenta){
  $conn=$this->conectar();
  $sql="SELECT idProductoServicio, ubicacion, estado FROM serialesImeis where estado='en almacen'";
  $query=$conn->query($sql);
  $n=0;
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    # code...

  }

}




/*=====  End of PRE-INVENTARIOS  ======*/

//Selecciono el LISTADO DE NOMBRE DE PRODUCTOS
public function listadoJsonNombreProductos(){
    $conn=$this->conectar();  
     $sqlMarcas="SELECT sku, nombreProductosServicios, tipoProductoServicio, retiroTemporal FROM PRODUCTOSERVICIOS 
                                                  WHERE  tipoProductoServicio = 'producto'
                                                  AND retiroTemporal='si'";
     $query=$conn->query($sqlMarcas);
     $jsonSku= array();
     $n=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $jsonSku[$n]=trim($rs['sku']).'';
        $n++;
      }
    $objResponse = $jsonSku;
    echo json_encode($objResponse); 
  }
  




/*=============================================
=            Section comment block            =
=============================================*/

public function checkSkuRepetido($parametros)
{
  $conn=$this->conectar();
  extract($parametros);
  //$sqlExistencia="SELECT idproductosServicios, sku FROM PRODUCTOSERVICIOS WHERE sku='".$parametro."' ";
   $sqlExistencia="SELECT idproductosServicios, sku, serializacion FROM PRODUCTOSERVICIOS WHERE sku='".trim($sku)."' AND serializacion = 'no'";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres(trim($sku));
  $query=$conn->query($sqlExistencia);
  $queryExistencia=$conn->query($sqlExistencia);


  $rsC=mysqli_fetch_array($queryExistencia, MYSQL_ASSOC);
  if($this->verificacionExistenciaEnPuntodeVenta($rsC['idproductosServicios'], $idOrigen)>0){
    while ($rs=mysqli_fetch_array($query)) { 
          # code...

          if ($this->normalizacionDeCaracteres(trim($rs['sku']))==$comparar) {
            $n++;
          }
        }
        if ($n>0) {
         $objResponse = 1;
        }
        else{
          $objResponse = 0;
        }
  }else{
    $objResponse = 0;
  }

    echo json_encode($objResponse); 
 
  $conn->close();
}




//Checkeo Existencia del producto
public function checkSkuAdd($parametros)
{
  $conn=$this->conectar();
  extract($parametros);
  //$sqlExistencia="SELECT idproductosServicios, sku FROM PRODUCTOSERVICIOS WHERE sku='".$parametro."' ";
  $sqlExistencia="SELECT idproductosServicios, sku, serializacion FROM PRODUCTOSERVICIOS WHERE sku='".trim($sku)."' ";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres(trim($sku));
  $query=$conn->query($sqlExistencia);
  $queryExistencia=$conn->query($sqlExistencia);
  if (mysqli_num_rows($queryExistencia)>0) {
    # code...
    $objResponse = 1;
  }else{
    $objResponse = 0;
  }

    echo json_encode($objResponse); 
 
  $conn->close();
}


/*=====  End of Section comment block  ======*/


//Existencia de un producto en el punto de venta
public function  verificacionExistenciaEnPuntodeVenta($idProductoServicio, $idPuntoVenta){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($idPuntoVenta);
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
    if (strlen($idPuntoVenta)==0) {
      # code...

      echo $sql="SELECT SUM(cantidadExistenteTraslado) AS existencia 
                                                      FROM  trasladosExistencia WHERE idProductoServicio= $idProductoServicio
                                                        ";
    }else{
        $sql="SELECT SUM(cantidadExistenteTraslado) AS existencia 
                                                      FROM  trasladosExistencia WHERE
                                                       destinoId=$idPuntoVenta
                                                       AND idProductoServicio= $idProductoServicio
                                                       AND cantidadExistenteTraslado >0 ";
    }
    
 


  $resultado = mysqli_fetch_assoc($conn->query($sql));
  
  return $resultado["existencia"];

}










//Verifoco que un producto exista en el INVENTARIOS de un local de origen
public function checkingexistenciaenorigen($idOrigen, $idProducto){
    $conn=$this->conectar();
    $idOrigen=$this->filtroNumerico($idOrigen);
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProducto, publickey));

  
    $sqlExistencia='SELECT SUM(cantidadExistenteTraslado) AS total FROM trasladosExistencia WHERE idProductoServicio = '.$idProductoServicio.' AND destinoId= '.$idOrigen.' ';
    $query=$conn->query($sqlExistencia);
    $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
    $objResponse = array('numero' => $rs['total'] );
    echo json_encode($objResponse);
}




public function checkingexistenciaenorigenTemp($idOrigen, $idProducto){
    $conn=$this->conectar();
    $idOrigen=$this->filtroNumerico($idOrigen);
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProducto, publickey));

  
    $sqlExistencia='SELECT SUM(cantidadExistenteTraslado) AS total FROM trasladosExistencia WHERE idProductoServicio = '.$idProductoServicio.' AND destinoId= '.$idOrigen.' ';
    $query=$conn->query($sqlExistencia);
    $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
    return $rs['total'];
}


public function costoTotalInventarioProducto($idProducto){

  $conn=$this->conectar();
  $idProductoServicio=$this->filtroNumerico($this->decrypt($idProducto, publickey));



 $sql="SELECT idProductoServicio, valorUnidad, impuesto, unidadesExistentes  FROM INVENTARIOS
                                      WHERE  idProductoServicio=$idProductoServicio AND
                                      unidadesExistentes > 0";
  $query=$conn->query($sql);
  $resultado=0;
  while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    # code...
      $valor=$rs['valorUnidad']*$rs['unidadesExistentes'];
      if ($rs['impuesto']>0) {   
        # code... 
        $valor=(($valor*$rs['impuesto'])/100)+$valor;   
      }
      $resultado=$valor+$resultado;
    

  }

 return $resultado;


}



/*===========================================
=            TRASLADOS MERCANCIA            =
===========================================*/

//CHECKEO SERIALES/IMEIS
public function checkImeiSerial($codigo, $idOrigen){
   $conn=$this->conectar(); 
   $codigo=trim($this->comillaSimplePorGuion(htmlentities($codigo))) ;
   $ubicacion=$this->filtroNumerico($idOrigen);
   $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, ubicacion  FROM serialesImeis WHERE codigo='".$codigo."'AND estado='en almacen' AND   ubicacion='".$ubicacion."' AND inventariado=0 ";
   $queryImeiSerial=$conn->query($sqlImeis);
   $rs=mysqli_fetch_array($queryImeiSerial, MYSQLI_ASSOC);
   $resultado=array('idSerialImei'=> $this->encrypt($rs['idSerialImei'], publickey),
                    'idProductoServicio'=>$this->encrypt($rs['idProductoServicio'], publickey),
                    'codigo'=>$rs['codigo'],
                    'ubicacion'=>$rs['ubicacion'], 
                    'valorVentaUnidad' => number_format($this->getDatosProductoServicio($rs['idProductoServicio'])['valorVentaUnidad']),
                    'nombreProductosServicios' =>  $this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios']

);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
}


/*=====  End of TRASLADOS MERCANCIA  ======*/




/*============================================
=            SECCION DE BUSQUEDAS            =
============================================*/


//QUERY BUSQUEDAS GENERALES

public function busquedaGeneral($parametro){
    $conn=$this->conectar();
  
  //Limpio los caracteres
  $parametro=$parametro;

  //Verifico existencia del producto
   $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios FROM PRODUCTOSERVICIOS 
                                      WHERE sku ='".$parametro."' OR nombreProductosServicios LIKE '%".$parametro."%'";
  $queryProductoServicio=$conn->query($sqlProductoServicio);

  if (mysqli_num_rows($queryProductoServicio)>0) {

      if (mysqli_num_rows($queryProductoServicio)>1) {
        # Producto existe mas de una vez (matriculado)
        $this->listaProductosEncontrados($parametro, 1);
      }else{
          //Este producto matriculado solo existe una vez
          $rs=mysqli_fetch_array($queryProductoServicio, MYSQL_ASSOC);
          $idProductoServicio=$rs['idproductosServicios'];
          $this->listaProductosEncontrados($parametro, 2);
      

      }
     
    # El producto si existe en la base de datos
    //Verifico si existe en INVENTARIOS 

    

  }else{
    //No lo encuentro, búscalo en los IMEI/SERIALES
    $sqlImeiSerial="SELECT codigo, idProductoServicio, ubicacion FROM serialesImeis 
                                      WHERE codigo='%".$parametro."%'
    ";
    $queryImeiSerial=$conn->query($sqlImeiSerial);

      if (mysqli_num_rows($queryImeiSerial)>0) {
        # Existe en imeis Saco el Id   
        $rs=mysqli_fetch_array($queryImeiSerial, MYSQL_ASSOC);
        $sku=$this->datosProductoServicio($this->encrypt($rs['idProductoServicio'],publickey))['sku'];
        echo $this->listaProductosEncontrados($sku, 1);
      }
      else{

        $sqlImeiSerial="SELECT codigo, idProductoServicio, ubicacion FROM serialesImeis 
                                      WHERE codigo LIKE '%".$parametro."'  ";
        $queryImeiSerial=$conn->query($sqlImeiSerial);

         if (mysqli_num_rows($queryImeiSerial)>0) {
        # Existe en imeis Saco el Id   
        $rs=mysqli_fetch_array($queryImeiSerial, MYSQL_ASSOC);
        $sku=$this->datosProductoServicio($this->encrypt($rs['idProductoServicio'],publickey))['sku'];
        echo $this->listaProductosEncontrados($sku, 1);
      }else{
        echo '<div class="alert alert-info col-md-12" align="center"><h4><i class="fa fa-info-circle"></i> Ops! no pude encontrar nada con los términos de búsqueda que me mandaste</h4></div><br><hr><br>';
        //No existe el producto con imei
        }
      }
  }


  $conn->close();
}






private function busquedaProductoId($idProductoServicio){
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
    $sqlInventario="SELECT idProductoServicio, unidadesExistentes  FROM INVENTARIOS WHERE idProductoServicio=$idProductoServicio";
    $queryInventario=$conn->query($sqlInventario);
    if (mysqli_num_rows($queryInventario)>0) {
      # HAY EXISTENCIA

      return mysqli_num_rows($queryInventario);
    }else{

      return 0;
      //No hay existencia
    }


}


private function listaProductosEncontrados($parametro, $tipo){
  $conn=$this->conectar();
  //[01]:Multiples coincidencias
  //[02]:solo una coincidencia
  //[03]:Coincidencia solo en seriales e imeis
  if($tipo==1 OR $tipo==2){
    $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios, valorVentaUnidad FROM PRODUCTOSERVICIOS 
                                      WHERE sku ='".$parametro."' OR nombreProductosServicios LIKE '%".$parametro."%'";
    $queryProductoServicio=$conn->query($sqlProductoServicio);
  
    
  }else if($tipo==3){
    //Consulta para INVENTARIOS

  }


  echo '<table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
              <thead>
                <tr>
                  <th>SKU </th>
                  <th>Nombre Producto</th>
                  <th>Valor</th>
                  <th data-hide="all" > Existencia en Punto</th>
                  <th data-hide="" data-toggle="true"> Existencia Global </th>
                  <th data-hide="all" ><i class="fa fa-plus"></i></th>
                </tr>
              </thead>
              <tbody id="linea">
      ';
      while ($rs=mysqli_fetch_array($queryProductoServicio, MYSQLI_ASSOC)) {
        # code...
        echo '<tr>
                  <td>'.$rs['sku'].'</td>
                  <td>'.$rs['nombreProductosServicios'].'</td>
                  <td align="center">'.$this->analisisValorVenta($rs['valorVentaUnidad'], $rs['idproductosServicios']).'</td>
                  <td align="center"></td>
                  
                  <td align="center">'.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).'</td>
                  <td><i class="fa  fa-plus-circle" id="muestraMas" name="show_'.$this->filtrocaracteres(($rs['sku'])).'"></i></td>
              </tr>
             </tr>


             <tr id="show_'.$this->filtrocaracteres($rs['sku']).'" style="display:none">
               <td class="tg-031e" colspan="6">
                    ';

                    $this->distribucionProducto($rs['idproductosServicios']);

                    echo '
               </td>
            </tr>
                ';


       
      }

      echo '
           </tbody>
            </table>
      ';
}









/*=====================================================
=            DISTRIBUCIÓN DE LOS PRODUCTOS            =
=====================================================*/

public function distribucionProducto($idProducto){
  $conn=$this->conectar();


  $sqlTraslados='SELECT destinoId, SUM(cantidadExistenteTraslado) AS existencias FROM trasladosExistencia WHERE idProductoServicio = '.$idProducto.' GROUP BY destinoId
';
  $queryExistencia=$conn->query($sqlTraslados);

  while ($rs=mysqli_fetch_assoc($queryExistencia)) {
    # code...
     if ($this->getCantidadExistenciasProductoEnPunto($idProducto,  $rs['destinoId'])>0) {
        echo '<div class="col-md-6 white-box" id="lista">
          <h4 align="center">'.$this->datosPuntoVenta($this->encrypt($rs['destinoId'], publickey))['nombrePunto'].'</h4>
          <h3 align="center">'.$this->getCantidadExistenciasProductoEnPunto($idProducto,  $rs['destinoId']).'</h3>
      ';
    $this->listaImieisEnPuntoSearch($rs['destinoId'], $idProducto);
     echo '</div> 
     
        ';
     }
  

  }

}




//listo los imei o seriales para el buscador 
private function listaImieisEnPuntoSearch($idPuntoVenta, $idProductoServicio){
    $conn=$this->conectar();
    $sql="SELECT codigo, ubicacion, estado  FROM serialesImeis WHERE ubicacion=$idPuntoVenta AND idProductoServicio=$idProductoServicio  AND estado != 'vendido' ";
    $querySeriales=$conn->query($sql);
if (mysqli_num_rows($querySeriales)>0) {
      while ($rs=mysqli_fetch_array($querySeriales)) {
          echo  '<div align="center"> '.$rs['codigo'].'</div> ';
      }
    }

}
/*=====  End of DISTRIBUCIÓN DE LOS PRODUCTOS  ======*/





/*==============================
=            LISTAS         =
==============================*/


    /*===================================
    =            PROVEDORES            =
    ===================================*/
      //listo todas las compras de los provedores
      public function listaCompraAProvedor(){
        //QUEDÉ EN LISTAR LAS COMPRAS QUE SE HICIERON A ESE PROVEROR
        $conn=$this->conectar();
        $idProvedor=$this->filtroNumerico($this->decrypt($_SESSION['IDPROVEDOR'], publickey));
        $sqlLista="SELECT * FROM facturasProvedores WHERE idProvedor=$idProvedor";
        $query=$conn->query($sqlLista);
        echo '<div class="table-responsive">
                  <table id="tablaB" class="table table-striped">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th><div align="center">Nro Factura</div></th>
                        <th align="center">Estado</th>
                        <th  align="center">Valor</th>
                        <th  align="center">Deuda</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
          ';
          while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
            # code...
          echo'<tr class="'.$this->cssEstadoPago($rs['estadoFactura']).'">
                  <td>'.$rs['fechaFacturaProvedor'].'</td>
                  <td><div align="center"> '.$rs['nroFacturaProvedor'].' </div> </td>
                  <td><div align="center"> '.$rs['estadoFactura'].'</div></td>
                  <td><div align=""> $ '.number_format($rs['valorFacturaProvedor']).'</div></td>
                  <td><div align=""> $ '.number_format($rs['deudaFacturaProvedor']).'</div></td>
                  <td>
                      <button type="button" class="btn btn-info" id="facturaProvedor" value="'.$this->encrypt($rs['idfacturaProvedor'], key).'"  onclick="link(this.value)"> <i class="fa fa-plus-circle"></i> Ver Mas</button>
                  </td>      
                </tr>
            ';
          }

          echo '</tbody>
              </table>
            </div>
          ';

      }



      //LISTA DE LOS ITEMS COMPRADOS EN UNA FACTURA A UN PROVEDOR
      public function listaProductosFacturaProvedor(){
       
        $conn=$this->conectar();
        $idProvedor=$this->filtroNumerico($this->decrypt($_SESSION['IDPROVEDOR'], publickey));
        $idFacturaProvedor=$this->filtroNumerico($this->decrypt($_SESSION['IDFACTURAPROVEDOR'], key));

        $sqlLista="SELECT  idinventario, idProvedor, IdFacturaProvedor,idProductoServicio, valorUnidad, impuesto,  unidadesCompradas, unidadesExistentes  FROM INVENTARIOS WHERE IdFacturaProvedor=$idFacturaProvedor AND idProvedor=$idProvedor";
        $query=$conn->query($sqlLista);
        $n=0;
        echo '<div class="table-responsive">
                  <table id="tablaB" class="table table-striped">
                    <thead>
                      <tr>

                        <th><div align="center">SKU</div></th>
                        <th align="center">PRODUCTO</th>
                        <th  align="center">Valor Unidad</th>
                        <th  align="center">Impuesto</th>
                        <th  align="center">Unidades Compradas</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
          ';
          
          while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
            # code...
          echo'<tr>
                  <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['sku'].'</td>
                  <td><div align="center"> '.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].' </div> </td>
                  
                  <td>
                    <div align="center" id="changeValorUnidad_'.$n.'">
                        <button class="btn btn-basic"  value="'.$n.'|'.number_format($rs['valorUnidad']).'|'.$this->encrypt($rs['idinventario'], publickey).'" ondblclick="editarItemValorUnidad(this.value)">$ '.number_format($rs['valorUnidad']).'</button>
                    </div>
                  </td>


                  <td>
                    <div align="center" id="changeValorimpuesto_'.$n.'">
                      <button class="btn btn-basic"  value="'.$n.'|'.number_format($rs['impuesto']).'|'.$this->encrypt($rs['idinventario'], publickey).'" ondblclick="editarItemImpuesto(this.value)"> $ '.number_format($rs['impuesto']).'</button>
                    </div>
                  </td>

                ';

                if ($this->getDatosProductoServicio($rs['idProductoServicio'])['serializacion'] =='si') {
                  # //Lighbox cambio seriales
                  echo ' 
                  <td>
                      <div align="center" id="changeUnidadesCompradas_'.$n.'">
                        <button class="btn btn-basic"  value="'.$n.'|'.number_format($rs['unidadesCompradas']).'|'.$this->encrypt($rs['idinventario'], publickey).'" ondblclick="editarUnidadesCompradas(this.value)"> '.$rs['unidadesCompradas'].'</button>
                      </div>
                  </td>';


                }else{

                  echo ' 
                  <td>
                      <div align="center" id="changeUnidadesCompradas_'.$n.'">
                        <button class="btn btn-basic"  value="'.$n.'|'.number_format($rs['unidadesCompradas']).'|'.$this->encrypt($rs['idinventario'], publickey).'" ondblclick="editarUnidadesCompradas(this.value)"> '.$rs['unidadesCompradas'].'</button>
                      </div>
                  </td>';


                }
              echo '
                  
                  
                  <td>
                      <button type="button" class="btn btn-danger" id="itemFacturaProvedor" value="'.$this->encrypt($rs['idinventario'], key).'" ondblclick="eliminarSub(this.value)" > <i class="fa fa-trash"></i></button>
                  </td>      
                </tr>
            ';
            $n++;
          }

          echo '</tbody>
              </table>
            </div>
          ';

      }




      public function serializacionProductosEnFactura(){
        $conn=$this->conectar();
        $idFactura=$this->decrypt($_SESSION['IDFACTURAPROVEDOR'], key);
        $sqlSeriales="SELECT idFacturaProvedor, codigo, idProductoServicio, ubicacion  FROM  serialesImeis WHERE idFacturaProvedor =$idFactura ";
        $query=$conn->query($sqlSeriales);
        if (mysqli_num_rows($query)>0) {
          # code...
          echo '<div class="table-responsive">
                  <table id="tablaB" class="table table-striped">
                    <thead>
                      <tr>

                        <th><div align="center">SERIAL</div></th>
                        <th align="center">PRODUCTO</th>
                        <th  align="center">UBICACION</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
          ';
            while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              # code...

              echo'<tr>
                    <td>'.$rs['codigo'].'</td>
                    <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                    <td align="center">'.$this->getDatosPuntosVenta($this->encrypt($rs['ubicacion'], publickey))['alias'].'</td>
                  </tr>  
              ';
            }



         echo '</tbody>
              </table>
            </div>
          ';
        }else{
          echo '<h4>No hay productos con seriales </h4>';
        }
      }






      //FIN DE LA COMPRA DE LOS PROVEDORES
    public function listaProvedores($parametros){
      $conn=$this->conectar();
      extract($parametros);
      $pagina=$page;
      $busqueda = mysqli_real_escape_string($conn,(strip_tags($q, ENT_QUOTES)));
      $pagina = (isset($pagina) && !empty($pagina))?$pagina:1;
      $porPagina = 7; //how much records you want to show
      $adjacents  = 4; //gap between pages after number of adjacents
      $offset = ($pagina - 1) * $porPagina;
      //Cuento el número total de registros
      $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM provedores  WHERE nombreProvedor != ''");
      $filas= mysqli_fetch_array($count_query);
      $numrows = $filas['numeroConsultas']; //El numero de consultas
      $totalPaginas = ceil($numrows/$pagina);

      $reload = '../../../modulos/provedores/index.php';
      if (strlen($q)>2) {
        # es una busqueda...
         $sql="SELECT idprovedor, nombreProvedor, ideProvedor, contactoProvedor, telefonoProvedor FROM provedores WHERE nombreProvedor LIKE  '%".$busqueda."%'  ORDER BY nombreProvedor ASC LIMIT $offset,$porPagina";
      }else{

        //Es un 
         $sql="SELECT idprovedor, nombreProvedor, ideProvedor, contactoProvedor, telefonoProvedor FROM provedores WHERE nombreProvedor != '' ORDER BY nombreProvedor ASC LIMIT $offset,$porPagina";
      }
     
      $query = $conn->query($sql);
        

echo '<table id="tablaProvedores" class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre Provedor</th>
                  <th>Teléfonos</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      # code...
        echo '<tr>
                  <td>'.$rs["nombreProvedor"].'</td>
                  <td>'.$rs["telefonoProvedor"].'</td>
                  
                  <td>
                    <a href="'.PATH.'modulos/provedores/link.php?idprovedor='.$this->encrypt($rs["idprovedor"], publickey).'" >

                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>';
    }
      echo '</tbody>
      
          </table>
      ';

      echo '<div class="col-md-12" align="center">'.$this->paginate($reload, $pagina, $totalPaginas, $adjacents).'<div>';
    }




public function listaProductosServicios($parametros){
      $conn=$this->conectar();
      extract($parametros);
      $pagina=$page;
      $busqueda = mysqli_real_escape_string($conn,(strip_tags($q, ENT_QUOTES)));
      $pagina = (isset($pagina) && !empty($pagina))?$pagina:1;
      $porPagina = 20; //how much records you want to show
      $adjacents  = 4; //gap between pages after number of adjacents
      $offset = ($pagina - 1) * $porPagina;
      //Cuento el número total de registros

      $categoria=(int)$categoria;
      $subCategoria=(int)$subCategoria;
      $reload = '../../../modulos/inventario/index.php';





      if ($categoria==0 AND $subCategoria==0 AND strlen($q)>2) {//Esta sin categoria y lo busca con nombre
        # code...
        $number= 1;
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE nombreProductosServicios LIKE  ('%".$busqueda."%'  OR sku  LIKE '%".$busqueda."') ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";


      }else if ($categoria>0 AND $subCategoria==0 AND  strlen($q)>1) {//Solo con categoria y con nombre o sku
        $number= 2;
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE (nombreProductosServicios LIKE  '%".$busqueda."%'  OR sku  LIKE '%".$busqueda."') AND (categoria=$categoria) ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
        # code...
      }else if ($categoria>0 AND $subCategoria>0 AND  strlen($q)>1) {//Con Categoria y SubCategoria y nombre o sku
        # code...
        $number= 3;
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE (nombreProductosServicios LIKE  '%".$busqueda."%'  OR sku  LIKE '%".$busqueda."') AND (categoria=$categoria  AND subCategoria=$subCategoria)  ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";



      }else if ($categoria>0 AND $subCategoria==0 AND strlen($q)==0) {//Solo con categoria
        # code...
        $number= 4;
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE categoria=$categoria  ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";

      }else if ($categoria>0 AND $subCategoria>0 AND strlen($q)==0) {//Con Categoria y SubCategoria

        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE( categoria=$categoria AND subCategoria=$subCategoria)  ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
        # code...

      }else if ($categoria>0 AND $subCategoria==0 AND strlen($q)>1) {//Con Categoria y SubCategoria

        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE (categoria=$categoria) AND (nombreProductosServicios LIKE '%".$q."%' OR  nombreProductosServicios LIKE '".$q."' ) ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
        # code...

      }
      else if(strlen($q)==0){

        $number= 6;
         $sql="SELECT idproductosServicios, sku, nombreProductosServicios  FROM PRODUCTOSERVICIOS WHERE nombreProductosServicios != '' ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";

      }


    //CONTADOR
      $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM PRODUCTOSERVICIOS  WHERE nombreProductosServicios != ''");




     $filas= mysqli_fetch_array($count_query);
      $numrows = $filas['numeroConsultas']; //El numero de consultas
      $totalPaginas = ceil($numrows/$pagina);
     $query= $conn->query($sql);

echo '<table id="tablaInventario" class="table table-striped">
              <thead>
                <tr>
                  <th>Sku/Código</th>
                  <th>Nombre Producto</th>
                  <th onclick="ordenar()">Existencia Global</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      # code...
        echo '<tr>
                  <td>'.$rs["sku"].'</td>
                  <td>'.$rs["nombreProductosServicios"].'</td>
                  <td align="center"> <span class="label label-success label-rouded">'.$this->getCantidadExistenciasProductoEnGlobal($rs["idproductosServicios"]).'</span></td>
                  
                  <td>
                    <a href="'.PATH.'modulos/inventario/link.php?idProductoServicio='.$this->encrypt($rs["idproductosServicios"], publickey).'" >

                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>';
    }
      echo '</tbody>
      
          </table>
      ';

      echo '<div class="col-md-12" align="center">'.$this->paginate($reload, $pagina, $totalPaginas, $adjacents).'<div>';
    }




/*===========================================
=            LISTADO DE CLIENTES            =
===========================================*/

public function listaClientes($parametros){
      $conn=$this->conectar();
      extract($parametros);
      $pagina=$page;
      $busqueda = mysqli_real_escape_string($conn,(strip_tags($q, ENT_QUOTES)));
      $pagina = (isset($pagina) && !empty($pagina))?$pagina:1;
      $porPagina = 20; //El numero de paginas que debo mostrar
      $adjacents  = 10; //gap between pages after number of adjacents
      $offset = ($pagina - 1) * $porPagina;
      //Cuento el número total de registros

      $categoria=(int)$categoria;
      $subCategoria=(int)$subCategoria;
      $reload = '../../../modulos/asociados/index.php';


    if (strlen($q)>0) {
         $sql="SELECT idcliente, identificacionCliente, tipoDocumento, nombreCliente  FROM  clientes WHERE   nombreCliente LIKE ('%".$busqueda."%')  OR identificacionCliente  LIKE ('%".$busqueda."') ORDER BY nombreCliente ASC LIMIT $offset,$porPagina";
      }
    else if(strlen($q)==0){
         $sql="SELECT idcliente, identificacionCliente, tipoDocumento, nombreCliente  FROM clientes WHERE nombreCliente != '' ORDER BY nombreCliente ASC LIMIT $offset,$porPagina";
      }

    //CONTADOR
      $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM clientes");



     $filas= mysqli_fetch_array($count_query);

      $numrows = $filas['numeroConsultas']/$porPagina; //El numero de consultas
      $totalPaginas = ceil($numrows/$pagina);
     $query= $conn->query($sql);

echo '<table id="tablaClientes" class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre Cliente</th>
                  <th>Identificación</th</th>
                  <th>Tipo Identificación</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
      # code...
        echo '<tr>
                  <td>'.$rs["nombreCliente"].'</td>
                  <td>'.$rs["identificacionCliente"].'</td>
                  <td>'.$rs["tipoDocumento"].'</td>
                  
                  <td>
                    <a href="'.PATH.'modulos/asociados/link.php?idCliente='.$this->encrypt($rs["idcliente"], publickey).'" >

                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>';
    }
      echo '</tbody>
      
          </table>
      ';

      echo '<div class="col-md-12" align="center">'.$this->paginate($reload, $pagina, $totalPaginas, $adjacents).'<div>';
    }







//Paginador
public function paginate($reload, $page, $tpages, $adjacents) {
  $prevlabel = "&lsaquo; Anterior";
  $nextlabel = "Siguiente &rsaquo;";
  $out = '<ul class="pagination pagination-large">';
  
  // previous label

  if($page==1) {
    $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
  } else if($page==2) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
  }else {
    $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";

  }
  
  // first label
  if($page>($adjacents+1)) {
    $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
  }
  // interval
  if($page>($adjacents+2)) {
    $out.= "<li><a>...</a></li>";
  }

  // pages

  $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
  $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
  for($i=$pmin; $i<=$pmax; $i++) {
    if($i==$page) {
      $out.= "<li class='active'><a>$i</a></li>";
    }else if($i==1) {
      $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
    }else {
      $out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
    }
  }

  // interval

  if($page<($tpages-$adjacents-1)) {
    $out.= "<li><a>...</a></li>";
  }

  // last

  if($page<($tpages-$adjacents)) {
    $out.= "<li><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
  }

  // next

  if($page<$tpages) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
  }else {
    $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
  }
  
  $out.= "</ul>";
  return $out;
}



public function paginador($reload, $page, $tpages, $adjacents) {
  $prevlabel = "&lsaquo; Anterior";
  $nextlabel = "Siguiente &rsaquo;";
  $out = '<ul class="pagination pagination-large">';
  
  // previous label

  if($page==1) {
    $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
  } else if($page==2) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='loadIndexacion(1)'>$prevlabel</a></span></li>";
  }else {
    $out.= "<li><span><a href='javascript:void(0);' onclick='loadIndexacion(".($page-1).")'>$prevlabel</a></span></li>";

  }
  
  // first label
  if($page>($adjacents+1)) {
    $out.= "<li><a href='javascript:void(0);' onclick='loadIndexacion(1)'>1</a></li>";
  }
  // interval
  if($page>($adjacents+2)) {
    $out.= "<li><a>...</a></li>";
  }

  // pages

  $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
  $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
  for($i=$pmin; $i<=$pmax; $i++) {
    if($i==$page) {
      $out.= "<li class='active'><a>$i</a></li>";
    }else if($i==1) {
      $out.= "<li><a href='javascript:void(0);' onclick='loadIndexacion(1)'>$i</a></li>";
    }else {
      $out.= "<li><a href='javascript:void(0);' onclick='loadIndexacion(".$i.")'>$i</a></li>";
    }
  }

  // interval

  if($page<($tpages-$adjacents-1)) {
    $out.= "<li><a>...</a></li>";
  }

  // last

  if($page<($tpages-$adjacents)) {
    $out.= "<li><a href='javascript:void(0);' onclick='loadIndexacion($tpages)'>$tpages</a></li>";
  }

  // next

  if($page<$tpages) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='loadIndexacion(".($page+1).")'>$nextlabel</a></span></li>";
  }else {
    $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
  }
  
  $out.= "</ul>";
  return $out;
}

    /*=====  End of PROVEDORES  ======*/
  





public function listaPreTraslado($token){
    $conn=$this->conectar();
    $token=$this->filtroNumerico($token);

    $sqlTraslados="SELECT * FROM trasladosMercancia WHERE token=$token ";
    $query=$conn->query($sqlTraslados);


      echo '<div class="table-responsive">
            <table id="tablaB" class="table table-striped">
              <thead>
                <tr>
                  <th><div>SKU</div></th>
                  <th><div align="center">PRODUCTO</div></th>
                  <th><div align="center">UNIDADES</div></th>
                  <th><div align="center">CODIGO</div></th>
                  <th><div align="center"></div></th>
                </tr>
              </thead>
              <tbody>
    ';

     while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
     echo '<tr>
            <input type="hidden" id="idTraslado" value="'.$rs['idTraslado'].'">
            <td>'.$rs['sku'].'</td>
            <td align="center"> '.$rs['nombreProductosServicios'].'</td>
            <td  align="center"> '.$rs['unidades'].'</td>
            <td align="center">'.$rs['codigo'].'</td>
            <td align="center"><i class="fa fa-trash" id="deletePreFactura"  onClick="deleteRow('.$rs['idTraslado'].')"></i></td>
          </tr>';
    } 
echo '</tbody>
            </table>
            </div>';


echo '<div class="col-md-12" align="center"> <button type="button" class="btn btn-info" onclick="trasladoMercancia()">  <i class="fa fa-arrow-circle-right"></i> Trasladar Mercancia</button> </div>';

}





public function preTraslado($parametros){
      $conn=$this->conectar();
      extract($parametros);
      $token=$this->filtroNumerico($token);
      $destinoId=$this->filtroNumerico($destinoId);
      $sql='UPDATE trasladosMercancia SET idDestino = '.$destinoId.'  WHERE token='.$token.'';
      $query=$conn->query($sql);
            $objResponse = array('token' => strtotime(date("Y-m-d H:i:s")) );
            $objResponse = array('codigo' => $token);

    echo json_encode($objResponse); 


}








public function listaFacturasRango($fecha){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

  $fecha1=$fecha.' 00:00:00';
  $fecha2=$fecha.' 23:59:00';
  if (isset($fecha1, $fecha2)) {
    # code...
     $sqlFactura="SELECT idFactura, nroFactura, idPuntoVenta, fechaFactura, valorTotalFactura, 
                        tipoPago, estadoFactura, pertenencia
      FROM facturacion WHERE (idPuntoVenta=$idPuntoVenta OR pertenencia=$idPuntoVenta)
                          AND fechaFactura BETWEEN '".$fecha1."' AND '".$fecha2."' ";
  }
  else if(isset($fecha1) AND !isset($fecha2)){
     $sqlFactura="SELECT idFactura, nroFactura, idPuntoVenta, fechaFactura, valorTotalFactura, 
                        tipoPago, estadoFactura, pertenencia
      FROM facturacion WHERE (idPuntoVenta=$idPuntoVenta OR pertenencia=$idPuntoVenta)
                          AND fechaFactura BETWEEN '".$fecha1."' AND '".$fecha1."' ";
  }


  else{
    $sqlFactura="SELECT idFactura, nroFactura, idPuntoVenta, fechaFactura, valorTotalFactura, 
                        tipoPago, estadoFactura, pertenencia
      FROM facturacion WHERE(idPuntoVenta=$idPuntoVenta OR pertenencia=$idPuntoVenta)
                          AND fechaFactura = '".date('Y-m-d')."' ";
  }
  $query=$conn->query($sqlFactura);


  echo '<div class="table-responsive">
            <table id="tablaB" class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nro Factura</th>
                  <th>Estado</th>
                  <th><div align="center">Tipo Pago</div></th>
                  <th>Valor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQL_ASSOC)) {
      # code...
      if($rs['pertenencia'] != $idPuntoVenta AND strlen($rs['pertenencia'] != 0)){   $foraneo="*"; $t=0; }else{$foraneo=""; $t=1;}


      echo '<tr class="'.$this->cssEstadoPago($rs['estadoFactura']).'">
                  <td> '.$foraneo.'  '.$rs['fechaFactura'].'</td>
                  <td align="center">'.$rs['nroFactura'].'</td>
                  <td>'.$rs['estadoFactura'].'</td>
                  <td align="center">'.$rs['tipoPago'].'</td>
                  <td  align="center">'.number_format($rs['valorTotalFactura']).'</td>
                  <td>
                  <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'],publickey).'">
                     <i class="fa fa-arrow-circle-right"  value="'.$rs['idFactura'].'" id="deleteRow" title="Ver La Factura"></i> Ver
                    </a>
                  </td>
                </tr>';
    }
                
  echo '      </tbody>
            </table>
            </div>';
  echo '<div class="pull-right m-t-30 text-right">
                        <p>Total Facturado </p>
                        <hr> 
                        <h3 class="text-success"><b>Total :</b> '.number_format($this->calculoTotalFacturas($fecha1, $fecha2)).'</h3>
                      </div>';
}




public function listaExistenciaPorProducto($idProductoServicio){
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProductoServicio, publickey));
    $seriales=$this->getDatosProductoServicio($idProductoServicio)['serializacion'];
    $sqlLista='SELECT DISTINCT (destinoId) FROM trasladosExistencia WHERE idProductoServicio='.$idProductoServicio.' ORDER BY(idProductoServicio) ASC';
    
    if ($seriales=='si') {
      # code...
      $col='col-md-8';
      $a=1;
    }else{
      $col='col-md-12';
    }
    $query=$conn->query($sqlLista);
    echo '<div class="table-responsive white-box '.$col.'">
            <table class="table">
              <thead>
                <tr>
                  <th>Punto de Venta</th>
                  <th>Existencia</th>

                </tr>
              </thead>
              <tbody>';
    while ($resultado=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      $existencia=$this->getCantidadExistenciasProductoEnPunto($idProductoServicio, $resultado['destinoId']);
      if ($existencia>0) {
        # code...
    
        echo ' <tr>
                  <td>'.$this->getDatosPuntosVenta($this->encrypt($resultado['destinoId'], publickey))['alias'].'</td>
                  <td> <span class="label label-success label-rouded">'.$existencia.'</span></td>
              
              </tr>';
              }
    }
    echo '</tbody>
            </table>
          </div>';



  //EL PRODUCTO TIENE IMEI O SERIALES
  if ($a==1) {
    # code...
    echo '<div class="table-responsive white-box col-md-4">

    <h3>SERIALES / IMEIS</h3>
            <table class="table">
              <thead>
                <tr>
                  <th>CODIGO</th>
                  <th>UBICACIÓN</th>
                </tr>
              </thead>
              <tbody>';
$sqlImeis="SELECT idSerialImei, tipo, codigo, ubicacion, estado from  serialesImeis WHERE idProductoServicio=$idProductoServicio ORDER BY(estado) ASC  ";
  $queryImeis=$conn->query($sqlImeis);
while($rsImeis=mysqli_fetch_array($queryImeis, MYSQLI_ASSOC)){
    if ($rsImeis['estado']=='vendido') {
      # code...
      $style='style="text-decoration-line: line-through; color:red; font-size:12px;"';
    }else{
         $style='style="color:green; font-size:12px;"';
    }

          echo '
          <a href=""><tr '.$style.'>
          <td>'.$rsImeis['codigo'].'</td>
                <td> '.$this->getDatosPuntosVenta($this->encrypt($rsImeis['ubicacion'], publickey))['alias'].'</td>

          </tr></a>
          ';
}
    echo '</tbody>
            </table>
          </div>
              ';
  }



   


} 




//GET RANGO DE FACTURAS DE PUNTO DE VENTA
public function getFacturasRango($fecha1, $fecha2){
    $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
  $sql="SELECT idFactura, nroFactura, prefijo, idPuntoVenta, idCliente, fechaFactura, estadoFactura, valorNetoFactura, valorTotalFactura, deudaFactura, codigoVendedor, tipoPago FROM facturacion WHERE idPuntoVenta=$idPuntoVenta AND 
    fechaFactura >= '".$fecha1."' and fechaFactura <= '".$fecha2."'
     ";
    $query=$conn->query($sql);

    echo '<div class="table-responsive m-t-40">
            <table id="listados" class="display nowrap table table-hover table-striped table-bordered" >
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nro Factura</th>
                  <th>Cliente</th>
                  <th>Identificación</th>
                  <th>Estado Factura</th>
                  <th>Valor Neto</th>
                  <th>Valor Total</th>
                  <th>Impuestos</th>
                  <th>Deuda</th>
                  <th>Tipo de Pago</th>
                  <th>Vendedor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQL_ASSOC)) {

      if ($rs['estadoFactura'] != 'pagada' ) {
        # code...
        $css='text text-danger';
      }else{
        $css='text text-success';
      }
      echo '<tr class="'.$css.'">
                  <td>'.$rs['fechaFactura'].'</td>
                  <td>'.$rs['prefijo'].''.$rs['nroFactura'].'</td>
                  <td>'.$this->sqlCliente($rs['idCliente'])['nombreCliente'].'</td>
                  <td>'.$this->sqlCliente($rs['idCliente'])['identificacionCliente'].'</td>
                  <td>'.$rs['estadoFactura'].'</td>
                  <td>$ '.number_format($rs['valorNetoFactura']).'</td>
                  <td>$ '.number_format($rs['valorTotalFactura']).'</td>
                  <td>$ '.number_format($rs['valorTotalFactura']-$rs['valorNetoFactura']).'</td>
                  <td>$ '.number_format($rs['deudaFactura']).'</td>
                  <td>'.$rs['tipoPago'].'</td>
                  <td>'.$this->datosVendedores($rs['codigoVendedor'])['nombre'].'</td>
                  <td>
                    <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'], publickey).'">
                     <i class="fa fa-arrow-circle-right"  title="Eliminar Gasto"></i>
                    </a>
                  </td>
                </tr> ';


echo "<script>$(function() {
        $('#myTable').DataTable();
    });
    $('#listados').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    });
    $('.buttons-excel').addClass('btn btn-success mr-1');
</script>";
    }
            

}






/*=============================================
=            LISTA PRODUCTOS PUNTO            =
=============================================*/



/*=====  End of LISTA PRODUCTOS PUNTO  ======*/








/*=====================================================
=            LISTADO DE TRASLADOS DE PUNTO            =
=====================================================*/
public function getListaTrasladosPunto($fecha1, $fecha2){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

  $sql="SELECT idProductoServicio, origenId, destinoId, fechaTraslado, cantidadTrasladada, tokenTraslado FROM trasladosExistencia WHERE (origenId=$idPuntoVenta  || destinoId=$idPuntoVenta)  AND 
    (fechaTraslado >= '".$fecha1." 00:00:01' AND fechaTraslado <= '".$fecha2." 23:59:00')
     ";
    $query=$conn->query($sql);

    echo '<div class="table-responsive m-t-40">
            <table id="listadosTraslados" class="display nowrap table table-hover table-striped table-bordered" >
              <thead>
                <tr>
                  <th><div align="center">Fecha Traslado</div></th>
                  <th><div align="center">Producto</div></th>
                  <th><div align="center">Cantidades</div></th>
                  <th><div align="center">Origen</div></th>
                  <th><div align="center">Destino</div></th>
                  <th><div align="center">Seriales/Imeis</div></th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC)) {

      $serialesImeis=$this->getSerialesTraslado($rs['idProductoServicio'], $rs['tokenTraslado']);
     
      echo '<tr class="">
                  <td>'.$rs['fechaTraslado'].'</td>
                  <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                  <td>'.$rs['cantidadTrasladada'].'</td>
                  <td>'.$this->getDatosPuntosVenta($this->encrypt($rs['origenId'], publickey))['alias'].'</td>
                  <td>'.$this->getDatosPuntosVenta($this->encrypt($rs['destinoId'], publickey))['alias'].'</td>
                  <td>
                    '.$serialesImeis.'
                  </td>
                </tr> ';


echo "<script>$(function() {
        $('#mitabla').DataTable();
    });
    $('#listadosTraslados').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    });
    $('.buttons-excel').addClass('btn btn-success mr-1');
</script>";
    }
            

}





//GET LOS SERIALES/IMEIS QUE SE HICIERON DE UN PRODUCTO EN UN TRASLADO
private function getSerialesTraslado($idProductoServicio, $tokenTraslado){
  $conn=$this->conectar();
  $seriales=array();
  $idProductoServicio=$this->filtroNumerico($idProductoServicio);
  $tokenTraslado=$this->filtroNumerico($tokenTraslado);
  $sqlSeriales="SELECT origenId, destinoId, idProductoServicio, codigo, tokenTraslado 
                                              FROM historicoTrasladosCodigos
                                              WHERE idProductoServicio=$idProductoServicio
                                              AND tokenTraslado=$tokenTraslado
                                               ";
  $n=0;
  $querySeriales=$conn->query($sqlSeriales);
  while ($rs=mysqli_fetch_array($querySeriales, MYSQLI_ASSOC)) {
    # code...
    $seriales[$n]=$rs['codigo'];
    $n++;
  }

  return wordwrap(implode(', ',$seriales));

}
/*=====  End of LISTADO DE TRASLADOS DE PUNTO  ======*/




//Elimino las lineas de los pre-traslados
public function deleteRowTraslado($idTraslado){
  $conn=$this->conectar();
  $idTraslado=$this->filtroNumerico($idTraslado);
  $sql="DELETE FROM trasladosMercancia where  idTraslado=$idTraslado";
  $conn->query($sql);
}




/*==================================
=            COMISIONES            =
==================================*/
public function getComisionesRango($fecha1, $fecha2){
  $conn=$this->conectar();
  $idEmpleado=$this->filtroNumerico($this->decrypt($_SESSION['IDEMPLEADO'], publickey));
  $codigoVendedor=$this->datosVendedores($idEmpleado)['codigo'];
  $sql="SELECT idFactura, nroFactura, prefijo, idPuntoVenta, idCliente, fechaFactura, estadoFactura, valorNetoFactura, valorTotalFactura, deudaFactura, codigoVendedor, tipoPago FROM facturacion WHERE codigoVendedor=$codigoVendedor AND 
    fechaFactura >= '".$fecha1."' and fechaFactura <= '".$fecha2."' AND estadoFactura != 'anulada'
     ";
     echo '_';
    $query=$conn->query($sql);
    $comision=0;
    echo '<div class="table-responsive m-t-40">
            <table id="listados" class="display nowrap table table-hover table-striped table-bordered" >
              <thead>
                <tr>
                  <th>Fecha Factura</th>
                  <th>Nro Factura</th>
                  <th>Total Factuta</th>
                  <th>Comisión</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQL_ASSOC)) {

      if ($rs['estadoFactura'] != 'pagada' ) {
        # code...
        $css='text text-danger';
      }else{
        $css='text text-success';
      }
      echo '<tr class="'.$css.'">
                  <td>'.$rs['fechaFactura'].'</td>
                  <td>'.$rs['prefijo'].''.$rs['nroFactura'].'</td>
                  <td>$ '.number_format($rs['valorTotalFactura']).'</td>
                  <td align="center">'.number_format($this->getcomisionFactura($rs['idFactura'])).'</td>
                  <td>
                    <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'], publickey).'">
                     <i class="fa fa-arrow-circle-right"  title="Ver Factura"></i>
                    </a>
                  </td>
                </tr></div> ';
                $comision=$comision+$this->getcomisionFactura($rs['idFactura']);
          }

echo "</tbody></table>

<div class='col-md-12'>
  <div class='col-xs-12 col-sm-3 col-md-3 btn btn-success'>
    <h5>Total Comisiones</h5>
    <h2><i class='fa fa-money'></i>".number_format($comision)."</h2>
  </div>
</div>
<script>$(function() {
        $('#myTable').DataTable();
    });
    $('#listados').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    });
    $('.buttons-excel').addClass('btn btn-success mr-1');
</script>";
    
            
}





private function getcomisionFactura($idFactura){
$conn=$this->conectar();
 $sql="SELECT idFactura, idProductoServicio, unidades,valorTotal, utilidad FROM itemsFactura WHERE idFactura=$idFactura";
$query=$conn->query($sql);
$comision=0;
while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
  # code...
  //Verifique que tipo de comisión se le paga


  $comision=$comision+($this->getUtilidadTipo($rs['idProductoServicio'], $rs['valorTotal']));

}

return $comision;

}





private function getUtilidadTipo($idProductoServicio, $valorUnidad){
  $conn=$this->conectar();

  $categoriaProducto=$this->datosProductoServicio($this->encrypt($idProductoServicio, publickey))['categoria'];
  $sqlComisiones="SELECT * FROM tablaComisiones WHERE categoria = $categoriaProducto AND entre < $valorUnidad ORDER BY `tablaComisiones`.`valorComision` DESC";
  $query=$query=$conn->query($sqlComisiones);
  $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
  if ($rs['tipo']==='valor') {

      return $this->filtroNumerico($rs['valorComision']);
  }else if($rs['tipo']==='porcentaje'){

    $valor=ceil(($rs['porcentaje']*$valorUnidad)/100);

      if (($rs['tope'] < $valor)) {
         $valor=$rs['tope'];

    }


    return $this->filtroNumerico($valor);
  }

}

/*=====  End of COMISIONES  ======*/


//************+LISTA DE EGRESOS Y GASTOS DE UN PUNTO DE VENTA. ***************///



public function listaEgresosIngresos($fecha){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
    $fecha1=$this->filtroStrings($fecha, 1);

  if (isset($fecha1)) {
     $sqlFecha="SELECT * FROM egresosGastos WHERE idPuntoVenta=$idPuntoVenta
                          AND fechaEgresoGasto = '".$fecha."' ";
  }
  else{
    $sqlFecha="SELECT * FROM egresosGastos WHERE idPuntoVenta=$idPuntoVenta
                          AND fechaEgresoGasto = '".date('Y-m-d')."' ";
  }


  $query=$conn->query($sqlFecha);
  echo '<div class="table-responsive">
            <table id="tablaA" class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Provedor</th>
                  <th>Nro Recibo</th>
                  <th>Descripción</th>
                  <th>Valor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQL_ASSOC)) {
      # code...
      echo '<tr id="rowEgreso">
                  <td>'.$rs['fechaEgresoGasto'].'</td>
                  <td>'.$rs['provedor'].'</td>
                  <td>'.$rs['nroRecibo'].'</td>
                  <td>'.$rs['descripcion'].'</td>
                  <td>'.number_format($rs['valorEgresoGasto']).'</td>
                  <td>
                     <i class="fa fa-times-circle"  value="'.$rs['nroRecibo'].'" id="deleteRow" title="Eliminar Gasto"></i>
                  </td>
                </tr>';
    }
                
  echo '      </tbody>
            </table>
            </div>';
  echo '<div class="pull-right m-t-30 text-right">
                        <p>Gastos y Egresos </p>
                        <hr>
                        <h3 class="text-danger"><b>Total :</b> '.number_format($this->calculoGastosEgresos($fecha1)).'</h3>
                      </div>';
}





/*=====  End of LISTAS  ======*/


public function listaFacturasTodosLosPuntos(){
  $conn=$this->conectar();

  $sql="SELECT idFactura, nroFactura, fechaFactura, valorTotalFactura, idPuntoVenta,  estadoFactura, idCliente, pertenencia FROM  facturacion WHERE fechaFactura = '".date('Y-m-d')."'ORDER BY `facturacion`.`idFactura` DESC ";

  $query=$conn->query($sql);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Punto de Venta</th>
                  <th>Nro Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

      ';

      while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
        # code...

        if ($rs['pertenencia']!=$rs['idPuntoVenta']) {
          $pertenencia="*";
        }else{$pertenencia="";}
        echo '<tr class='.$this->cssEstadoPago($rs['estadoFactura']).'>
                    <td>'.$this->sqlCliente($rs['idCliente'])['nombreCliente'].'</td>
                    <td> '.$pertenencia.' '.$this->getDatosPuntosVenta($this->encrypt($rs['idPuntoVenta'], publickey))['alias'].'</td>
                    <td>'.$rs['nroFactura'].'</td>
                    <td style="text-align:center;">$ '.number_format($rs['valorTotalFactura']).'</td>
                    <td> <div class='.$this->cssEstadoPago($rs['estadoFactura']).'>'.$rs['estadoFactura'].'</td>
                    <td>
                      <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'], publickey).'">
                       <button class="btn btn-info"> Ver La Factura </button>
                      </a>
                    </td> 
                </tr>';
      }
                


        '      </tbody>
      </table>
              ';

}




public function listaFacturasPorPagarDia(){
  $conn=$this->conectar();

  $sql="SELECT idFactura, nroFactura, fechaFactura, valorTotalFactura, idPuntoVenta,  estadoFactura, idCliente FROM  facturacion WHERE fechaFactura = '".date('Y-m-d')."'  AND estadoFactura='en credito' ORDER BY `facturacion`.`idFactura` DESC ";

  $query=$conn->query($sql);
  echo '<table id="tablaFacturacion" class="table table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Punto de Venta</th>
                  <th>Nro Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado De Cuenta</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

      ';

      while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
        # code...
        echo '<tr class='.$this->cssEstadoPago($rs['estadoFactura']).'>
                    <td>'.$this->sqlCliente($rs['idCliente'])['nombreCliente'].'</td>
                    <td>'.$this->getDatosPuntosVenta($this->encrypt($rs['idPuntoVenta'], publickey))['alias'].'</td>
                    <td>'.$rs['nroFactura'].'</td>
                    <td style="text-align:center;">$ '.number_format($rs['valorTotalFactura']).'</td>
                    <td> <div class='.$this->cssEstadoPago($rs['estadoFactura']).'>'.$rs['estadoFactura'].'</td>
                    <td>
                      <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'], publickey).'">
                       <button class="btn btn-info"> Ver La Factura </button>
                      </a>
                    </td> 
                </tr>';
      }
                


  echo     '      </tbody>
      </table>
              ';

}





/*==========================================================
=            LISTADO COMPLETO IMEIS DISPONIBLES            =
==========================================================*/

public function getListadoImeis($parametros){
  $conn=$this->conectar();
  extract($parametros);

  switch ($tipo) {
    case 1:
    $estado='en almacen';
      # code...
      break;

    case 2:
    $estado='vendido';
      # code...
      break;
  }

     $pagina=$page;
     $busqueda = mysqli_real_escape_string($conn,(strip_tags($serial, ENT_QUOTES)));
     $pagina = (isset($pagina) && !empty($pagina))?$pagina:1;
     $porPagina = 10; //how much records you want to show
     $adjacents  = 2; //gap between pages after number of adjacents
     $offset = ($pagina - 1) * $porPagina;

        //Cuento el número total de registros
     $reload = '../../../modulos/inventario/imeisSeriales.php';
    

    $sql="SELECT codigo, idProductoServicio, idFacturaProvedor,fechaRegistro, idFacturaVenta,estado, fechaFacturado, ubicacion FROM serialesImeis WHERE codigo LIKE  ('%".$busqueda."%') ORDER BY codigo ASC LIMIT $offset,$porPagina";


    $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM serialesImeis  WHERE codigo != ''");
    $filas= mysqli_fetch_array($count_query);
    $numrows = $filas['numeroConsultas']; //El numero de consultas
    $totalPaginas = ceil($numrows/$pagina);
    $query= $conn->query($sql);






    echo '
            <table id="'.$this->espacioPorNada($estado).'" class="table table-hover table-striped table-bordered" >
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Codigo</th>
                  <th>Punto</th>
                  <th>Estado</th>
                  <th>Factura Provedor</th>
                  <th>Factura Cliente</th>
                  <th>Fecha Venta</th>
                  <th>Fecha Ingreso</th>
                </tr>
              </thead>
              <tbody>
    ';
    while ($rs=mysqli_fetch_array($query,MYSQL_ASSOC)) {

      if ($rs['estado'] == 'en almacen' ) {
        # code...
        $css='text text-success';
      }else{
        $css='text text-danger';
      }
      echo '<tr class="'.$css.'">
                  <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                  <td>'.$rs['codigo'].'</td>
                  <td>'.$this->getDatosPuntosVenta($this->encrypt($rs['ubicacion'], publickey))['alias'].'</td>
                  <td>'.$rs['estado'].'</td>
                  <td align="center"><a href="'.PATH.'/modulos/provedores/link.php?data=historico&idFactura='.$this->encrypt($rs['idFacturaProvedor'], key).'"  target="_BLANK">'.$this->getDatosFacturaProvedores($rs['idFacturaProvedor'])['nroFacturaProvedor'].'</a></td>
                  <td align="center"><a href="'.PATH.'/modulos/contabilidad/link.php?idFactura='.$this->encrypt($rs['idFacturaVenta'], publickey).'" target="_BLANK"> '.$this->getDatosFactura($rs['idFacturaVenta'])['nroFactura'].'</a></td>
                  <td> '.$rs['fechaFacturado'].' </td>
                  <td>'.$rs['fechaRegistro'].'</td>
                  
            </tr> ';




    }
  echo    '      </tbody>
      </table>
              ';

      echo '<div class="col-md-12" align="center">'.$this->paginador($reload, $pagina, $totalPaginas, $adjacents).'<div>';
        

}





public function listaFacturaVentasDia($fecha){
  $conn=$this->conectar();
  $fecha=$this->decrypt($fecha, publickey);

  $sqlFactura="SELECT idFactura, nroFactura, idCliente, fechaFactura, tipoPago, valorFactura  FROM facturacion
            WHERE  fechaFactura = '".$fecha."'";

    $queryFactura=$conn->query($sqlFactura);
    
echo '<h2 align="center"> <i class="fa fa-calendar"></i> Facturas del '.$fecha.' </h2> <i align="center">Año-Mes-Día</i>';
echo '<table id="tablaFacturas" class="table color-table primary-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nro Factura</th>
                <th>Cliente</th>
                <th>Tipo de Pago</th>
                <th>Valor</th>
                <th></th>
              </tr>
        </thead>
    ';

    echo '<tbody>';
    $total=0;
   while ($rsFactura=mysqli_fetch_array($queryFactura, MYSQL_ASSOC)) {
      
       echo '
              <tr>
                  <td>'.$rsFactura['nroFactura'].'</td>
                  <td>'.$this->sqlCliente($rsFactura['idCliente'])['nombreCliente'].'</td>
                  <td>'.$rsFactura['tipoPago'].'</td>
                  <td>$ '.number_format($rsFactura['valorFactura']).'</td>
                  <td>
                    <a href="../ventas/facturaCliente.php?id='.$_REQUEST['id'].'&idFactura='.$this->encrypt($rsFactura['idFactura'], publickey).'">
                      <button type="button" class="btn btn-info">Ver Factura</button></a>
                  </td>
              </tr>                 
                      ';
                      $total=$rsFactura['valorFactura']+$total;
    }
    echo ' </tbody>';
    echo '</table>';

echo '<div class="col-md-12">

          <div class="pull-right m-t-30 text-right">
            <p>Total Ventas Globales</p>
            <hr>
            <h3><b>Total :</b> $ '.number_format($total).'</h3>
          </div>
      </div>';

}


//Listo todos los puntos de venta
public function listaPuntosVenta($parametro){
  $conn=$this->conectar();
  $sql="SELECT idPunto, alias, nitPunto FROM puntosVenta";
  $query=$conn->query($sql);
  $totalDisponible=0;
  echo '<div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="text-align:center">Nombre Punto</th>
                    <th style="text-align:center">N.I.T</th>
                    <th style="text-align:center">Efectivo Hoy</th>
                    <th style="text-align:center">Transacciones Hoy</th>
                    <th class="text-nowrap">Egresos Hoy</th>
                    <th style="text-align:center">Efectivo Disponible</th>
                    <th style="text-align:center"></th>
                  </tr>
                </thead>
                <tbody>';
              while ($rsPunto=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                # code...
                $idPuntoVenta=$this->encrypt($rsPunto['idPunto'],publickey);
                $efectivo=$this->calculoTotalEfectivoDia(date('Y-m-d'), $rsPunto['idPunto']);
                $transacciones=$this->calculoValorTransacciones(date('Y-m-d'), $rsPunto['idPunto']);
                $egresos=$this->calculoValorEgresosGastos($idPuntoVenta,NULL);

                $total=($efectivo-$egresos);
                $totalDisponible=$totalDisponible+$total;
          echo '<tr>
                    <td>'.$rsPunto['alias'].'</td>
                    <td >'.$rsPunto['nitPunto'].'</td>
                    <td align="center">$ '.number_format($efectivo).'</td>
                    <td align="center">$ '.number_format($transacciones).'</td>
                    <td class="text-text-danger" align="center">'.number_format($egresos).'</td>
                    <td class="text-text-success" align="center">$'.number_format($total).'</td>
                    <td class="text-nowrap">
                      <a href="'.PATH.'/modulos/puntosVenta/link.php?idPunto='.$idPuntoVenta.'">
                          <button type="button"  class="btn btn-info">
                              Ver Punto
                          </button>
                      </a>
                    </td>
                  </tr>
                  ';
              }
  echo '        </tbody>
              </table>
  
          <div class="col-md-12">
                <div class="pull-right m-t-30 text-right">
                  <hr>
                  <h3><b>Total Disponible :</b> $'.number_format($totalDisponible).'</h3>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="text-right">
                </div>
              </div>
  ';

}



//LISTA DE LAS CATEGORIAS
public function listaCategoriasSubcategorias(){
  $conn=$this->conectar();
  $sqlCategorias="SELECT * FROM categorias ";
  $queryCategorias=$conn->query($sqlCategorias);

  echo '<h3 class="box-title">Lista de las categorías y Subcategorías</h3>';
  echo '<div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th style="text-align:center">Pertenencia</th>
                    <th>Impuestos</th>
                    <th class="text-nowrap">Action</th>
                  </tr>
                </thead>
                <tbody>';

                /*----------  WHILES  ----------*/
   while ($rsCategorias=mysqli_fetch_array($queryCategorias, MYSQL_ASSOC)) {
      echo '<tr>
                    <td>'.$rsCategorias['nombreCategoria'].'</td>
                    <td>'.$rsCategorias['tipo'].'</td>
                    <td align="center">'.$this->datosCategoria($rsCategorias['padre'], 'nombreCategoria').'</td>
                    <td>'.$rsCategorias['valorTopeImpuesto'].'</td>
                    <td class="text-nowrap">
                      <a href="#" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>

                      <a href="#" data-toggle="tooltip" data-original-title="Eliminar" id="deleteCategoria" > <i class="fa fa-trash text-danger"></i></a>
                    </td>
                  </tr>
                  ';
   }
   //Fin del While
  echo        '</tbody>
            </table>
          </div>
  ';
  $conn=$this->close();
}



public function listaPreSeriales($token, $sku){
  $conn=$this->conectar();
  $token=$this->filtroNumerico($token);

  $sku=trim($sku);
  $sql="SELECT * FROM preSerializacion WHERE token= $token AND sku='".$sku."'";
  $query=$conn->query($sql);
  $n=1;
  while ($rs=mysqli_fetch_array($query)) {
    # code...
      echo '<button class="btn btn-info col-md-4" value="'.$rs['idSerializacion'].'" id="code" name="'.$rs['codigo'].'" ondblclick="deleteCodigo(this)" id="preCodigos" style="text-align:left;">['.$n.'] '.$rs['codigo'].'</button>';
      $n++;
  }


}




public function listaPreCompras($token){
      $conn=$this->conectar();
      $token=$this->filtroNumerico($token);

      $sqlPrecompra="SELECT * FROM preCompra WHERE token=$token";
      $query=$conn->query($sqlPrecompra);
      $subTotal=0;
      $impuestos=0;
      $total=0;
  echo '<h4 align="center"> <i class="fa fa-sort-amount-asc"></i> Esto Es Lo Que Registraré</h4>
  <!-- tabla-->
  <div class="col-md-12 table-responsive">
  
    <table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
              <thead>
                <tr>
                  <th ><div style="text-align: center"> Sku</div></th>
                  <th> Producto </th>
                  <th> <div style="text-align: center">Costo Unidad </div></th>
                  <th> <div style="text-align: center">Unidades </div></th>
                  <th> <div style="text-align: center">Valor Neto</div></th>
                  <th> <div style="text-align: center">Valor Total</div></th>
                  <th data-hide="" data-toggle="true"><div style="text-align: center">Serial</div></th>
                  <th data-hide="all" > </th>
                </tr>
              </thead>
              <tbody>';
    
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...

      echo '<tr>
              <td>'.$rs['sku'].'</td>
              <td>'.$rs['nombreProductosServicios'].'</td>
              <td>'.number_format(($rs['CostoTotal'])/$rs['unidades']).'</td>
              <td>'.$rs['unidades'].'</td>
              <td>'.number_format($rs['costoNeto']).'</td>
              <td>'.number_format($rs['CostoTotal']).'</td>
              <td>'.$rs['tipo'].'</td>
              <td> <i class="fa fa-times-circle"  id="deleteRow" onclick="deleteRow('.$rs['idCompra'].')" title="Eliminar"></i></td>
                    
            </tr>';

           $subTotal=$subTotal+$rs['costoNeto'];
           $impuestos=$impuestos+ ($rs['CostoTotal']-$rs['costoNeto']);
           $total=$total+$rs['CostoTotal'];
    }


echo'</tbody>
            </table> 
      <div class="col-md-12">
                <div class="pull-right m-t-30 text-right">
                  <p class="text-green">SubTotal: <span>'.number_format($subTotal).'</span></p>
                  <p class="text-danger">Impuestos : <span id="totalImpuestos">'.number_format($impuestos).'</span>  </p>
                  <hr>
                  <h3 class="text-success"><b>Total :</b> <span id="totalFinal">'.number_format($total).'</span></h3>
                  <input type="hidden" id="totalFactura" value="'.$total.'">
                  <input type="hidden" id="impuestos" value="'.$impuestos.'">
                  <input type="hidden" id="subTotal" value="'.$subTotal.'">
                </div>
                <div class="clearfix"></div>
                <hr>
                <div align="right">
                  <button class="btn btn-success" id="saveInventario" onClick="saveFactura()" > <i class="fa fa-save"></i> Registra Ya El inventario  </button>
                </div>
              </div>
  </div>
  ';

}







//Listo los productos en existencia en el punto de venta global
public function listaProductosPunto(){
  $conn=$this->conectar();
  $idPunto=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
  $sqlLista='SELECT DISTINCT idProductoServicio, destinoId, cantidadExistenteTraslado FROM trasladosExistencia WHERE destinoId='.$idPunto.' ORDER BY(idProductoServicio) ASC';

  $array=array();
  $n=0;
  $query=$conn->query($sqlLista);
  echo '<div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><div align="center">SKU</div></th>
                    <th><div align="center">Nombre del Producto</div></th>
                    <th class="text-nowrap"><div align="center">Cantidad Existente</div></th>
                  </tr>
                </thead>
                <tbody>';


  while ($rs=mysqli_fetch_array($query,MYSQLI_ASSOC)) {
    # code...
       echo '<tr>
                 <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['sku'].'</td>
                 <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                 <td>'.$this->getCantidadExistenteProductoPorPunto($rs['idProductoServicio']).'</td>
                 <td></td>

            </tr>';

  }

   echo        '</tbody>
            </table>
          </div>
  ';

  $conn=$this->close();
}






//SACO EL HISTORIAL DE TODOS LOS TRASLADOS HECHOS 
public function historialTrasladosMercancia(){
    $conn=$this->conectar();
    $sql="SELECT DISTINCT fechaTraslado, destinoId, origenId, estadoTraslado FROM trasladosExistencia";
    $query=$conn->query($sql);
    echo '<div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Fecha de Traslado</th>
                    <th>Origen</th>
                    <th style="text-align:center">Destino</th>
                    <th>Estado</th>
                    <th class="text-nowrap"></th>
                  </tr>
                </thead>
                <tbody>';
          while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
            # code...
            echo '<tr><td>'.$rs['fechaTraslado'].'</td>
                  <td>'.$this->getDatosPuntosVenta($this->encrypt($rs['origenId'], publickey))['alias'].'</td>
                  <td align="center">'.$this->getDatosPuntosVenta($this->encrypt($rs['destinoId'], publickey))['alias'].'</td>
                  <td>'.$rs['estadoTraslado'].'</td>
                  <td>
                      <a href="'.PATH.'/modulos/inventario/historialTraslados.php?id='.$_REQUEST['id'].'&f='.$this->encrypt($rs['fechaTraslado'].'|'.$rs['destinoId'], publickey).'">
                      <button type="button" class="btn btn-info">
                            <i class="fa fa-plus"></i> Ver Este Traslado
                      </button>
                      </a>
                  </td>
                  </tr>
            ';
          }
    echo '</tbody></table>';
    $conn=$this->close();
}



public function listaMovimientosTransacciones($fecha){
  $conn=$this->conectar();

  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

  $fecha1=$fecha.' 00:00:00';
  $fecha2=$fecha.' 23:59:00';


  $sql="SELECT * FROM perfilPagos WHERE idPuntoVenta=$idPuntoVenta AND fechaRegistrado>='".$fecha1."'  AND  fechaRegistrado < '".$fecha2."' AND (tipoPago='tarjeta credito' OR tipoPago='tarjeta debito' OR tipoPago='entidad crediticia') AND estado='activa'";
  $query=$conn->query($sql);
  $totalDebito=0;
  $totalCredito=0;
  $totalEntidad=0;
  echo '<div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nro Factura</th>
                    <th><div align="center">Tipo</div></th>
                    <th style="text-align:center">Valor</th>
                    <th style="text-align:center">Comisión</th>
                  </tr>
                </thead>
                <tbody>';
                while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
                  # code...
                  if ($rs['tipoPago']=='tarjeta debito') {
                    # code...
                    $totalDebito=$rs['valor']+$totalDebito;

                  }elseif($rs['tipoPago']=='tarjeta credito'){
                    $totalCredito=($rs['valor']+$rs['comision'])+$totalCredito;;

                  }elseif ($rs['tipoPago']=='entidad crediticia') {
                    $totalEntidad=$rs['valor']+$totalEntidad;
                  }
                  $valor=$this->tratamientoDecimales($rs['valor'], 0);
                  $comision=$this->tratamientoDecimales($rs['comision'], 0);
                
                echo '        
                  <tr>
                      <td >'.$this->getDatosFactura($rs['idFactura'])['nroFactura'].'</td>
                      <td align="center">'.$rs['tipoPago'].'</td>
                      <td align="center">$ '.number_format($valor).'</td>
                      <td align="center">$ '.number_format($comision).'</td>
                  </tr>';

             }
             echo '       
  </tbody>
              </table>

  <div class="col-md-12">
  
        <div class="col-md-4 col-xs-12 col-sm-6">
          <div class="white-box text-center bg-purple">
            <h1 class="text-white counter">$ '.number_format($totalDebito).'</h1>
            <p class="text-white">Total Tarjetas Débito</p>
          </div>
        </div>

        <div class="col-md-4 col-xs-12 col-sm-6">
          <div class="white-box text-center bg-purple">
            <h1 class="text-white counter">$ '.number_format($totalCredito).'</h1>
            <p class="text-white">Total Tarjetas Crédito</p>
          </div>
        </div>


        <div class="col-md-4 col-xs-12 col-sm-6">
          <div class="white-box text-center bg-purple">
            <h1 class="text-white counter">$ '.number_format($totalEntidad).'</h1>
            <p class="text-white">Total Entidades</p>
          </div>
        </div>
      </div>
              ';
  $query=$conn->query($sql);

  //$conn=$this->close();
}



/*============================
=            MATH            =
============================*/



//SUMA DE LO QUE HAY DISPONIBLE EN EFECTOVO EN TODOS LOS PUNTOS DE VENTA
public function disponibleEfectivoAllPuntos(){
  $conn=$this->conectar();
  $sql="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       fechaRegistrado BETWEEN '".date('Y-m-d 00:00:00')."' AND '".date('Y-m-d 23:59:59')."' AND tipoPago = 'efectivo'  AND estado='activa' ";
    $resultado = mysqli_fetch_assoc($conn->query($sql));  
    $r=explode('.', $resultado['valorTotal']);




    $sqlEgreso="SELECT SUM(valorEgresoGasto) AS valorEgreso 
                                                      FROM egresosGastos WHERE
                                                       fechaEgresoGasto = '".date('Y-m-d')."'";
    $rs = mysqli_fetch_assoc($conn->query($sqlEgreso));  
    return $r[0]-$rs['valorEgreso'];

}









public function calculoTotalEfectivoDia($fecha, $idPuntoVenta){
  $conn=$this->conectar();
  $fecha1=$this->puntoPorNada($fecha).' 00:00:00';
  $fecha2=$this->puntoPorNada($fecha).' 23:59:00';
  if (!isset($idPuntoVenta)) {
    # code...
       $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

  }else{
      $idPuntoVenta=$this->filtroNumerico($idPuntoVenta);

  }
   $sql="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago = 'efectivo'  AND estado = 'activa' ";

  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  $r=explode('.', $resultado['valorTotal']);
  return $r[0];
}







//Calculo los gastos y egresos en un rango de tiempo 
public function calculoTotalFacturas($fecha1, $fecha2){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

      if (isset($fecha1, $fecha2)) {
    # code..
        $sql="SELECT SUM(valorTotalFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaFactura BETWEEN '".$fecha1."' AND '".$fecha2."' AND estadoFactura != 'anulada' ";
  }else{
   
    $sql="SELECT SUM(valorTotalFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaFactura = '".date('Y-m-d')."'
                                                      AND estadoFactura != 'anulada'
                                                      ";
  }
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["valorTotal"];
}
//FIN DEL CÁLCULO TOTAL DEL EFECTIVO





//Calculo los gastos y egresos en un rango de tiempo 
public function calculoGastosEgresos($fecha1, $fecha2){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

      if (isset($fecha1)) {
        $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto = '".$fecha1."' ";
  }
 
  else{
   
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto = '".date('Y-m-d')."'";
  }
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["valorTotal"];
}

//Fin del calculo de los gastos y egresos



//SACO EL VALOR DE LAS CUENTAS POR COBRAR
public function calculoValorCuentasPorCobrar($fecha){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
      if (isset($fecha)) {
      $sql="SELECT SUM(deudaFactura) AS valorTotal 
                FROM facturacion WHERE
                      idPuntoVenta=$idPuntoVenta
                AND fechaFactura = '".$fecha."'
                AND estadoFactura = 'en credito' ";
  }


  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  $r=explode('.', $resultado['valorTotal']);
  return $r[0];
}



//
public function calculoValorTransacciones($fecha, $idPuntoVenta){
    $conn=$this->conectar();
    $fecha1=$this->puntoPorNada($fecha).' 00:00:00';
    $fecha2=$this->puntoPorNada($fecha).' 23:59:00';
    if (!isset($idPuntoVenta)) {
    # code...
       $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));

    }else{
      $idPuntoVenta=$this->filtroNumerico($idPuntoVenta);

    }

      if (isset($fecha1, $fecha2)) {
      $sqlTransacciones="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                      (idPuntoVenta=$idPuntoVenta or pertenencia = $idPuntoVenta)
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago != 'efectivo' AND estado='activa'  ";
      $sqlTransaccionesComision="SELECT SUM(comision) AS valorTotalComision 
                                                      FROM perfilPagos WHERE
                                                       (idPuntoVenta=$idPuntoVenta or pertenencia = $idPuntoVenta)
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago != 'efectivo' AND  estado='activa' ";
  }
 
  else{
   
   $sqlTransacciones="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       (idPuntoVenta=$idPuntoVenta or pertenencia = $idPuntoVenta)
                                                      AND fechaRegistrado LIKE '".date('Y-m-d')."%'
                                                      AND tipoPago != 'efectivo' AND estado='activa'
                                                      ";
  $sqlTransaccionesComision="SELECT SUM(comision) AS valorTotalComision 
                                                      FROM perfilPagos WHERE
                                                       (idPuntoVenta=$idPuntoVenta or pertenencia = $idPuntoVenta)
                                                      AND fechaRegistrado LIKE '".date('Y-m-d')."%'
                                                      AND tipoPago != 'efectivo' AND estado='activa'
                                                      ";
  }


  $resultado = mysqli_fetch_assoc($conn->query($sqlTransacciones)); 
  $resultadoComision = mysqli_fetch_assoc($conn->query($sqlTransaccionesComision));  
  $r=explode('.', $resultado['valorTotal']);
  $rc=explode('.', $resultadoComision['valorTotalComision']);
  return ($r[0]+$rc[0]);
}




//SUMATORIA DE EGRESOS POR FECHA ÚNICA
public function calculoValorEgresos($fecha){
    $conn=$this->conectar();
    $fecha1=$this->puntoPorNada($fecha);
    if (!isset($idPuntoVenta)) {
         $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
    }else{
        $idPuntoVenta=$this->filtroNumerico($idPuntoVenta);
    }
     $sql="SELECT SUM(valorEgresoGasto) AS valorEgreso 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto = '".$fecha."'";
   
   $resultado = mysqli_fetch_assoc($conn->query($sql));
   return  $resultado['valorEgreso'];
}
//fin sumatoria egresos por fecha unica


//CALCULO DEL VALOR DE LOS EGRESOS
public function calculoValorEgresosGastos($idPuntoVenta, $parametro){
    $conn=$this->conectar();
  if (sizeof($parametro['fecha'])>0) {
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];
  }else{
      $fecha1=date('Y-m-d 00:00:00');
      $fecha2=date('Y-m-d 23:59:00');;
  }
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($idPuntoVenta, publickey));
      if (isset($fecha1, $fecha2)) {
        $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto BETWEEN '".$fecha1."' AND '".$fecha2."'  ";
  }
  elseif (isset($fecha1) AND !isset($fecha2)) {
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto BETWEEN '".$fecha1."' AND '".$fecha2."'  ";
  }
  else{
   
   $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto LIKE '".date('Y-m-d')."%'
                                                      ";
  }
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  $r=explode('.', $resultado['valorTotal']);
  return $r[0];
}




//Calculo el gran total del movimiento 
public function calculoValorGranTotal($parametro){
    $idPuntoVenta=$this->decrypt($_SESSION['idPV'], publickey);
    $egresosGastos=$this->calculoValorEgresos($parametro);
    $totalEfectivo=$this->calculoTotalEfectivoDia($parametro, $idPuntoVenta);
    return ($totalEfectivo-$egresosGastos);

}


//Obtengo la existencia global de un producto por idProducto
public function getCantidadExistenteProductoPorPunto($idProductoServicio){
    $conn=$this->conectar();
    $idPunto=$this->filtroNumerico($this->decrypt($_SESSION['idPV'], publickey));
    $idProductoServicio=$this->filtroNumerico($this->normalizacionDeCaracteres($idProductoServicio));
    $sql="SELECT SUM(cantidadExistenteTraslado) AS existencia 
                                                      FROM trasladosExistencia WHERE
                                                       idProductoServicio=$idProductoServicio
                                                       AND destinoId='".$idPunto."'
                                                       AND cantidadExistenteTraslado >0 ";
 
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["existencia"];
}



   

private function calcularValorPromedio($idProducto){
  $conn=$this->conectar();
  $sqlInventario="SELECT idProductoServicio, unidadesExistentes, valorUnidad, unidadesCompradas 
              FROM  INVENTARIOS
                    WHERE idProductoServicio=$idProducto AND  valorUnidad >0   ORDER BY valorUnidad desc  LIMIT 0,1
  ";
  $queryInventario=$conn->query($sqlInventario);
  $arrayCostos=array();
  $n=0;


  while ($rs=mysqli_fetch_array($queryInventario, MYSQL_ASSOC)) {
    # code... 
    $vunidad=explode('.',$rs['valorUnidad']);


    $arrayCostos[$n]=(ceil($vunidad[0]/1));//Saco el coste promedio por cada registro  en el INVENTARIOS
    $n++;


  
  }

  $numeroCiclos=sizeof($arrayCostos);
  $costoTotal=0;
  for ($i=0; $i <= $numeroCiclos; $i++) { 
    # code...
    $costoTotal=$arrayCostos[$i]+$costoTotal;
  }

  return ceil($costoTotal/$numeroCiclos);

}



//analiso el valor de un producto, si es igual a cero entonces calculo el costo promedio
private function analisisValorVenta($valorProducto, $idProducto){
  $conn=$this->conectar();
  $valorProducto=$this->filtroNumerico($valorProducto);
    if ($valorProducto>0) {
      # code...
      return $valorProducto;
    }
    else{
      //return '<div class="label label-megna label-rounded" title="Es costo promedio"> <i class="fa fa-warning"></i> $ '.number_format($this->calcularValorPromedio($idProducto)).'</div>';
      return $this->calcularValorPromedio($idProducto);
    }
}




//OBTENGO LA CANTIDAD DE UN PRODUCTO TRASLADADO A UN PUNTO DE VENTA
private function getCantidadExistenciasProductoEnPunto($idProducto, $idPunto){
    $conn=$this->conectar();

    if ($this->getDatosProductoServicio($idProducto)['serializacion']=='si') {
      # code...
        $sqlSeriales="SELECT idProductoServicio, estado, ubicacion  FROM serialesImeis where idProductoServicio=$idProducto AND  estado='en almacen' AND ubicacion=".$idPunto."";
        $query=$conn->query($sqlSeriales);
        if (mysqli_num_rows($query)>0) {
          # code...
          return mysqli_num_rows($query);
        }else{
          return 0;
        }
    }else{
        $sql='SELECT idProductoServicio, destinoId, cantidadExistenteTraslado FROM trasladosExistencia where   idProductoServicio = '.$idProducto.' AND cantidadExistenteTraslado >0  AND destinoId='.$idPunto.'';
        $query=$conn->query($sql);
        $existencia=0;


        while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
          $existencia=$rs['cantidadExistenteTraslado']+$existencia;
        }
        return   $existencia;
    }

}



//OBTENGO LA CANTIDAD DE UN PRODUCTO TRASLADADO A UN PUNTO DE VENTA
public function getCantidadExistenciasProductoEnGlobal($idProducto){
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($idProducto);
    if ($this->getDatosProductoServicio($idProducto)['serializacion']=='si') {
      # Cuento en seriales e imeis...
      $sqlSeriales="SELECT idProductoServicio, estado  FROM serialesImeis where idProductoServicio=$idProductoServicio AND  estado='en almacen'";
      $query=$conn->query($sqlSeriales);
      if (mysqli_num_rows($query)>0) {
        # code...
        return mysqli_num_rows($query);
      }else{ 
        return 0;
      }
    }else{ //no tiene serialización entonces busquelo con los traslados 
       $sql='SELECT idProductoServicio, destinoId, cantidadExistenteTraslado FROM trasladosExistencia where   idProductoServicio = '.$idProductoServicio.' AND cantidadExistenteTraslado >0 ';
        $query=$conn->query($sql);
        $existencia=0;


        while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
          $existencia=$rs['cantidadExistenteTraslado']+$existencia;
        }
        return   $existencia;
    
    }
}
/*=====  End of Section comment block  ======*/

/*=====  End of MATH  ======*/

//*Calculos de union y  sum()

private function checkValorTotalVentasRangoFechas($fecha1, $fecha2){
  $conn=$this->conectar();

  $sql="SELECT fechaFactura, estadoFactura,valorFactura FROM facturacion where fechaFactura BETWEEN  '".$fecha1."' and '".$fecha2."'";
  $query=$conn->query($sql);
  $valor=0;
  while ($rs=mysqli_fetch_array($query)) {
    # code...
    $valor=$rs['valorFactura']+$valor;
  }

  return $valor;
}






private function checkValorTotalCreditosRangoFechas($fecha1, $fecha2){
  $conn=$this->conectar();

  $sql="SELECT fechaFactura, estadoFactura,deudaFactura FROM facturacion where fechaFactura BETWEEN  '".$fecha1."' and '".$fecha2."'";
  $query=$conn->query($sql);
  $valor=0;
  while ($rs=mysqli_fetch_array($query)) {
    # code...
    $valor=$rs['valorFactura']+$valor;
  }

  return $valor;
}


/*----------  SELECTEDS  ----------*/




public function selectAdministradorPunto($parametro){
    $conn=$this->conectar();
    $sql="SELECT idusuario, nombre, tipoUsuario, identificacion, activada FROM usuarios  WHERE tipoUsuario!='vendedor' AND activada = 'si' ";
    $query=$conn->query($sql);
    echo '<option value="">Selecciona un Usuario</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$rs['nombre'].'" '.$this->selected($parametro, $rs['nombre']).'> '.$rs['nombre'].' | '.$rs['identificacion'].'  </option>';
    }
    $conn->close();
}




public function selectCiudades($parametro){
    $conn=$this->conectar();
    $sql="SELECT nombre FROM ciudades ";
    $query=$conn->query($sql);
    if ($parametro==null) {
      # code...
      $parametro= ciudadDefecto;
    }

    echo '<option value="">Selecciona Una Ciudad</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.utf8_encode($rs['nombre']).'" '.$this->selected($parametro, utf8_encode($rs['nombre'])).' > '.utf8_encode($rs['nombre']).' </option>';
    }
    $conn->close();
}


//SELECCIONO TODOS LOS DEPARTAMENTOS
public function selectDepto($parametro){
    $conn=$this->conectar();
    $sql="SELECT idDepartamento, nombre FROM departamento ";
    $query=$conn->query($sql);
    if ($parametro==null) {
      # code...
      $parametro= dptoDefecto;
    }
    echo '<option value="">Selecciona El Departamento</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.utf8_encode($rs['nombre']).'" '.$this->selected($parametro, utf8_encode($rs['nombre'])).' > '.utf8_encode($rs['nombre']).' </option>';
    }
    $conn->close();
}



//SELECCIONO TODOS LOS VENDEDORES
public function selectVendedores($parametro){
    $conn=$this->conectar();
    $sql="SELECT * FROM usuarios ";
    $query=$conn->query($sql);
    
    echo '<option value="">Selecciona Quien Lo Vendió</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$this->encrypt($rs['codigo'], publickey).'" '.$this->selected($parametro, utf8_encode($rs['codigo'])).' > '.utf8_encode($rs['nombre']).' </option>';
    }
    $conn->close();
}



//SELECCIONO TODOS LOS REGIMENES TRIBUTARIOS
public function selectRegimenEmpresa($parametro){
    $conn=$this->conectar();
    $sql="SELECT * FROM   regimenTributario WHERE  tipo =1";
    $query=$conn->query($sql);
    
    echo '<option value="">Selecciona El Régimen</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="" '.$this->selected($parametro, utf8_encode($rs['nombreRegimen'])).' > '.utf8_encode($rs['nombreRegimen']).' </option>';
    }
    $conn->close();
}




//SELECCIONO TODAS LAS PERSONAS JURÍDICAS
public function selectPersonasJuridicas($parametro){

    $conn=$this->conectar();
    echo $sql="SELECT * FROM   regimenTributario WHERE  tipo =2";
    $query=$conn->query($sql);
    echo '<option value="">Selecciona El Régimen</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="" '.$this->selected($parametro, utf8_encode($rs['nombreRegimen'])).' > '.utf8_encode($rs['nombreRegimen']).' </option>';
    }
    $conn->close();
}

//**************FIN RETORNO DE DATOS******************//









//**************[CONSULTAS]******************//

public function checkProvedor($parametro){

   $conn=$this->conectar();
   $provedor=explode('|',$parametro);
   $sql="SELECT idprovedor, nombreProvedor  FROM provedores WHERE nombreProvedor ='".htmlentities($provedor[0])."'";
 
  $comparar=$this->normalizacionDeCaracteres($provedor[0]);
  $query=$conn->query($sql);
  while ($rs=mysqli_fetch_array($query)) {

    if ($this->normalizacionDeCaracteres($rs['nombreProvedor'])==$comparar) {
        $idProvedor= $rs['idprovedor'];
        break ;
    }
  }

  if ($idProvedor>0) {
    # code...
       $objResponse = array('idProvedor' => $idProvedor );
  }
  else{
     $objResponse = array('idProvedor' => 0 );
  }

  echo json_encode($objResponse);

}


//**************[FIN CONSULTAS]******************//


/*==================================
=            PRINT DATA            =
==================================*/


//Imprimo los egresos que genere
public function billEgresos($printData){
  $conn=$this->conectar();
  $idEgreso=$this->decrypt($printData, publickey);
  $sql="SELECT * FROM egresosGastos WHERE idegresosGasto=$idEgreso";
  $query=$conn->query($sql);
  $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
  $cabezote ='
    <style type="text/css">
.tg  {border-collapse:collapse;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:10px 5px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:10px 5px;;overflow:hidden;word-break:normal;color:#333;background-color:#f0f0f0;}
.tg .tg-88nc{font-weight:bold;text-align:center}
.tg .tg-8m2u{font-weight:bold;}
.tg .tg-us36{vertical-align:top}
.tg .tg-quj4{text-align:right}
.tg .tg-p8bj{font-weight:bold;vertical-align:top}
.tg .tg-7btt{font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-dvpl{text-align:right;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 250px">
  <tr>
    <td colspan="4">
    <h2 align="center">COMPROBANTE DE EGRESO</h2>
    </td>
  </tr>
  <tr>
    <td class="tg-8m2u" colspan="2">PUNTO</td>
    <td class="tg-quj4" colspan="2">'.$this->datosPuntoVenta($this->encrypt($this->decrypt($_SESSION['datos'],key), publickey))['nombrePunto'].'</td>
  </tr>


  <tr>
    <td class="tg-8m2u" colspan="2">FECHA</td>
    <td class="tg-quj4" colspan="2">'.$rs['fechaEgresoGasto'].'</td>
  </tr>
  <tr>
    <td class="tg-p8bj" colspan="2">PAGADO A </td>
    <td class="tg-us36" colspan="2" align="right">'.$rs['provedor'].'</td>
  </tr>
  <tr>
    <td class="tg-7btt" colspan="4" style="text-align:justify">DESCRIPCIÓN</td>
  </tr>
  <tr>
    <td class="tg-us36" colspan="4">
      '.$rs['descripcion'].'
    </td>
  </tr>
  <tr>
    <td class="tg-p8bj" colspan="1">VALOR EGRESO</td>
    <td class="tg-dvpl" colspan="4" style="font-size:25px">$ '.number_format($rs['valorEgresoGasto']).'</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="4"><br><br><br><br><br>FIRMA____________________________</td>
  </tr>
</table>
<div align="center" style="font-size:8px">'.piePaginaFacturas.'</div>

  ';

  return $cabezote;
}






/*=======================================================
=            IMPRIMIR TRASLADO PUNTO A PUNTO            =
=======================================================*/


/*===============================================
=            TRALSADOS PUNTO A PUNTO            =
===============================================*/


//PRINT

public function printTrasladoPuntoPunto($tokenTraslado){
    $conn=$this->conectar();

  $token=$this->filtroNumerico($tokenTraslado);
  if ($token<1514764800) {
    # code...
    header('Location:../../index.php');
  }
   $sqlDatosTraslado="SELECT * FROM trasladosMercancia WHERE token=$token";
  $queryDatosTraslado=$conn->query($sqlDatosTraslado);
  $rsDatosTraslado=mysqli_fetch_array($queryDatosTraslado, MYSQLI_ASSOC);
  $origen=$this->datosPuntoVenta($this->encrypt($rsDatosTraslado['idOrigen'],publickey))['alias'];
  $destino=$this->datosPuntoVenta($this->encrypt($rsDatosTraslado['idDestino'],publickey))['alias'];

  

  $cabezote= '<h1 align="center">TRASLADO PUNTO A PUNTO</h1>

      <table>
        <tr>
          <td><strong>ORIGEN:</strong></td>
          <td>'.$this->filtroStrings($origen,1).'</td>
        </tr>

        <tr>
          <td><strong>DESTINO:</strong></td>
          <td>'.$this->filtroStrings($destino,1).'</td>
        </tr>


        <tr>
          <td><strong>FECHA Y HORA</strong></td>
          <td>'.gmdate("Y-m-d H:i:s", $rsDatosTraslado['token']).'</td>
        </tr>
        <tr>
          <td width="150"><strong>CÓDIGO DE TRASLADO</strong></td>
          <td align="center">'.$token.'</td>
        </tr>
      </table>

      
      <hr>
      <h3 align="center">PRODUCTOS TRASLADADOS</h3>

      <table style="font-size:10px">
          <tr>
            <td width="50%" align="center"><b>Nombre</b></td>
            <td width="10%" align="center"><b>Cant</b></td>
            <td width="40%" align="center"><b>Codigo</b></td>
          </tr>
    '.$this->productosTrasladados($token).'
          

         <hr>

         <h1 align="center">IMPORTANTE</h1>
         <div style="border:2px, solid, #f00; text-align:center;">
           LOS TRASLADOS EN EL SISTEMA SOLO SE HARÁN EFECTIVOS HASTA QUE EL PUNTO DE RECEPCIÓN ACEPTE EN SU SISTEMA DE PUNTO DE VENTA, DE LO CONTRARIO 6 HORAS DESPUÉS DE HECHO EL TRASLADO, LOS PRODUCTOS RETORNARÁN AL PUNTO DE ORIGEN QUEDANDO AUTOMARICAMENTE ANULADO EL TRASLADO.
         </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div style="border-bottom:2px, solid, #f00; text-align:center; margin-top:100px;">
    FIRMA QUIEN RECIBE TRASLADO
    </div>



  ';
  return $cabezote;
}




//Listo los productos trasladados
private function productosTrasladados($token){
  $conn=$this->conectar();
  //$sqlDatosTraslado="SELECT * FROM trasladosExistencia WHERE tokenTraslado=$token AND cantidadTrasladada>0";
  $sqlDatosTraslado="SELECT * FROM trasladosMercancia WHERE  token=$token  ";
  $queryDatosTraslado=$conn->query($sqlDatosTraslado);
  
  $n=0;
  while ($rsDatosTraslado=mysqli_fetch_array($queryDatosTraslado, MYSQL_ASSOC)) {
    # code...
     $rs[$n]='<tr>
                <td>'.$rsDatosTraslado['nombreProductosServicios'].'</td>
                <td align="center">'.$rsDatosTraslado['unidades'].'</td>
                <td align="center" >'.$rsDatosTraslado['codigo'].'</td>
              </tr>';
      $n++;
  }


  return implode('', $rs);

}




/*=====  End of IMPRIMIR TRASLADO PUNTO A PUNTO  ======*/



/*=====  End of PRINT DATA  ======*/







/*===========================================
=            TOOLS NORMALIZACION            =
===========================================*/


public function listadoExistenciaProductosSinSerial(){
echo '<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width="100%"}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-l711{border-color:inherit}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-uys7{border-color:inherit;text-align:center}
.tg .tg-us36{border-color:inherit;vertical-align:top}
</style>
<table class="tg" >
  <tr>
    <th class="tg-uys7">Codigo</th>
    <th class="tg-uys7">Nombre Producto</th>
    <th class="tg-uys7">Valor Promedio</th>
    <th class="tg-uys7">DR DRONE</th>

  </tr>
';
$conn=$this->conectar();

 $sqlProductoServicio="SELECT idproductosServicios, sku,nombreProductosServicios,serializacion 

                                        FROM PRODUCTOSERVICIOS WHERE serializacion='no' ORDER BY(sku) asc  ";
  $query=$conn->query($sqlProductoServicio);
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    # code...
  echo ' <tr>
          <td class="tg-l711">'.$rs['sku'].'</td>
          <td class="tg-l711">'.$rs['nombreProductosServicios'].'</td>
          <td class="tg-l711"></td>
          <td class="tg-l711">'.$this->existenciasFix($rs['idproductosServicios'], 16).'</td>

        </tr>';
  }

 


echo '
</table>';


}




public function listadoExistenciaProductosConSerial(){
  $conn=$this->conectar();

  echo '<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-l711{border-color:inherit}
.tg .tg-us36{border-color:inherit;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-l711">Codigo</th>
    <th class="tg-l711">Nombre Producto</th>
    <th class="tg-l711">Valor Promedio</th>
    <th class="tg-l711" colspan="2">PREMIUM PLAZA</th>
  </tr>
  ';

  $conn=$this->conectar();

 $sqlProductoServicio="SELECT idproductosServicios, sku,nombreProductosServicios,serializacion 

                                        FROM PRODUCTOSERVICIOS WHERE serializacion='si' ORDER BY(sku) asc ";
  $query=$conn->query($sqlProductoServicio);
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {

  echo '<tr>
    <td class="tg-l711">'.$rs['sku'].'</td>
    <td class="tg-l711">'.$rs['nombreProductosServicios'].'</td>
    <td class="tg-l711"></td><!-- VALOR PROMEDIO-->
    <td class="tg-l711">'.$this->existenciasFix($rs['idproductosServicios'], 16).'</td>
    <td class="tg-l711">'.$this->existenciasFixSeriales($rs['idproductosServicios'], 16).'</td>
   
  </tr>
  ';
  }
echo '
</table>';
/*
 $sqlProductoServicio="SELECT idproductosServicios, sku,nombreProductosServicios,serializacion 

                                        FROM PRODUCTOSERVICIOS WHERE serializacion='si' ORDER BY(sku) asc  ";
  $query=$conn->query($sqlProductoServicio);

  }

*/
}



public function limpiezaProductosImei(){
  $conn=$this->conectar();
   $sqlProductoServicio="SELECT idproductosServicios, serializacion 

                                        FROM PRODUCTOSERVICIOS WHERE serializacion='si'";
  $query=$conn->query($sqlProductoServicio);
  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    

    //ACTUAIZO LOS TRASLADOS
      $sqlActualizacionTraslados="UPDATE trasladosExistencia SET cantidadExistenteTraslado=0 
        WHERE idProductoServicio='".$rs['idproductosServicios']."'";
        $conn->query($sqlActualizacionTraslados);

    $sqlActualizacionINVENTARIO="UPDATE  INVENTARIOS SET unidadesExistentes=0 , valorUnidad=0
        WHERE idProductoServicio='".$rs['idproductosServicios']."'";
        $conn->query($sqlActualizacionINVENTARIO); 

    $sqlBorrar="DELETE FROM serialesImeis WHERE idProductoServicio='".$rs['idproductosServicios']."' AND  estado != 'vendido'";
    $conn->query($sqlBorrar);

  }//Fin del ciclo de los productos y servicios
}





public function deletePreserial($idSerializacion){
  $conn=$this->conectar();
  $idSerializacion=$this->filtroNumerico($idSerializacion);
  $sqlBorrar="DELETE FROM preSerializacion WHERE idSerializacion=$idSerializacion";
  $conn->query($sqlBorrar);

}



public function deleteRowPreCompra($idCompra, $token){
  $conn=$this->conectar();
  $idCompra=$this->filtroNumerico($idCompra);
  $token=$this->filtroNumerico($token);

  //Verifique si existen seriales/imeis

  $sql="SELECT idCompra, sku FROM  preCompra WHERE idCompra=$idCompra";
  $queryprecompra=$conn->query($sql);
  if (mysqli_num_rows($queryprecompra)>0) {
    # code...
    $rs=mysqli_fetch_array($queryprecompra, MYSQLI_ASSOC);

    if ($this->getDatosProductoServicioDesdeSku(trim($rs['sku']))['serializacion']=='si') {
      # ///Eliminar los seriales 
      $sqlDeleteSeriales="DELETE FROM preSerializacion WHERE token=$token AND sku='".$rs['sku']."'";
      $conn->query($sqlDeleteSeriales);
    }

  }
  $sqlBorrar="DELETE FROM preCompra WHERE idCompra=$idCompra";
  $conn->query($sqlBorrar);

}



//existencia por punto
public function existenciasFix($idProducto, $puntoVenta){
   $conn=$this->conectar();
    $idPuntoVenta=$puntoVenta;
    $idProductoServicio=$this->filtroNumerico($idProducto);
    $sql="SELECT SUM(cantidadExistenteTraslado) AS existencia 
                                                      FROM  trasladosExistencia WHERE
                                                       idProductoServicio=$idProductoServicio
                                                          AND destinoId=$idPuntoVenta
                                                       AND cantidadExistenteTraslado >0 ";
 
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["existencia"];
}





//Saco todos los codigos
public function existenciasFixSeriales($idProducto, $puntoVenta){
   $conn=$this->conectar();
   $sql="SELECT codigo,idProductoServicio,ubicacion,estado FROM serialesImeis WHERE  idProductoServicio=$idProducto and ubicacion=$puntoVenta and   estado != 'vendido'";
  $n=0;
  $codigos=array();
  $query=$conn->query($sql);
  while ($rsCodigos=mysqli_fetch_array($query, MYSQL_ASSOC)) {
    # code...
    $codigos[$n]=$rsCodigos['codigo'].'';
    $n++;
  }
   return implode(',', $codigos);
}





//Verifico si existen imeis repetidos
public function serialImeiRepetido($parametro){
      $conn=$this->conectar();
      $sql="SELECT codigo  FROM serialesImeis WHERE  codigo='".$codigo."'";
      $query=$conn->query($sql);
      return mysqli_num_rows($query);
}

/*=====  End of TOOLS NORMALIZACION  ======*/






//**************[FILTROS]******************//
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
      if($parametro=='')
      {
        return '';
      }
      else
      {
        return 'checked';
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




//Separo los decimales de los enteros en un numero decimal
public function tratamientoDecimales($parametro, $vector){
  $numero=explode('.', $parametro);
  switch ($vector) {

    case 0:
      return $numero[0];//Retorno los enteros
      # code...
      break;
  case 1:
      return $numero[1]; //Retorno los decimales
      # code...
      break;
    
    default:
    return $parametro; //Retorno los enteros y decimales 
      # code...
      break;
  }

}


public function espacioPorGuion($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "_");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}

public  function espacioPorNada($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}


public  function puntoPorNada($parametro){
      $encontrar    = array( ".");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}

//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{
  $fecha=explode("/", $parametro);
  return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
}
  
public function formatoFecha2($parametro){
$fecha=explode('/', $parametro);
return $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

}

private function cssEstadoPago($parametro){

switch ($parametro) {
  case 'pagada':
    # code...
    return 'text-success'; 
    break;

  case 'en credito':
    # code...
    return 'text-danger'; 
    break;

  case 'anulada':
    # code...
    return 'text-tachado'; 
    break;
    
  default:
    # code...
    break;
}

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


define(key, "SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen");
define(publickey, "5663284166397124291158310398993993");