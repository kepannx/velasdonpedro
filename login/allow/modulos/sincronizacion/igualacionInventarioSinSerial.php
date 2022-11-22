<?php 
require('../../data/libreria.lib/libreria.clases.php');
require '../../data/libreria.lib/70/libreria.class.php';

$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();
$consultasAjax = new queryAjax();
$guardarAjax=new guardarAjax();


//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=sincronizacion;
$breadcrumb = array(0 => sincronizacion, 1=> sincronizarProductos);


?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- CSS PLUGIN TABLAS-->
<link href="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH; ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">


<!-- FIN CSS PLUGIN TABLAS-->
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
            <h2><i class="fa fa-refresh"></i> <?php echo sincronizarProductos; ?></h2>
        </div>
          <div class="col-md-6" align="right">

               <button class="btn btn-success waves-effect waves-light" id="downloadProducoServicios" type="button"><span class="btn-label"><i class="fa fa-cloud-download"></i></span>Bajar Plantilla de Excel </button>
          </div>

          <div class="col-md-12 well">
            <i class="fa fa-info-circle"></i>
            <strong>¿Cómo sincronizo el inventario?</strong>
              <p>Baja el archivo de excel para productos y servicios, copia y pega todos tus productos o servicios en las columnas de el archivo de excel que bajaste, guardalo, antes de subirlo selecciona a cuál punto de venta quieres enviar ese inventario, sube el archivo de excel que guardaste y haz clic en "importar" </p>
          </div>


        

        <!-- DROP FILES -->
        <div class="col-sm-6 ol-md-12 col-xs-12">
         <form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" >
          <?php
            require '../../data/comunes/formularios/inventario/datosUploadMercanciaImei.php';

          ?>
          <input type="file" name="excel" />
          <input type='submit' name='enviar'  value="Importar"  />
          <input type="hidden" value="upload" name="action" />
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          </form>
          <?php 
