<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$traslados=new queryAjax();
extract($_REQUEST);
$traslados=new queryAjax();
echo $traslados->loadSelectCategorias($tipo, $padre);

?>