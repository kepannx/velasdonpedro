<?php
session_start();
if (!isset($_SESSION['datos'])){
	header('Location:../../logOut.php');
}else{
require '../../data/libreria.lib/libreria.clases.php';
$validar=new validar();
$validar->validando();
extract($_REQUEST);
if (!isset($idFactura)) {//FACTURA CLIENTE
		# code...
		header('Location:../../logOut.php');
		
		}else{
			if (strlen(filter_var($validar->decrypt($idFactura, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['ideFactura']=$idFactura;
				header('Location:facturaCliente.php');
			}else{
				header('Location:../../logOut.php');
			}
		}
	}

?>