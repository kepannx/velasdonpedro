<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class queryAjax extends conect  {
	

public function datosPuntoVenta($id)
	  {
	    $conn=$this->conectar();
	    $id=$this->filtroNumerico($this->decrypt($id, publickey));
	    $sql = "SELECT * FROM  puntosVenta  where idPunto='".intval($id)."'";
	    return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
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


//Datos de una factura
public function datosFactura($idFactura){
  $conn=$this->conectar();
  //$idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $idFactura=$this->decrypt($idFactura, publickey);
  $sqlFactura="SELECT * FROM facturacion WHERE idFactura=$idFactura";
  return mysqli_fetch_array($conn->query($sqlFactura), MYSQL_ASSOC);
}



public  function getDatosProductoServicio($idProductoServicio){
    $conn=$this->conectar();
    //$idPuntoVenta=$this->filtroNumerico($this->decrypt($idPuntoVenta, publickey));
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
     $sqlProductoServicio="SELECT * FROM  PRODUCTOSERVICIOS WHERE idproductosServicios=$idProductoServicio";
    $query=$conn->query($sqlProductoServicio);
    return mysqli_fetch_array($query, MYSQL_ASSOC);
    $conn->close();
}



//Datos del cliente
public function datosCliente($id)
    {
      $conn=$this->conectar();
      $id=$this->filtroNumerico($this->decrypt($id, publickey));
      $sql = "SELECT * FROM  clientes  where idcliente=".intval($id)."";
       return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    } 


//Datos del cliente
public function datosVendedor($id)
    {
      $conn=$this->conectar();
      $sql = "SELECT * FROM   usuarios  where codigo=".intval($id)."";
       return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
      $conn->close();
    } 





public function checkProvedor($parametro){

   $conn=$this->conectar();
  $sql="SELECT idprovedor, nombreProvedor  FROM provedores WHERE nombreProvedor ='".htmlentities($parametro)."'";
 
  $comparar=$this->normalizacionDeCaracteres($parametro);
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
    echo 0;
     $objResponse = array('idProvedor' => 0 );
  }
  echo json_encode($objResponse);

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




    //Comparo el nombre del provedor y verifico si existe
public function getIdProvedor($provedor){
    $conn=$this->conectar();
    $nombreProvedor=$this->filtroStrings($provedor, 2);
    $sqlProvedor="SELECT idprovedor, nombreProvedor FROM  provedores WHERE nombreProvedor='".$nombreProvedor."'";
    $query=$conn->query($sqlProvedor);
    if (mysqli_num_rows($query)>0) {
      # code...
      $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
      $objResponse = array('aviso' => true, 'idProvedor' => $rs['idprovedor'] );
      
    }
    else{
      $objResponse = array('aviso' => false, 'idProvedor' =>  0);
    }
    $conn->close();
    echo json_encode($objResponse); 
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

/*----------  TYPERHEADS  ----------*/

    //Listado de los productos para pasarlos en JSON
public function listadoProductosServicios(){
    $conn=$this->conectar();  
     $sqlProductos="SELECT nombreProductosServicios FROM  PRODUCTOSERVICIOS";
     $query=$conn->query($sqlProductos);
     $productos= array();
     $n=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $productos[$n]=$rs['nombreProductosServicios'];
      $n++;
    }
    $objResponse = $productos;
    
    $conn->close();
    echo json_encode($objResponse); 

  }

  //Listado de marcas

  public function listadoJsonMarcas(){
    $conn=$this->conectar();  
    $usuario=$this->encrypt($usuario, key);
     $sqlMarcas="SELECT nombreMarca FROM  marcas";
     $query=$conn->query($sqlMarcas);
     $marcas= array();
     $n=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $marcas[$n]=$rs['nombreMarca'];
      $n++;
    }
    $objResponse = $marcas;
    
    $conn->close();
    echo json_encode($objResponse); 

  }


//Listado de provedores
    public function listadoJsonProvedores(){
    $conn=$this->conectar();  
    $usuario=$this->encrypt($usuario, key);
     $sqlMarcas="SELECT nombreProvedor FROM  provedores";
     $query=$conn->query($sqlMarcas);
     $provedores= array();
     $n=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $provedores[$n]=$rs['nombreProvedor'];
      $n++;
    }
    $objResponse = $provedores;
    
    $conn->close();
    echo json_encode($objResponse); 

  }



//JSON SKU PRODUCTOS REGISTRADOS
    public function listadoJsonSku(){
    $conn=$this->conectar();  
    $sqlMarcas="SELECT sku, tipoProductoServicio, retiroTemporal FROM PRODUCTOSERVICIOS 
                                                  WHERE  tipoProductoServicio = 'producto'
                                                  AND retiroTemporal='si'";
     $query=$conn->query($sqlMarcas);
     $jsonSku= array();
     $n=0;
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $jsonSku[$n]=$rs['sku'];
      $n++;
    }
    $objResponse = $jsonSku;
    
    $conn->close();
    echo json_encode($objResponse); 

  }



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




//Lista de la identificación de los clientes registrados
public function listadoClientesIdentificacion(){
    $conn=$this->conectar();   
     $sqlClientes="SELECT identificacionCliente FROM  clientes ";
     $query=$conn->query($sqlClientes);
     $jsonSku= array();
     $n=0;
      while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $jsonSku[$n]=$rs['identificacionCliente'];
        $n++;
      }
    $objResponse = $jsonSku;
    
    $conn->close();
    echo json_encode($objResponse); 

  }

/*----------  FIN TYPERHEAD  ----------*/






public function  loadSelectCategorias($tipo, $padre){
      $conn=$this->conectar();

      echo $tipo;
      if($tipo =='subCategoria'){
         $sql="SELECT idCategoria, tipo, nombreCategoria FROM  categorias WHERE padre = $padre ORDER BY nombreCategoria ASC";
        }
      else if($tipo =='categoria'){
          $sql="SELECT idCategoria, tipo, nombreCategoria FROM  categorias WHERE tipo='categoria' ORDER BY nombreCategoria ASC";
      }
        $query=$conn->query($sql);
        if (mysqli_num_rows($query)>0) {
            while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              echo ' <option value="'.$rs['idCategoria'].'">'.$rs['nombreCategoria'].'</option>';
            } 
        }
       $conn->close();
    }


//Seleccion de las subcategorias según la categoría pasada como parámetro
public function selectSubCategorias($categoria, $subCategorias){
    $conn=$this->conectar();  
    $categoria=$this->filtroNumerico($this->decrypt($categoria, publickey));
    $sql="SELECT idCategoria, tipo, padre, nombreCategoria FROM categorias  WHERE 
                                                              padre = $categoria
                                                          AND tipo='subCategoria'";


    $query=$conn->query($sql);

    if(mysqli_num_rows($query)>0){
      echo '<select id="subCategoria" class="form-control" >
            <option>Selecciona SubCategoria</option>
      ';
        while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {

          echo '<option value="'.$this->encrypt($rs['idCategoria'], publickey).'" '.$this->selected($this->encrypt($rs['idCategoria'], publickey), $subCategorias).' >'.$rs['nombreCategoria'].'</option>';
        }
        echo '</select>';
      }
    else{//Si no hay subcategorias 
      echo '<h3 class="text-danger">'.txtSinSubCategoria.' <i class="fa  fa-frown-o"></i> </h3>';
    }
    $conn->close();
  }



public function checkProductosServicios($parametro)
{
  $conn=$this->conectar();
  $sql="SELECT nombreProductosServicios, tipoProductoServicio FROM PRODUCTOSERVICIOS";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres(trim($parametro));
  $query=$conn->query($sql);
  while ($rs=mysqli_fetch_array($query)) {
    # code...
    if ($this->normalizacionDeCaracteres(trim($rs['nombreProductosServicios']))==$comparar) {
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
 
  $conn->close();
}


//Checkeo el SKU o Código. repetido
public function checkSkuRepetido($parametro)
{
  $conn=$this->conectar();
  $sqlSku="SELECT idproductosServicios, sku FROM PRODUCTOSERVICIOS";
  //$sqlExistencia="SELECT idproductosServicios, sku FROM PRODUCTOSERVICIOS WHERE sku='".$parametro."' ";
  $sqlExistencia="SELECT idproductosServicios, sku, serializacion FROM PRODUCTOSERVICIOS WHERE sku='".trim($parametro)."' AND serializacion = 'no'";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres(trim($parametro));
  $query=$conn->query($sqlSku);
  $queryExistencia=$conn->query($sqlExistencia);
  $rsC=mysqli_fetch_array($queryExistencia, MYSQL_ASSOC);

  $this->verificacionExistenciaEnPuntodeVenta($rsC['idproductosServicios']); 
  if($this->verificacionExistenciaEnPuntodeVenta($rsC['idproductosServicios'])>0){
    while ($rs=mysqli_fetch_array($query)) {
          # code...
          if ($this->normalizacionDeCaracteres(trim($rs['sku']))==$comparar) {
            $n++;
          }
        }
        if ($n>0) {
         $objResponse = true;
        }
        else{
          $objResponse = false;
        }
  }else{
    $objResponse = false;
  }
  
        

    echo json_encode($objResponse); 
 
  $conn->close();
}








//CHECKEO SERIALES/IMEIS
public function checkImeiSerial($codigo){
  $conn=$this->conectar(); 
   $codigo=trim($this->comillaSimplePorGuion(htmlentities($codigo))) ;
   $ubicacion=$this->decrypt($_SESSION['datos'], key);
  $sqlImeis="SELECT idSerialImei, idProductoServicio, codigo, tipo, ubicacion, estado  FROM serialesImeis WHERE codigo='".$codigo."'AND ubicacion='".$ubicacion."' AND estado='en almacen' AND  inventariado=0 ";
   $queryImeiSerial=$conn->query($sqlImeis);
   $rs=mysqli_fetch_array($queryImeiSerial, MYSQLI_ASSOC);
   $resultado=array('idSerialImei'=> $this->encrypt($rs['idSerialImei'], publickey),
                    'idProductoServicio'=> $this->encrypt($rs['idProductoServicio'], publickey),
                    'codigo'=>$rs['codigo'],
                    'tipo'=>$rs['tipo'],
                    'ubicacion'=>$rs['ubicacion'], 
                    'valorVentaUnidad' => number_format($this->getDatosProductoServicio($rs['idProductoServicio'])['valorVentaUnidad']),
                    'nombreProductosServicios' =>  $this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios']

);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
}







//Cargo los taxes que  hay registrados por ley
public function loadTaxes(){
  $conn=$this->conectar();
  $sql="SELECT * FROM taxes WHERE aplicacion='todos'  ORDER BY `idImpuesto`  ASC
";
  $query=$conn->query($sql);
  echo '<div class="custom-control custom-radio">';
  while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  echo '  <input type="radio" value="'.$rs['valor'].'"id="impuesto" name="impuesto" checked class="custom-control-input">
          <label class="custom-control-label" for="impuestos">'.$rs['nombreImpuesto'].'</label> | ';
  }
 echo '</div>';
}



//Verifoco que un producto exista en el INVENTARIOS de un local de origen
public function checkingexistenciaenorigen($idProducto){
    $conn=$this->conectar();
    $idOrigen=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProducto, publickey));
  
    $sqlExistencia='SELECT SUM(cantidadExistenteTraslado) AS total FROM trasladosExistencia WHERE idProductoServicio = '.$idProductoServicio.' AND destinoId= '.$idOrigen.' ';
    $query=$conn->query($sqlExistencia);
    $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
    $objResponse = array('numero' => $rs['total'] );
   echo json_encode($objResponse);
}






