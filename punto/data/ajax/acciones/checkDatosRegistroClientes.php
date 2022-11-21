<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validador($id);
require('../../libreria.lib/70/libreria.class.php');
$comparacion=new queryAjax();
$comparacion->loadDatosClientesExitentes($identificacionCliente);
?>