<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validador($id);
require('../../libreria.lib/70/libreria.class.php');
$guardarFacturas=new guardarAjax();
$guardarFacturas->guardarFacturas($_REQUEST);
?>