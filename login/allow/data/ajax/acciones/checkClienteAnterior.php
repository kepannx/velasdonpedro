<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/inventarios/libreria.clases.php');

$validar=new validar();
if (!isset($identificacionCliente) || (strlen($identificacionCliente)<=2)) {
	$validar->validador();
}
$validar->validador($id);
$productosJson=new consultaInventarios();
$productosJson->checkCliente($identificacionCliente);
?>