<?php 
class consultasAjax extends conectar {

//


//CARGO LOS DATOS DEL CLIENTE  EN LOS CAMPOS DEL FORMULARIO SOLO PASANDO EL PAAMETRO DE LA IDENTIFICACIÓN
	public function loadDatosCliente($parametro) {
		conectar::conexiones();
		$parametro=explode("|", $parametro);
		if(isset($parametro))
			{  
				$sql="select * from clientes where nombreCliente='".$parametro[0]."'";
			    $res = mysql_query($sql) or die(mysql_error());
			  	if($inf = mysql_fetch_array($res)){
			    echo "formObj.identificacionCliente.value = '".$this->normalizacionDeCaracteres($inf["identificacionCliente"])."';\n";   
			    echo "formObj.direccionCliente.value = '".$inf["direccionCliente"]."';\n";
			    echo "formObj.telefonosCliente.value = '".$inf["telefonosCliente"]."';\n";
			    echo "formObj.emailCliente.value = '".$inf["emailCliente"]."';\n";
			    echo "formObj.ciudadCliente.value = '".$inf["ciudadCliente"]."';\n";
			    echo "formObj.nuevoCliente.value = '".$inf["idcliente"]."';\n";
			  }
			  else{
			    echo "formObj.identificacionCliente.value = '';\n";  
			    echo "formObj.direccionCliente.value = '';\n"; 
			    echo "formObj.telefonosCliente.value = '';\n";
			    echo "formObj.emailCliente.value = '';\n"; 
			    echo "formObj.ciudadCliente.value = '';\n";    
			    echo "formObj.nuevoCliente.value = '0';\n";

			  }

			}
		conectar::desconectar();
	}







//Checkeo si un producto o servicio esta repetido

public function checkProductosServicios($parametro, $ignorar)
{
conectar::conexiones();
sleep(1);

if($parametro)
{
	$query = "SELECT nombreProductosServicios, tipoProductoServicio from PRODUCTOSERVICIOS where nombreProductosServicios = '".$parametro."'";
	$results = mysql_query( $query) or die('ok');
	
	if(mysql_num_rows(@$results) > 0) // not available
	{	
		$rs=mysql_fetch_array($results);
		echo '<div class="alert alert-danger danger" align="center"> <i class="fa fa-warning"></i> Existe un '.$rs["tipoProductoServicio"].' con este nombre</div>';
	}
	}
}


//json productos

public  function ajaxProductosJson($parametros)
{
	conectar::conexiones();
	extract($parametros);
	if ($type == 'productos') {
	$result = mysql_query("SELECT  clienteNombreCompleto  FROM cliente WHERE  clienteNombreCompleto LIKE '%".strtoupper($nombresApellidos)."%' LIMIT 0,10");
	$data   = array();
	while ($row = mysql_fetch_array($result)) {
		array_push($data, $row['clienteNombreCompleto']);
	}
	echo json_encode($data);
}
	conectar::desconectar();
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


}
?>