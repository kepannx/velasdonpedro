<?php 
require('data/libreria.lib/libreria.clases.php');
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require 'data/libreria.lib/70/libreria.class.php';
require('data/libreria.lib/inventarios/libreria.clases.php');
require('data/libreria.lib/contabilidad/libreria.clases.php');
$consultaComun=new consultasComunes();
$consultaInventario=new consultaInventarios();
$ingresarContabilidad=new ingresoContabilidad();
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
$paginaActual=index;
$breadcrumb = array(0 => index );
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("data/comunes/headercode.php");
?>

<!-- CSS PLUGIN TABLAS-->
<link href="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- FIN CSS PLUGIN TABLAS-->

<!-- CSS PLUGIN sweet alert -->
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">


</head>



<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require("data/comunes/headerMenu.php");
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require("data/comunes/menuLateral.php");
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
         require("data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      


      
      <!-- Widgets--> 
      <div class="row">


      <!-- Indicador Ventas del Día -->

      <a href="<?php echo PATH ?>/modulos/puntosVenta/lista.php">
        <div class="col-md-4 col-lg-4 col-sm-12">
          <div class="white-box">
           <h3 class="box-title">Disponible En Efectivo</h3>
               <ul class="list-inline two-part">
                  <li style="width: 50px;" ><i class="fa fa-dollar text-info" ></i></li>
                  <li class="text-right" style="width: 50px;" ><span class="counter" style="font-size: 40px;" id="disponibilidadEfectivo"></span></li>
              </ul>
          </div>
        </div>
      </a>
      <!-- Fin Indicador Ventas del Día -->



      <!-- Indicador Créditos del Día -->
        <div class="col-md-4 col-lg-4 col-sm-12">
          <div class="white-box" id="creditosDia">
            <?php 
                require("data/comunes/widgets/creditosDiaActual.php");
            ?>
          </div>
        </div>
      <!-- Fin Indicador Créditos del Día -->


      <!-- Indicador Alertas Inventario -->
        <div class="col-md-4 col-lg-4 col-sm-12">
          <div class="white-box">
            <?php 
                require("data/comunes/widgets/alertaInventario.php");
            ?>
          </div>
        </div>
      <!-- Fin Indicador Alertas Inventario-->

      </div>


      <!-- Fin de Widgets-->





    <!--Lista Ventas Del Dia-->
      <div class="row">
        <div class="col-md-12  col-sm-12 col-xs-12" >
        
              <div class="white-box">
                <div class="table-responsive">
                <h1><i class="fa fa-list"></i> Lista de las ventas de hoy </h1>
                  <div id="listaFacturasTodosLosPuntos"></div>
                </div>
              </div>

        </div>
        
      </div>
    <!-- Fin Lista Ventas Del Dia-->


      <!-- Fin del cuerpo-->






      
    </div>
    <!-- /.container-fluid -->

    <?php 
       require("data/comunes/footer.php");
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->

<!-- Aperturas de Caja-->
<?php 
//Links de librerias js 
require("data/comunes/js.php");
?>
  <script src="<?php echo PATH; ?>js/acciones/customIndex.js"></script>

<!-- JS PLUGINGS-->
  <!-- TABLAS-->
  <script src="<?php echo BASEPATH ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

  <!-- sweer alerts-->
  
  <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>




  </script>

  <!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>
