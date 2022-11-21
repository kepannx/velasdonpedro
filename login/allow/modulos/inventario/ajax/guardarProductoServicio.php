<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$ingresarP=new ingresosAjax();
$ingresarP->ingresarProductoServicio($_REQUEST);
?>