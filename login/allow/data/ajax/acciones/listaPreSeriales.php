<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
$edicionFacturas=new queryAjax();
$edicionFacturas->listaPreSeriales($token, $sku);
?>