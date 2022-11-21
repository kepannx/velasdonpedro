<?php 
session_start();
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$query=new queryAjax();
$validar->validando();
extract($_REQUEST);
if (isset($fechaTransacciones)) {
	# code...
$fecha=$query->formatoFecha2($fechaTransacciones);
}else{
		$fecha=date('Y-m-d');
}
echo number_format($query->listaMovimientosTransacciones($fecha));

?>