<?php
require('../../../../data/libreria.lib/libreria.clases.php');
$cComun=new consultasComunes();
$cComun->listaFacturasBusqueda($_REQUEST);
?>