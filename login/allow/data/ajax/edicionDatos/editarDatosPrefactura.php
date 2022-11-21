<?php
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
$edicion=new editarAjax();
$edicion->editarItemsFactura($_REQUEST);
?>