//Chequeo Productos
public function checkProductoServicioReperido($parametro)
{
  $conn=$this->conectar();
  $sql="SELECT nombreProductosServicios FROM PRODUCTOSERVICIOS";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  $query=$conn->query($sql);

  while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
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
}







/*----------  JSON RETURN  ----------*/



//JSON DE DATOS DE LOS PRODUCTOS 

public function jsonProductoServicio($sku)
{
  $conn=$this->conectar();

  $nombreProductosServicios=$this->filtroStrings($nombreProductosServicios, 2);
  $sku=$this->filtroStrings($sku, 1);

  $sqlProductoServicio="SELECT * FROM PRODUCTOSERVICIOS WHERE sku='".$sku."' AND retiroTemporal = 'si' ";
  $n=0;
  $queryProductoServicio=$conn->query($sqlProductoServicio);
  $rs=mysqli_fetch_array($queryProductoServicio);
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
                    'imagenProducto'=>$rs['imagenProducto'],
                    'maximoDescuento'=>$rs['maximoDescuento'],
                    'ventaCruzada'=>$rs['ventaCruzada'],
                    'web'=>$rs['web'],
                    'retiroTemporal'=>$rs['retiroTemporal'],
                    'costoPromedio'=>($this->analisisValorVenta($rs['valorVentaUnidad'], $rs['idproductosServicios']))

);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
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
    echo json_encode($objResponse); 
 
  $conn->close();
}




//Return json facturacion

public function jsonFacturacion($idFactura)
{
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $idFactura=$this->decrypt($idFactura, publickey);

  $sqlFactura="SELECT * FROM facturacion WHERE idFactura=$idFactura AND idPuntoVenta=$idPuntoVenta";
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
                    'retiroTemporal'=>$rs['retiroTemporal']

);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
}

public function jsonPuntoVenta($idFactura)
{
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

  $sqlFactura="SELECT * FROM puntosVenta WHERE idPunto=$idPuntoVenta";
  $queryFactura=$conn->query($sqlFactura);
  $rs=mysqli_fetch_array($queryFactura);
  $resultado=array('idPunto'=> $this->encrypt($rs['idPunto'], key),
                    'matricula'=>$rs['matricula'],
                    'bodega'=>$rs['bodega'],
                    'nombrePunto'=>$rs['nombrePunto'],
                    'alias'=>$rs['alias'],
                    'razonSocial'=>$rs['razonSocial'],
                    'direccionPunto'=>$rs['direccionPunto'],
                    'ciudadPunto'=>$rs['ciudadPunto'],
                    'departamentoPunto'=>$rs['departamentoPunto'],
                    'sitioWebPunto'=>$rs['sitioWebPunto'],
                    'email'=>$rs['email'],
                    'logoPunto'=>$rs['logoPunto'],
                    'telefonoPunto'=>$rs['telefonoPunto'],
                    'idAdministrador'=>$rs['idAdministrador'],
                    'regimenTributario'=>$rs['regimenTributario'],
                    'nitPunto'=>$rs['nitPunto'],
                    'formatoImpresion'=>$rs['formatoImpresion'],
                    'prefijo'=>$rs['prefijo'],
                    'nroInicioFactura'=>$rs['nroInicioFactura'],
                    'representanteLegal'=>$rs['representanteLegal'],
                    'terminosCondicionesFactura'=>$rs['terminosCondicionesFactura'],
                    'ultimaSesion'=>$rs['ultimaSesion'],
                    'permitirCreditos'=>$rs['permitirCreditos'],
                    'activada'=>$rs['activada'],
                    'usuario'=>$rs['usuario'],
                    'modoInventario'=>$rs['modoInventario']


);
  $objResponse = $resultado;
    echo json_encode($objResponse); 
 
}



public function checkMetodosPagoFactura($idFactura){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
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



//Checkeo el SKU o Código. repetido
public function checkCliente($parametro)
{
  $conn=$this->conectar();
  $sql="SELECT identificacionCliente FROM  clientes";
  $n=0;
  $comparar=$this->normalizacionDeCaracteres($parametro);
  //$query=$conn->query($sql);
  $query=$conn->query($sql);

  while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    # code...
    if ($this->normalizacionDeCaracteres($rs['identificacionCliente'])==$comparar) {
      $n++;
    }
  }

  if ($n>0) {
   $objResponse = 1;
    }
    else{
      $objResponse = 0;
    }

    echo json_encode($objResponse); 
 
  $conn->close();

}


/*----------  FIN JSON RETURN  ----------*/


/*----------  LISTAS  ----------*/















/*============================================
=            SECCION DE BUSQUEDAS            =
============================================*/


//LISTADO DE  PRODUCTOS Y SERVICIOS
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
      $arr_parametros = preg_split ("/\s+/", $busqueda);

      $clave = implode($arr_parametros,"*");

      $clave = $clave ."*";

      $categoria=(int)$categoria;
      $subCategoria=(int)$subCategoria;
      $reload = '../../../modulos/productos/index.php';


      if ($categoria==0 AND $subCategoria==0 AND strlen($busqueda)>2) {//Esta sin categoria y lo busca con nombre
        # code...
        
        $sql="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (sku ='".$busqueda."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si'  ORDER BY puntuacion ASC LIMIT $offset,$porPagina  ";

      }else if ($categoria>0 AND $subCategoria==0 AND  strlen($busqueda)>2) {//Solo con categoria y con nombre o sku
        $sql="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (sku ='".$busqueda."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si' AND categoria=$categoria  ORDER BY puntuacion ASC LIMIT $offset,$porPagina  ";

        # code...
      }else if ($categoria>0 AND $subCategoria>0 AND  strlen($busqueda)>1) {//Con Categoria y SubCategoria y nombre o sku
        # code...
       $sql="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (sku ='".$busqueda."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si' AND (categoria=$categoria AND subCategoria=$subCategoria)  ORDER BY puntuacion ASC LIMIT $offset,$porPagina  ";


      }else if ($categoria>0 AND $subCategoria==0 AND strlen($busqueda)==0) {//Solo con categoria
        # code...
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE categoria=$categoria  ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";

      }else if ($categoria>0 AND $subCategoria>0 AND strlen($busqueda)==0) {//Con Categoria y SubCategoria
        $sql="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE( categoria=$categoria AND subCategoria=$subCategoria)  ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
        # code...

      }
      else if(strlen($busqueda)==0){
         $sql="SELECT idproductosServicios, sku, nombreProductosServicios  FROM PRODUCTOSERVICIOS WHERE nombreProductosServicios != '' ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
      }

    //CONTADOR
      $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM PRODUCTOSERVICIOS  WHERE nombreProductosServicios != ''");



     $filas= mysqli_fetch_array($count_query);
      $numrows = $filas['numeroConsultas']; //El numero de consultas
      $totalPaginas = ceil($numrows/$pagina);
     $query= $conn->query($sql);

     echo '<table id="tablaInventario" class="table table-bordered" data-toggle-column="first">
    <thead>
      <tr>
        <th data-breakpoints="xs"></th>
            <th>Codigo</th>
            <th>Producto</th>
            <th data-breakpoints="xs">Costo</th>

            <th data-breakpoints="xs sm">Existencia Punto </th>
            <th data-breakpoints="xs">Existencia Global</th>
            <th data-breakpoints="all" data-title="Ubicación"><div id="">/div></th>
                                            </tr>
            </thead>
          <tbody>
      ';




    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {

      echo ' <tr onclick="loadStores('.$rs['idproductosServicios'].')">
            <td></td>
            <td>
              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'
              </td>
              <td>'.$this->getDatosProductoServicio($rs['idproductosServicios'])['nombreProductosServicios'].'</td>
              <td>'.number_format($this->calcularValorPonderado($rs['idproductosServicios'])).' </td>

              <td>'.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
              <td>'.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).' </td>
              <td><div id="loadStore'.$rs['idproductosServicios'].'"></div></td>
          </tr>';
        }
 


     echo '                                      
                                        </tbody>
                                    </table>';




      echo '<div class="col-md-12" align="center">'.$this->paginate($reload, $pagina, $totalPaginas, $adjacents, 'listaProductos').'<div>';
    }





