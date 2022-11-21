<?php
require('../../data/libreria.lib/libreria.clases.php');
$consulta= new consultasAjax();

if (isset($_GET['idCliente'])) {
	# code...
	$consulta->loadDatosCliente($_GET['idCliente']);

}
?>