<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/provedores/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$ingresoProvedores= new ingresoProvedores();
//$ingresarInventario=new ingresoInventarios();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=provedor;
$breadcrumb = array(0 => provedor, 1=> nuevoProvedor);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">


<!-- FIN CSS PLUGIN SWEET ALERT -->


<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

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
    
      <div class="row">
        <?php
        require("../../data/comunes/formularios/provedores/datosProvedor.php");
        
        ?>
        
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

<script src="<?php echo PATH ?>js/guardar/guardarProvedor.js" type="text/javascript" charset="utf-8" async defer></script>



<!-- PLUGINGS-->

    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    
  <!-- JQUERYS --> 
  <script>


  </script>
  <!-- FIN JQUERY-->

   
<!-- FIN PLUGINS-->

</body>
</html>
