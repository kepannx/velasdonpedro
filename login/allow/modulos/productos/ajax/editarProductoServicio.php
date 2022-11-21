<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$edicionFacturas=new edicionAjax();
$edicionFacturas->editarProductosServicios($_REQUEST);
?>