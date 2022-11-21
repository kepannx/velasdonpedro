<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$edicionFacturas=new ingresosAjax();
$edicionFacturas->ingresoAbonoGlobales($_REQUEST);
?>