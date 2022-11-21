<?php 
require('../../data/libreria.lib/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();

//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=sincronizacion;
$breadcrumb = array(0 => sincronizacion, 1=> sincronizarProveedores);


?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

</head>



<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require("../../data/comunes/headerMenu.php");
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require("../../data/comunes/menuLateral.php");
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
         require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->



      <div class="row white-box">
        <div class="col-md-12  col-sm-12 col-xs-12 ">
        <div class="col-md-6">
            <h2><i class="fa fa-refresh"></i> <?php echo sincronizarProveedores; ?></h2>
        </div>
          <div class="col-md-6" align="right">

               <button class="btn btn-success waves-effect waves-light" id="downloadProvedores" type="button"><span class="btn-label"><i class="fa fa-cloud-download"></i></span>Bajar Plantilla de Excel </button>
          </div>

          <div class="col-md-12 well">
            <i class="fa fa-info-circle"></i>
            <strong>¿Cómo sincronizo?</strong>
              <p>Baja el archivo de excel para clientes, copia y pega todos tus clientes en las columnas de el archivo de excel que bajaste, guardalo y luego subelo aqui, yo haré el resto </p>
          </div>
        

        <!-- DROP FILES -->
        <div class="col-sm-6 ol-md-12 col-xs-12">
         <form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" >
          <input type="file" name="excel" />
          <input type='submit' name='enviar'  value="Importar"  />
          <input type="hidden" value="upload" name="action" />
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          </form>
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
require_once('../../data/Classes/PHPExcel.php');
require_once('../../data/Classes/PHPExcel/Reader/Excel2007.php');

// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_".$archivo);
$objFecha = new PHPExcel_Shared_Date();       

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);


$cn = mysql_connect ("localhost","bwDrmovil","U3h6vRHA8jy7pQ7D") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("billware_drMovil",$cn) or die ("ERROR AL CONECTAR A LA BD");

        // Llenamos el arreglo con los datos  del archivo xlsx
for ($i=2;$i<=300;$i++){
  $_DATOS_EXCEL[$i]['nombreProvedor'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['ideProvedor'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['direccionProvedor'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['ciudadProvedor'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['emailProvedor'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['telefonoProvedor'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['contactoProvedor'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();

}   
}
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD

foreach($_DATOS_EXCEL as $campo => $valor){

  if (strlen($valor['nombreProvedor'])>2) {
    # code...

    $sql="INSERT INTO provedores SET nombreProvedor='".$valor['nombreProvedor']."', ideProvedor='".$valor['ideProvedor']."', direccionProvedor='".$valor['direccionProvedor']."', ciudadProvedor='".$valor['ciudadProvedor']."', emailProvedor='".$valor['emailProvedor']."', telefonoProvedor='".$valor['telefonoProvedor']."', contactoProvedor='".$valor['contactoProvedor']."' ";

      mysql_query($sql);
      $cont++;
  }


  
}
  

/////////////////////////////////////////////////////////////////////////

echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $cont REGISTROS Y $errores ERRORES</center></strong>";
//una vez terminado el proceso borramos el 
//archivo que esta en el servidor el bak_
unlink($destino);
}

?>



        </div>
        <!-- FIN DROP FILE -->

        </div>
        
      </div>
    
      <!-- Fin del cuerpo-->

      
    </div>

    <script src="<?php echo PATH ?>js/custom.js" type="text/javascript" charset="utf-8" async defer></script>

    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
    ?>

  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->

<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>


  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>
