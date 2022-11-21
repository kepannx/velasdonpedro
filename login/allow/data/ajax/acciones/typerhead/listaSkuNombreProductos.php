<?php
extract($_REQUEST);
session_start();
require '../../../libreria.lib/libreria.clases.php';
require('../../../libreria.lib/inventarios/libreria.clases.php');
require_once '../../../libreria.lib/70/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$productosJson=new queryAjax();
$productosJson->listadoJsonNombreProductos();
?>

