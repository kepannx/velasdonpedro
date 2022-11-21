<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$ajaxBancos=new edicionAjax();
$ajaxBancos->editarBanco($_REQUEST);
?>