<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
$validar=new validar();
$validar->validando();
require('../../libreria.lib/70/libreria.class.php');
$datosProvedores=new queryAjax();
$idFacturaProvedor=$validar->decrypt($_SESSION['IDFACTURAPROVEDOR'], key);
echo $datosProvedores->jsonDatosFacturaProvedor($idFacturaProvedor);
?>