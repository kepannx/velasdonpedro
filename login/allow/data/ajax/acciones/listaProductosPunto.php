<?php
session_start();
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
$listaEnPunto=new queryAjax();
$listaEnPunto->listaProductosPunto();
?>