<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=productosServicios;
$breadcrumb = array(0 => productosServicios, 1=>listaProductosServicios );
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

<link href="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />


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
        <div class="col-md-12 col-lg-12 col-sm-12 white-box">
  

            <div class="col-md-12">
              <div class="col-md-12">
                <div class="col-md-8">
                  <label for="q" class="col-md-12 control-label">¿Qué producto búscas?</label>
                  <input type="text" class="form-control" id="queryBusqueda" placeholder="Dime el nombre del producto o codigo" onkeyup='listaProductos(1);'>
                </div>
                <div class="col-md-4">
                   <div class="col-md-6">
                        <!-- CATEGORIA-->
                      <label for="categories" class="col-md-12 control-label">Categoria</label>
                          <select id="categories" class="form-control" >
                          </select>
                        <!-- FIN DE CATEGORIA-->
                      </div>
                      <div class="col-md-6">
                        <label for="subCategories" class="col-md-12 control-label">SubCategoria</label>
                          <select id="subCategories" class="form-control" ></select>
                      </div>
            </div>  
  <hr>

                </div>
                
              

            </div>

             

          <div id="listaProductosServicios"></div>
          

        </div>


      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>

<script src="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo PATH; ?>js/acciones/listaProductosServicios.js" type="text/javascript" charset="utf-8" async defer></script>



<!-- JS PLUGINGS-->
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>