//FIN DE LA BUSQUEDA CON PAGINADOR







//QUERY BUSQUEDAS GENERALES


public function busquedaGeneral($parametros){
  $conn=$this->conectar();
  extract($_REQUEST);
  $page=$this->filtroNumerico($page);
  $busqueda = mysqli_real_escape_string($conn,(strip_tags($q, ENT_QUOTES)));
  $pagina = (isset($pagina) && !empty($pagina))?$pagina:1;
  $porPagina = 100; //how much records you want to show
  $adjacents  = 4; //gap between pages after number of adjacents
  $offset = ($pagina - 1) * $porPagina;
  $categoria=(int)$categoria;
  $subCategoria=(int)$subCategoria;


   echo '<table id="tablaBusqueda" class="table table-bordered" data-toggle-column="first">
    <thead>
      <tr>
        <th data-breakpoints="xs"></th>
            <th>Codigo</th>
            <th>Producto</th>
            <th data-breakpoints="xs sm">Existencia Punto </th>
            <th data-breakpoints="xs">Existencia Global</th>
            <th data-breakpoints="all" data-title="Ubicación"><div id="">/div></th>
                                            </tr>
            </thead>
          <tbody>
      ';
  if ($categoria > 0 or $subCategoria >0) {//Si estoy filtrando por categorias
    # code...
     $parametro= trim($busqueda);
     $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE sku ='".$parametro."' OR nombreProductosServicios='".$parametro."' AND (categoria = $categoria OR subCategoria = $subCategoria) LIMIT $offset,$porPagina";
        
      $query=$conn->query($sqlProductoServicio);
      if(mysqli_num_rows($query)>0){//Exite producto
      $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
      echo ' <tr onclick="loadStores('.$rs['idproductosServicios'].')">
            <td></td>
            <td>
              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'
              </td>
              <td>'.$this->getDatosProductoServicio($rs['idproductosServicios'])['nombreProductosServicios'].'</td>
              <td>'.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
              <td>'.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).' </td>
              <td><div id="loadStore'.$rs['idproductosServicios'].'"></div></td>
          </tr>';




    }else{//si el producto no esta 
            $arr_parametros = preg_split ("/\s+/", $parametro);
            $clave = implode($arr_parametros,"*");
            $clave = $clave ."*";
              if ($categoria==0 AND $subCategoria==0 AND strlen($q)>2) {//Esta sin categoria y lo busca con nombre
                //echo 'sin categoria, sin subcategoria y solo con consulta';

                $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (sku ='".$parametro."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si' ORDER BY puntuacion ASC LIMIT $offset,$porPagina  ";



              }else if ($categoria>0 AND $subCategoria==0 AND strlen($q)>2) {
                # code...
                //echo 'Con categoria, sin subcategoria y con consulta';
                $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (categoria=$categoria) AND
                  (sku ='".$parametro."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si' ORDER BY puntuacion ASC LIMIT $offset,$porPagina  ";



              }else if ($categoria>0 AND $subCategoria>0 AND strlen($q)>2) {
                # code...
                //echo 'Con categoria, Con subcategoria y con consulta';

                $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios, categoria, subCategoria ,MATCH(nombreProductosServicios)  AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE 
                  (categoria=$categoria AND subCategoria=$subCategoria) AND
                  (sku ='".$parametro."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE)) AND retiroTemporal='si' ORDER BY puntuacion ASC LIMIT $offset,$porPagina ";


              }else if ($categoria>0 AND $subCategoria==0 AND strlen($q)==0) {
                # code...
                //echo 'Con categoria, sin subcategoria y Sin consulta';

                $sqlProductoServicio="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE categoria=$categoria  AND retiroTemporal='si' ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina  ";

              }
              else if ($categoria>0 AND $subCategoria>0 AND strlen($q)==0) {
                # code...
               $sqlProductoServicio="SELECT idproductosServicios, sku, nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE categoria=$categoria  AND subCategoria=$subCategoria  AND retiroTemporal='si' ORDER BY nombreProductosServicios ASC LIMIT $offset,$porPagina";
              }








            $queryProductoServicio=$conn->query($sqlProductoServicio);
            $count_query   = mysqli_query($conn, "SELECT count(*) AS numeroConsultas FROM PRODUCTOSERVICIOS  WHERE nombreProductosServicios != ''");
            $filas= mysqli_fetch_array($count_query);
            $numrows = $filas['numeroConsultas']; //El numero de consultas
            $totalPaginas = ceil($numrows/$pagina);


            echo $totalPaginas.'<br>';
            while ($rs=mysqli_fetch_array($queryProductoServicio, MYSQLI_ASSOC)) {
              # code...
              echo ' <tr onclick="loadStores('.$rs['idproductosServicios'].')">
                        <td></td>
                             <td>
                              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'
                            </td>
                            <td>
                              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['nombreProductosServicios'].'</td>
                            <td>
                              '.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
                            <td>
                              '.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).' </td>
                            <td><div id="loadStore'.$rs['idproductosServicios'].'"></div></td>
                        </tr>';
            }//FIN DEL CICLO DE BUSQUEDA CON MATCH

    }//Fin de busqueda por categorias
  }
  else{

  }
  //Busco primero el imei/serial
  $sqlSerial="SELECT codigo, idProductoServicio,  estado FROM serialesImeis  WHERE codigo='".trim($busqueda)."' AND estado ='en almacen' ";
  $query=$conn->query($sqlSerial);

      //
      if(mysqli_num_rows($query)>0){
        $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
          echo ' <tr onclick="loadStores('.$rs['idProductoServicio'].')">
            <td></td>
            <td>
                                                '.$this->getDatosProductoServicio($rs['idProductoServicio'])['sku'].'
                                                </td>
                                                <td>'.$this->getDatosProductoServicio($rs['idProductoServicio'])['nombreProductosServicios'].'</td>
                                                <td>'.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idProductoServicio'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
                                                <td>'.$this->getCantidadExistenciasProductoEnGlobal($rs['idProductoServicio']).' </td>
                                                <td><div id="loadStore'.$rs['idProductoServicio'].'"></div></td>
                                            </tr>';

      }else{
        //NO SE ENCONTRO CON SERIAL, BUSCAR CON  CODIGO
          $parametro= trim($busqueda);
          $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios FROM PRODUCTOSERVICIOS WHERE sku ='".$parametro."' OR nombreProductosServicios='".$parametro."' ";
          

          $query=$conn->query($sqlProductoServicio);
          if(mysqli_num_rows($query)>0){
          $rs=mysqli_fetch_array($query, MYSQLI_ASSOC);
          echo ' <tr onclick="loadStores('.$rs['idproductosServicios'].')">
            <td></td>
            <td>
                                                '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'
                                                </td>
                                                <td>'.$this->getDatosProductoServicio($rs['idproductosServicios'])['nombreProductosServicios'].'</td>
                                                <td>'.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
                                                <td>'.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).' </td>
                                                <td><div id="loadStore'.$rs['idproductosServicios'].'"></div></td>
                                            </tr>';

          }//FIN DE PRODUCTO ENCONTRADO CON SOLO CODIGO
          else{//Busco con los parametros en match

            $arr_parametros = preg_split ("/\s+/", $parametro);
            $clave = implode($arr_parametros,"*");
            $clave = $clave ."*";
            $sqlProductoServicio="SELECT idproductosServicios,sku,nombreProductosServicios ,MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE) as puntuacion FROM PRODUCTOSERVICIOS WHERE sku ='".$parametro."' OR MATCH(nombreProductosServicios) AGAINST ('".$clave."' IN BOOLEAN MODE) AND retiroTemporal='si'  ORDER BY puntuacion ASC  ";

            $queryProductoServicio=$conn->query($sqlProductoServicio);

            while ($rs=mysqli_fetch_array($queryProductoServicio, MYSQLI_ASSOC)) {
              # code...
              echo ' <tr onclick="loadStores('.$rs['idproductosServicios'].')">
                        <td></td>
                             <td>
                              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['sku'].'
                            </td>
                            <td>
                              '.$this->getDatosProductoServicio($rs['idproductosServicios'])['nombreProductosServicios'].'</td>
                            <td>
                              '.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
                            <td>
                              '.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).' </td>
                            <td><div id="loadStore'.$rs['idproductosServicios'].'"></div></td>
                        </tr>';
            }//FIN DEL CICLO DE BUSQUEDA CON MATCH

          }//fin de busqueda con MATCH
   
      }




                                           
                                            
      echo '                                      
                                        </tbody>
                                    </table>';




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
                  <td align="center"></td>
                  <td align="center">'.$this->filtroNumerico($this->getCantidadExistenciasProductoEnPunto($rs['idproductosServicios'], ($this->decrypt($_SESSION['datos'], key)))).'</td>
                  
                  <td align="center">'.$this->getCantidadExistenciasProductoEnGlobal($rs['idproductosServicios']).'</td>
                  <td><i class="fa  fa-plus-circle" id="muestraMas" name="show_'.$rs['sku'].'"></i></td>
              </tr>
             </tr>
             <tr id="show_'.$rs['sku'].'" style="display:none;">
               <td class="tg-031e" colspan="6">
                    ';

                    //$this->distribucionProducto($rs['idproductosServicios']);
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

/*=====  End of SECCION DE BUSQUEDAS  ======*/



/*----------  LISTA DE  LAS COMPRAS RELACIONADAS DE UN PRODUCTO  ----------*/
/**
 *
 * Esta lista me  saca las compras hechas a los provedores de un producto determinado
 *
 */







/*==========================================
=            LISTA DE GARANTIAS            =
==========================================*/


/*=====  End of LISTA DE GARANTIAS  ======*/








/*=========================================
=            LISTA DE FACTURAS            =
=========================================*/
public function listaFacturasRango($parametro){
  $conn=$this->conectar();

  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

  if (strlen($parametro['fecha'])>10) {
    # code...
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];
  }


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
      FROM facturacion WHERE (idPuntoVenta=$idPuntoVenta  OR pertenencia=$idPuntoVenta)
                          AND fechaFactura = '".date('Y-m-d')."' ";
  }


  $query=$conn->query($sqlFactura);
  $total=0;
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
                  <td>  '.$foraneo.' '.$rs['fechaFactura'].'</td>
                  <td align="center">'.$rs['nroFactura'].'</td>
                  <td>'.$rs['estadoFactura'].'</td>
                  <td align="center">'.$rs['tipoPago'].'</td>
                  <td  align="center">'.number_format($rs['valorTotalFactura']).'</td>
                  <td>
                  <a href="'.PATH.'/modulos/contabilidad/facturaCliente.php?idFactura='.$this->encrypt($rs['idFactura'],publickey).'">
                     <i class="fa fa-arrow-circle-right"  value="'.$rs['idFactura'].'" id="deleteRow" title="Ver La Factura"></i>
                    </a>
                  </td>
                </tr>';
                if ($rs['estadoFactura']=='anulada' OR  $t==0) {
                  # code...
                  $total=$total+0;
                }else{
                  $total=$total+$rs['valorTotalFactura'];
                }
                
    }
                
  echo '      </tbody>
            </table>
            </div>';
  echo '<div class="pull-right m-t-30 text-right">
                        <p>Total Facturado </p>
                        <hr>
                        <h3 class="text-success"><b>Totales :</b> '.number_format($total).'</h3>
                      </div>';
}










public function checkPassAdmin2($pass){
  $conn=$this->conectar();

  $pass=$this->encrypt(filter_var(strip_tags($pass), FILTER_SANITIZE_STRING), key);
  $idPunto=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $sql="SELECT idPunto, contrasenaAdmin FROM puntosVenta WHERE contrasenaAdmin='".$pass."' AND idPunto=$idPunto ";
  $query=$conn->query($sql);
  if (mysqli_num_rows($query)>0) {
    # code...
     echo  $_SESSION['datosAdmin']=strtotime((date('Y-m-d H:i:s')));
  }else{
    echo  0;
  }
}








//Listado de Historico de Ventas

public function listaMovimiendosDiarios($parametro){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    # code..
    $fechas=explode('_', $parametro['fecha']);
    $fecha1=$fechas[0].' 00:00:00';
    $fecha2=$fechas[1].' 23:59:59';



  if (isset($fecha1, $fecha2)) {
    # code...
    $f1=strtotime($fecha1);
    $f2=strtotime($fecha2);
    $nroDias=ceil(($f2-$f1)/86400);

  }
  $control=0;

   echo '<div class="table-responsive">
            <table id="tablaB" class="table table-striped">
              <thead>
                <tr>
                  <th><div>Fecha</div></th>
                  <th><div align="center">Efectivo</div></th>
                  <th><div align="center">Transacciones</div></th>
                  <th><div align="center">Egresos</div></th>
                  <th><div align="center">Total</div></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
    ';
  
    while ($nroDias>$control) {
      # code...
      $date1=(gmdate('Y-m-d', $f1)).' 00:00:00';
      $date2=(gmdate('Y-m-d', $f1)).' 23:59:59';
      $date=(gmdate('Y-m-d', $f1));


      $fecha = array('fecha' => $this->encrypt($date1."_".$date2,publickey));
      $efectivo=$this->calculoTotalEfectivo($fecha);
      $transacciones=$this->calculoValorTransacciones($fecha);
      $egresos=$this->calculoValorEgresosGastos($fecha);
      $total=($efectivo+$transacciones)-$egresos;
      if ($total!=0) {
       echo '<tr>
                  <td>'.$date.'</td>
                  <td align="center">$ '.number_format($efectivo).'</td>
                  <td  align="center">$ '.number_format($transacciones).'</td>
                  <td align="center">$ '.number_format($egresos).'</td>
                  <td  align="center">$ '.number_format($total).'</td>
                  <td> 
                    <a href="'.PATH.'/modulos/contabilidad/movimientosDia.php?fechaFiltro='.$this->encrypt($date1."_".$date2,publickey).'">
                     <i class="fa fa-arrow-circle-right"   id="goToQuery" title="Ver Todos Los Movimientos De Este Día"></i>
                    </a>
                  </td>
                </tr>';
          }
      $control++;
      $f1=$f1+86400;
    } 
  echo '      </tbody>
            </table>
            </div>';

}









//Calculo los gastos y egresos en un rango de tiempo 
public function calculoTotalFacturas($fecha1, $fecha2){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

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




//CALCULO TOTAL DEL EFECTIVO
public function calculoTotalEfectivo($parametro){
    $conn=$this->conectar();

if (sizeof($parametro['fecha'])>0) {
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];
  }
  //CUANDO PASO EL PARAMETRO POR JAVASCRIPT. LO PASA POR /
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

if (isset($parametro['fecha'])) {
    # code..
        $sql="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago = 'efectivo' AND estado='activa' ";
  }
  else if(isset($fecha1) AND !isset($fecha2)){


    $sql="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago = 'efectivo' AND estado='activa' ";
  }
  else{
   
   $sql="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado LIKE '".date('Y-m-d')."%'
                                                      AND tipoPago = 'efectivo'AND estado='activa' ";
  }

  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  $r=explode('.', $resultado['valorTotal']);
  return $r[0];
}
//FIN DEL CÁLCULO TOTAL DEL EFECTIVO

//
public function calculoValorTransacciones($parametro){
    $conn=$this->conectar();
  if (sizeof($parametro['fecha'])>0) {
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];
  }
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
      if (isset($fecha1, $fecha2)) {
      $sqlTransacciones="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago != 'efectivo' AND estado='activa' ";
      $sqlTransaccionesComision="SELECT SUM(comision) AS valorTotalComision 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado BETWEEN '".$fecha1."' AND '".$fecha2."' AND tipoPago != 'efectivo' AND estado='activa' ";
  }
 
  else{
   
   $sqlTransacciones="SELECT SUM(valor) AS valorTotal 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado LIKE '".date('Y-m-d')."%'
                                                      AND tipoPago != 'efectivo'
                                                      AND estado='activa' ";
    $sqlTransaccionesComision="SELECT SUM(comision) AS valorTotalComision 
                                                      FROM perfilPagos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaRegistrado LIKE '".date('Y-m-d')."%'
                                                      AND tipoPago != 'efectivo'
                                                      AND estado='activa' ";
  }


  $resultado = mysqli_fetch_assoc($conn->query($sqlTransacciones)); 
  $resultadoComision = mysqli_fetch_assoc($conn->query($sqlTransaccionesComision));  
  $r=explode('.', $resultado['valorTotal']);
  $rc=explode('.', $resultadoComision['valorTotalComision']);
  return ($r[0]+$rc[0]);
}





