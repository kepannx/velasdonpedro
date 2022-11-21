<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require('../../data/libreria.lib/inventarios/libreria.clases.php');
require '../../data/libreria.lib/70/libreria.class.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();

$consultasAjax = new queryAjax();
///selectVendedores
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
//Los fetch para las consultas
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=ventas;
$breadcrumb = array(0 => ventas, 1=> postVentas);
?>
<!DOCTYPE html>

<style type="text/css">
  
</style>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

  <!-- CSS PLUGIN switchery -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />



<!-- FIN CSS PLUGIN switchery -->
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
      <div class="row bg-title" id="noPrint">
        <?php 
         require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->
    
      <div class="row white-box">
         <div class="col-md-12  col-sm-12 col-xs-12">

            <?php
              require '../../data/comunes/formularios/ventas/datosBasicoClienteFacturaSimplificada.php';
              require '../../data/comunes/formularios/ventas/datosMetodoPago.php';
              require '../../data/comunes/formularios/ventas/posVenta.php';
            ?>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
            <input type="hidden" id="idCliente" value="">
        </div>
      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      //
      require "../../data/comunes/modal/confirmaciones/confirmacionFacturaVenta.html";

      //require "../../data/comunes/modal/bodegasInventario/serialsImeis.html";
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



<!-- JS PLUGINGS-->
 <!-- Invoice-->
  <script src="../../scripts/ui/jquery-ui.min.js"></script>


  <!--fin invoice -->

  <!-- swich

  -->
  <!-- Fin Swich-->
   <!-- TYPEHEAD-->
      <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

      <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

      <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
      <script src="<?php echo PATH ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>
      <script src="<?php echo PATH ?>js/custom.js"></script>
  
      <script src="<?php echo PATH ?>js/acciones/customFacturasPuntoVenta.js"></script>
      <script src="<?php echo PATH ?>js/acciones/confirmacionFacturaVenta.js" type="text/javascript" charset="utf-8" async defer></script>
      <script src="<?php echo PATH ?>js/guardar/guardarFacturacion.js"></script>
      

      <!--
     
  <!-FIN TYPEHEAD-->

<!-- FIN PLUGIN JS-->


</body>
</html>
