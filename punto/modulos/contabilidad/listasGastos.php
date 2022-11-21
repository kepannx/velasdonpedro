<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=gastos;
$breadcrumb = array(0 => gastos);
/*
$consultaComun->datosUsuario($_SESSION['datos']);
*/
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
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

      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="col-md-12">
            <h3><i class="fa fa-list-alt"></i> <?php echo listaGastos; ?></h3>
          </div>
          <div class="col-sm-12 col-md-8">
            
          </div>
          <div class="col-sm-12 col-md-4" align="right">
            <button type="button" class="btn btn btn-info col-md-12 col-sm-12 col-xs-12" data-toggle="modal" data-target="#registrarGasto">
              <i class="fa fa-file" ></i> Nuevo Gasto/Egreso
            </button>

          </div>
        </div>
          <div class="col-md-12">
            <div id="listaGastosDia"></div>
           <div id="listaGastosRangoFechas"></div>
          </div>
          
      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
        require "../../data/comunes/footer.php";
        require '../../../login/allow/data/comunes/modal/contabilidad/registrarGasto.php';

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
<script src="<?php echo PATH ?>js/guardar/guardarEgresoGastos.js"></script>
<script src="<?php echo PATH ?>js/acciones/listas/listaEgresosGastos.js"></script>
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>