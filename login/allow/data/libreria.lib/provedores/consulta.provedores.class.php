<?php
class consultaProvedores extends conectar {



/***************consultas de productos */
public function consultaDatosProvedor($parametro, $vector)
{
  $idProvedor=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM provedores WHERE idprovedor='".$idProvedor."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'nombreProvedor':
      # NOMBRE DEL PROVEDOR...
      return $rs["nombreProvedor"];
      break;


    case 'ideProvedor':
      # NIT O IDENTIFICACIÓN TRIBUTARIA...
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

    case 'contactoProvedor':
      # code...
      return $rs["contactoProvedor"];
      break;

    default:
      # code...
      return "No hay datos :(";
      break;
  }

}







//Listo todos los convenios que tengo  registrados
public  function listaProvedores()
{
	//conectar::conexiones();

	$sql="SELECT idprovedor, nombreProvedor, telefonoProvedor FROM provedores";
	$query=mysql_query($sql);
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
       while ($rs=mysql_fetch_array($query)) {
       	# code...
          echo '<tr>
                  <td>'.$rs["nombreProvedor"].'</td>
                  <td>'.$rs["telefonoProvedor"].'</td>
                  
                  <td>
                  	<a href="'.$this->datospagina(5).'modulos/provedores/perfilProvedor.php?id='.$_GET['id'].'&idprovedor='.$this->encrypt($rs["idprovedor"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>
               ';
               }

   	 echo '  </tbody>
            </table>';
	//conectar::desconectar();

}



//Listo todos los convenios que tengo  registrados
public  function listaComprasAProvedor($idProvedor)
{

  $idProvedor=$this->filtroNumerico($idProvedor);
  $sql="SELECT * FROM facturasProvedores WHERE idProvedor=$idProvedor";
  $query=mysql_query($sql);
  echo '<table id="tablaRelacionFacturas" class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha Compra</th>
                  <th>Nro Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        # code...
          echo '<tr>
                  <td>'.$rs["fechaFacturaProvedor"].'</td>
                  <td>'.$rs["nroFacturaProvedor"].'</td>
                  <td>$ '.number_format($rs["valorFacturaProvedor"]).'</td>
                  <td>'.$this->estadoFactura($rs["estadoFactura"]).'</td>
                  
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/contabilidad/facturaProvedor.php?id='.$_GET['id'].'&idFactura='.$this->encrypt($rs["idfacturaProvedor"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>
               ';
               }

     echo '  </tbody>
            </table>';
  //conectar::desconectar();

}








//Muestro en visual en que estado esta cada factur
private function estadoFactura($vector){

  if ($vector=='cancelado') {
    # code...
    return '<span class="label-rouded label-success"  style="color:#fff;">Cancelado</span>';
  }
  elseif ($vector=='credito') {
    # code...
    return '<span class="label-rouded label-danger"  style="color:#fff;">Crédito</span>';
  }
  elseif ($vector=='consignacion') {
    # code...
    return '<span class="label-rouded label-warning" style="color:#fff;">Consignación</span>';
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