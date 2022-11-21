<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
if (!isset($sku) || (strlen($sku)<=2)) {
	$validar->validador();
}
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();
$productosJson->checkProductoServicioReperido($sku);
?>