<?php
require_once '../../libreria.lib/libreria.class.php';
session_start();
$validar=new validar();
if (!isset($_SESSION['idPunto'])) {
	$validar->logOut();
}
$edicionFacturas=new editarAjax();
$edicionFacturas->editarDatosTributariosPunto($_REQUEST);
?>