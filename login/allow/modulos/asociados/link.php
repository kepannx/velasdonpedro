<?php
session_start();
if (!isset($_SESSION['datos'])){
	header('Location:../../logOut.php');
}else{
require '../../data/libreria.lib/libreria.clases.php';
$validar=new validar();
$validar->validando();
extract($_REQUEST);

if (!isset($idCliente)) {//FACTURA CLIENTE
		header('Location:../../logOut.php');
		}else{

			if (strlen(filter_var($validar->decrypt($idCliente, publickey), FILTER_SANITIZE_NUMBER_FLOAT))>0) {

				$_SESSION['IDCLIENTE']=$idCliente;
				header('Location:perfilCliente.php');
			}else{
				header('Location:../../logOut.php');
			}
		}
	}
?>