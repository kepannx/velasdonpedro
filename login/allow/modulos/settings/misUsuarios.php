<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/provedores/libreria.clases.php');
require '../../data/libreria.lib/70/libreria.class.php';

$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();
$consulta=new queryAjax();

$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
$paginaActual=listaUsuarios;
$breadcrumb = array(0 => usuarios, 1=> listaUsuarios);
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
        <div class="col-md-6">
            <h1><i class="fa fa-list"></i> <?php echo listaUsuarios; ?></h1>
        </div>
        <div class="col-md-6" align="right">

          <?php 

          ?>
          

          <?php

              if (($consultaComun->checkNumeroUsuarios())>=($consultaComun->datospagina(12))) {
                # code...
                echo ' <div class="alert alert-success"> <i class="fa fa-frown-o"></i>  Tu paquete de renta actual no me deja crear mas usuarios </div>';

              }
              else
              {
                echo '<button class="btn btn-success waves-effect waves-light"  type="button" data-toggle="modal" data-target="#creacionUsuarios"><span class="btn-label"><i class="fa fa-user"></i></span>Crear Nuevo Usuario</button>';
              }
           ?>
        </div>



         <div class="col-md-12  col-sm-12 col-xs-12">
            <?php
                $consultaComun->listaMisUsuarios();
            ?>
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
<?php

if ($consultaComun->checkNumeroUsuarios()<$consultaComun->datospagina(12)) {
  require("../../data/comunes/modal/settings/crearUsuario.php"); 
?>
  <script src="<?php echo PATH ?>js/guardar/nuevoUsuario.js" type="text/javascript" charset="utf-8" async defer></script>
  <script src="<?php echo BASEPATH ?>js/validator.js"></script>
    <!-- sweer alerts-->
  <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>


<?php }

?>

  <script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
      $('#tablaProvedores').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          
          "drawCallback": function ( settings ) {
            var api = this.api();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

              }
            } );
          }
        } );
  });
    });
    
  </script>
  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->


</body>
</html>
