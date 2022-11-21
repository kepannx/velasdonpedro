<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$tablas=new queryAjax();
extract($_REQUEST);
$tablas->listadoImeisSerialesEnOtrosPuntos($_REQUEST);
?>