public function calculoValorEgresosGastos($parametro){
    $conn=$this->conectar();
  if (sizeof($parametro['fecha'])>0) {
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];
  }
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
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




//SACO EL VALOR DE LAS CUENTAS POR COBRAR
public function calculoValorCuentasPorCobrar($fecha1, $fecha2){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));


      if (isset($fecha1, $fecha2)) {
    # code..
        $fecha1=$this->formatoFecha($fecha1);
        $fecha2=$this->formatoFecha($fecha2);
        $sql="SELECT SUM(deudaFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaFactura BETWEEN '".$fecha1."' AND '".$fecha2."' AND estadoFactura = 'en credito' ";
  }

  else if(isset($fecha1) AND !isset($fecha2)){
       // $fecha1=$this->formatoFecha($fecha1);
       // $fecha2=$fecha1;
    $fecha1=date('Y-m-d');
    $fecha2=$fecha1;
        $sql="SELECT SUM(deudaFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaFactura BETWEEN '".$fecha1."' AND '".$fecha2."' AND estadoFactura = 'en credito' ";
  }
  else{
    
   $sql="SELECT SUM(deudaFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaFactura LIKE '".date('Y-m-d')."%'
                                                      AND estadoFactura = 'en credito'
                                                      ";
  }

  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  $r=explode('.', $resultado['valorTotal']);
  return $r[0];
}





/*==============================
=            PREFAC            =
==============================*/

