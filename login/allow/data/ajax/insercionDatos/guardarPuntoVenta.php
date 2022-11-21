<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validador($id);
require('../../libreria.lib/70/libreria.class.php');
$edicionFacturas=new guardarAjax();
$edicionFacturas->guardarPuntoVenta($_REQUEST);
?>