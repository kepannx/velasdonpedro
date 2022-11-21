<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
$datos=$_REQUEST;
extract($datos);
$validar=new validar();

require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require('../../data/libreria.lib/inventarios/libreria.clases.php');
require '../../data/libreria.lib/70/libreria.class.php';
$validar->validando();


$objHtm=new objetosHtml();

$consultaComun=new consultasComunes();
$consultaInventario=new consultaInventarios();


//Aqui viene el condicional para saber si es empleado del convenio o  es administrador

//Los fetch para las consultas
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
<link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
  <!-- FIN CSS-->

  <!-- CSS PLUGIN switchery -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<link href="<?php echo BASEPATH ?>plugins/bower_components/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

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
         <div class="col-md-12  col-sm-12 col-xs-12">
            <?php
              require '../../data/comunes/formularios/productos/informacionBaseProducto.php';
            ?>
            
        </div>

        <div class="col-md-12" align="center">
              <button type="submit" class="btn btn-success" id="confirmarGuardarItem"
                  data-toggle="modal" data-target="#confirmacionNuevoProductoServicio" ><i class="fa fa-save"></i> Guardame Este Item</button>
        </div>


      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require "../../data/comunes/modal/confirmaciones/confirmacionNuevoProductoServicio.html";

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

  <!--Librerías Base-->
      <script src="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js"></script>

      <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo BASEPATH ?>js/validator.js"></script>
      <script type="text/javascript" src="<?php echo BASEPATH ?>plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
      <script src="<?php echo PATH ?>js/acciones/validaciones.js"></script>
      <script src="<?php echo PATH ?>js/custom.js"></script>
      <script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>

  
  <!-- Fin Librerías Base -->
  <!-- Librerias  -->
  <script src="<?php echo PATH ?>js/customProductosServicios.js"></script>
  <script src="<?php echo PATH ?>js/acciones/confirmacionProductoServicios.js"></script>
  <script src="<?php echo PATH ?>js/guardar/guardarServicioProducto.js"></script>
  <!--Fin Librerías -->



<script>
  //$('#ventaCruzada').multiSelect(); 
  $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
</script>
<!-- FIN PLUGIN JS-->


</body>
</html>