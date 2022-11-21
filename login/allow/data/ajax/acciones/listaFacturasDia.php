<?php
session_start();
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validando();
extract($_REQUEST);
if (isset($fecha)) {
$fecha=$query->formatoFecha2($fecha);
}else{
		$fecha=date('Y-m-d');
}
$query->listaFacturasRango($fecha)

?>