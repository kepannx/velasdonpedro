<?php
extract($_REQUEST);
require('../../libreria.lib/70/libreria.class.php');
require('../../libreria.lib/libreria.clases.php');

$validar=new validar();
if (!isset($imeiSerial) || (strlen($imeiSerial)<=2)) {
	$validar->validador();
}
$productosJson=new queryAjax();
$productosJson->checkImeiSerial($imeiSerial, $idOrigen);
?>