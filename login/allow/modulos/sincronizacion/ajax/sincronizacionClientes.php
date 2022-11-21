<?php

extract($_POST);
if ($action == "upload"){
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_ 
	$archivo = $_FILES['excel']['name'];
	$tipo = $_FILES['excel']['type'];
	$destino = "bak_".$archivo;
	if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Éxito";
	else echo "Error Al Cargar el Archivo";
////////////////////////////////////////////////////////
if (file_exists ("bak_".$archivo)){ 
/** Clases necesarias */
require('../../../data/Classes/PHPExcel.php');
require('../../../data/Classes/PHPExcel/Reader/Excel2007.php');

// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_".$archivo);
$objFecha = new PHPExcel_Shared_Date();       

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);


$cn = mysql_connect ("localhost","billWare","KB2LAwrFN3269wHF") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("billWare",$cn) or die ("ERROR AL CONECTAR A LA BD");


        // Llenamos el arreglo con los datos  del archivo xlsx
for ($i=2;$i<=200;$i++){
	$_DATOS_EXCEL[$i]['nombreCliente'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
	$_DATOS_EXCEL[$i]['identificacionCliente'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$_DATOS_EXCEL[$i]['direccionCliente'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	$_DATOS_EXCEL[$i]['telefonosCliente'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	$_DATOS_EXCEL[$i]['emailCliente'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	$_DATOS_EXCEL[$i]['ciudadCliente'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();

}		
}
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD

foreach($_DATOS_EXCEL as $campo => $valor){

	if (isset($valor['nombreCliente'])) {
		# code...

		$sql="INSERT INTO clientes SET nombreCliente='".$valor['nombreCliente']."', identificacionCliente='".$valor['identificacionCliente']."', direccionCliente='".$valor['direccionCliente']."', telefonosCliente='".$valor['telefonosCliente']."', emailCliente='".$valor['emailCliente']."', ciudadCliente='".$valor['ciudadCliente']."' ";

			mysql_query($sql);
	}


	
}
	

/////////////////////////////////////////////////////////////////////////

echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
//una vez terminado el proceso borramos el 
//archivo que esta en el servidor el bak_
unlink($destino);
}
?>