<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$listaItems=new queryAjax();
$listaItems->listaProductosServicios($_REQUEST);
?>