public function listaPreFactura($tokenPrefactura){
  //Listo la prefactura del punto
  $tokenPrefactura=$this->filtroNumerico($tokenPrefactura);
  $conn=$this->conectar();
  echo '<table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
              <thead>
                <tr>
                  <th> Productos</th>
                  <th> <div style="text-align: center">Unidades </div></th>
                  <th> <div style="text-align: center">Costo Unidad </div></th>
                  <th> <div style="text-align: center">Impuesto</div></th>
                  <th> <div style="text-align: center">Valor Total</div></th>
                  <th data-hide="all" > </th>
                </tr>
              </thead>
              <tbody id="listadoProductos">
              ';
  $sql="SELECT * FROM preVenta where token='".$tokenPrefactura."'";
  $query=$conn->query($sql);
  $impuestos=0;
  $subTotal=0;
  $total=0;


  while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    # code...
    echo '<tr>
                  <td>
                    <input type="hidden" id="sku_" value = "'.$rs['codigo'].'">
                    <input type="hidden" id="idproductosServicios_" value = "'.$rs['idProducto'].'">
                    '.$this->filtroStrings($rs['nombreProductosServicios'],2).'

                  </td>
                  <td><input type="hidden" id="nombreProductoServicio_" value="'.$this->filtroStrings($rs['nombreProductosServicios'],2).'"><div style="text-align: center">'.$this->filtroStrings($rs['cantidades'],2).' </div></td>
                    <input type="hidden" id="unidades_" value = "'.$this->filtroStrings($rs['cantidades'],2).'">
                  <td> 
                    <div style="text-align: center">'.number_format($rs['valorUnidad']).' </div>
                    <input type="hidden" id="valorUnidad_" value = "'.($rs['valorUnidad']+$rs['impuesto']).'">

                  </td>
                  
                  <td>
                    <div style="text-align: center">'.number_format($rs['impuesto']).' </div>

                  </td>
                  
                  <td>
                    <div style="text-align: center">'.number_format(($rs['valorUnidad']+$rs['impuesto'])*$rs['cantidades']).'</div>
                  </td>
                  <td data-hide="all" ><i class="fa fa-trash" id="deletePreFactura"  onClick="deleteRow('.$rs['idPreventa'].')"></i> </td>
          </tr>';
    $impuestos=($rs['impuesto']*$rs['cantidades'])+$impuestos;
    $subTotal=($rs['valorUnidad']*$rs['cantidades'])+$subTotal;
    $total=(($rs['valorUnidad']+$rs['impuesto'])*$rs['cantidades'])+$total;
      
  }

    echo      '
              </tbody>
    </table>

  
      <div class="pull-right m-t-30 text-right">
        <p class="text-green">SubTotal: <span id="subTotal">'.number_format($subTotal).'</span></p>
        <input type="hidden" id="valorNeto" value="'.$subTotal.'">
        <p class="text-danger">Impuestos : <span id="totalImpuestos">'.number_format($impuestos).'</span>  </p>
        <hr>
        <h3 class="text-success"><b>Total :</b> <span id="totalFinal">'.number_format($total).'</span></h3>
            <input type="hidden" id="valorTotal" value="'.$total.'">

        <input type="hidden" id="totalhide">
      </div>
      <div class="clearfix"></div>
     ';
}

/*=====  End of PREFAC  ======*/
/* 
*/






/*==============================================
=            LISTA DE PRE-TRASLADOS            =
==============================================*/


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





//LISTA PRODUCTOS LISTOS PARA PRE-TRASLADO


public function listaPreTrasladoPunto($token){
    $conn=$this->conectar();
    $idDestino=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

    $sqlTraslados="SELECT * FROM trasladosMercancia WHERE  idDestino=$idDestino AND confirmacion='no'";
    $query=$conn->query($sqlTraslados);

    if (mysqli_num_rows($query)>0) {
      # code...
    
      echo '<div class="table-responsive">
            <table id="tablaB" class="table table-striped">
              <thead>
                <tr>
                  <th><div></div></th>
                  <th><div>ORIGEN</div></th>
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
            <td><input type="checkbox" id="idTraslado" value="'.$rs['idTraslado'].'" checked></td>
            <td>'.$this->datosPuntoVenta($this->encrypt($rs['idOrigen'], publickey))['alias'].'</td>
            <td>'.$rs['sku'].'</td>
            <td align="center"> '.$rs['nombreProductosServicios'].'</td>
            <td  align="center"> '.$rs['unidades'].'</td>
            <td align="center">'.$rs['codigo'].'</td>
          </tr>';
    } 
echo '</tbody>
            </table>
            </div>
<div class="col-md-12" align="center"> <button type="button" class="btn btn-info" onclick="trasladoMercancia()">  <i class="fa fa-arrow-circle-right"></i> Trasladar Mercancia Seleccionada  A Mi Punto Ya Mismo</button> </div>
            ';
}else{


    echo '<div class="col-md-12" align="center"> <div class="alert alert-success col-md-12"><i class="fa fa-check-circle"></i> No tienes traslados pendientes</div> </div>';


}


}




//Checkeo si existen  traslados hechos a un punto
public function checkTraslados(){
      $conn=$this->conectar();
      $idDestino=$this->decrypt($_SESSION['datos'],  key);
      $sqlTraslados="SELECT idDestino, confirmacion FROM trasladosMercancia WHERE idDestino='".$idDestino."' AND confirmacion='no'";
      $query=$conn->query($sqlTraslados);
      if (mysqli_num_rows($query)>0) {
        # code...
        echo 1;
      }else{
        echo 0;
      }
}
/*=====  End of LISTA DE PRE-TRASLADOS  ======*/







/*==============================================
=            ACTIVACION DE TRASLADO            =
==============================================*/

public function preTraslado($parametros){
      $conn=$this->conectar();
      extract($parametros);
      $token=$this->filtroNumerico($token);
      $destinoId=$this->filtroNumerico($destinoId);
      $idOrigen=$this->decrypt($_SESSION['datos'],  key);
      $sql='UPDATE trasladosMercancia SET idDestino = '.$destinoId.'  WHERE  idOrigen = '.$idOrigen.' and token='.$token.'';
      $query=$conn->query($sql);
            $objResponse = array('token' => strtotime(date("Y-m-d H:i:s")) );
            $objResponse = array('codigo' => $token);

    echo json_encode($objResponse); 


}



/*=====  End of ACTIVACION DE TRASLADO  ======*/






/*===========================================
=            LISTA DE TRASLADOS             =
===========================================*/

public function listTrasladosPuntoCenta($parametro){
  $conn=$this->conectar();

echo '_';
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    # code..
    $fechas=explode('_', $parametro['fecha']);
    $fecha1=$fechas[0].' 00:00:00';
    $fecha2=$fechas[1].' 23:59:59';
  if (isset($fecha1, $fecha2)) {
    # code...
    $f1=strtotime($fecha1);
    $f2=strtotime($fecha2);
    $nroDias=ceil(($f2-$f1)/86400);

  }

   echo '<div class="table-responsive">
            <table id="tablaB" class="table table-striped">
              <thead>
                <tr>
                  <th><div>Fecha y Hora</div></th>
                  <th><div align="center">ORIGEN</div></th>
                  <th><div align="center">DESTINO</div></th>
                  <th><div align="center">PRODUCTO</div></th>
                  <th><div align="center">CODIGO</div></th>
                  <th><div align="center">Unidades</div></th>
                  <th><div align="center"></div></th>
                </tr>
              </thead>
              <tbody>
    ';
  
 $sqlTraslados="SELECT * FROM trasladosMercancia WHERE  idDestino=$idPuntoVenta OR idOrigen=$idPuntoVenta AND  fechaTraslado >= '".$fecha1."' AND  fechaTraslado <='".$fecha2."'    ";

  $query=$conn->query($sqlTraslados);
    while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
     echo '<tr  class="'.$this->cssEstadoPago($rs['confirmacion']).'">
            <td>'.$rs['fechaTraslado'].'</td>
            <td align="center"> '.$this->datosPuntoVenta($this->encrypt($rs['idOrigen'], publickey))['alias'].'</td>
            <td  align="center"> '.$this->datosPuntoVenta($this->encrypt($rs['idDestino'], publickey))['alias'].'</td>
            <td align="center">'.$rs['nombreProductosServicios'].'</td>
            <td align="center">'.$rs['codigo'].'</td>
            <td align="center">'.$rs['unidades'].'</td>
            <td align="center">'.$rs['token'].'</td>
            <td> 
              <a href="'.PATH.'/print/formatos/trasladoPuntoPunto.php?printData='.$rs['token'].'" target="_BLANK" >
                <i class="fa fa-arrow-circle-right"   id="goToQuery" title="Ver Todos Los Movimientos De Este Día"></i>
              </a>
            </td>
          </tr>';
    } 
  echo '      </tbody>
            </table>
            </div>';

}








public function checkNuevosTraslados(){
  echo date('Y-m-d H-m-s');
}





/*=====  End of LISTA DE TRASLADOS   ======*/





//Calculo el gran total del movimiento 
public function calculoValorGranTotal($parametro){
    $egresosGastos=$this->calculoValorEgresosGastos($parametro);
    $totalTransacciones=$this->calculoValorTransacciones($parametro); 
    $totalEfectivo=$this->calculoTotalEfectivo($parametro);
    return (($totalEfectivo-$egresosGastos)).' En Efectivo';

}


//Lista de los items de una factura
public function listaItemsFactura($idFactura){
  $conn=$this->conectar();
  $idFactura=$this->decrypt($idFactura, publickey);
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
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>';
    while ($rsItems=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...

       echo '<tr>
                  <td>'.$this->getDatosProductoServicio($rsItems['idProductoServicio'])['nombreProductosServicios'].'</td>
                  <td align="center"> '.$rsItems['unidades'].'</td>
                  <td  align="center">$ '.number_format($rsItems['valorNeto']).'</td>
                  <td align="center"> '.$rsItems['porcentajeImpuesto'].' %</td>
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
                  <td>'.$this->getDatosProductoServicio($rsImei['idProductoServicio'])['nombreProductosServicios'].'</td>                 
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
                  <th><div align="center">Productoss sin serial</div></th>
                  <th><div align="center">Cantidad</div></th>
                  <th><div align="center">Valor Neto</div></th>
                  <th align="center"><div align="center">Impuestos</div></th>
                  <th><div align="center">Total</div></th>
                </tr>
              </thead>
              <tbody>';
       while ($rsItems=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...

       echo '<tr>
                  <td>'.$this->getDatosProductoServicio($rsItems['idProductoServicio'])['nombreProductosServicios'].'</td>
                  <td align="center"> '.$rsItems['unidades'].'</td>
                  <td  align="center"> '.number_format($rsItems['valorNeto']).'</td>
                  <td align="center"> '.number_format($rsItems['porcentajeImpuesto']).'</td>
                  <td  align="center">$ '.number_format($rsItems['valorTotal']).' </td>
                 
                </tr>';
    }

          echo '</tbody>
          </table>
      </div>
    </div>';
  }

}






//LISTA DE LOS PRODUCTOS Y SERVICIOS ADQUIRIDOS PARA FACTURACION

