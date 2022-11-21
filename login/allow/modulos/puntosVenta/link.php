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
		if (!isset($idPunto)) {
		# code...
		header('Location:../../logOut.php');
		}else{
			if (strlen(filter_var($validar->decrypt($idPunto, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['idPV']=$idPunto;
				header('Location:perfilPuntoVenta.php');
			}else if(strlen(filter_var($validar->decrypt($idFactura, publickey), FILTER_SANITIZE_NUMBER_FLOAT))){//Para enviar a factura
				header('Location:../contabilidad/facturaCliente.php');
			}
			else{
				header('Location:../../logOut.php');//No cumple 
			}
		}
	}else{header('Location:../../logOut.php');}
}

?>