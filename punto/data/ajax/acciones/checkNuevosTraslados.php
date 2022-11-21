<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$consultas=new queryAjax();
extract($_REQUEST);
$consultas->checkNuevosTraslados();
?>