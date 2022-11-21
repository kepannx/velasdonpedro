<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/inventarios/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();
$consultaInventario = new consultaInventarios();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
$paginaActual='Seriales e Imeis';
$breadcrumb = array(0 => 'Seriales e Imeis');
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
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

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
         <div class="col-md-12  col-sm-12 col-xs-12">
           <div class="col-sm-12 col-md-6">
             <h3> <i class="fa fa-sitemap"></i> PANEL DE SERIALES E IMEIS </h3>
           </div>
           <div class="col-sm-12 col-md-6" align="right">
           </div>
          <div class="col-md-12">
              <!-- listado -->
              
             <h2>Seriales Disponibles</h2>
                        <div class="col-md-12">
                        <label for="q" class="col-md-3 control-label">¿Cuál Serial Buscas?</label>
                          <input type="text" class="form-control" id="serial" placeholder="Escribe el serial o imei que necesitas" onkeyup='loadIndexacion(1);'>
                        </div>


                        <div id="listadoSerialesDisponibles"></div>




              <!-- Fin del listado -->
          </div>

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
  <!-- TABLAS-->
<script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASEPATH; ?>js/cbpFWTabs.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>
<script src="<?php echo PATH ?>js/acciones/validaciones.js"></script>
<script src="<?php echo PATH; ?>js/acciones/customSerialesImeis.js"></script>


  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->


</body>
</html>
