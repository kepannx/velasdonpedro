<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$tablas=new queryAjax();
extract($_REQUEST);
$tablas->listaPreTraslado($tokenPrefactura);
?>