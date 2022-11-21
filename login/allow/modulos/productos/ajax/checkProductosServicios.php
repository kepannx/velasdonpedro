<?php
require('../../../data/libreria.lib/libreria.clases.php');
$ajax=new consultasAjax();
extract($_REQUEST);
$ajax->checkProductosServicios($productoServicio, NULL);
?>