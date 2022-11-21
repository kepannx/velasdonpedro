<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require '../../data/libreria.lib/70/libreria.class.php';
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=recetasyproductos;
$breadcrumb = array(0 => recetasyproductos, 1=> detalleProducto);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>

<!-- Pluging AutoCompletar-->
  <!-- CSS-->
<link href="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

  <!-- CSS PLUGIN switchery -->
<link href="<?php echo BASEPATH; ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH; ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />


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
      <div class="row bg-title">
        <?php 
         require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->
    
      <div class="row white-box">

        <div id="mostrar" style="display:none;"><input type="checkbox" id="myCheckbox" checked="checked" /> Factura Cruzada</div>
         <div class="col-md-12  col-sm-12 col-xs-12">
            <?php
              require '../../data/comunes/formularios/inventario/datosBasicosIngresoInventario.php';
              require '../../data/comunes/formularios/inventario/ingresoLotes.php';
            ?>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
            <input type="hidden" id="token" value="<?php echo strtotime(date('Y-m-d H:i:s')) ?>">
        </div>
      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require "../../data/comunes/modal/bodegasInventario/loadSerialesImeis.html";

      require "../../data/comunes/modal/bodegasInventario/serialsImeis.html";
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

  <!-- swich-->
  <!-- Fin Swich-->
   <!-- TYPEHEAD-->
      <script src="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

      <script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
      <script src="<?php echo BASEPATH; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>



      <script src="<?php echo PATH; ?>js/custom.js"></script>
      <script src="<?php echo PATH; ?>js/acciones/checkProvedoresId.js" type="text/javascript" charset="utf-8" async defer></script>

      <script src="<?php echo PATH; ?>js/acciones/customFacturacionProvedores.js"></script>

     
  <!-- FIN TYPEHEAD-->

  <script>


  // Date Picker
      
  </script>
<!-- FIN PLUGIN JS-->


</body>
</html>
