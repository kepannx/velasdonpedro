<?php
session_start();
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validador($_SESSION['datos']);
require('../../libreria.lib/70/libreria.class.php');
$edicionFacturas=new queryAjax();

echo number_format($edicionFacturas->disponibleEfectivoAllPuntos());
?>