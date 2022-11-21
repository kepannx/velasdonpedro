<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$ajaxBancos=new ingresosAjax();
$ajaxBancos->ingresoAbonoFacturaProvedor($_REQUEST);
?>