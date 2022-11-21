<?php
session_start();
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validando();
extract($_REQUEST);
if (isset($fechaTraslado)) {
	# code...
	$data=explode('-', trim($fechaTraslado));
	$fecha1=$query->formatoFecha2(trim($data[0]));
	$fecha2=$query->formatoFecha2(trim($data[1]));

}else{
	echo date('d/m/Y',strtotime('+30 days',strtotime(str_replace('/', '-', '05/06/2016')))) . PHP_EOL;
}
$query->getListaTrasladosPunto($fecha1, $fecha2);
?>