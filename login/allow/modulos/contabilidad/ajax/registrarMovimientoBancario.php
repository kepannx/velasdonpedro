<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$movimientosBancarios=new ingresosAjax();
$movimientosBancarios->registrarMovimientoBancario($_REQUEST);
?>