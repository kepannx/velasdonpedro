<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/inventarios/libreria.clases.php');
//Checkeo de existencia de datos
$validar=new validar();
if (!isset($identificacionCliente)) {
	# revise si existe  con nombre de producto...
	$validar->validador();
}
$validar->validador($id);
$productosJson=new consultaInventarios();
$productosJson->jsonClientes($identificacionCliente);
?>