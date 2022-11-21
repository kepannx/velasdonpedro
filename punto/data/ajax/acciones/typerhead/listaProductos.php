<?php
extract($_REQUEST);
require_once '../../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();
$productosJson->listadoProductosServicios();
?>