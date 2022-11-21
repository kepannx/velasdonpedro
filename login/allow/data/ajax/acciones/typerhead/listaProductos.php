<?php
extract($_REQUEST);
require '../../../libreria.lib/libreria.clases.php';
require('../../../libreria.lib/inventarios/libreria.clases.php');

$validar=new validar();
$validar->validando();

$productosJson = new consultaInventarios();
$productosJson->listadoProductosServicios();
?>