<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class queryComun  extends conect {

	/* datos Administrador */
  public function datosUsuario($id)
  {
    $conn=$this->conectar();
    $id=$this->filtroNumerico($this->decrypt($id, key));
    $sql = "SELECT * FROM  puntosVenta  where idPunto='".intval($id)."'";
    return mysqli_fetch_array($conn->query($sql), MYSQL_ASSOC);
    
  
  }



//SELECCIONO TODOS LOS CIUDADES
public function selectCiudades($parametro){
    $conn=$this->conectar();
    $sql="SELECT idCiudad, nombre FROM ciudades ";
    $query=$conn->query($sql);
    if ($parametro==null) {
      # code...
      $parametro= ciudadDefecto;
    }
    echo '<option value="">Selecciona Ciudad</option>';
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




public function selectAdministradorPunto($parametro){
    $conn=$this->conectar();
    $sql="SELECT idusuario, nombre, tipoUsuario, identificacion, activada FROM usuarios  WHERE tipoUsuario!='vendedor' AND activada = 'si' ";
    $query=$conn->query($sql);
    echo '<option value="">Selecciona un Usuario</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$rs['idusuario'].'" '.$this->selected($parametro, $rs['idusuario']).'> '.$rs['nombre'].' | '.$rs['identificacion'].'  </option>';
    }
    $conn->close();
}



public function loadSelectPuntosVentas($parametro){
 $conn=$this->conectar();
 $parametro=$this->filtroNumerico($parametro);
    $sql="SELECT idPunto, nombrePunto, alias FROM puntosVenta WHERE idPunto != 0 AND idPunto != '$parametro'";
  $query=$conn->query($sql);
   while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        echo ' <option value="'.$rs['idPunto'].'" '.$this->selected($parametro, $rs['idPunto']).' >'.$rs['nombrePunto'].' | '.$rs['alias'].'</option>';
          } 
  // $conn->close(); 
}



/*===========================
=            POS            =
===========================*/

//SELECCIONO TODOS LOS VENDEDORES
public function selectVendedores($parametro){
    $conn=$this->conectar();
    $idPunto=$this->decrypt($_SESSION['datos'], key);

    $sql="SELECT * FROM usuarios WHERE puntoAsignado=$idPunto";
    $query=$conn->query($sql);
    echo '<option value="">Selecciona Quien Lo Vendió</option>';
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$this->encrypt($rs['codigo'], publickey).'" '.$this->selected($parametro, utf8_encode($rs['codigo'])).' > '.utf8_encode($rs['nombre']).' </option>';
    }
    $conn->close();
}

/*=====  End of POS  ======*/



//SELECT TODO LO DE PUNTOS DE VENTA
public function selectPunto($parametro){
    $conn=$this->conectar();
    $sql="SELECT idPunto, nombrePunto, nitPunto FROM puntosVenta  WHERE  activada = 'si' ";
    $query=$conn->query($sql);
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$rs['idPunto'].'" '.$this->selected($parametro, $rs['idPunto']).'> '.$rs['nombrePunto'].' | '.$rs['nitPunto'].'  </option>';
    }
    $conn->close();
}








//Grupo de Bodegas y Puntos de Venta
public function optionGroupBodegasPuntosVenta(){
  $conn=$this->conectar();
  $sqlBodegas="SELECT idBodega, nombreBodega FROM bodegas";
  $sqlPuntosVenta="SELECT idPunto, nombrePunto, nitPunto FROM puntosVenta  WHERE  activada = 'si' ";
  $queryBodegas=$conn->query($sqlBodegas);
  $queryPuntosVenta=$conn->query($sqlPuntosVenta);

    //Grupo Bodegas
    echo '<optgroup label="Bodegas">';
    while ($rsBodegas=mysqli_fetch_array($queryBodegas, MYSQLI_ASSOC)) {
        echo '<option value="'.$this->encrypt("bodega|".$rsBodegas['idBodega']." ", publickey).'">'.$rsBodegas['nombreBodega'].'</option>';
    }
    echo '</optgroup>';


    //Grupo Puntos de Venta
    echo '<optgroup label="Puntos de Venta">';
    while ($rsPuntosVenta=mysqli_fetch_array($queryPuntosVenta, MYSQLI_ASSOC)) {
        echo '<option value="'.$this->encrypt("puntoVenta|".$rsPuntosVenta['idPunto']." ", publickey).'">'.$rsPuntosVenta['nombrePunto'].'</option>';
    }
    echo '</optgroup>';
  $conn->close();
}



//SELECT TODO LO DE PUNTOS DE VENTA
public function selectCategorias($parametro){
    $conn=$this->conectar();
    $sql="SELECT idCategoria, tipo, nombreCategoria FROM categorias  WHERE  tipo = 'categoria' ";
    $query=$conn->query($sql);
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      # code...
      echo '<option value="'.$this->encrypt($rs['idCategoria'], publickey).'" '.$this->selected($parametro, $this->encrypt($rs['idCategoria'], publickey)).'> '.$rs['nombreCategoria'].'  </option>';
    }
    $conn->close();
}



//Lista de los 
public function selectProductosServiciosCruzados($parametro){

  $conn=$this->conectar();
  $sql="SELECT idproductosServicios, nombreProductosServicios FROM PRODUCTOSERVICIOS  WHERE  retiroTemporal = 'no' ";
    $query=$conn->query($sql);
    while ($rs=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $selected=$this->idProductoCruzado($parametro, $rs['idproductosServicios']);
      echo '<option value="'.$this->encrypt($rs['idproductosServicios'], publickey).'" '.$selected.' >'.$rs['nombreProductosServicios'].'</option>';
    }

}

//Pongo select a las option value que un producto cruzado tenga
private function idProductoCruzado($parametro, $comparar){
  $parametros=explode('|', $parametro);
  $valores=array();
  for ($i=0; $i < sizeof($parametros) ; $i++) { 
    $valores[$i]=$parametros[$i];
  }
  if (in_array($comparar, $valores)) {
    return 'selected';
  }

}










/*=====  End of PRINT BILLS  ======*/







}