<?php
require_once '../../libreria.lib/libreria.class.php';
extract($_REQUEST);
$validar=new validar();
if (!isset($nombreProductosServicios) AND !isset($sku) AND !isset($_SESSION['idProductoServicio'])) {
	$validar->logOut($_SESSION['datos']);
}
$validar->validador($_SESSION['datos']);
$edicion=new editarAjax();
$edicion->editarServicioProducto($_REQUEST);
?>