public function listaBillRoll($idFactura){
    $conn=$this->conectar();
    $idFactura=$this->decrypt($idFactura, publickey);
   

   $sqlItems="SELECT * FROM itemsFactura WHERE idFactura=$idFactura ORDER BY(idProductoServicio) DESC";
   $sqlImeiSerial="SELECT idFacturaVenta, idProductoServicio, codigo FROM serialesImeis WHERE idFacturaVenta =$idFactura ";
    

    $queryImeiSerial=$conn->query($sqlImeiSerial);
    $queryItems=$conn->query($sqlItems);
    $n=0;
    $a=0;
    $costoServicio=0;
   while ($rsItems=mysqli_fetch_array($queryItems, MYSQL_ASSOC)) {
      # code...
      if ($rsItems['nombreProductosServicios']=='SERVITEC') {//NUMERO CORRESPONDE A EL COSTO DEL SERVICIO TECNICO
        # code...
        $costoServicio=$costoServicio+$rsItems['valorTotal'];
        $a=1;
      }else{
        $r[$n]= '<tr>
                  <td class="producto" width="40%">'.$this->getDatosProductoServicio($rsItems['idProductoServicio'])['nombreProductosServicios'].'</td>

                  <td class="producto" width="10%" align="center" > '.$rsItems['unidades'].'</td>

                  <td  class="producto" width="20%" align="center" > '.number_format(($rsItems['valorNeto'])).'</td>

                  
                  <td  class="producto" width="30%" align="center" >$ '.number_format(($rsItems['valorNeto']+$rsItems['impuesto'])*$rsItems['unidades']).' </td>
                 
                </tr>';
        $n++;
 
              }
       
    }
    return implode('',$r);
}





//Listado de los imeis relacionados en una factura 
public function listaImeisSerialesBillRoll($idFactura){
    $conn=$this->conectar();
    $idFactura=$this->decrypt($idFactura, publickey);
    $sqlImeiSerial="SELECT idFacturaVenta, idProductoServicio, codigo FROM serialesImeis WHERE idFacturaVenta =$idFactura ";
    $queryImeiSerial=$conn->query($sqlImeiSerial);
    $n=0;

    
      if (mysqli_num_rows($queryImeiSerial)>0) {
        # code...
        $r[$n]='<tr align="center">
                    <td class="titulos" colspan="5"><h3>Seriales e Imeis</h3></td>
                </tr>
              <tr align="center">
                    <td class="titulos" colspan="2"><h3>Codigo</h3></td>
                    <td class="titulos" colspan="3"><h3>Producto</h3></td>
                </tr>
                ';
          $n++;
            while ($rsImei=mysqli_fetch_array($queryImeiSerial, MYSQL_ASSOC)) {
              $r[$n]='<tr>
                        <td  colspan="2" class="producto">'.$rsImei['codigo'].'</td>
                        <td  colspan="3" class="producto">'.$this->getDatosProductoServicio($rsImei['idProductoServicio'])['nombreProductosServicios'].'</td>                 
                      </tr>';
              $n++;
          }
      }
      else{
         $r[$n];
      }

    return implode('', $r);

}



/*=====  End of LISTA DE FACTURAS  ======*/






/*========================================
=            BILLS AND PRINTS            =
========================================*/



/*===================================
=            PRINT BILLS            =
===================================*/



//Factura en roll
public function billRoll($printData){
  $conn=$this->conectar();


  $cabezote='
<style>
h1{
  line-height: 90%;
}
.footer{ font-size:10px; text-align:justify; width="20px"> }
.titulos{ font-style:bold;}
.producto{font-size:9px}
strong{font-size:11px}


</style>
<table class="tg" style="undefined;table-layout: fixed; width: 250px;" >
  <tr>
    <th class="tg-s6z2" colspan="4" align="center">
      <!-- LOGOS -->
    </th>
  </tr>
  <tr>
  <!--DATOS TRIBUTARIOS Y DE PUNTO DE VENTA -->
    <td class="tg-s6z2" colspan="4" align="center">

      <h1>'.$this->filtroStrings($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['nombrePunto'],1).'
      </h1>
    '.$this->filtroNombresRepresentantes($printData).'  

     <h4><div style="width:100%"> '.
        $this->filtroStrings($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['regimenTributario'],1).

        ' '.$this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['nitPunto'].'</div>
     '.$this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['direccionPunto']),2).' '.$this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['ciudadPunto']),2).' '.$this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['departamentoPunto']),2).'
    <div style="width:100%"> Teléfono: '.$this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['telefonoPunto']),2).' '.$this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->datosFactura($printData)['idPuntoVenta'], publickey))['email']),0).' </div>
    </h4>
    </td>
  </tr>
  <!-- FIN DE LOS DATOS TRIBUTARIOS Y DE PUNTO DE VENTA-->
  <tr>
    <td class="titulos" colspan="2"><strong>REMISI&Oacute;N DE VENTA NRO</strong></td>
    <td class="tg-0ord" colspan="2" align="right" class="producto">

    <h3>'.$this->datosFactura($printData)['prefijo'].''.$this->datosFactura($printData)['nroFactura'].'</h3></td>
  </tr>
   <tr>
    <td class="titulos" colspan="2"><strong>FECHA</strong></td>
    <td class="tg-0ord" colspan="2" align="right" class="producto">'.$this->datosFactura($printData)['fechaFactura'].'</td>
  </tr>

  <tr>
    <td class="titulos" colspan="2"><strong>VENDEDOR</strong></td>
    <td class="tg-0ord" colspan="3" align="right" class="producto">'.$this->filtroStrings($this->datosVendedor($this->datosFactura($printData)['codigoVendedor'])['nombre'], 1).'</td>
  </tr>



<!-- DATOS DE LOS CLIENTES -->
  <tr>
    <td class="titulos" ><strong>CLIENTE</strong></td>
    <td class="tg-0ord" colspan="4" align="right" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['nombreCliente'].'</td>
  </tr>

  <tr>
    <td class="titulos" colspan="2"><strong>IDENTIFICACIÓN</strong></td>
    <td class="tg-0ord" colspan="2" align="right" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['identificacionCliente'].'</td>
  </tr>

  <tr>
    <td class="titulos" colspan="2"><strong>DIRECCIÓN</strong></td>
  </tr>
  <tr>
    <td class="tg-0ord" colspan="4" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['direccionCliente'].' </td>
  </tr>


  <tr>
    <td class="titulos" colspan="2"><strong>CIUDAD</strong></td>
    <td class="tg-0ord" colspan="2" align="right" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['ciudadCliente'].' </td>
  </tr>
  
  <tr>
    <td class="titulos" colspan="2"><strong>TELÉFONO</strong></td>
    <td class="tg-0ord" colspan="2" align="right" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['telefonosCliente'].' </td>
  </tr>


  <tr>
    <td class="titulos" colspan="1"><strong>EMAIL</strong></td>
    <td class="tg-0ord" colspan="3" align="right" class="producto">'.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['emailCliente'].' </td>
  </tr>
<!-- FIN DATOS DE LOS CLIENTES-->
  <!--PRODUCTOS Y SERVICIOS ADQUIRIDOS-->
  <hr>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th align="center" width="40%"><strong>PRODUCTO</strong></th>
                  <th align="center" width="10%"><strong>#</strong></th>
                  <th align="center" width="20%"><strong>V/U</strong></th>
                  <th align="center"  width="30%"><strong>TOTAL</strong></th>
                </tr>
              </thead>
              <tbody>
              '.$this->listaBillRoll($printData).'

             
              </tbody>
            </table>
<!-- FIN DE LOS PRODUCTOS Y SERVICIOS ADQUIRIDOS-->
 </tr>

  '.$this->listaImeisSerialesBillRoll($printData).'
  
 <hr>
 '.$this->taxesBill($this->filtroStrings(($this->datosPuntoVenta($this->encrypt($this->decrypt($_SESSION['datos'],key), publickey))['regimenTributario']),2), $printData).'
  <div align="center">

    <h3 align="center">GRAN TOTAL</h3>
    <h1 style="font-size:23:59:590px">$ '.number_format($this->datosFactura($printData)['valorNetoFactura']).'</h1>
  
  '.$this->estadoFacturaImpresion($printData).'
   

  </div>
</table>
<hr>

<h2  style="border-top: dotten 1px grayspace; width:90%; text-align:center"> TERMINOS Y CONDICIONES </h2>
<table class="tg" style="undefined;table-layout: fixed; width: 100px">
<div class="footer">
  '.html_entity_decode($this->datosPuntoVenta($this->encrypt($this->decrypt($_SESSION['datos'],key), publickey))['terminosCondicionesFactura']).'
<p></p><p></p><p></p><p></p>
<h6 align="center">

Yo '.$this->datosCliente($this->encrypt($this->datosFactura($printData)['idCliente'], publickey))['nombreCliente'].' Acepto conforme el/los productos registrados en esta factura y declaro que los recibi sin ninguna alteración </h6>
</div>

</table>

  ';

  return $cabezote;
}




//CALCULO  VALORES FACTURA EPM

private function calculoValorEpm($idFactura, $parametro){
 $conn=$this->conectar();
 $idFactura=$this->decrypt($idFactura,publickey);
  $sqlEpm="SELECT * FROM facturaEpm WHERE idFactura=$idFactura";
  $queryEpm=$conn->query($sqlEpm);


  switch ($parametro) {
    case 'totalIva':
      # code...
    $totalIva=0;
       while ($rsFactura=mysqli_fetch_array($queryEpm, MYSQL_ASSOC)) {
        # code...
        $totalIva=$totalIva+$rsFactura['impuesto'];
      }

      return $totalIva;
      break;


    case 'valorTotal':
      # code...
    $valorTotal=0;
       while ($rsFactura=mysqli_fetch_array($queryEpm, MYSQL_ASSOC)) {
        # code...
        $valorTotal=$valorTotal+($rsFactura['valorUnidad']+$rsFactura['impuesto'])*$rsFactura['cantidades'];
      }

      return $valorTotal;
      break;
    
    default:
      # code...
      break;
  }
}




