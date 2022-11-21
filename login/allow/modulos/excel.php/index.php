<?php
$filename='hola.xls';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
require '../../data/libreria.lib/70/libreria.class.php';
$query=new queryAjax();
$query->getFacturasRango();

?>