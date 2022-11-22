<?php 
require('../../data/libreria.lib/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();

//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['DATOS']));

/*breadcrumb */
$paginaActual=sincronizacion;
$breadcrumb = array(0 => sincronizacion, 1=> sincronizarCliente);


?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- CSS PLUGIN TABLAS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">


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
            <h2><i class="fa fa-refresh"></i> <?php echo sincronizarCliente; ?></h2>
        </div>
          <div class="col-md-6" align="right">

               <button class="btn btn-success waves-effect waves-light" id="downloadCliente" type="button"><span class="btn-label"><i class="fa fa-cloud-download"></i></span>Bajar Plantilla de Excel </button>
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



$cn = mysql_connect ("localhost","bWDigital","DYFUNszt4yX5frmS") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("billware_velas",$cn) or die ("ERROR AL CONECTAR A LA BD");

        // Llenamos el arreglo con los datos  del archivo xlsx
for ($i=2;$i<=3000;$i++){
  $_DATOS_EXCEL[$i]['sku'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['nombreProductoServicio'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['categoria'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['marca'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['subCategoria'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
 
}   
}
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD

foreach($_DATOS_EXCEL as $campo => $valor){
  if (isset($valor['sku'])) {
    # Saco Categorias...
    switch (trim($valor['categoria'])) {
      case 'CELULARES':
          $categoria=1;
        # code...
        break;

      case 'COMPUTADORES':
          $categoria=2;
        # code...
        break;


      case 'ACCESORIOS':
          $categoria=3;
        # code...
        break;

      case 'GADGETS':
          $categoria=6;
        # code...
        break;
      

      case 'SERVICIOS':
          $categoria=37;
        # code...
        break;


      case 'SONIDO':
          $categoria=38;
        # code...
        break;


      case 'TABLETS':
          $categoria=40;
        # code...
        break;


      case 'DRONES':
          $categoria=42;
        # code...
        break;


      case 'REPUESTOS':
              $categoria=228;
            # code...
            break;

      case 'MEMORIAS Y DISCOS DUROS':
              $categoria=216;
            # code...
            break;

      default:
        $categoria=0;
        break;

    };//Fin de las categorias

  //Saco SubCategorias
  switch ($valor['subCategoria']) {
      

      case 'RETOMA':
          $subCategoria=48;
        # code...
        break;

      case 'Genericos':
          $subCategoria=53;
        # code...
        break;


      case '7':
          $subCategoria=54;
        # code...
        break;

      case '8':
          $subCategoria=55;
        # code...
        break;


      case '105':
          $subCategoria=56;
        # code...
        break;


      case '9360':
          $subCategoria=57;
        # code...
        break;


      case '9360':
          $subCategoria=57;
        # code...
        break;


      case '9720':
          $subCategoria=58;
        # code...
        break;

    case 'A1':
          $subCategoria=59;
        # code...
        break;

    case 'AIR 2':
          $subCategoria=60;
        # code...
        break;

    case 'ASCEND':
          $subCategoria=61;
        # code...
        break;

    case 'CLIP +':
          $subCategoria=62;
        # code...
        break;

    case 'CLIP 2':
          $subCategoria=63;
        # code...
        break;

    case 'FLIP 2':
          $subCategoria=64;
        # code...
        break;

    case 'FLIP 3':
          $subCategoria=65;
        # code...
        break;

    case 'FLIP 4':
          $subCategoria=66;
        # code...
        break;

    case 'G4':
          $subCategoria=67;
        # code...
        break;

    case 'G4 PLUS':
          $subCategoria=68;
        # code...
        break;

    case 'G5':
          $subCategoria=69;
        # code...
        break;

    case 'G5 PLUS':
          $subCategoria=70;
        # code...
        break;

    case 'G5S':
          $subCategoria=71;
        # code...
        break;

    case 'G6':
          $subCategoria=73;
        # code...
        break;

    case 'G6 PLUS':
          $categoria=74;
        # code...
        break;

    case 'GALAXY A5':
          $subCategoria=75;
        # code...
        break;

    case 'GALAXY A7':
          $subCategoria=76;
        # code...
        break;

    case 'GALAXY A8':
          $subCategoria=77;
        # code...
        break;

    case 'GALAXY A8 PLUS':
          $subCategoria=78;
        # code...
        break;

    case 'GALAXY AGE 4 NEO':
          $subCategoria=79;
        # code...
        break;

    case 'GALAXY C5':
          $subCategoria=80;
        # code...
        break;

    case 'GALAXY C5 PRO':
          $subCategoria=81;
        # code...
        break;

    case 'GALAXY C7':
          $subCategoria=82;
        # code...
        break;

    case 'GALAXY J1 AGE':
          $subCategoria=83;
        # code...
        break;

    case 'GALAXY J1 MINI':
          $subCategoria=84;
        # code...
        break;

    case 'GALAXY J1 MINI PRIME':
          $subCategoria=85;
        # code...
        break;

    case 'GALAXY J2':
          $subCategoria=86;
        # code...
        break;


    case 'GALAXY J2 PRIME':
          $subCategoria=87;
        # code...
        break;

    case 'GALAXY J2 PRO':
          $subCategoria=88;
        # code...
        break;

    case 'GALAXY J4':
          $subCategoria=89;
        # code...
        break;

    case 'GALAXY J5':
          $subCategoria=90;
        # code...
        break;

    case 'GALAXY J5 PRIME':
          $subCategoria=91;
        # code...
        break;

    case 'GALAXY J5 PRO':
          $subCategoria=92;
        # code...
        break;

    case 'GALAXY J5-6':
          $subCategoria=93;
        # code...
        break;

    case 'GALAXY J6':
          $subCategoria=94;
        # code...
        break;

    case 'GALAXY J7':
          $subCategoria=95;
        # code...
        break;

    case 'GALAXY J7 PRIME':
          $subCategoria=96;
        # code...
        break;

    case 'GALAXY J7 PRO':
          $subCategoria=97;
        # code...
        break;

    case 'GALAXY NOTE 5':
          $subCategoria=98;
        # code...
        break;

    case 'GALAXY NOTE 8':
          $subCategoria=99;
        # code...
        break;

    case 'GALAXY NOTE 9':
          $subCategoria=100;
        # code...
        break;

    case 'GALAXY S6':
          $subCategoria=101;
        # code...
        break;

    case 'GALAXY S7':
          $subCategoria=102;
        # code...
        break;

    case 'GALAXY S8':
          $subCategoria=103;
        # code...
        break;


    case 'GALAXY S8 PLUS':
          $subCategoria=104;
        # code...
        break;

    case 'GALAXY S9':
          $subCategoria=105;
        # code...
        break;

    case 'GALAXY S9 PLUS':
          $subCategoria=106;
        # code...
        break;

    case 'GALAXY TAB 7':
          $subCategoria=107;
        # code...
        break;

    case 'GALAXY TAB A6':
          $subCategoria=108;
        # code...
        break;

    case 'TAB A-6':
          $subCategoria=108;
        # code...
        break;

    case 'GALAXY TAB E':
          $subCategoria=109;
        # code...
        break;

    case 'GEAR FIT2 PRO':
          $subCategoria=110;
        # code...
        break;

    case 'GO':
          $subCategoria=111;
        # code...
        break;

    case 'GO 2':
          $subCategoria=112;
        # code...
        break;

    case 'GR3':
          $subCategoria=113;
        # code...
        break;

    case 'GR5':
          $subCategoria=114;
        # code...
        break;

    case 'HEXAGONO X8':
          $subCategoria=115;
        # code...
        break;


    case 'IMAC':
          $subCategoria=116;
        # code...
        break;

    case 'INSPIRE 2':
          $subCategoria=117;
        # code...
        break;

    case 'INTUOS':
          $subCategoria=118;
        # code...
        break;

    case 'IPAD MINI':
          $subCategoria=119;
        # code...
        break;


    case 'IPAD MINI 1':
          $subCategoria=120;
        # code...
        break;

    case 'IPAD MINI 2':
          $subCategoria=121;
        # code...
        break;

    case 'IPAD NEW':
          $subCategoria=122;
        # code...
        break;

    case 'IPAD PRO':
          $subCategoria=123;
        # code...
        break;

    case 'IPAD SEXTA GENERACION':
          $subCategoria=124;
        # code...
        break;

    case 'IPHONE 5':
          $subCategoria=125;
        # code...
        break;

    case 'IPHONE 5S':
          $subCategoria=126;
        # code...
        break;

    case 'IPHONE 6':
          $subCategoria=127;
        # code...
        break;

    case 'IPHONE 6 PLUS':
          $subCategoria=128;
        # code...
        break;

    case 'IPHONE 6S':
          $subCategoria=129;
        # code...
        break;

    case 'IPHONE 6S PLUS':
          $subCategoria=130;
        # code...
        break;

    case 'IPHONE 7':
          $subCategoria=131;
        # code...
        break;

    case 'IPHONE 7 PLUS':
          $subCategoria=132;
        # code...
        break;

    case 'IPHONE 8':
          $subCategoria=133;
        # code...
        break;

    case 'H5SW-1':
          $subCategoria=134;
        # code...
        break;

    case 'IPHONE 8 PLUS':
          $subCategoria=135;
        # code...
        break;

    case 'IPHONE SE':
          $subCategoria=136;
        # code...
        break;

    case 'IPHONE X':
          $subCategoria=137;
        # code...
        break;

    case 'L32':
          $subCategoria=138;
        # code...
        break;

    case 'LEVEL BOX PRO':
          $subCategoria=139;
        # code...
        break;

    case 'M9':
          $subCategoria=140;
        # code...
        break;

    case 'MACBOOK':
          $subCategoria=141;
        # code...
        break;

    case 'MACBOOK AIR':
          $subCategoria=143;
        # code...
        break;

    case 'MACBOOK PRO':
          $subCategoria=144;
        # code...
        break;

    case 'MATE 10':
          $subCategoria=145;
        # code...
        break;

    case 'MATE 10 LITE':
          $subCategoria=146;
        # code...
        break;

    case 'MATE 10 PRO':
          $subCategoria=147;
        # code...
        break;

    case 'MATE 9 LITE':
          $subCategoria=148;
        # code...
        break;

    case 'MAVIC AIR':
          $subCategoria=149;
        # code...
        break;

    case 'MAVIC PRO':
          $subCategoria=150;
        # code...
        break;

    case 'MOTO C':
          $subCategoria=152;
        # code...
        break;
    

    case 'MOTO C PLUS':
              $subCategoria=153;
            # code...
            break;
    case 'MOTO E4 PLUS':
              $subCategoria=154;
            # code...
            break;
    case 'MOTO X PLAY':
              $subCategoria=155;
            # code...
            break;
    case 'MOTO Z':
              $subCategoria=156;
            # code...
            break;
    case 'MOTO Z PLAY':
              $subCategoria=157;
            # code...
            break;
    case 'NEW':
              $subCategoria=158;
            # code...
            break;
    case 'NR 1016':
              $subCategoria=159;
            # code...
            break;
    case 'NR1016':
              $subCategoria=160;
            # code...
            break;

    case 'NR 1016':
              $subCategoria=160;
            # code...
            break;


    case 'P SMART':
              $subCategoria=161;
            # code...
            break;
    case 'P10 PLUS':
              $subCategoria=162;
            # code...
            break;
    case 'P20':
              $subCategoria=163;
            # code...
            break;
    case 'P20 LITE':
              $subCategoria=164;
            # code...
            break;
    case 'P20 PRO':
              $subCategoria=165;
            # code...
            break;
    case 'P9 LITE':
              $subCategoria=166;
            # code...
            break;
    case 'PHANTOM  4 PRO':
              $subCategoria=167;
            # code...
            break;
    case 'PRO':
              $subCategoria=168;
            # code...
            break;
    case 'Q10':
              $subCategoria=169;
            # code...
            break;
    case 'REDMI 5 PLUS':
              $subCategoria=170;
            # code...
            break;
    case 'REDMI 5A':
              $subCategoria=171;
            # code...
            break;
    case 'REDMI NOTE 5':
              $subCategoria=172;
            # code...
            break;
    case 'REDMI NOTE 5 PLUS':
              $subCategoria=173;
            # code...
            break;
    case 'ROLLING SPIDER':
              $subCategoria=174;
            # code...
            break;
    case 'RTF MODE 2':
              $subCategoria=175;
            # code...
            break;
    case 'S205':
              $subCategoria=176;
            # code...
            break;

    case 'S30':
              $subCategoria=177;
            # code...
            break;

    case 'S60':
              $subCategoria=178;
            # code...
            break;

    case 'SEXTA GENERACION':
              $subCategoria=179;
            # code...
            break;

    case 'SPARK':
              $subCategoria=180;
            # code...
            break;


    case 'T-171':
              $subCategoria=182;
            # code...
            break;

    case 'T-175':
              $subCategoria=183;
            # code...
            break;

    case 'T660':
              $subCategoria=184;
            # code...
            break;

    case 'SOUNDLINK REVOLV':
              $subCategoria=185;
            # code...
            break;

    case 'TAB 7':
              $subCategoria=186;
            # code...
            break;

    case 'TELLO':
              $subCategoria=187;
            # code...
            break;

    case 'TG113':
              $subCategoria=188;
            # code...
            break;

    case 'TG117':
              $subCategoria=189;
            # code...
            break;

    case 'WATCH SERIES 2':
              $subCategoria=190;
            # code...
            break;

    case 'WATCH SERIES 3':
              $subCategoria=191;
            # code...
            break;

    case 'WX3F LTE':
              $subCategoria=192;
            # code...
            break;

    case 'XPERIA XA1':
              $subCategoria=193;
            # code...
            break;

    case 'XTREME':
              $subCategoria=194;
            # code...
            break;

    case 'XZ PREMIUM':
              $subCategoria=195;
            # code...
            break;

    case 'ZENFONE 3 MAX':
              $subCategoria=196;
            # code...
            break;

    case 'ZENFONE 4 MAX':
              $subCategoria=197;
            # code...
            break;


    case 'IPHONE XR':
              $subCategoria=198;
            # code...
            break;


    case 'APPLE WATCH S4':
              $subCategoria=199;
            # code...
            break;

    case 'APPLE WATCH S3':
              $subCategoria=200;
            # code...
            break;

    case 'RETOMA GADGETS':
              $subCategoria=201;
            # code...
            break;
    
    case 'OTROS RELOJES':
              $subCategoria=202;
            # code...
            break;
    

    case 'REDMI NOTE 6':
              $subCategoria=203;
            # code...
            break;
    

    case 'REDMI 6A':
              $subCategoria=204;
            # code...
            break;
    

    case 'RETOMA DRONES':
              $subCategoria=205;
            # code...
            break;
    

    case 'RETOMA TABLETS':
              $subCategoria=206;
            # code...
            break;
    


    case 'T205':
              $subCategoria=209;
            # code...
            break;
    

    case 'IPHONE XS':
              $subCategoria=210;
            # code...
            break;
    

    case 'IPHONE XS MAX':
              $subCategoria=211;
            # code...
            break;
    

    case 'MATE 20':
              $subCategoria=212;
            # code...
            break;
    

    case 'HOME POD':
              $subCategoria=213;
            # code...
            break;
    


    

    case 'T450':
              $subCategoria=215;
            # code...
            break;
    
    
    
    case 'MICRO SD':
              $subCategoria=217;
            # code...
            break;
    
    case 'USB':
              $subCategoria=218;
            # code...
            break;
    
    case 'RAM':
              $subCategoria=219;
            # code...
            break;
    
    case 'DISCO DURO':
              $subCategoria=220;
            # code...
            break;
    
    case 'REDMI 5':
              $subCategoria=221;
            # code...
            break;
    
    case 'T110':
              $subCategoria=222;
            # code...
            break;
    
    case 'ENDURANCE':
              $subCategoria=223;
            # code...
            break;
    
    case 'YOGA TAB 3':
              $subCategoria=224;
            # code...
            break;

    case 'TAB 3':
              $subCategoria=224;
            # code...
            break;
    
    case 'MI A2 LITE':
              $subCategoria=225;
            # code...
            break;
    
    case 'MI A2':
              $subCategoria=226;
            # code...
            break;
    
    case 'EARPODS':
              $subCategoria=227;
            # code...
            break;
    
    
    
   
    case 'Z5 REPUESTOS':
              $subCategoria=229;
            # code...
            break;
    
    case 'B25 RESPUESTOS':
              $subCategoria=230;
            # code...
            break;
    
    case 'S30 REPUESTOS':
              $subCategoria=231;
            # code...
            break;
    
    case 'XZ REPUESTOS':
              $subCategoria=232;
            # code...
            break;
    
    case 'P10 REPUESTOS':
              $subCategoria=233;
            # code...
            break;
    
    case 'REDMI S2':
              $subCategoria=234;
            # code...
            break;
    
    case 'POWER BANK':
              $subCategoria=235;
            # code...
            break;
    

    case 'APPLE WATCH':
              $subCategoria=236;
            # code...
            break;
    case 'ACCESORIOS APPLE':
              $subCategoria=237;
            # code...
            break;
    
    case 'REFLECT MINI':
              $subCategoria=238;
            # code...
            break;
    
    case 'CABINAS':
              $subCategoria=239;
            # code...
            break;
    
    case 'ADAPTADORES':
              $subCategoria=240;
            # code...
            break;
    
    case 'ACCESORIOS DRONES':
              $subCategoria=241;
            # code...
            break;
    
    case 'BATERIAS':
              $subCategoria=242;
            # code...
            break;
    
    case 'CABLES':
              $subCategoria=243;
            # code...
            break;
    

    case 'CARGADORES':
              $subCategoria=244;
            # code...
            break;
    

    case 'IPHONE 6S REPUESTOS':
              $subCategoria=245;
            # code...
            break;
    

    case 'ESTUCHES':
              $subCategoria=246;
            # code...
            break;
    

    case 'VIDRIOS':
              $subCategoria=247;
            # code...
            break;
    

    case 'CHROME CAST':
              $subCategoria=248;
            # code...
            break;
    
    case 'CONTROL DRONES':
              $subCategoria=249;
            # code...
            break;
    
    case 'AIRPODS':
              $subCategoria=250;
            # code...
            break;
    
    case 'BATERIA DRONES':
              $subCategoria=251;
            # code...
            break;
    
    case 'APPLE TV':
              $subCategoria=252;
            # code...
            break;
    
    case 'OSMO':
              $subCategoria=253;
            # code...
            break;
    
    case 'FLEX':
              $subCategoria=254;
            # code...
            break;
    
    case 'T210':
              $subCategoria=255;
            # code...
            break;
    
    case 'J6 PLUS':
              $subCategoria=256;
            # code...
            break;
    
    case 'AURICULARES':
              $subCategoria=257;
            # code...
            break;
    
    case 'T290':
              $subCategoria=258;
            # code...
            break;
    
    case 'DISPLAYS':
              $subCategoria=259;
            # code...
            break;
    
    case 'Z10':
              $subCategoria=260;
            # code...
            break;
    
    case 'ASCEND MATE 7':
              $subCategoria=261;
            # code...
            break;
    

    case 'PHANTOM 4 PRO':
              $subCategoria=262;
            # code...
            break;
    

    case 'PHANTOM 4':
              $subCategoria=263;
            # code...
            break;
    

    case 'Y360':
              $subCategoria=264;
            # code...
            break;
    


    case 'ASCEND Y330':
              $subCategoria=265;
            # code...
            break;
    

    case 'Y7 PRIME':
              $subCategoria=266;
            # code...
            break;
    
    case 'E5':
              $subCategoria=267;
            # code...
            break;
    
    
    case 'Z5 PREMIUM':
              $subCategoria=276;
            # code...
            break;
    
    case 'DTEK50':
              $subCategoria=277;
            # code...
            break;
    
    case 'Z2 PLAY':
              $subCategoria=278;
            # code...
            break;
    
    case 'Y9':
              $subCategoria=279;
            # code...
            break;
    
    case 'Y6':
              $subCategoria=280;
            # code...
            break;
    
    case 'Z':
              $subCategoria=281;
            # code...
            break;

    case 'E5 PLUS':
              $subCategoria=283;
            # code...
            break;
    
    
    case 'Y5 LITE 2018':
              $subCategoria=284;
            # code...
            break;

    case 'Y5 LITE':
              $subCategoria=284;
            # code...
            break;

    
    case 'Y6 2018':
              $subCategoria=285;
            # code...
            break;
    
    case 'Y5 2018':
              $subCategoria=286;
            # code...
            break;
    
    case 'Y7 2018':
              $subCategoria=287;
            # code...
            break;
    
    
    
    case 'DESIRE 626S':
              $subCategoria=289;
            # code...
            break;
    
    case 'XPERIA M5 DUAL':
              $subCategoria=290;
            # code...
            break;

    case 'GALAXY C9 PRO':
              $subCategoria=291;
            # code...
            break;

    case 'Y7':
              $subCategoria=292;
            # code...
            break;

    case 'MATE 9':
              $subCategoria=293;
            # code...
            break;

    case 'XA ULTRA':
              $subCategoria=294;
            # code...
            break;

    case 'G6 PLAY':
              $subCategoria=295;
            # code...
            break;

    case 'STEIN G181':
              $subCategoria=296;
            # code...
            break;

    case 'REDMI 6':
              $subCategoria=297;
            # code...
            break;

    case 'GALAXY J7 NEO':
              $subCategoria=298;
            # code...
            break;

    case 'GALAXY J4 PLUS':
              $subCategoria=299;
            # code...
            break;

    case 'S61':
              $subCategoria=300;
            # code...
            break;

    case 'MATE 20 LITE':
              $subCategoria=301;
            # code...
            break;

    case 'J8':
              $subCategoria=302;
            # code...
            break;

    case 'IPHONE 6 REPUESTOS':
              $subCategoria=303;
            # code...
            break;

    case 'Z10 REPUESTOS':
              $subCategoria=304;
            # code...
            break;

    case 'MI 8 LITE':
              $subCategoria=305;
            # code...
            break;

    case 'POCOPHONE':
              $subCategoria=306;
            # code...
            break;

    case 'HONOR 8X':
              $subCategoria=307;
            # code...
            break;



    case 'ONE':
              $subCategoria=308;
            # code...
            break;

    case 'PHANTOM 3':
              $subCategoria=309;
            # code...
            break;

    case 'MAC PRO':
              $subCategoria=144;
            # code...
            break;

    case 'WATCH SERIES 4':
              $subCategoria=311;
            # code...
            break;

    case 'CHARGE 3':
              $subCategoria=312;
            # code...
            break;

    case 'CHARGE 2':
              $subCategoria=313;
            # code...
            break;

    case 'PARLOUTDOOR':
              $subCategoria=314;
            # code...
            break;

    case 'BOOMBOTIX':
              $subCategoria=315;
            # code...
            break;

    case 'WJC':
              $subCategoria=316;
            # code...
            break;

    case 'ALTEC':
              $subCategoria=317;
            # code...
            break;

    case 'BOOMBOTREX':
              $subCategoria=318;
            # code...
            break;

    case 'TS360':
              $subCategoria=319;
            # code...
            break;

    case 'SPEAKER BT808E':
              $subCategoria=320;
            # code...
            break;



    case 'BOOMBOX':
              $subCategoria=321;
            # code...
            break;

    case 'XTREME 2':
              $subCategoria=322;
            # code...
            break;

    case 'KLIP XTREME':
              $subCategoria=323;
            # code...
            break;

    case 'ZPLAY':
              $subCategoria=324;
            # code...
            break;

    case 'TAB 10':
              $subCategoria=325;
            # code...
            break;

    case 'IPAD MINI 4':
              $subCategoria=328;
            # code...
            break;

    case 'GALAXY TAB A':
              $subCategoria=329;
            # code...
            break;

    case 'A2':
              $subCategoria=330;
            # code...
            break;

    case 'A3':
              $subCategoria=331;
            # code...
            break;

    case 'IPAD AIR':
              $subCategoria=332;
            # code...
            break;

    case 'ASCEND MATE 2':
      # code...
        $subCategoria=334;
      break;

    case 'G5S PLUS':
      # code...
        $subCategoria=335;
      break;


    case 'PHANTOM 4 PRO V2':
      $subCategoria=337;
      break;

    case 'MAVIC 2 PRO':
      $subCategoria=338;
      break;


    case 'MAVIC 2 ZOOM':
      $subCategoria=339;
      break;

    case 'RONIN':
      $subCategoria=340;
      # code...
      break;

    case 'CAMARAS':
      # code...
      $subCategoria=341;
      break;


    case 'S41':
      # code...
      $subCategoria=342;
      break;


    case 'CONSOLAS':
      # code...
      $subCategoria=343;
      break;

    case 'JUEGOS PLAY STATION':
      # code...
      $subCategoria=344;
      break;

    case 'CONSOLA PLAY STATION':
      # code...
      $subCategoria=345;
      break;

    
      default:
        $subCategoria=0;
        break;
    }


    if ($subCategoria==0) {
      # code...
        echo  $sql="UPDATE productosServicios SET categoria=".$categoria.", marca='".$valor['marca']."' WHERE sku ='".$valor['sku']."' ";

    }else{
        echo  $sql="UPDATE productosServicios SET categoria=".$categoria.", subCategoria='".$subCategoria."', marca='".$valor['marca']."' WHERE sku ='".$valor['sku']."' ";

    }

  echo '<br><br>';
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



        </div>
        <!-- FIN DROP FILE -->

        </div>
        
      </div>
    


      <!-- Fin del cuerpo-->






      
    </div>


    <script src="<?php echo PATH ?>js/acciones/sincronizacionClientes.js" type="text/javascript" charset="utf-8" async defer></script>
    <!-- /.container-fluid -->
  <script src="<?php echo PATH ?>js/custom.js" type="text/javascript" charset="utf-8" async defer></script>
    <!-- sweer alerts-->
  <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    


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
