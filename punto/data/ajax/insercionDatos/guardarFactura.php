<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
//Validación de tokensnicos
$guardar=new guardarAjax();
$guardar->guardarFacturas($_REQUEST);
?>