<?php 
session_start();
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validador($_SESSION['datos']);
extract($_REQUEST);
if (isset($fechaCuentasXcobrar)) {
	# code...
$fecha=$query->formatoFecha2($fechaCuentasXcobrar);
}else{
		$fecha=date('Y-m-d');
}
echo number_format($query->calculoValorCuentasPorCobrar($fecha));

?>