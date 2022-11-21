<?php
require_once 'data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultasAjax=new queryComun();
$objHtm=new objetosHtml();
$datoUsuario=$consultasAjax->datosUsuario($_SESSION['datos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("data/comunes/headercode.php");
?>
<!-- LIBRERÍAS DE POS -->
<link href="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
<!-- FIN LIBRERIAS POS -->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require("data/comunes/headerMenu.php");
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require("data/comunes/menuLateral.php");
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
         require("data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

        <!--Inicio del cuerpo  -->
        <div class="row"></div>
        <!-- Widgets--> 
      <div class="row white-box">
      <!-- Indicador Ventas del Día -->
        <div class="col-md-12">

          <div class="col-md-12" id="foraneo"></div>
         <?php
          require '../login/allow/data/comunes/formularios/ventas/datosBasicoClienteFacturaSimplificada.php';
          require '../login/allow/data/comunes/formularios/ventas/datosMetodoPago.php';
          require '../login/allow/data/comunes/formularios/ventas/posVenta20.php';
          
         ?>
          <input type="hidden" id="idCliente" value="">

            
        </div>
      <!-- Fin Indicador Ventas del Día -->

      </div>


      <!-- Fin de Widgets-->





    <!--Lista Ventas Del Dia-->
      <div class="row">
        <div class="col-md-12  col-sm-12 col-xs-12">
        </div>
        
      </div>
    <!-- Fin Lista Ventas Del Dia-->


      <!-- Fin del cuerpo-->
    </div>
    <?php       
        require("data/comunes/footer.php");
        require "../login/allow/data/comunes/modal/confirmaciones/confirmacionFacturaVenta.html";
    ?>
    <!-- /.container-fluid -->
    
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->


      <?php 
      //Links de librerias js 
      require("data/comunes/js.php");
      ?>

<!-- JS PLUGINGS-->
      <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

      <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
      <script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>


      <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
      <script src="<?php echo BASEPATH ?>login/allow/js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>
  
      <script src="<?php echo PATH ?>js/acciones/customFacturasPuntoVenta.js"></script>
      <script src="<?php echo PATH ?>js/acciones/confirmacionFacturaVenta.js" type="text/javascript" charset="utf-8" async defer></script>
      <script src="<?php echo PATH ?>js/guardar/guardarFacturacion.js"></script>
<!-- FIN PLUGIN JS-->
     





</body>
</html>