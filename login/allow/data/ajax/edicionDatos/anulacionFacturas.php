<?php
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
if (!isset($_SESSION['ideFactura'])) {
	header('../../../logOut.php');
}
$edicion=new editarAjax();
extract($_REQUEST);
$edicion->anulacionFactura($justificarAnulacion);
?>