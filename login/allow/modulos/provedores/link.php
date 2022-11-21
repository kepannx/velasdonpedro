<?php
session_start();
if (!isset($_SESSION['datos'])){
	header('Location:../../logOut.php');
}else{
require '../../data/libreria.lib/libreria.clases.php';
$validar=new validar();
$validar->validando();
extract($_REQUEST);
if (!isset($data)) {
	# code...
		if (!isset($idprovedor)) {
		# code...
		header('Location:../../logOut.php');
		
		}else{
			if (strlen(filter_var($validar->decrypt($idprovedor, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['IDPROVEDOR']=$idprovedor;
				header('Location:perfilProvedor.php');
			}else{
				header('Location:../../logOut.php');
			}
		}
	}else{
		if ($data=='historico'){//Envio a la lista de las facturas que se le ha comprado a un provedor
			# code...
			//echo filter_var($validar->decrypt($idFactura, publickey), FILTER_SANITIZE_NUMBER_FLOAT);
			if (strlen(filter_var($validar->decrypt($idFactura, key), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['IDFACTURAPROVEDOR']=$idFactura;
				header('Location:perfilFacturaProvedor.php');
			}else{
				header('Location:../../logOut.php');
			}
		}else if($data=='garantias'){
			//Envio a garantias
		}
	}
}

?>