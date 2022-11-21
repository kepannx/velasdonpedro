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
		if (!isset($idUsuario)) {
		# code...
		header('Location:../../logOut.php');
		
		}else{
			if (strlen(filter_var($validar->decrypt($idUsuario, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {
				$_SESSION['IDEMPLEADO']=$idUsuario;
				header('Location:perfilUsuario.php');
			}else{
				header('Location:../../logOut.php');
			}
		}
	
	}else{header('Location:../../logOut.php');}
}

?>