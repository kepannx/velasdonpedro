<?php
extract($_REQUEST);
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$validar->validando();
$datosProvedores=new queryAjax();
echo $datosProvedores->jsonDatosProvedor($_SESSION['IDPROVEDOR']);
?>