<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/provedores/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();
$consultaProvedor = new consultaProvedores();
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
$paginaActual=provedor;
$breadcrumb = array(0 => provedor, 1=> listaProvedores);
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
        <div class="col-md-12">
          <h3> <i class="fa fa-list"></i><?php echo listaProvedores; ?></h3>
          <label for="q" class="col-md-3 control-label">¿Cuál provedor buscas?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="q" placeholder="Nombre del provedor o nit" onkeyup='load(1);'>
              </div>
        </div>
        <div class="col-md-12" id="loader"></div>
         
      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

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

<!-- JS PLUGINGS-->
  <!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo PATH ?>js/acciones/customListaProvedores.js" type="text/javascript" charset="utf-8" async defer></script>


<script>
    
    
  </script>
  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->


</body>
</html>
