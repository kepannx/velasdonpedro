<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
extract($_REQUEST);
$validar->validando();
$listas=new guardarAjax();
$listas->ingresoAbonoFactura($_REQUEST);
?>