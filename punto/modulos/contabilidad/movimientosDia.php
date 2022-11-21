  <?php
extract($_REQUEST);
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$paginaActual=contabilidad;
$breadcrumb = array(0 => contabilidad, 1=>movimientoDia );
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
require_once "../../data/comunes/headercode.php";
?>

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
      <div class="row white-box">

      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12">
          

          <div class="col-md-12">
            <h3> <i class="fa  fa-book"></i><?php echo movimientoDia; ?></h3>
          </div>


          <div class="col-xs-12 col-sm-12 col-md-6">
            <h4 align="center"><i class="fa fa-check-circle"></i> Facturación </h4>
            <div id="listaFacturasDia"></div>
          </div>
          
          <!-- EGRESOS Y GASTOS-->
          <div class="col-xs-12 col-sm-12 col-md-6">
             <h4 align="center"><i class="ti-ticket"></i> Egresos y Gastos </h4> 
             <div id="listaGastosDia"></div>
          </div>
          <!-- FIN DE LOS EGRESOS Y LOS GASTOS-->
    
          <!--TOTALES -->
          <div class="col-md-12" style="margin-top: 20px;">
            <h1 class="text text-success" align="center">Consolidado</h1>
            

            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-success">
              <h5>Ventas En Efectivo</h5>
              <h2><i class="fa fa-money"></i><div id="totalEfectivo"></div> </h2>
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-info">
              <h5>Ventas Con Transacciones</h5>
              <h2><i class="fa fa-bank"></i><div id="totalTransacciones"></div> </h2>
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-danger">
              <h5>Total en Egresos</h5>
              <h2><i class="fa fa-bank"></i><div id="totalEgresos"></div> </h2>
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 btn btn-warning">
              <h5>Cuentas por Cobrar</h5>
                    
              <h2><i class="ti-wallet"></i><div id="cxc"></div></h2>
            </div>
           



            <div class="col-xs-12 col-sm-12 col-md-12 btn btn-default">
              
               <h5>Deberías Tener </h5>
              <h2><i class="fa fa-star"></i><div id="granTotalGlobal"></div></h2>
            </div>


           


          <?php
              if (isset($fechaFiltro)) {
                # Me recoje la fecha filtro para poder sacar los valores del movimiento del dia que estoy buscando.
                echo '<input type="hidden" id="fechas" value="'.$fechaFiltro.'"">';
              }
          ?>            
          </div>



          <!-- FIN DE TOTALES-->
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
<!-- JS PLUGINGS-->
<script src="<?php echo PATH ?>js/acciones/listas/listaFacturasDia.js"></script>
<script src="<?php echo PATH ?>js/acciones/listas/listaEgresosGastos.js"></script>
<script src="<?php echo PATH ?>js/acciones/customMovimientos.js"></script>


<script type="text/javascript">
        
</script>
<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>