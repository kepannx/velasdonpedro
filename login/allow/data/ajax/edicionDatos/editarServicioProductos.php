<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
if (!isset($nombreProductosServicios) AND !isset($sku) AND !isset($_SESSION['idProductoServicio'])) {
	$validar->validador(NULL);
}

$edicion=new editarAjax();
$edicion->editarServicioProducto($_REQUEST);
?>