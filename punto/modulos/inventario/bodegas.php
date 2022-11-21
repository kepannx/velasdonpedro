<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=inventario;
$breadcrumb = array(0 => inventario, 1=>listadoBodegas );

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
      <div class="row">

      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="white-box">
            


              <div class="col-md-12">
                  <div class="col-md-6"> <h3><i class="fa fa-list"></i> <?php echo listadoBodegas; ?></h3>
              </div>
              <div class="col-md-6">
                  <button type="button" class="btn btn-success col-md-12" data-toggle="modal" data-target="#crearBodegas">
                      <i class="fa fa-file"></i> Crear Nueva Bodega
                  </button>
              </div>
            </div>
            
            <!-- LISTA DE LAS BODEGAS -->
            <div id="listadoBodegas"></div>

          </div>
        </div>


      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
       require '../../data/comunes/modal/bodegasInventario/crearBodega.php'
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<script src="<?php echo PATH; ?>js/acciones/listaBodegas.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo PATH; ?>js/guardar/guardarBodega.js" type="text/javascript" charset="utf-8" async defer></script>

<!-- JS PLUGINGS-->
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>