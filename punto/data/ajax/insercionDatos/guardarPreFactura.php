<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
//Validación de tokensnicos
$guardar=new guardarAjax();
$guardar->guardarPreFactura($_REQUEST);
?>