//ESTADO DE LA FACTURA
private function estadoFacturaImpresion($printData){

  $estado=$this->datosFactura($printData)['estadoFactura'];


  if ($estado=='pagada') {
    # code...
//     return '<div ><p>Realizaste el pago con '.$this->datosFactura($printData)['tipoPago'].'</p></div>';
    return 'FACTURA PAGADA';
  }else if($estado=='en credito'){

    $deuda=explode('.', $this->datosFactura($printData)['deudaFactura']);    
    return '<div ><p>
                  <div style="border:1px, solid, #f00; text-align:center">
                      ESTE RECIBO ESTA EN  CUENTA POR COBRAR Y DEBE
                      <div style="font-size:20px"> $ '.number_format($deuda[0]).'</div>
                  </div>
                </p>
          </div>';
  } else if ($estado=='anulada') {
    # code...
    return '<div>
                  <div style="border:1px, solid, #f00; text-align:center">
                      <h1>ESTA FACTURA ESTA ANULADA Y NO TIENE NINGUNA VALIDEZ</h1>
                  </div>
          </div>';
  }

}




//Perfilo los impuestos que tengo que mostrar deacuerdo al régimen del establecimiento
function taxesBill($tipoRegimen,$printData){

  switch ($tipoRegimen) {
    case 'Regimen Comun':
      # code...

      return ' <tr align="center">
                <td class="titulos" colspan="2" align="left"><strong>IVA</strong></td>
                <td class="tg-0ord" colspan="2" align="right"></td>
              </tr>

            <tr align="center">
                <td class="titulos" colspan="2" align="left"><strong>RETEFUENTE</strong></td>
                <td class="tg-0ord" colspan="2" align="right">0</td>
              </tr>
              ';
      break;
    
    default:

      return '';
      # code...
      break;
  }
}






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





public function filtroNombresRepresentantes($idPuntoVenta){

   $conn=$this->conectar();
    if (isset($idPuntoVenta)) {
       # code...
      $idPuntoVenta=$this->decrypt($idPuntoVenta, key);
     }else{
      $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
     }


  $idPuntoVenta=$this->encrypt($idPuntoVenta, publickey);
  $razonSocial=$this->datosPuntoVenta($idPuntoVenta)['razonSocial'];
  $nombrePunto=$this->datosPuntoVenta($idPuntoVenta)['nombrePunto'];
  $representanteLegal=$this->datosPuntoVenta($idPuntoVenta)['representanteLegal'];
  $regimenTributario=$this->datosPuntoVenta($idPuntoVenta)['regimenTributario'];


  if ($regimenTributario=='regimen simplificado') {
    # code...
    return '<h3>'.$representanteLegal.'</h3>';
  }else if($regimenTributario=='regimen comun'){
    if (strlen($razonSocial)==0) {
      # code...
      return '<h3>'.$representanteLegal.'</h3>';
    }
  }

}







//Imprimo los egresos que genere
public function tirillaAbonoFacturaCliente($printData){
  $conn=$this->conectar();
  $printData=$this->decrypt($printData, publickey);
  $parametros=explode('-', $printData);
  $token=$this->filtroNumerico($parametros[0]);
  $idFactura=$this->encrypt($this->filtroNumerico($parametros[1]), publickey);
  $sql="SELECT * FROM abonoFacturas WHERE tokenAbono=$token ";
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
    <h2 align="center">COMPROBANTE DE ABONO </h2>
    </td>
  </tr>
  <tr>
    <td class="tg-8m2u" colspan="2">PUNTO  DE VENTA</td>
    <td class="tg-quj4" colspan="2">'.$this->datosPuntoVenta($this->encrypt($this->datosFactura($idFactura)['idPuntoVenta'], publickey))['alias'].'</td>
  </tr>
  <tr>
    <td class="tg-8m2u" colspan="2">FECHA DE ABONO</td>
    <td class="tg-quj4" colspan="2">'.$rs['fechaAbono'].'</td>
  </tr>
  <tr>
    <td class="tg-p8bj" colspan="2">NRO FACTURA</td>
    <td class="tg-us36" colspan="2" align="right">'.$this->datosFactura($idFactura)['nroFactura'].'</td>
  </tr>
  <tr>
    <td class="tg-p8bj" colspan="2">CLIENTE</td>
    <td class="tg-us36" colspan="2" align="right">'.$this->datosCliente($this->encrypt($this->datosFactura($idFactura)['idCliente'], publickey))['nombreCliente'].'</td>
  </tr>
  <tr>
    <td class="tg-p8bj" colspan="1">VALOR ABONO</td>
    <td class="tg-dvpl" colspan="4" style="font-size:25px">$ '.number_format($rs['valorAbono']).'</td>
  </tr>

  <tr>
    <td class="tg-p8bj" colspan="2">MÉTODO DE PAGO</td>
    <td class="tg-us36" colspan="2" align="right">'.$rs['tipoPago'].'</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="4"><br><br><br><br><br>RECIBE____________________________</td>
  </tr>
</table>
<div align="center" style="font-size:8px">'.piePaginaFacturas.'</div>

  ';

  return $cabezote;
}

/*

public function comprobanteEgresoGasto($printData){
  return '<b>Comprobante De Egreso</b>';
}
*/


/*=====  End of BILLS AND PRINTS  ======*/




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
/*=====  End of TRALSADOS PUNTO A PUNTO  ======*/



private function serialesTraslados($query){
  $conn=$this->conectar();
  $a=0;
  while ($rsSeriales=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    # code...
      $sr[$a]='['.$rsSeriales['codigo'].'] | ';
      $a++;
  }
  return implode('', $sr); 
}




/*===================================================
=            LISTADO DE EGRESOS Y GASTOS            =
===================================================*/


public function listaEgresosIngresos($parametro){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  if (sizeof($parametro['fecha'])>0) {
    $fechas=explode('_', $this->decrypt($parametro['fecha'], publickey));
    $fecha1=$fechas[0];
    $fecha2=$fechas[1];

  }

  if (isset($fecha1, $fecha2)) {
     $sqlFecha="SELECT * FROM egresosGastos WHERE idPuntoVenta=$idPuntoVenta
                          AND fechaEgresoGasto BETWEEN '".$fecha1."' AND '".$fecha2."' ";
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
                    <a href="'.PATH.'print/formatos/formatoEgresos.php?printData='.$this->encrypt($rs['idegresosGasto'], publickey).'" target="_BLANK">
                     <i class="fa fa-arrow-circle-right"  value="'.$rs['nroRecibo'].'" id="deleteRow" title="Eliminar Gasto"></i>
                     </a>
                  </td>
                </tr>';
    }
                
  echo '      </tbody>
            </table>
            </div>';
  echo '<div class="pull-right m-t-30 text-right">
                        <p>Gastos y Egresos </p>
                        <hr>
                        <h3 class="text-danger"><b>Total :</b> '.number_format($this->calculoGastosEgresos($fecha1, $fecha2)).'</h3>
                      </div>';
}












//Calculo los gastos y egresos en un rango de tiempo 
public function calculoGastosEgresos($fecha1, $fecha2){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));

      if (isset($fecha1, $fecha2)) {
        $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                       idPuntoVenta=$idPuntoVenta
                                                      AND fechaEgresoGasto BETWEEN '".$fecha1."' AND '".$fecha2."' ";
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




/*=====  End of LISTADO DE EGRESOS Y GASTOS  ======*/




//LISTA DE LOS DOCUMENTOS RELACIONADOS CON EL PUNTO DE VENTA
public function listaDocumentosPuntoVenta(){
  $conn=$this->conectar();
  $idPunto=$this->decrypt($_SESSION['idPunto'], publickey);
  echo '<table class="table color-table primary-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Documento</th>
                                            <th>Fecha Subida</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
        ';
$sqlLista="SELECT idPuntoVenta, nombreDocumento, fechaUpload, nombreArchivo FROM  documentosPuntosVenta WHERE idPuntoVenta=$idPunto";
$query=$conn->query($sqlLista);
while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  # code...
  echo '<tr>
          <td>'.$rs['nombreDocumento'].'</td>
          <td>'.$rs['fechaUpload'].'</td>
          <td>
            <a href="'.PATH.'modulos/uploads/archivosPuntoVenta/'.$rs['nombreArchivo'].'" target="_BLANK">
              <button type="button" class="btn btn-info" > <i class="fa fa-search-plus"></i>Abreme Este Archivo</button>
            </a>
          </td>
      </tr>';
}
                                        
  echo '
         </tbody>
    </table>';
    $conn->close();
}



//LISTA DE LAS BODEGAS QUE EXISTEN
public function listadoBodegas(){
  $conn=$this->conectar();
  echo '<table class="table color-table primary-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre de la Bodega</th>
                                            <th>Tipo</th>
                                            <th>Pertenece</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
        ';
$sqlLista="SELECT * FROM  bodegas";
$query=$conn->query($sqlLista);
while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  # code...
  echo '<tr>
          <td>'.$rs['nombreBodega'].'</td>
          <td>'.$rs['tipo'].'</td>
   <td>
    ';
         $this->checkpuntosVentaBodegas($rs['matricula']);
  echo '</td> <td>
            <a href="'.PATH.'modulos/inventarios/bodegas/bodega.php?idBodega='.$this->encrypt($rs['tipo'], publickey).'" target="_BLANK">
              <button type="button" class="btn btn-info" > <i class="fa fa-search-plus"></i>Ver Más</button>
            </a>
          </td>
      </tr>';
}
                                        
  echo '
         </tbody>
    </table>';
    $conn->close();
}
//FIN DE LAS BODEGAS






/*=====================================================
=            DISTRIBUCIÓN DE LOS PRODUCTOS            =
=====================================================*/

