<?php 
session_start();
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validador($_SESSION['datos']);

extract($_REQUEST);
if (isset($fecha)) {
	# code...
$fecha=$query->formatoFecha2($fecha);
}else{
		$fecha=date('Y-m-d');
}
echo number_format($query->calculoValorGranTotal($fecha));

?>