<?php
session_start();
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validando();
extract($_REQUEST);
$query->getProductosPuntoVenta();
?>