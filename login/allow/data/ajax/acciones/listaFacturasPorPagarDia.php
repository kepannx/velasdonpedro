<?php
session_start();
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
$listaFacturas=new queryAjax();
$listaFacturas->listaFacturasPorPagarDia()
?>