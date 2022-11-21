<?php
extract($_REQUEST);
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$datosFactura=new queryAjax();
$datosFactura->checkMetodosPagoFactura($idFactura);
?>