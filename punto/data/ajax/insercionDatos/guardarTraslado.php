<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$traslados=new guardarAjax();
extract($_REQUEST);
$traslados->guardarTraslado($idTraslado);
?>