<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$calculoValores=new queryAjax();
$calculoValores->calculoGastosEgresos();
?>