<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$ingreso=new guardarAjax();
$ingreso->comparacionInventarios($_REQUEST);

?>