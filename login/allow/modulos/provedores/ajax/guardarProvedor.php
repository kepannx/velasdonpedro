<?php
include('../../../data/libreria.lib/ajax/backend.ajax.php');
$ingresarP=new ingresosAjax();
$ingresarP->ingresarProvedor($_REQUEST);
?>