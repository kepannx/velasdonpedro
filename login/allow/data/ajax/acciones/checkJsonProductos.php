<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/inventarios/libreria.clases.php');
//Checkeo de existencia de datos
if (!isset($sku) || (strlen($sku)<=2)) {
	# revise si existe  con nombre de producto...
	if (!isset($nombreProductosServicios) || (strlen($nombreProductosServicios)<=2)) {
	# revise si existe  con nombre de producto...
		$validar->validador();
	}
}
$productosJson=new consultaInventarios();
$productosJson->jsonProductoServicio($sku, $nombreProductosServicios);
?>