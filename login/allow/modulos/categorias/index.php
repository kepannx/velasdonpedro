<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/inventarios/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);
$consultaComun=new consultasComunes();
$consultaInventario = new consultaInventarios();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=categorias;
$breadcrumb = array(0 => categorias);
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
             <h3> <i class="fa fa-sitemap"></i> <?php echo categorias; ?> </h3>
           </div>
           <div class="col-sm-12 col-md-6" align="right">
              <button type="button" class="btn btn-info" alt="default" data-toggle="modal" data-target=".modalCategoria"> 
                  <i class="fa fa-plus"></i> Agregar Otra Categoría </button>
           </div>
          <div class="col-md-12">
              <!-- listado -->
              <div class="row">
                <div id="listaCategorias"></div>
              </div>
              <!-- Fin del listado -->
          </div>
          <input type="hidden" id="id" value="<?php echo $id ?>">

        </div>
      </div>
   
      <!-- Fin del cuerpo-->
   
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require '../../data/comunes/modal/categorias/nuevaCategoria.html';
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
<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>
<script src="<?php echo PATH ?>js/acciones/validaciones.js"></script>

<script src="<?php echo PATH ?>js/acciones/loadCategorias.js"></script>
<script src="<?php echo PATH ?>js/acciones/customCategorias.js"></script>

<script src="<?php echo PATH ?>js/guardar/guardarCategorias.js"></script>
<script src="<?php echo PATH ?>js/acciones/listaCategoriasSubcategorias.js"></script>

<script>

  //
   $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
</script>
  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->


</body>
</html>
