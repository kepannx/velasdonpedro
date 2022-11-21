<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/inventarios/libreria.clases.php');
//Checkeo de existencia de datos
$validar=new validar();
if (!isset($nombreProductosServicios) || (strlen($nombreProductosServicios)<=2)) {
	$validar->validador();
}
$validar->validador($id);
$productosJson=new consultaInventarios();
$productosJson->checkProductosServicios($nombreProductosServicios);
?>