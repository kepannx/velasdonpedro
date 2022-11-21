<?php
require_once '../../libreria.lib/libreria.class.php';
extract($_REQUEST);
$validar=new validar();
if (!isset($nombreProductosServicios) AND !isset($sku)) {
	$validar->logOut($_SESSION['datos']);
}
$validar->validador($_SESSION['datos']);
$guardar=new guardarAjax();
$guardar->guardarServicioProducto($_REQUEST);
?>