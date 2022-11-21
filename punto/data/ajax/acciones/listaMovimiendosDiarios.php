<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$tablas=new queryAjax();
extract($_REQUEST);

if ((strlen($fecha1)>0) &&  (strlen($fecha2)>0)) {
	# code..
  $fechas = array('fecha' => $validar->formatoFecha2($fecha1)."_".$validar->formatoFecha2($fecha2));
}else{
	 $time= strtotime(date('m/d/Y')); $fecha2= date("m/d/Y", strtotime("-1 month", $time));
	$fechas = array('fecha' => $validar->formatoFecha2($fecha2)."_".$validar->formatoFecha2($fecha1));
}


$tablas->listaMovimiendosDiarios($fechas);

?>