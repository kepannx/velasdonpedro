<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$datosFactura=new queryAjax();
$datosFactura->distribucionProducto($idProducto);
?>
