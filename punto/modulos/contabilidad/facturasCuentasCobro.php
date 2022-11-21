<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=contabilidad;
$breadcrumb = array(0 => contabilidad, 1=> tusFacturas);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
?>
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
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
      <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="col-md-12">
            <h3><i class="fa fa-list-alt"></i> <?php echo tusFacturas; ?> del <span id="fechaFactura"><?php echo date('Y-m-d'); ?></span> </h3>
          </div>
          <!-- RÁNGO DE FECHAS-->
          <div class="col-sm-12 col-md-8">
              <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-calender"></i>Busca En Rango de Fechas</span>
                    <input type="text" class="form-control input-daterange-datepicker" id="fechaFiltro" placeholder="<?php echo date('m/d/Y'); ?> " value="<?php echo date('m/d/Y'); ?>-<?php echo date('m/d/Y'); ?>" readonly />
                                  <button type="button" id="filtrar" class="btn btn-info col-md-12"><i class="fa fa-filter"></i> Filtrame Este Rángo</button>

                </div>
            </div>

          </div>
          <!---FIN DEL RÁNGO -->

          <div class="col-sm-12 col-md-4" align="right">
            <button type="button" class="btn btn btn-info col-md-12 col-sm-12 col-xs-12" data-toggle="modal" data-target="#busquedaAvanzada">
              <i class="fa fa-search" ></i>Búsqueda Avanzada
            </button>
          </div>
        
        </div>
      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div id="listaFacturasDia"></div>
        </div>


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
<!-- BASE LIBRERIAS -->
<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!--FIN DE LA BASE. DE LAS LIBRERÍAS-->
<!--<script src="<?php echo PATH ?>js/acciones/listas/listaFacturasDia.js"></script> -->
<script src="<?php echo PATH ?>/js/acciones/customFacturasListas.js"></script>

<!-- JS PLUGINGS-->
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>