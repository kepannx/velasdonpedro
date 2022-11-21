<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$uploads=new ingresosAjax();
$uploads->uploadLogo($_REQUEST);