extract($_POST);
if ($action == "upload"){


  echo "Destino: ".$destinoId."<br>";
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_ 
  $archivo = $_FILES['excel']['name'];
  $tipo = $_FILES['excel']['type'];
  $destino = "bak_".$archivo;
  if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Éxito<br><br>";
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



$cn = mysql_connect ("localhost","bWDigital","DYFUNszt4yX5frmS") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("billware_velas",$cn) or die ("ERROR AL CONECTAR A LA BD");


        // Llenamos el arreglo con los datos  del archivo xlsx
for ($i=2;$i<=2000;$i++){
 $_DATOS_EXCEL[$i]['sku'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['nombreProductosServicios'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['costoUnitario'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['cantidades'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['serializacion'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();

 
}   
}
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;


//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD

foreach($_DATOS_EXCEL as $campo => $valor){
  $sku=strtoupper($valor['sku']);
  if (strlen($sku)>=1) {//si el sku esta repetido entonces sumele a 
    # code...
    $producto=$consultasAjax->getIdProductoServicio($sku);//Obtengo el IdProducto
    if ($producto>0) {
      $idProducto=$consultasAjax->getDatosProductoServicio($producto)['idproductosServicios'];

    }else{//si el sku no esta repetido entonces insertemelo

      if (strlen($valor['serializacion']>2)) {
        # code...
        $serializacion='serializacion="si", serial="si",';
      }else{
          $serializacion=' ';
      }

      echo $sql="INSERT INTO productosServicios SET 
        sku='".$sku."', 
        nombreProductosServicios='".$consultaComun->filtroStrings($valor['nombreProductosServicios'],1)."', 
        tipoProductoServicio='producto',
        valorVentaUnidad='0',
        valorVentaPorMayor=0,
        impuesto=0,
        ".$serializacion."
        cantidadMinimaPuntos=1,
        retiroTemporal='si'";
        $query= mysql_query($sql);
        $idProducto=mysql_insert_id();
        $nuevo=1;

     }  //Fin ver si el producto existe

     //verifico Cantidades 

     $cantidadesExistentes = $consultasAjax->checkingexistenciaenorigenTemp($destinoId, ($consultasAjax->encrypt($idProducto, publickey)));

     if ($consultasAjax->getDatosProductoServicio($idProducto)['serializacion'] == 'no') {
       # code...
      if ($cantidadesExistentes < $valor['cantidades'] OR $cantidadesExistentes > $valor['cantidades']) {
          $actualizo='UPDATE trasladosExistencia SET cantidadExistenteTraslado=0 WHERE destinoId='.$destinoId.' and idProductoServicio= '.$idProducto.'';
          //$query= mysql_query($actualizo);

          $sqlRepartir="INSERT INTO trasladosExistencia SET idProductoServicio=$idProducto,
                                                      tipoTraslado='bodega-puntoVenta',
                                                      origenId=0,
                                                      destinoId=".$destinoId.",
                                                      fechaTraslado='".date('Y-m-d H:i:s')."',
                                                      estadoTraslado='Trasladado',
                                                      cantidadTrasladada='".$valor['cantidades']."',
                                                      cantidadExistenteTraslado='".$valor['cantidades']."'";
        //$query= mysql_query($sqlRepartir);
      }
     }else if($consultasAjax->getDatosProductoServicio($idProducto)['serializacion']) { //ES UN PRODUCTO SERIALIZADO
      $imei=explode(',', str_replace(".", "", $valor['serializacion']));
      $t=sizeof($imei);
      $n=0;
      $a=0;
      $imeiRepetido=array();
      $cantidades=$t;      
       while ($t >= $n) {
        //Verifico que el imei/serial Exista
       echo $sqlVerificacionImei="SELECT idSerialImei, codigo, idProductoServicio, ubicacion FROM serialesImeis where 
                                                        idProductoServicio=$idProducto AND 
                                                        codigo = '".trim($imei[$n])."'";
        $query=mysql_query($sqlVerificacionImei);

        if (mysql_num_rows($query)>0) {//EL  IMEI EXISTE
          # code...
          $rsImei=mysql_fetch_array($query);
          if ($rsImei['ubicacion']!=$destinoId) {
            # ACTUALIZO LA UBICACION DEL IMEI...
             $sqlActualizoUbicacion="UPDATE serialesImeis SET ubicacion=".$destinoId." WHERE  
                                                                    idProductoServicio=$idProducto AND 
                                                                    codigo = '".trim($imei[$n])."'";
            mysql_query($sqlActualizoUbicacion);

          }
        }//FIN DEL IMEI EXISTE
        else{//EL IMEI NO existe
             $sql="INSERT INTO serialesImeis SET tipo='serial', 
                        codigo='".trim($imei[$n])."',
                        idFacturaProvedor='0',
                        fechaRegistro='".date('Y-m-d')."',
                        idProductoServicio='".$idProducto."',
                        ubicacion=$destinoId,
                        estado='en almacen'
                         ";
            $query= mysql_query($sql);
             $sqlTraslado="INSERT INTO trasladosExistencia SET idProductoServicio='".$idProducto."',
                                                            tipoTraslado='bodega-puntoVenta',
                                                            origenId=0,
                                                            destinoId=".$destinoId.",
                                                            fechaTraslado='".date('Y-m-d H:i:s')."',
                                                            estadoTraslado='Trasladado',
                                                            cantidadTrasladada=1,
                                                            cantidadExistenteTraslado=1
            ";
            $query= mysql_query($sqlTraslado);


            echo '<br><br>';
        }//FIN DEL IMEI INEXISTENTE




        $n++;
       }



       $actualizo='UPDATE trasladosExistencia SET cantidadExistenteTraslado=0 WHERE destinoId='.$destinoId.' and idProductoServicio= '.$idProducto.'';
          $query= mysql_query($actualizo);
          $sqlRepartir="INSERT INTO trasladosExistencia SET idProductoServicio=$idProducto,
                                                      tipoTraslado='bodega-puntoVenta',
                                                      origenId=0,
                                                      destinoId=".$destinoId.",
                                                      fechaTraslado='".date('Y-m-d H:i:s')."',
                                                      estadoTraslado='Trasladado',
                                                      cantidadTrasladada='".$cantidades."',
                                                      cantidadExistenteTraslado='".$cantidades."'";
        $query= mysql_query($sqlRepartir);

     }//FIN DE LA SERIALIZACION 

     echo 'ID PRODUCTO: '.$idProducto.'<br><br>';

  }


  
}
  
  

/////////////////////////////////////////////////////////////////////////

//echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
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


    <!-- /.container-fluid -->
  <script src="<?php echo BASEPATH; ?>js/custom.js" type="text/javascript" charset="utf-8" async defer></script>
    <!-- sweer alerts-->
    


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
