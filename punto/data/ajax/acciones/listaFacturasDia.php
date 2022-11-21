<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$tablas=new queryAjax();
extract($_REQUEST);
if (sizeof($fecha)>0) {
    $fechas = array('fecha' => $fecha);

}else{
		$fechas = array('fecha' => $validar->encrypt(date('Y-m-d 00:00:00').'_'.date('Y-m-d 23:59:59'),publickey));
}

$tablas->listaFacturasRango($fechas);
?>
