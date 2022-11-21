<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$tablas=new queryAjax();
$tablas->listaComprasProducto();
?>