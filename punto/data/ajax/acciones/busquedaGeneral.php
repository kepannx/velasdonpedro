<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$search=new queryAjax();
extract($_REQUEST);
$search->busquedaGeneral($_REQUEST);

?>