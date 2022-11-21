<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
//Validación de tokensnicos
$guardar=new guardarAjax();
$guardar->guardarPreTraslado($_REQUEST);
?>