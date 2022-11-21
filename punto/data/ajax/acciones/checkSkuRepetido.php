<?php
extract($_REQUEST);
session_start();
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
if (!isset($sku) || (strlen($sku)<=2)) {
	$validar->validador();
}
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();
$productosJson->checkSkuRepetido($sku);
?>