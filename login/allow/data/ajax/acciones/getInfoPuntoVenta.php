<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$validar->validando();
extract($_REQUEST);
$datosCliente=new queryAjax();
echo $datosCliente->jsonDatosPuntoVenta($validar->encrypt($idPuntoVenta, publickey));
?>