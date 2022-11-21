<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$comparacion=new queryAjax();
$comparacion->selectSubCategorias($categoria);
?>