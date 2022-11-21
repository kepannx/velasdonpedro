<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$edicionFacturas=new edicionAjax();
$edicionFacturas->anulacionFacturas($_REQUEST);
?>