<?php 
require('../../data/libreria.lib/libreria.clases.php');//Clases normales basicas.
require('../../data/libreria.lib/productos/libreria.clases.php'); //Llamo las clases  para productos
require('../../data/libreria.lib/inventarios/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require '../../data/libreria.lib/70/libreria.class.php';

$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();

$consultasAjax = new queryAjax();
///selectVendedores
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
//Los fetch para las consultas
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=inventarios;
$breadcrumb = array(0 => inventarios, 1=> historialTraslados);
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

<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">




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
             <h2 > <i class="fa fa-arrow-both"></i>Traslado de Mercancía e Historicos</h2>
          <!--DATOS DEL TRASLADO -->
            

          

        <!-- -->
        <div class="col-md-12">
            <div class="col-md-4">
              <label class="col-md-8 control-label">Origen del Traslado</label>
                <div class="col-md-4" id="origenTraslado"></div>
            </div>

            <div class="col-md-4">
              <label class="col-md-8 control-label">Destino Traslado</label>
                <div class="col-md-4" id="destinoTraslado"></div>
            </div>


            <div class="col-md-4">
              <label class="col-md-5 control-label">Fecha Traslado</label>
                <div class="col-md-7" id="fechaTraslado"></div>
            </div>

        </div>

        




          <!-- FIN DE LOS DATOS DEL TRASLADO-->
          
          <!-- LISTA DE LOS PRODUCTOS TRASLADADOS-->

          <div class="col-md-12">
            <h3 align="center"><i class="fa fa-list"></i> Lista de Productos Trasladados</h3>
            <div id="listaProductosTrasladados"></div>
          </div>
          <!-- FIN DE LA LISTA DE LOS PRODUCTOS TRASLADADOS-->

            <input type="hidden" id="id" value="<?php echo $id; ?>">
            <input type="hidden" id="parametro" value="<?php echo $f; ?>">
        </div>
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
 <!-- Invoice-->


  <!--fin invoice -->


   <!-- TYPEEAD-->
      <script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
      <script src="<?php echo BASEPATH; ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo PATH; ?>js/acciones/customHojaTrasladoMercancia.js"></script>


      <!--
     

<!-- FIN PLUGIN JS-->


</body>
</html>
