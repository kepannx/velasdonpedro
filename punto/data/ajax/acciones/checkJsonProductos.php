<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
//Checkeo de existencia de datos
if (!isset($sku) || (strlen($sku)<=2)) {
	$validar->logOut();
}
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();

$productosJson->jsonProductoServicio($sku);
?>