public function distribucionProducto($idProducto){
  $conn=$this->conectar();


  $sqlTraslados='SELECT destinoId, SUM(cantidadExistenteTraslado) AS existencia FROM trasladosExistencia WHERE idProductoServicio = '.$idProducto.' GROUP BY destinoId
';


  $queryExistencia=$conn->query($sqlTraslados);

  while ($rs=mysqli_fetch_array($queryExistencia, MYSQLI_ASSOC)) {
    # code...
    if ($this->getCantidadExistenciasProductoEnPunto($idProducto,  $rs['destinoId'])>0) {
      # code...
    echo '<div class="col-md-6 white-box">
          <h4 align="center">'.$this->datosPuntoVenta($this->encrypt($rs['destinoId'], publickey))['alias'].'</h4>
          <h3 align="center">'.$this->getCantidadExistenciasProductoEnPunto($idProducto,  $rs['destinoId']).'</h3>
      ';
    $this->listaImieisEnPuntoSearch($rs['destinoId'], $idProducto);
     echo '</div>';
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






/*----------  FIN DE LAS LISTAS  ----------*/





/*=============================================
=            Section comment block            =
=============================================*/

private function checkpuntosVentaBodegas($puntos){
   $conn=$this->conectar();
   $puntosVenta=explode(",", $puntos);
   $t=sizeof($puntosVenta);
   if ($t>0) {
     for ($i=0; $i < $t ; $i++) { 
      # code...
      if (strlen($puntosVenta[$i])>0) {
        # code...
        echo "<li>".$this->datosPuntoVenta($this->encrypt($puntosVenta[$i],publickey))['nombrePunto']."</li> ";
      }
    }
   }
   
   $conn->close();
}




//Existencia de un producto en el punto de venta
public function  verificacionExistenciaEnPuntodeVenta($idProductoServicio){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    $idProductoServicio=$this->filtroNumerico($idProductoServicio);
    $sql="SELECT SUM(cantidadExistenteTraslado) AS existencia 
                                                      FROM  trasladosExistencia WHERE
                                                       destinoId=$idPuntoVenta
                                                       AND idProductoServicio= $idProductoServicio
                                                       AND cantidadExistenteTraslado >0 ";
 
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["existencia"];

}

//Obtengo la existencia global de un producto
public function getCantidadExistenteProducto($idProductoServicio){
    $conn=$this->conectar();
    $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
    $idProductoServicio=$this->filtroNumerico($this->decrypt($idProductoServicio, publickey));
    $sql="SELECT SUM(unidadesExistentes) AS existencia 
                                                      FROM INVENTARIOS WHERE
                                                       idProductoServicio=$idProductoServicio
                                                       AND unidadesExistentes >0 ";
 
  $resultado = mysqli_fetch_assoc($conn->query($sql));  
  return $resultado["existencia"];
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
private function getCantidadExistenciasProductoEnGlobal($idProducto){
    $conn=$this->conectar();
    $idProductoServicio=$this->filtroNumerico($idProducto);
    if ($this->getDatosProductoServicio($idProductoServicio)['serializacion']=='si') {
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


/*============================
=            MATH            =
============================*/

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




//COSTOS PONDERADOS
 public function calcularValorPonderado($idProducto)
{
  $conn=$this->conectar();
  $sqlInventario="SELECT idProductoServicio, unidadesExistentes, valorUnidad, unidadesCompradas 
              FROM  INVENTARIOS
                    WHERE idProductoServicio=$idProducto AND unidadesCompradas>0 LIMIT 0,100
  ";
  $queryInventario=$conn->query($sqlInventario);
  $row = array();
  $n=0;
  while ($rs=mysqli_fetch_array($queryInventario, MYSQLI_ASSOC)) {
    # code...
    $row[$n]=array('unidadesCompradas' =>$rs['unidadesCompradas'] , 'valorUnidad'=>$rs['valorUnidad'], 'valorTotal'=>($rs['valorUnidad']*$rs['unidadesCompradas']));
    $cantitadFinal=$cantitadFinal+$rs['unidadesCompradas'];
    $n++;
  }

  $t=sizeof($row);
  $vF=0;
  for ($i=0; $i < $t; $i++) { 
    # code...
    $valorFinal=$valorFinal+$row[$i]['valorTotal'];
    $unidadesCompradas=$unidadesCompradas+$row[$i]['unidadesCompradas']; 
  }

  return ($valorFinal/$unidadesCompradas);



  # code...
}


/*=====  End of MATH  ======*/





/*================================================
=            LISTAS DE PREINVENTARIOS            =
================================================*/


public function listadoPreinventario(){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $sql="SELECT * FROM  preInventario WHERE puntoVenta=$idPuntoVenta ORDER BY time desc";
  $query=$conn->query($sql);

  echo '<table id="tablaRelacionFacturas" class="table color-table primary-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>CANTIDAD</th>
                                    <th>CODIGO</th>
                                    <th>PRODUCTO</th>
                                    <th>CANT  REG</th>
                               </tr>
                            </thead>
    ';
 while ($rsFactura=mysqli_fetch_array($query, MYSQL_ASSOC)) {
  $idProducto=$this->encrypt($rsFactura['idProducto'], publickey);
    echo '<tr>
                  <td> <div id="'.$rsFactura['time'].'">'.$rsFactura['cantidades'].'</div></td>
                  <td>'.$this->getDatosProductoServicio($idProducto)['sku'].'</td>
                  <td>'.$this->getDatosProductoServicio($idProducto)['nombreProductosServicios'].'</td>
                  <td align="center">'.$this->getCantidadExistenciasProductoEnPunto($rsFactura['idProducto'], $idPuntoVenta).'</td>
              </tr>                 
                      ';
 }
 echo ' </tbody>';
 echo '</table>';

}



//Muestro los imeis o. seriales que registro en el punto fisico pero en el sistema aparece como si estuviera en otro punto
public function listadoImeisSerialesEnOtrosPuntos(){
  $conn=$this->conectar();
  $idPuntoVenta=$this->filtroNumerico($this->decrypt($_SESSION['datos'], key));
  $sql="SELECT idProductoServicio, codigo, ubicacion, estado, inventariado FROM  serialesImeis WHERE inventariado=$idPuntoVenta  ";
  $query=$conn->query($sql);
  
  echo '<table id="tablaRelacionFacturas" class="table color-table danger-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>PRODUCTO</th>
                               </tr>
                            </thead>
    ';
 while ($rs=mysqli_fetch_array($query, MYSQL_ASSOC)) {
  $idProducto=$this->encrypt($rs['idProductoServicio'], publickey);
        echo '<tr>
                  <td>'.$rs['codigo'].'</td>
                  <td>'.$this->getDatosProductoServicio($idProducto)['nombreProductosServicios'].'</td>
              </tr>                 
                      ';
 }
 echo ' </tbody>';
 echo '</table>';


}



/*=====  End of LISTAS DE PREINVENTARIOS  ======*/





/*=================================
=            PAGINADOR            =
=================================*/


//Paginador
public function paginate($reload, $page, $tpages, $adjacents, $funcion) {
  $prevlabel = "&lsaquo; Anterior";
  $nextlabel = "Siguiente &rsaquo;";
  $out = '<ul class="pagination pagination-large">';
  
  // previous label

  if($page==1) {
    $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
  } else if($page==2) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='".$funcion."(1)'>$prevlabel</a></span></li>";
  }else {
    $out.= "<li><span><a href='javascript:void(0);' onclick='".$funcion."(".($page-1).")'>$prevlabel</a></span></li>";

  }
  
  // first label
  if($page>($adjacents+1)) {
    $out.= "<li><a href='javascript:void(0);' onclick='".$funcion."(1)'>1</a></li>";
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
      $out.= "<li><a href='javascript:void(0);' onclick='".$funcion."(1)'>$i</a></li>";
    }else {
      $out.= "<li><a href='javascript:void(0);' onclick='".$funcion."(".$i.")'>$i</a></li>";
    }
  }

  // interval

  if($page<($tpages-$adjacents-1)) {
    $out.= "<li><a>...</a></li>";
  }

  // last

  if($page<($tpages-$adjacents)) {
    $out.= "<li><a href='javascript:void(0);' onclick='".$funcion."($tpages)'>$tpages</a></li>";
  }

  // next

  if($page<$tpages) {
    $out.= "<li><span><a href='javascript:void(0);' onclick='".$funcion."(".($page+1).")'>$nextlabel</a></span></li>";
  }else {
    $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
  }
  
  $out.= "</ul>";
  return $out;
}



/*=====  End of PAGINADOR  ======*/



/*======================================
=            SECCION DELETE            =
======================================*/

public function deleteRow($idPreventa){
  $conn=$this->conectar();
  $idPreventa=$this->filtroNumerico($idPreventa);

  $sqlPreventa="SELECT idPreventa, codigo FROM preVenta where  idPreventa=$idPreventa";
  $query=$conn->query($sqlPreventa);
  $rs=mysqli_fetch_array($query, MYSQL_ASSOC);
  if (strlen($rs['codigo'])>0) {
    # code...
    $sql="UPDATE serialesImeis SET inventariado = 0 WHERE codigo='".$rs['codigo']."'";
     $conn->query($sql);
  }
  $sql="DELETE FROM preVenta where  idPreventa=$idPreventa";
 $conn->query($sql);

}




//Elimino las lineas de los pre-traslados
public function deleteRowTraslado($idTraslado){
  $conn=$this->conectar();
  $idTraslado=$this->filtroNumerico($idTraslado);
  $sql="DELETE FROM trasladosMercancia where  idTraslado=$idTraslado";
  $conn->query($sql);
}

/*=====  End of SECCION DELETE  ======*/












/*=====================================
=            CSS Y ESTILOS            =
=====================================*/

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


  case 'no':
    # code...
    return 'text-danger'; 
    break;

  case 'si':
    # code...
    return 'text-success'; 
    break;
    
  default:
    # code...
    break;
}

}

/*=====  End of CSS Y ESTILOS  ======*/


}