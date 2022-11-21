<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$saveTemp = new saveForms();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";

?>
<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>
<link href="<?php echo BASEPATH ?>plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"  ></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require "../../data/comunes/headerMenu.php";
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require "../../data/comunes/menuLateral.php";
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
         require "../../data/comunes/breadcrumb.php";
        ?>
      </div>

      <!-- Fin breadcrumb -->
      
      <!-- BODY -->
      <div class="row white-box">
        
       <div class="col-md-12  col-sm-12 col-xs-12">
          <h2>Trasladar Productos</h2>
              <?php
                require '../../data/comunes/formularios/inventario/datosTrasladosMercancia.php';
                require '../../../login/allow/data/comunes/formularios/inventario/trasladoMercancia.php';
              ?>
              <p align="center"> <i class="fa fa-warning"></i>
              <strong class="text text-danger"> LOS PRODUCTOS TRASLADADOS TIENEN QUE SER CONFIRMADOS POR EL PUNTO DE DESTINO ANTES DE 6 HORAS! DE LO CONTRARIO VOLVERÁN A TU INVENTARIO</strong>
              </p>
      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<!-- JS PLUGINGS-->
<script src="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
<script src="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo PATH; ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>



<script src="<?php  echo BASEPATH ?>js/cbpFWTabs.js"></script>
      <script src="<?php echo PATH; ?>js/acciones/customTrasladoBloqueMercancia.js"></script>



<script src="<?php  echo BASEPATH ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>