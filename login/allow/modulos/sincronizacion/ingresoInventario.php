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



$cn = mysql_connect ("localhost","bWDigital","DYFUNszt4yX5frmS") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("billware_velas",$cn) or die ("ERROR AL CONECTAR A LA BD");


        // Llenamos el arreglo con los datos  del archivo xlsx
for ($i=2;$i<=2000;$i++){
 $_DATOS_EXCEL[$i]['sku'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['nombreProductosServicios'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['costoUnitario'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['cantidades'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();

  //$_DATOS_EXCEL[$i]['costoTotal'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['precioVenta'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['ventas_al_por_mayor'] = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();

}   
} 
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;


//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD

foreach($_DATOS_EXCEL as $campo => $valor){
  $sku=strtoupper(trim($valor['sku']));
  if (strlen($sku)>=1) {//si el sku esta repetido entonces sumele a 
    # code...
    $producto=$consultasAjax->getIdProductoServicio($sku);//Obtengo el IdProducto
    if ($producto>0) {
      $idProducto=$consultasAjax->getDatosProductoServicio($producto)['idproductosServicios'];

    }else{//si el sku no esta repetido entonces insertemelo

        $sql="INSERT INTO PRODUCTOSERVICIOS SET 
        sku='".$sku."', 
        nombreProductosServicios='".$consultaComun->filtroStrings($valor['nombreProductosServicios'],1)."', 
        tipoProductoServicio='producto',

        valorVentaUnidad='".$consultaComun->normalizacionDeCaracteres($consultaComun->filtroNumerico($valor['precioVenta']))."',

        valorVentaPorMayor='".$consultaComun->normalizacionDeCaracteres($consultaComun->filtroNumerico($valor['ventas_al_por_mayor']))."',

        impuesto=0,
        serializacion='no',
        serial='no',
        imei='no',
        cantidadMinimaPuntos=1,
        retiroTemporal='si'
        ";
        $query= mysql_query($sql);
        $idProducto=mysql_insert_id();

        echo '<br>hola <br>';

     }  //Fin ver si el producto existe


    //Ingresar al inventario
        $sql="INSERT INTO INVENTARIOS SET idProvedor=0, IdFacturaProvedor=0,
                        idProductoServicio='".$idProducto."',
                        fechaIngreso='".date('Y-m-d')."',
                        valorUnidad='".$valor['costoUnitario']."',
                        tipoNegocio='compra',
                        unidadesCompradas='".$valor['cantidades']."',
                        unidadesExistentes='".$valor['cantidades']."'";

    $query= mysql_query($sql);


    //Repartir al los puntos de venta 

      # code...
     $sqlRepartir="INSERT INTO trasladosExistencia SET idProductoServicio=$idProducto,
                                                      tipoTraslado='bodega-puntoVenta',
                                                      origenId=0,
                                                      destinoId=$destinoId,
                                                      fechaTraslado='".date('Y-m-d H:i:s')."',
                                                      estadoTraslado='Trasladado',
                                                      cantidadTrasladada='".$valor['cantidades']."',
                                                      cantidadExistenteTraslado='".$valor['cantidades']."'

        ";

      $query= mysql_query($sqlRepartir);

     


  }


  
}
  
  

/////////////////////////////////////////////////////////////////////////

echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
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
