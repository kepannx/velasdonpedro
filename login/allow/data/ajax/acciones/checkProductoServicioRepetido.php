<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/inventarios/libreria.clases.php');

$validar=new validar();
if (!isset($sku) || (strlen($sku)<=2)) {
	$validar->validador();
}
$validar->validador($id);
$productosJson=new consultaInventarios();
$productosJson->checkProductoServicioReperido($sku, $idOrigen);
?>