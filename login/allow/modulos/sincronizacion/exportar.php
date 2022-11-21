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
        


<?php //$consultasAjax->listadoExistenciaProductosSinSerial();
      //$consultasAjax->listadoExistenciaProductosConSerial()
      //$consultasAjax->limpiezaProductosImei();
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
