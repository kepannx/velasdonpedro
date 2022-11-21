<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
if (!isset($_SESSION['idProductoServicio'])) {
	$validar->validador();
}
$datosFactura=new queryAjax();
echo $datosFactura->getCantidadExistenteProducto($_SESSION['idProductoServicio']);
?>