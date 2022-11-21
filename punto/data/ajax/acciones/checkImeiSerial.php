<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
if (!isset($imeiSerial) || (strlen($imeiSerial)<=2)) {
	$validar->validador();
}
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();
$productosJson->checkImeiSerial($imeiSerial);
?>
