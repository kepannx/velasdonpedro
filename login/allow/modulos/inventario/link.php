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
		if (!isset($idProductoServicio)) {
		# code...
		header('Location:../../logOut.php');
		
		}else{
			if (strlen(filter_var($validar->decrypt($idProductoServicio, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['idProductoServicio']=$idProductoServicio;
				header('Location:../productos/detalleProducto.php');
			}else{
				header('Location:../../logOut.php');
			}
		}
	
	}else{header('Location:../../logOut.php');}
}

?>