<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$edicionFacturas=new guardarAjax();
$edicionFacturas->guardarBodegas($_REQUEST);
?>