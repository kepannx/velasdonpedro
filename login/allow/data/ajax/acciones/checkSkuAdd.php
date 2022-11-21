<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
if (!isset($sku) || (strlen($sku)<=2)) {
	$validar->validando();
} 
$validar->validando();
$productosJson=new queryAjax();
$productosJson->checkSkuAdd($_REQUEST);
?>